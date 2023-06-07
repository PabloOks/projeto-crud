<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['bail', 'required', 'confirmed', Password::min(8)],
            'role_id' => ['required', 'exists:roles,id']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Informe o nome',
            'name.string' => 'O nome informado não está em um formato válido',
            'email.required' => 'Informe o email',
            'email.email' => 'O email informado não é válido',
            'password.required' => 'Informe a senha',
            'password.confirmed' => 'As senhas informadas não conferem',
            'password.min' => 'A senha necessita ter no mínimo 8 caracteres',
            'role_id.required' => 'Informe o grupo ao qual este usuário pertence',
            'role_id.exists' => 'O grupo informado não existe',
        ];
    }
}
