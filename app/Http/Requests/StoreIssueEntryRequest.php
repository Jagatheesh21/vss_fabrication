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
            'type_id' => 'required',
            'raw_material_id' => 'required',
            'uom_id' => 'required',
            'available_quantity' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:1',
            'issue_quantity' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:1|max:'.$this->available_quantity,
        ];
    }
}
