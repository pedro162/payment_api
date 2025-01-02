<?php

namespace App\Http\Requests\V1\QRCodePayment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQRCodePaymentRequest extends FormRequest
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
            'customer.phones.country' => 'required_with:customer.phones|integer|digits:2',
            'customer.phones.area' => 'required_with:customer.phones|integer|digits:2',
            'customer.phones.number' => 'required_with:customer.phones|integer|digits_between:8,9',
            'customer.phones.type' => 'required_with:customer.phones|in:MOBILE,BUSINESS,HOME',
            'qr_codes' => 'required|array',
            'qr_codes.*.amount' => 'required|array',
            'qr_codes.*.amount.value' => 'required|integer|min:1|max:999999999', // Ajuste de limite
            'qr_codes.*.expiration_date' => 'sometimes|date|date_format:Y-m-d\TH:i:sP',
            'items' => 'sometimes|array',
            'items.*.name' => 'required|string|min:1|max:64',
            'items.*.quantity' => 'required|integer|min:1|max:99999', // Ajuste de limite
            'items.*.unit_amount' => 'required|integer|min:1|max:999999999', // Ajuste de limite
            'items.*.reference_id' => 'required|string|min:1|max:255',
        ];
    }
}
