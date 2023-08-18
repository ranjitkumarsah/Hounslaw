<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userDetailsJson = request()->cookie('user_details');
        
        if(Auth::user()->is_admin ==1) {
            return redirect()->route('admin.home');
        } 
        else {
            if ($userDetailsJson) {

                $userDetails = json_decode($userDetailsJson, true);
    
                // Update user details
                $user = Auth::user();
                $user->country = $userDetails['country_text'];
                $user->address = $userDetails['address'];
                $user->city = $userDetails['city'];
                $user->postal_code = $userDetails['post_code'];
                $user->save();
    
                return redirect()->route('choose-payment');
            }
            
            return view('home');
        }
       
    }
    
    public function choosePayment(Request $request)  {

        $userDetailsJson = request()->cookie('user_details');

        if ($userDetailsJson) {

            $userDetails = json_decode($userDetailsJson, true);

            // Save document
            $document = new Document();
            $document->user_id = Auth::user()->id;
            $document->country_code =  $userDetails['country'];
            $document->document_type_id = $userDetails['document_type'];
            $document->image = $userDetails['image'];
            $document->delivery_option = $userDetails['delivery_option_text'];
            $document->delivery_option_val = $userDetails['delivery_option_val'];
            // $document->save();
            if($userDetails['delivery_option_val'] == 1 || $userDetails['delivery_option_val'] == 3) {

                $userDetails['payment_value'] = ' £5.99';

            } elseif ($userDetails['delivery_option_val'] == 2) {

                $userDetails['payment_value'] =   '£7.50';
            }
        }

        return view('main.payment_page',compact('userDetails'));
    }
}
