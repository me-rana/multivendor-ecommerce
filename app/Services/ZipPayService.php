<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZipPayService
{
    protected $publicKey;
    protected $secretKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->publicKey = env('ZIPPAY_SANDBOX_PUBLIC_KEY');
        $this->secretKey = env('ZIPPAY_SANDBOX_SECRET_KEY');
        $this->apiUrl = env('ZIPPAY_SANDBOX_API_URL');
    }

    public function createPaymentRequest($amount, $currency, $description, $customerEmail)
    {
        $response = Http::withBasicAuth($this->publicKey, $this->secretKey)
            ->post($this->apiUrl . '/payment_requests', [
                'amount' => $amount,
                'currency' => $currency,
                'description' => $description,
                'customer' => [
                    'email' => $customerEmail,
                ],
                'reference' => uniqid(), // Unique reference for your transaction
            ]);

        return $response->json();
    }
}
