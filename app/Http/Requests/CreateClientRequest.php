<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
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
            'state_id'  => 'required',
            'cite_id'   => 'required',
            'name'      => 'required|min:4|max:255',
            'email'     => 'required|unique:clients,email',
            'address'   => 'required|min:4|max:255',
            'phone'     => 'required',
            'phone2'    => 'required',
            'zipcode'   => 'required',
            'bairro'    => 'required',
            'cnpj'      => 'required',
            'ie'        => 'required',
            'site'      => 'nullable|url',
        ];
    }
}
