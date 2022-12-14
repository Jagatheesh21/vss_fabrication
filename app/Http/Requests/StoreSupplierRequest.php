<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'code' => 'required',
            'company_name' => 'required',
            'contact_person' => 'required',
            'gst_number' => 'required',
            'pin_code' => 'required|numeric',
            'state_code' => 'required|numeric',
            'state' => 'required',
            'address' => 'required',
        ];
    }
}
