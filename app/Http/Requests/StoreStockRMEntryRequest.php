<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockRMEntryRequest extends FormRequest
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
            'type_id' => 'required',
            'raw_material_id' => 'required',
            'uom_id' => 'required',
            'inward_quantity' => 'required|numeric|between:1,999999.999|max:'.$this->available_quantity,
            'available_quantity' => 'required|numeric|between:1,999999.999',
            'available_material_quantity' => 'required|numeric|between:1,999999.999',
            'inward_material_quantity' => 'required|numeric|between:1,999999.999|max:'.$this->available_material_quantity,
            'unit_material_quantity' => 'required|numeric|between:1,999999.999',
            'invoice_number' => 'required',
            'purchase_order_id' => 'required',
            'supplier_id' => 'required',
        ];
    }
}
