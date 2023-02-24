<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'supplier_id' => 'required',
            'purchase_order_number' => 'required',
            'reference_number' => 'required',
            'state' => 'required',
            'state_code' => 'required',
            'pin_code' => 'required',
            'address' => 'required',
            'delivery_terms' => 'required',
            'mode_of_dispatch' => 'required',
            'payment_terms' => 'required',
            'purchase_order_date' => 'required',
            'sub_total' => 'required',
            'cgst' => 'required',
            'igst' => 'required',
            'sgst' => 'required',
            'tax' => 'required',
            'tax_amount' => 'required',
            'total_amount' => 'required',
            'raw_material_id.*' => 'required',
            'quantity.*' => 'required',
            'price.*' => 'required',
            'total_quantity.*' => 'required',
        ];
    }
}
