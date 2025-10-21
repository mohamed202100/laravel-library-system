<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('تعديل الكتاب: ') . $book->title }}
            </h2>
            {{-- زر العودة للخلف --}}
            <a href="{{ route('admin.books.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-150 text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                العودة لقائمة الكتب
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('admin.books.update', $book->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- حقل العنوان --}}
                    <div class="mb-4">
                        <x-input-label for="title" :value="__('عنوان الكتاب')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                            :value="old('title', $book->title)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    {{-- حقل المؤلف --}}
                    <div class="mb-4">
                        <x-input-label for="author_id" :value="__('المؤلف')" />
                        {{-- تفعيل حلقة التكرار للمؤلفين --}}
                        <select id="author_id" name="author_id"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            required>
                            <option value="">-- اختر مؤلفاً --</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}"
                                    {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('author_id')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                        <div>
                            <x-input-label for="total_copies" :value="__('إجمالي النسخ')" />
                            <x-text-input id="total_copies" name="total_copies" type="number" min="1"
                                class="mt-1 block w-full" :value="old('total_copies', $book->total_copies)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('total_copies')" />
                        </div>

                        <div>
                            <x-input-label for="available_copies" :value="__('النسخ المتاحة حالياً')" />
                            <x-text-input id="available_copies" name="available_copies" type="number" min="0"
                                class="mt-1 block w-full" :value="old('available_copies', $book->available_copies)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('available_copies')" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('السعر (بالعملة المحلية)')" />
                            <x-text-input id="price" name="price" type="text" class="mt-1 block w-full"
                                :value="old('price', $book->price)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        {{-- حقل صورة الغلاف --}}
                        <div>
                            <x-input-label for="cover_image" :value="__('صورة الغلاف (اتركها فارغة لعدم التغيير)')" />
                            <input id="cover_image" name="cover_image" type="file"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-1" />
                            <x-input-error class="mt-2" :messages="$errors->get('cover_image')" />
                            @if ($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="غلاف حالي"
                                    class="mt-2 w-16 h-16 object-cover rounded-md shadow-md" />
                            @endif
                        </div>
                    </div>

                    {{-- حقل الوصف --}}
                    <div class="mb-6">
                        <x-input-label for="description" :value="__('الوصف')" />
                        <textarea id="description" name="description" rows="4"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $book->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>
                            {{ __('حفظ التعديلات') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
