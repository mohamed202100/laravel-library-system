<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('إضافة كتاب جديد') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                {{-- يجب تحديد enctype="multipart/form-data" لرفع الملفات (الصورة) --}}
                <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- حقل العنوان --}}
                    <div class="mb-4">
                        <x-input-label for="title" :value="__('عنوان الكتاب')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                            :value="old('title')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    {{-- حقل المؤلف (سنفترض قائمة منسدلة للمؤلفين) --}}
                    <div class="mb-4">
                        <x-input-label for="author_id" :value="__('المؤلف')" />
                        {{--  TODO: هنا نحتاج لتمرير قائمة المؤلفين من Controller ($authors) --}}
                        <select id="author_id" name="author_id"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            required>
                            <option value="">-- اختر مؤلفاً --</option>
                            {{-- @foreach ($authors as $author) --}}
                            <option value="1">أحمد خالد توفيق (مثال)</option>
                            {{-- @endforeach --}}
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('author_id')" />
                    </div>

                    {{-- حقول المخزون والسعر --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <x-input-label for="total_copies" :value="__('إجمالي النسخ')" />
                            <x-text-input id="total_copies" name="total_copies" type="number" min="1"
                                class="mt-1 block w-full" :value="old('total_copies', 1)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('total_copies')" />
                        </div>
                        <div>
                            <x-input-label for="price" :value="__('السعر (بالعملة المحلية)')" />
                            <x-text-input id="price" name="price" type="text" class="mt-1 block w-full"
                                :value="old('price', 0.0)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        {{-- حقل صورة الغلاف --}}
                        <div>
                            <x-input-label for="cover_image" :value="__('صورة الغلاف')" />
                            <input id="cover_image" name="cover_image" type="file"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-1" />
                            <x-input-error class="mt-2" :messages="$errors->get('cover_image')" />
                        </div>
                    </div>

                    {{-- حقل الوصف --}}
                    <div class="mb-6">
                        <x-input-label for="description" :value="__('الوصف')" />
                        <textarea id="description" name="description" rows="4"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>
                            {{ __('إضافة الكتاب') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
