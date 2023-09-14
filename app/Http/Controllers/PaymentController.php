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
        $userDetailsJson = request()->cookie('user_details');
        $userDetails = json_decode($userDetailsJson, true);
        if ($userDetails) {
            $name = $userDetails['name'];
            $email = $userDetails['email'];
            $image = $userDetails['image'];
    
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    
            $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';
    
    
            $response = $stripe->checkout->sessions->create([
                'success_url' => $redirectUrl,
    
                'customer_email' => $email,
                
    
                'payment_method_types' => ['card'],
    
                'line_items' => [
                    [
                        'price_data' => [
                            'product_data' => [
                                'name' => 'Online Passport Image',
                                'images' => [$image],
                            ],
                            'unit_amount' => 100 * 5,
                            'currency' => 'USD',
                        ],
                        'quantity' => 1
                    ],
                ],
    
                'mode' => 'payment',
                // 'allow_promotion_codes' => true,
                'customer_email' => $email,
                'client_reference_id' => $name,
            ]);
    
            return redirect($response['url']);
        } else {
            return redirect('/');
        }

        
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $response = $stripe->checkout->sessions->retrieve($request->session_id);

        if ($response->payment_status === 'paid') {
            $transactionId = $response->payment_intent;
            
            // Send a simple confirmation email
            $userDetailsJson = request()->cookie('user_details');
            $userDetails = json_decode($userDetailsJson, true);
            if (!$userDetails) {
                echo "No Data Found.";
            }
    
            $name = $userDetails['name'];
            $email = $userDetails['email'];
            $image = $userDetails['image'];


            $message = "Hi $name,\n\nYour payment was successfully processed. Your order/transaction ID is: $transactionId.\n\nThank you for your purchase!\n\nSincerely,\nHounslaw.";

            Mail::raw($message, function ($message) use ($email, $image) {
                $message->to($email)
                        ->subject('Payment Confirmation')
                        ->attach($image);
            });

            return redirect()->route('thank-you')->with('transactionId',$transactionId);

        }
    }
}
