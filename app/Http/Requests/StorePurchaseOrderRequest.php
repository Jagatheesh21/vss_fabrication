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
            'purchase_order_number' => 'required',
            'supplier_id' => 'required',
            'raw_material_id' => 'required',
            'purchase_order_date' => 'required',
            'quantity' => 'required',
            'unit_quantity' => 'required',
            'total_quantity' => 'required',
            'uom_id' => 'required',
        ];
    }
}
