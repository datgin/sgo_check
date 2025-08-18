<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
        $userId = Auth::id();
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email,' . $userId,
            'phone'     => 'nullable|string|max:20|regex:/^[0-9\-\+\s\(\)]+$/',
            'company'   => 'nullable|string|max:255',
            'address'   => 'nullable|string|max:255',
            'tax_number' => 'nullable|string|max:50',
            'website'   => 'nullable|url|max:255',
            'logo'      => 'nullable|url|max:500',
            'favicon'   => 'nullable|url|max:500',
        ];
    }

    public function messages()
    {
        return __('request.messages');
    }

    public function attributes(): array
    {
        return [
            'name'       => 'Họ tên',
            'email'      => 'Email',
            'phone'      => 'Số điện thoại',
            'company'    => 'Công ty',
            'address'    => 'Địa chỉ',
            'tax_number' => 'Mã số thuế',
            'website'    => 'Website',
            'logo'       => 'Logo',
            'favicon'    => 'Favicon',
        ];
    }
}
