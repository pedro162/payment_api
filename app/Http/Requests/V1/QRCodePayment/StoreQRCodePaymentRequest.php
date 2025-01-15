<?php

namespace App\Http\Requests\V1\QRCodePayment;

use Illuminate\Foundation\Http\FormRequest;

class StoreQRCodePaymentRequest extends FormRequest
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
            'charges' => 'required|array',
            'charges.*.amount' => 'required|array',
            'charges.*.amount.value' => 'required|integer|min:1|max:999999999',
            'charges.*.expiration_date' => 'sometimes|date|date_format:Y-m-d\TH:i:sP',
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
            'shipping.address.region_code' => 'required_with:shipping.address|string|min:1|max:50|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            'shipping.address.country' => 'required_with:shipping.address|string|min:1|max:3|in:BRA',
            'shipping.address.postal_code' => 'required_with:shipping.address|string|min:8|max:8',
        ];
    }
}
