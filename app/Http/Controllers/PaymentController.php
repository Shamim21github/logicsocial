<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;

class PaymentController extends Controller
{
    //displaying the payment form to the user,  $publishableKey is used to initialize the Stripe Checkout on the frontend
    public function index(){
        $publishableKey = "pk_test_51MjFUqCFTGXHnhNX6lqIxq9Cizw7M7uU5tjKkbqDF77I9OnfL3a0YUrhOul3FATFFKG7wiFurYYUwXCN972rBluV00ornZH0M7";
        return view('pages.erp.stripe.form')->with('publishableKey',$publishableKey);
      
    }

    //triggered when the payment form is submitted. It handles the payment process using the Stripe API.$request object contains the form data submitted by the user 
    public function submitPayment(Request $request)
    {
        $secretKey = "sk_test_51MjFUqCFTGXHnhNXSPX9VPTsAAaGE1avS41t1TvGYgOoZC6kOfMU44iGQcum15nDxNec90I4faK2S42FpiXblv3X00RnceLNim";
        Stripe::setApiKey($secretKey);
        $token = $request->input('stripeToken');
        //Stripe::setApiKey($secretKey) sets the secret key for the Stripe PHP SDK, allowing the SDK to interact with Stripe servers

        try {
            $charge = \Stripe\Charge::create([
                'amount' => 100,
                'currency' => 'USD',
                'description' => 'Payment description',
                'source' => $token,

            ]);
            

            // Payment successful, handle the success scenario here
            return view('pages.erp.stripe.submit', ['message' => 'Payment successful!']);
        } catch (\Exception $e) {
        // Payment failed, handle the error scenario here
        return view('pages.erp.stripe.submit', ['message' => 'Payment failed. Please try again later.']);
        }
    }
}
