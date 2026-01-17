<?php
// يتم تمرير متغير $book إلى هذا الـ View
?>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $book->title }} ({{ __('التفاصيل') }})
            </h2>

            {{-- زر العودة لتصفح المكتبة --}}
            <a href="{{ route('dashboard') }}"
                class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg transition duration-150 text-sm flex items-center shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4 mr-1 transform rotate-180">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
                العودة لتصفح المكتبة
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl p-8">

                <div class="flex flex-col md:flex-row gap-10 items-start">

                    <!-- قسم الصورة والإجراءات (العمود الأيمن/الأول) -->
                    <div class="w-full md:w-80 flex-shrink-0 flex flex-col items-center sticky top-6">

                        {{-- عرض صورة الغلاف --}}
                        @if ($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                class="w-full h-auto object-cover rounded-xl shadow-2xl mb-6 max-w-xs border-4 border-gray-100" />
                        @else
                            {{-- Placeholder في حال عدم وجود صورة --}}
                            <div
                                class="w-full max-w-xs h-96 bg-gray-200 flex items-center justify-center rounded-xl mb-6 shadow-xl border-4 border-gray-100">
                                <span class="text-gray-500 font-semibold">{{ __('لا يوجد غلاف') }}</span>
                            </div>
                        @endif

                        {{-- بطاقة الحجز والإجراءات --}}
                        <div class="w-full bg-blue-50 p-5 rounded-xl shadow-lg border border-blue-100">
                            <h3 class="text-xl font-extrabold text-blue-800 mb-4 text-center">{{ __('إجراء الحجز') }}
                            </h3>

                            @auth
                                @if ($book->available_copies > 0)
                                    <p class="text-sm text-green-600 mb-3 font-medium text-center">
                                        {{ __('نسخ متاحة: ') . $book->available_copies }}
                                    </p>
                                    <a href="{{ route('reservations.create', $book) }}"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2 px-4 rounded-lg shadow transition">
                                        {{ __('احجز الآن') }}
                                    </a>
                                @else
                                    <p class="text-sm text-red-600 mb-3 font-medium text-center">
                                        {{ __('جميع النسخ مُعارة حاليًا.') }}</p>
                                    <button disabled
                                        class="w-full bg-gray-400 text-white font-bold py-3 px-4 rounded-xl cursor-not-allowed shadow-md">
                                        {{ __('غير متاح للحجز') }}
                                    </button>
                                @endif
                                <p class="mt-4 text-xs text-gray-500 text-center">
                                    {{ __('سيتم تأكيد الحجز مباشرة في سجل حجوزاتك.') }}</p>
                            @else
                                <p class="text-sm text-red-500 font-semibold text-center mb-3">
                                    {{ __('يجب تسجيل الدخول للحجز.') }}</p>
                                <a href="{{ route('login') }}"
                                    class="w-full block text-center bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl shadow-md transition duration-200">
                                    {{ __('تسجيل الدخول') }}
                                </a>
                            @endauth
                        </div>
                    </div>


                    <!-- قسم التفاصيل (العمود الأيسر/الثاني) -->
                    <div class="flex-1 w-full space-y-8">
                        <h1 class="text-5xl font-extrabold text-gray-900">{{ $book->title }}</h1>

                        {{-- معلومات المؤلف --}}
                        <p class="text-2xl text-gray-700">
                            <span class="font-bold">{{ __('المؤلف:') }}</span>
                            @if ($book->author)
                                <span class="text-blue-700 font-extrabold">{{ $book->author->name }}</span>
                            @else
                                <span class="text-red-500">{{ __('مؤلف مجهول أو محذوف') }}</span>
                            @endif
                        </p>

                        <!-- تفاصيل سريعة -->
                        <div class="grid grid-cols-2 gap-4 border-t border-b py-4">
                            <div>
                                <span class="font-semibold text-gray-600">{{ __('الإصدارات الكلية:') }}</span>
                                <p class="text-xl font-bold text-gray-900">{{ $book->total_copies }}</p>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-600">{{ __('سعر الإيجار:') }}</span>
                                <p class="text-xl font-bold text-gray-900">{{ number_format($book->price, 2) }}
                                    {{ __('ر.س') }}</p>
                            </div>
                        </div>

                        <!-- الوصف -->
                        <div class="pt-4">
                            <h2 class="text-3xl font-extrabold text-gray-800 mb-4 border-r-4 border-yellow-400 pr-4">
                                {{ __('الوصف الموجز') }}
                            </h2>
                            <p class="text-gray-700 leading-loose whitespace-pre-line text-justify">
                                {{ $book->description ?: __('لا يوجد وصف متاح لهذا الكتاب.') }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
