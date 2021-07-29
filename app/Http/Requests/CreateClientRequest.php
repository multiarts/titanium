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
        $id = auth()->user()->id;
        return [
            'state_id' => ['required', 'string', 'max:255'],
            'cite_id' => ['required', 'string', 'max:255'],
            'name' => ['required', 'min:4', 'max:255'],
            'email' => ['required', 'unique:clients', 'email'],
            'address' => ['required', 'min:4', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'phone2' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
            'bairro' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'string', 'max:255'],
            'ie' => ['required', 'string', 'max:255'],
            'site' => 'nullable|url',
        ];
    }
}
