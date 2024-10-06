<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AfterpayService
{
    protected $merchantId;
    protected $secretKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->merchantId = env('AFTERPAY_MERCHANT_ID');
        $this->secretKey = env('AFTERPAY_SECRET_KEY');
        $this->apiUrl = env('AFTERPAY_API_URL');
    }

    public function createPaymentRequest($amount, $currency, $description, $returnUrl, $cancelUrl)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->merchantId . ':' . $this->secretKey),
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl . '/payments', [
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'returnUrl' => $returnUrl,
            'cancelUrl' => $cancelUrl,
        ]);

        return $response->json();
    }

    public function getPaymentStatus($paymentId)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->merchantId . ':' . $this->secretKey),
        ])->get($this->apiUrl . "/payments/{$paymentId}");

        return $response->json();
    }
}
