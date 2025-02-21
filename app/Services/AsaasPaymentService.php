<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Facades\Http;

class AsaasPaymentService
{

    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('ASAAS_API_KEY');
        $this->baseUrl = env('ASAAS_BASE_URL');
    }

    public function processPayment(array $data)
    {
        $customer = $this->createCustomer([
            'name' => $data['customer_name'],
            'email' => $data['customer_email'],
            'cpfCnpj' => $data['customer_cpf'],
        ]);

        $paymentData = [
            'customer' => $customer['id'],
            'billingType' => $this->getAsaasBillingType($data['payment_method']),
            'value' => $data['amount'],
            'dueDate' => now()->addDays(3)->format('Y-m-d'),
        ];

        if ($data['payment_method'] === 'credit_card') {
            $paymentData['creditCard'] = [
                'holderName' => $data['card_holder_name'],
                'number' => $data['card_number'],
                'expiryMonth' => $data['card_expiry_month'],
                'expiryYear' => $data['card_expiry_year'],
                'ccv' => $data['card_ccv'],
            ];

            $paymentData['creditCardHolderInfo'] = [
                'name' => $data['card_holder_name'],
                'email' => $data['customer_email'],
                'cpfCnpj' => $data['customer_cpf'],
                'postalCode' => $data['customer_zipcode'],
                'addressNumber' => $data['customer_address_number'],
                'addressComplement' => null,
                'phone' => $data['customer_phone'],
                'mobilePhone' => $data['customer_phone'],
            ];
        }

        $response = $this->createPayment($paymentData);
        //dd($response);
        Payment::create([
            'payment_id' => $response['id'],
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_cpf' => $data['customer_cpf'],
            'customer_zipcode' => $data['customer_zipcode'],
            'customer_address_number' => $data['customer_address_number'],
            'customer_phone' => $data['customer_phone'],
            'amount' => $data['amount'],
            'payment_method' => $data['payment_method'],
            'status' => $response['status'],
            'payment_data' => $response,
        ]);

        return $response;
    }

    protected function createCustomer(array $data)
    {
        $response = Http::withHeaders([
            'access_token' => $this->apiKey,
        ])->post("{$this->baseUrl}/customers", $data);

        // Logar erro se não for possível criar o cliente
        abort_if(!$response->successful(), 400, 'Erro ao criar cliente');

        return $response->json();
    }

    protected function createPayment(array $data)
    {
        $response = Http::withHeaders([
            'access_token' => $this->apiKey,
        ])->post("{$this->baseUrl}/payments", $data);

        abort_if(!$response->successful(), 400, 'Erro ao processar pagamento');

        return $response->json();
    }

    public function getPixQrCodePayment(string $paymentId)
    {
        $response = Http::withHeaders([
            'access_token' => $this->apiKey,
        ])->get("{$this->baseUrl}/payments/{$paymentId}/pixQrCode")
            ->json();

        return $response;
    }

    protected function getAsaasBillingType(string $method)
    {
        return match($method) {
            'boleto' => 'BOLETO',
            'credit_card' => 'CREDIT_CARD',
            'pix' => 'PIX',
            default => 'BOLETO',
        };
    }

}
