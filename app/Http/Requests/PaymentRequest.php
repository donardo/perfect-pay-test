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

    public function attributes()
    {
        return [
            'payment_method' => 'método de pagamento',
            'amount' => 'valor',
            'customer_name' => 'nome',
            'customer_email' => 'e-mail',
            'customer_cpf' => 'CPF',
            'customer_zipcode' => 'CEP',
            'customer_address_number' => 'número do endereço',
            'card_number' => 'número do cartão',
            'card_expiry_month' => 'mês de vencimento',
            'card_expiry_year' => 'ano de vencimento',
            'card_ccv' => 'código de segurança',
            'card_holder_name' => 'nome no cartão',
        ];
    }

    public function messages()
    {
        return [
            'payment_method.required' => 'Por favor, selecione um método de pagamento.',
            'payment_method.in' => 'O método de pagamento selecionado é inválido.',
            'amount.required' => 'Por favor, informe o valor do pagamento.',
            'amount.numeric' => 'O valor deve ser um número.',
            'amount.min' => 'O valor deve ser maior que zero.',
            'customer_name.required' => 'Por favor, informe seu nome.',
            'customer_email.required' => 'Por favor, informe seu e-mail.',
            'customer_email.email' => 'Por favor, informe um e-mail válido.',
            'customer_cpf.required' => 'Por favor, informe seu CPF.',
            'customer_cpf.size' => 'O CPF deve ter 11 dígitos.',
            'customer_zipcode.required' => 'Por favor, informe seu CEP.',
            'customer_address_number.required' => 'Por favor, informe o número do endereço.',

            // Mensagens específicas para cartão
            'card_number.required' => 'O número do cartão é obrigatório.',
            'card_number.size' => 'O número do cartão deve ter 16 dígitos.',
            'card_expiry_month.required' => 'O mês de vencimento do cartão é obrigatório.',
            'card_expiry_month.size' => 'O mês deve ter 2 dígitos.',
            'card_expiry_year.required' => 'O ano de vencimento do cartão é obrigatório.',
            'card_expiry_year.size' => 'O ano deve ter 4 dígitos.',
            'card_ccv.required' => 'O código de segurança do cartão é obrigatório.',
            'card_ccv.size' => 'O código de segurança deve ter 3 dígitos.',
            'card_holder_name.required' => 'O nome impresso no cartão é obrigatório.',
            'card_holder_name.max' => 'O nome no cartão não pode ter mais que :max caracteres.',
        ];
    }
}
