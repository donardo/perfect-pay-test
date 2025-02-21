<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Services\AsaasPaymentService;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(protected AsaasPaymentService $paymentService) {}

    public function show()
    {
        return view('payment_form');
    }

    public function store(PaymentRequest $request)
    {
        try {
            $payment = $this->paymentService->processPayment($request->all());

            if ($request->payment_method === 'pix') {
                $pix = $this->paymentService->getPixQrCodePayment($payment['id']);
                $payment += [
                    'encodedImage' => $pix['encodedImage'],
                    'payload' => $pix['payload'],
                ];
            }
            return redirect()
                ->route('payment.success')
                ->with('payment', $payment);
        } catch (Exception $e) {
            return redirect()
                ->route('payment.form')
                ->with('error',  $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        $payment = session('payment');

        if (!$payment) {
            return redirect()->route('payment.form');
        }

        return view('success', compact('payment'));
    }

    public function proccessed()
    {
        return Payment::all();
    }
}
