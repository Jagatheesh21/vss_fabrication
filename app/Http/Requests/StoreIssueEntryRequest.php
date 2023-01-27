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
            'category_id' => 'required',
            'type_id' => 'required',
            'raw_material_id' => 'required',
            'route_card_type_id' => 'required',
            'route_card_number' => 'required',
            'store_stock_id' => 'required', // GRN Number
            'available_quantity' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:1',
            'issue_unit_quantity' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:1',
            'issue_quantity' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:1',
            'type_of_issue' => 'required',
            'nesting_id' => 'required',
            'nesting_type_id.*' => 'required',
            'child_part_number_id.*' => 'required',
            'unit_weight.*' => 'required',
            'quantity.*' => 'required',
            'useage_weight.*' => 'required',
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
        'child_part_number_id.*' => 'Child Part Number is Required',
        'issue_unit_quantity' => 'Unit Quantity is Required',
        'issue_quantity' => 'Estimate Quantity is Required',
        'quantity.*' => 'Quantity is Required',
        'unit_weight.*' => 'BOM is Required',
        'nesting_type_id.*' => 'Nesting Type is Required',
        'useage_weight.*' => 'Useage Weight is Required',
        'total_useage_weight' => 'Total Useage Quantity is Required',
        'store_stock_id' => 'GRN is Required!',

    ];
}
}
