<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'description' => 'nullable|string',
            'total_copies' => 'required|integer|min:1',
            'price' => 'required|numeric|min:1',
            'available_copies' => 'integer|min:0|lte:total_copies',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الكتاب مطلوب.',
            'author_id.required' => 'يجب اختيار مؤلف للكتاب.',
            'author_id.exists' => 'المؤلف المختار غير موجود.',
            'total_copies.required' => 'إجمالي عدد النسخ مطلوب.',
            'total_copies.min' => 'يجب أن يكون إجمالي النسخ نسخة واحدة على الأقل.',
            'available_copies.lte' => 'لا يمكن أن تكون النسخ المتاحة أكبر من إجمالي عدد النسخ.',
            'price.required' => 'حقل السعر مطلوب.',
            'cover_image.image' => 'الرجاء تحميل ملف صورة صالح للغلاف.',
            'cover_image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
        ];
    }
}
