<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use Illuminate\Support\Facades\Validator;  
use Mail;
use Stripe;

class PaymentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }


    // public function stripeCheckout(Request $request) {
        
    //     $rules = [
    //         'name' => 'required',
    //         'card_number' => 'required|min:16',
    //         'expiry_month' => 'required|min:2',
    //         'expiry_year' => 'required|min:2',
    //         'cvv' => 'required|min:3',
    //     ];

        
    //     $validator = Validator::make($request->all(), $rules);
        
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'errors' => $validator->errors()
    //         ], 422); // 422 is the status code for validation errors
    //     }
    //     $userMail = Auth::user()->email;
        
    //     $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));

    // }

    public function stripeCheckout(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';

        $response = $stripe->checkout->sessions->create([
            'success_url' => $redirectUrl,

            // 'customer_email' => 'demo@gmail.com',

            'payment_method_types' => ['card'],

            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => 'Test ',
                        ],
                        'unit_amount' => 100 * 5,
                        'currency' => 'USD',
                    ],
                    'quantity' => 1
                ],
            ],

            'mode' => 'payment',
            'allow_promotion_codes' => true,
            
        ]);

        return redirect($response['url']);
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $response = $stripe->checkout->sessions->retrieve($request->session_id);

        dd($response);
        return redirect()->route('stripe.index')->with('success','Payment successful.');
    }
}
