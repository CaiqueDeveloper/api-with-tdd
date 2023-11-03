<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|',
            'author' => 'required|string|',
            'description' => 'required|string|',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'O Campo Title é obrigatório.',
            'author.required' => 'O Campo Author é obrigatório.',
            'description.required' => 'O Campo Description é obrigatório.',
        ];
    }
}
