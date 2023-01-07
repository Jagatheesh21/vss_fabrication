<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePoMasterRequest extends FormRequest
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
            'rm_po_number' => 'required',
            'supplier_id' => 'required',
            'raw_material_id' => 'required',
            'type_id' => 'required',
            'po_date' => 'required',
            'po_quantity' => 'required',
            'uom_id' => 'required',
            'material_quantity' => 'required',
            'material_uom_id' => 'required',
            'unit_material_quantity' => 'required',
            'invoice_number' => 'required',
            'remarks' => 'max:255',
        ];
    }
}
