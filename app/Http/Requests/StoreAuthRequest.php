<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Actions\Fortify\PasswordValidationRules;

class StoreAuthRequest extends FormRequest
{
    use PasswordValidationRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' =>  $this->passwordRules(),
            'type'     => ['required', 'in:superAdmin,admin,customer'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'name.max' => 'El nombre no debe exceder los 255 caracteres',
            'email.required' => 'El email es requerido',
            'email.string' => 'El email debe ser una cadena de texto',
            'email.email' => 'El email debe ser un email válido',
            'email.max' => 'El email no debe exceder los 255 caracteres',
            'email.unique' => 'El email ya está en uso',
            'password.required' => 'La contraseña es requerida',
            'password.string' => 'La contraseña debe ser una cadena de texto',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'type.required' => 'El tipo de usuario es requerido',
            'type.in' => 'El tipo de usuario debe ser superAdmin, admin o customer',
        ];
    }

}
