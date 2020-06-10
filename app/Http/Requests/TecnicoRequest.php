<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TecnicoRequest extends FormRequest
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
            'name' => 'required',
            'email' => [
                'required',
                'email'
            ],
            'rg' => 'required|unique:tecnicos',
            'cpf' => 'required|unique:tecnicos',
            'telefone' => 'required',
            'telefone1' => 'required',
            'address' => 'required',
            'state_id' => 'required',
            'cite_id' => 'required',
            'agencia' => 'required',
            'numconta' => 'required',
            'numbanco' => 'required',
            'operacao' => 'required',
            'tipo' => 'required',
            'active' => 'required',
        ];
    }
}
