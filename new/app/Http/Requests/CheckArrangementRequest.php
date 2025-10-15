<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckArrangementRequest extends FormRequest
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
            'order' => ['required', 'array', 'min:1'],
            'order.*' => ['required', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'order.required' => 'Urutan tidak boleh kosong.',
            'order.array' => 'Format urutan tidak valid.',
            'order.min' => 'Minimal harus ada 1 potongan.',
            'order.*.required' => 'Setiap potongan wajib diisi.',
            'order.*.string' => 'Format potongan tidak valid.',
        ];
    }
}
