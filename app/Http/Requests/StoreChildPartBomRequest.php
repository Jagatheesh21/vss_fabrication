<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChildPartBomRequest extends FormRequest
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
            'bom_id' =>'required',
            'type_id' => 'required',
            'raw_material_id' =>'required',
            'nesting_id' => 'required',
            // 'nesting_type_id' => 'required|array',
            // 'child_part_number_id' => 'required|array',
            // 'quantity' => 'required|array',
        ];
    }
}
