<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSnippetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isOperator() ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
            'correct_order' => ['required', 'integer', 'min:1', 'unique:snippets,correct_order'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'content.required' => 'Konten snippet wajib diisi.',
            'correct_order.required' => 'Urutan wajib diisi.',
            'correct_order.integer' => 'Urutan harus berupa angka.',
            'correct_order.min' => 'Urutan minimal 1.',
            'correct_order.unique' => 'Urutan ini sudah digunakan.',
        ];
    }
}
