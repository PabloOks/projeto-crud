<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'role_id.required' => 'Informe o grupo ao qual este usuário pertence',
            'role_id.exists' => 'O grupo informado não existe',
        ];
    }
}
