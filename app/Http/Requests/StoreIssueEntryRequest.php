<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIssueEntryRequest extends FormRequest
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
            'route_card_type_id' => 'required',
            'route_card_number' => 'required',
            'category_id' => 'required',
            'store_stock_id' => 'required',
            'type_id' => 'required',
            'raw_material_id' => 'required',
            'nesting_id' => 'required',
            'nesting_type_id.*' => 'required',
            'child_part_number_id.*' => 'required',
            'available_quantity' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:1',
            'unit_weight.*' => 'required',
            'estimate_quantity.*' => 'required',
            'total_useage_weight' => 'required',
            
        ];
    }
    public function messages()
{
    return [
        'category_id' => 'Category is Required',
        'type_id' => 'Type is Required',
        'raw_material_id' => 'Part Description Required',
        'nesting_id' => 'Nesting is Required',
        'nesting_type_id' => 'Nesting Type is Required',
        'available_quantity' => 'Available Quantity is Required',
        'child_part_number_id' => 'Child Part Number is Required',
        'unit_weight' => 'Unit Quantity is Required',
        'estimate_quantity' => 'Estimate Quantity is Required',
        'total_useage_weight' => 'Total Useage Quantity is Required',
        'store_stock_id' => 'GRN is Required!',

    ];
}
}
