<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;  
use App\Models\Country;
use App\Models\DocumentType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class MainController extends Controller
{
    public function index() {

        $countries = Country::all();

        return view('main.index',compact('countries'));
    }

    public function details(Request $request) {

        // dd($request->all());
        $rules = [
            'country' => 'required',
            'document_type' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // 'address' => 'required|string',
            // 'city' => 'required|string|max:255',
            // 'post_code' => 'required|string|max:10', 
            // 'image' => 'required',
        ];

        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $data = $request->all();
        // dd($data);
        $imageData = $data['image'];
        $imageBinaryData = base64_decode($imageData);

        $fileName = 'image_' . time() . '.jpg';
        Storage::disk('public')->put($fileName, $imageBinaryData);

        $filePath = '/public/' . $fileName;
        // $fileUrl = Storage::url($filePath);
        $baseUrl = URL::to('/storage/app');

        $fullUrl = $baseUrl . $filePath;
        $data['image_url'] = $fullUrl;

        unset($data['_token']);
        unset($data['image']);
        unset($data['image_upload']);

        // session(['user_details' => $data]);
        
        $dataJson = json_encode($data);

        // Store the JSON string as a cookie
        Cookie::queue('user_details', $dataJson, 60);

        return view('main.details',compact('data'));
    }

    public function getDocTypes($code) {
        
        $data = DocumentType::where('country_code',$code)->get();
        if($data) {
            return response()->json([
                'success' => true,
                'data' => $data,
                'code' => 200,
                'message'=> 'Data found',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'code' => 404,
                'message'=> 'Data not found',

            ]);
        }
        
    }

    public function thankYou(){
        

        return view('main.thank-you');

        
    }

    public function documentSize($code) {

        $data = DocumentType::where('doc_code',$code)->first();

        if($data) {
            return response()->json([
                'success' => true,
                'data' => $data,
                'code' => 200,
                'message'=> 'Data found',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'code' => 404,
                'message'=> 'Data not found',

            ]);
        }
    }
    
    public function downloadImage(Request $request) {
        
        $imageDataUrl = $request->image;
        $imageBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageDataUrl));
    
        $fileName = 'image_download_' . time() . '.jpg';
        $filePath = storage_path('app/public/' . $fileName);

        $image = imagecreatefromstring($imageBinary);
    
        $newDPI = 300;
        imageresolution($image, $newDPI, $newDPI);
        imagejpeg($image, $filePath, 100);
        imagedestroy($image);

        return response()->download($filePath, $fileName);
    }
    

    public function saveImageSession(Request $request) {
        
        $imageDataUrl = $request->image;
        $imageBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageDataUrl));


        $fileName = 'image_' . time() . '.jpg';
        $filePath = storage_path('app/public/' . $fileName);

        $image = imagecreatefromstring($imageBinary);
    
        $newDPI = 300;
        imageresolution($image, $newDPI, $newDPI);
        imagejpeg($image, $filePath, 100);
        imagedestroy($image);

        $imageUrl = asset('storage/app/public/' . $fileName);


        // $fileName = 'image_edited_' . time() . '.jpg';
        // Storage::disk('public')->put($fileName, $imageBinary);

        // $filePath = '/public/' . $fileName;
        // // $fileUrl = Storage::url($filePath);
        // $baseUrl = URL::to('/storage/app');

        // $fullUrl = $baseUrl . $filePath;

        // $userDetails = session('user_details');
        $userDetailsJson = request()->cookie('user_details');
        $userDetails = json_decode($userDetailsJson, true);
        if (!$userDetails) {
            return response()->json(['message' => 'data not found.']);
        }

        $userDetails['image'] = $imageUrl;
        // $userDetails['delivery_option_val'] = $request->delivery_option_val;
        // $userDetails['delivery_option_text'] = $request->delivery_option_text;

        $updatedUserDetailsJson = json_encode($userDetails);
        Cookie::queue('user_details', $updatedUserDetailsJson,60);
        // session(['user_data' => $userDetails]);

        $redirectUrl = route('choose-payment');

        return response()->json(['message' => 'Session data updated successfully.','redirect_url' => $redirectUrl]);
        
    }

}
