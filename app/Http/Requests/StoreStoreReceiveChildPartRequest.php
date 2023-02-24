<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreReceiveChildPartRequest extends FormRequest
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
            'previous_route_card_type_id'=>'required',
            'previous_route_card_type_id'=>'required',
            'operation_id' => 'required',
            'previous_operation_id' => 'required',
            'child_part_number_id.*' => 'required',
            'issued_quantity.*' => 'required|numeric|between:1,999999.999',
            'ok_quantity.*' => 'required|numeric|between:1,999999.999',
        ];
    }
}
