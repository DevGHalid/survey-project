<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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

    public function rules()
    {
        return [
            'email' => 'email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Почта не валидная.',
            'password.required' => 'Пароля обязательно для заполнения.'
        ];
    }
}
