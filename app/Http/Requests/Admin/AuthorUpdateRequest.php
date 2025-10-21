<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AuthorUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $authorId = $this->route('author')->id;

        return [
            'name' => 'required|string|max:255|unique:authors,name,' . $authorId,
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
