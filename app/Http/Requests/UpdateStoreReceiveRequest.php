<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreReceiveRequest extends FormRequest
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
            'approved_status' => 'required',
            'inspection_report' => 'required|max:10000',
            'remarks' => 'required',
            'inward_material_quantity' => 'required',
            'ok_material_quantity' => 'required|numeric|min:1|max:inward_material_quantity',
            'reject_material_quantity' => 'required|numeric|min:0|max:inward_material_quantity',
         ];
    }
}
