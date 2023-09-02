<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use Illuminate\Support\Facades\Validator;  
use Mail;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }


    public function stripeCheckout(Request $request) {
        
        $rules = [
            'name' => 'required',
            'card_number' => 'required|min:16',
            'expiry_month' => 'required|min:2',
            'expiry_year' => 'required|min:2',
            'cvv' => 'required|min:3',
        ];

        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // 422 is the status code for validation errors
        }
        $userMail = Auth::user()->email;
        
        $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));

    }
}
