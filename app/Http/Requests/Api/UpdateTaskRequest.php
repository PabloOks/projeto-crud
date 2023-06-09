<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'description' => ['string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Informe o nome da tarefa',
            'name.string' => 'O nome da tarefa informado não está em um formato válido',
            'description.string' => 'A descrição informada não está em um formato válido',
        ];
    }
}
