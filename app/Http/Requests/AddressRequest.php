<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'neighborhood' => 'required|max:100',
            'street' => 'required|max:100',
            'street_number' => 'required|Integer|min:1',
            'street_type' => 'max:100',
            'zipcode' => 'required',
            'street_complement' => 'required|max:100',
            'state' => 'required|max:100',
        ];
    }
}
