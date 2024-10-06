<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    //Paypal Started----------------------------------------------------------------------------------->
    public function createPayment(Request $request)
    {

        
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setAccessToken($provider->getAccessToken());

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "AUD",
                        "value" => Session::get('paypal')['total'],
                    ],
                    "description" => "Payment Description",
                ]
            ],
            "application_context" => [
                "return_url" => url('paypal/payment/execute'),
                "cancel_url" => url('paypal/payment/cancel'),
            ]
        ]);

        $order = Order::where('order_id',Session::get('paypal')['order_id'])->update([
            'transaction_id' => $response['id'],
        ]);
        
        // Check the response
        if (isset($response['id']) && isset($response['links'])) {
            // Redirect to PayPal for approval
            $approvalLink = collect($response['links'])->firstWhere('rel', 'approve')['href'] ?? null;
        
            if ($approvalLink) {
                return redirect($approvalLink);
            } else {
                // Handle missing approval link
                dd('Approval link not found', $response);
            }
        } else {
            // Handle error or unexpected response
            dd('Error:', $response);
        }
    }

    public function executePayment(Request $request)
{

 
    $provider = new PayPalClient;

    // Set API credentials
    $provider->setApiCredentials(config('paypal'));

    // Retrieve the access token
    $provider->setAccessToken($provider->getAccessToken());

    // Retrieve token and PayerID from the request
    $token = $request->input('token');
    $payerId = $request->input('PayerID');

    // Use the token to get the payment details
    $response = $provider->showOrderDetails($token);

    // Check the response and capture the payment if needed
    if (isset($response['id']) && $response['status'] === 'APPROVED') {
        // Capture payment if it's not yet captured
        $order = Order::where('transaction_id',$response['id'])->first();
        $invoice = $order->invoice;
        $order->update([
            'pay_staus' => 1,
        ]);
        return view('frontend.order.order-success',compact('invoice'));
    }

    return "Payment failed!";
}

}
