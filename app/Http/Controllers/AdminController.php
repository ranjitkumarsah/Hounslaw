<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\Country;
use App\Models\DocumentType;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index() {
        
        $countries = Country::all();

        return view('Admin.index',compact('countries'));
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

    public function documentSizeUpdate($id, Request $request) {
        
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'document_width' => 'required',
            'document_height' => 'required',
        ]);
    
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }


        $document = DocumentType::findOrFail($id);

        $document->update([
            'width' => $request->input('document_width'),
            'height' => $request->input('document_height'),
            
        ]);

        return response()->json(['message' => 'Document Type updated successfully']);
    }
}
