<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       $rules = [
            'payment_method' => 'required|in:boleto,credit_card,pix',
            'amount' => 'required|numeric|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_cpf' => 'required|string|size:11',
        ];

        if ($this->payment_method === 'credit_card') {
            $rules += [
                'card_number' => 'required|string|size:16',
                'card_expiry_month' => 'required|string|size:2',
                'card_expiry_year' => 'required|string|size:4',
                'card_ccv' => 'required|string|size:3',
                'card_holder_name' => 'required|string|max:255',
                'customer_zipcode' => 'required|string|size:8',
                'customer_address_number' => 'required|string|max:20',
                'customer_phone' => 'required|string|max:20',

            ];
        }

        return $rules;
    }
}
