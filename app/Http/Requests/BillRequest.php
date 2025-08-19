<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
        $id = $this->route('bill')->id ?? null;

        return [
            'name'              => ['required', 'string', 'max:255'],
            'origin'            => ['nullable', 'string', 'max:255'],
            'product_code'      => ['required', 'string', 'max:100'],
            'production_date'   => ['nullable', 'date'],
            'guarantee'         => ['nullable', 'string', 'max:255'],
            'other_information' => ['nullable', 'string'], // Tagify JSON
            'short_description' => ['nullable', 'string'],
            'image'             => ['nullable', 'string'], // nếu lưu URL hoặc path
            'files'             => ['nullable', 'array'],
            'files.*'           => ['nullable', !$id ? 'file' : '', 'mimes:jpg,jpeg,png', 'max:2048'], // mỗi file <= 2MB
        ];
    }
}
