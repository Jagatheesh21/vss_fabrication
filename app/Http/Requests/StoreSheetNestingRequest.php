<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSheetNestingRequest extends FormRequest
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
            'nesting_number' => 'required',
            'category_id' => 'required',
            'raw_material_id' => 'required',
            'type_id.*' => 'required',
            'child_part_number_id.*' => 'required',
            'quantity.*' => 'required',
        ]; 
    }
}
