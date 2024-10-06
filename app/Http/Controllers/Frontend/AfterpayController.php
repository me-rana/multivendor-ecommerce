<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AfterpayService;

class AfterpayController extends Controller
{
    //
    protected $afterpayService;

    public function __construct(AfterpayService $afterpayService)
    {
        $this->afterpayService = $afterpayService;
    }

    public function createPayment(Request $request)
    {
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $description = $request->input('description');
        $returnUrl = route('payment.return');
        $cancelUrl = route('payment.cancel');

        $response = $this->afterpayService->createPaymentRequest($amount, $currency, $description, $returnUrl, $cancelUrl);

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], 400);
        }

        return response()->json(['payment_url' => $response['paymentUrl']], 200);
    }

    public function paymentReturn(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $response = $this->afterpayService->getPaymentStatus($paymentId);

        // Handle payment confirmation or failure here
        return view('payment.return', ['response' => $response]);
    }

    public function paymentCancel()
    {
        // Handle payment cancellation here
        return view('payment.cancel');
    }
}
