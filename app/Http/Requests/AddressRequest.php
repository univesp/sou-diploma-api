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
            'neighborhood' => 'max:100',
            'street' => 'max:100',
            'street_number' => 'Integer|min:1',
            'street_type' => 'max:100',
            //'zipcode' => '',
            'street_complement' => 'max:100',
            'state' => 'max:100',
        ];
    }
}
