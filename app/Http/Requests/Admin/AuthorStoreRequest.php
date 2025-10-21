<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AuthorStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:authors,name',
            'bio' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'هذا المؤلف موجود بالفعل.',
            'name.required' => 'حقل الاسم مطلوب.',
        ];
    }
}
