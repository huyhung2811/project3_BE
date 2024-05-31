<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'phone' => 'regex:/^\d{10}$/|nullable',
            'address' => 'nullable',
            'home_town' => 'nullable',
            'avatar' => 'image|nullable',
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'avatar.image' => 'Avatar phải là ảnh'
        ];
    }
}
