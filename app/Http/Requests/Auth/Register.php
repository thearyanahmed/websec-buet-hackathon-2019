<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // User must be aunthenticated
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
            'name'     => 'required|string|regex:/^[a-zA-Z ]+$/u|max:191',
            'email'    => 'required|email|unique:users,email|max:191',
            'password' => 'required|max:191'
        ];
    }
}
