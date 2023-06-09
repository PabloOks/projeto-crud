<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class DelegateMembersRequest extends FormRequest
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
            'users' => ['array'],
            'users.*' => ['exists:users,id']
        ];
    }

    public function messages(): array
    {
        return [
            'users.array' => 'Os usuários informados não estão no formato válido',
            'users.*.exists' => 'Alguns dos usuários informados não existem'
        ];
    }
}
