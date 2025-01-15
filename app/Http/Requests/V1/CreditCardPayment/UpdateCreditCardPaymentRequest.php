<?php

namespace App\Http\Requests\V1\CreditCardPayment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCreditCardPaymentRequest extends FormRequest
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
        return [
            'reference_id' => 'required|string|min:1|max:64',
            'customer' => 'required|array',
            'customer.name' => 'required|string|min:1|max:30',
            'customer.email' => 'required|email',
            'customer.tax_id' => 'required|string|min:11|max:14',
            'customer.phones' => 'sometimes|array',
            'customer.phones.*.country' => 'required_with:customer.phones|integer|digits:2',
            'customer.phones.*.area' => 'required_with:customer.phones|integer|digits:2',
            'customer.phones.*.number' => 'required_with:customer.phones|integer|digits_between:8,9',
            'customer.phones.*.type' => 'required_with:customer.phones|in:MOBILE,BUSINESS,HOME',
            'items' => 'sometimes|array',
            'items.*.name' => 'required|string|min:1|max:64',
            'items.*.quantity' => 'required|integer|min:1|max:99999',
            'items.*.unit_amount' => 'required|integer|min:1|max:999999999',
            'items.*.reference_id' => 'required|string|min:1|max:255',
            'shipping.address' => 'sometimes|array',
            'shipping.address.street' => 'required_with:shipping.address|string|min:1|max:160',
            'shipping.address.number' => 'required_with:shipping.address|string|min:1|max:20',
            'shipping.address.complement' => 'required_with:shipping.address|string|min:1|max:40',
            'shipping.address.locality' => 'required_with:shipping.address|string|min:1|max:60',
            'shipping.address.city' => 'required_with:shipping.address|string|min:1|max:90',
            'shipping.address.region_code' => 'required_with:shipping.address|string|min:1|max:2|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            'shipping.address.country' => 'required_with:shipping.address|string|min:1|max:50|in:BRA',
            'shipping.address.postal_code' => 'required_with:shipping.address|string|min:8|max:8',
            'charges' => 'sometimes|array',
            'charges.*.reference_id' => 'required|string|min:1|max:160',
            'charges.*.description' => 'required|string|min:1|max:160',
            'charges.*.amount' => 'required|array',
            'charges.*.amount.value' => 'required|integer|min:1|max:999999999',
            'charges.*.amount.currency' => 'required|string|min:3|max:3|in:BRL',
            'charges.*.payment_method' => 'required|array',
            'charges.*.payment_method.type' => 'required|string|in:CREDIT_CARD',
            'charges.*.payment_method.installments' => 'required|integer|digits_between:1,2|min:1|max:99',
            'charges.*.payment_method.capture' => 'required|boolean',
            'charges.*.payment_method.soft_descriptor' => 'required|string|min:1|max:22',
            'charges.*.payment_method.card' => 'required|array',
            'charges.*.payment_method.card.number' => 'required|string|min:14|max:19',
            'charges.*.payment_method.card.exp_month' => 'required|integer|digits_between:1,2|between:1,12',
            'charges.*.payment_method.card.exp_year' => 'required|integer|digits_between:3,4|min:' . date('Y'),
            'charges.*.payment_method.card.security_code' => 'required|string|digits_between:3,4',
            'charges.*.payment_method.card.holder' => 'required|array',
            'charges.*.payment_method.card.holder.name' => 'required|string|min:1|max:30',
            'charges.*.payment_method.card.holder.tax_id' => 'required|string|min:11|max:14|digits_between:11,14',
        ];
    }
}
