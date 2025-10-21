<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('تعديل المؤلف: ') . $author->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                {{-- نستخدم ميثود PATCH لتحديث الموارد في Laravel --}}
                <form method="POST" action="{{ route('admin.authors.update', $author->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- حقل الاسم --}}
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('اسم المؤلف')" />
                        {{-- قيمة الاسم يجب أن تكون هي القيمة الحالية للمؤلف أو قيمة قديمة إذا فشل التحقق --}}
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name', $author->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    {{-- حقل السيرة الذاتية --}}
                    <div class="mb-6">
                        <x-input-label for="bio" :value="__('السيرة الذاتية (اختياري)')" />
                        <textarea id="bio" name="bio" rows="4"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('bio', $author->bio) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('bio')" />
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
