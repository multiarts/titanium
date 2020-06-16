<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name'     => 'required|string|min:4|max:255',
            'email'    => 'required|unique:users,email',
            'username' => 'required|unique:users,username,string|max:255',
            'password' => 'required|min:6',
            'roles'    => 'required'
            // 'current_password' => 'required',
        ];
    }
}
