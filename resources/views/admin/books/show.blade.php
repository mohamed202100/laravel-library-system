<?php
?>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $book->title }} ({{ __('التفاصيل') }})
            </h2>

            <a href="{{ route('dashboard') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-150 text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                العودة لتصفح المكتبة
            </a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex flex-col md:flex-row gap-8 items-start">

                    <div class="w-full md:w-1/3 flex flex-col items-center">
                        @if ($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                class="w-full h-auto object-cover rounded-lg shadow-2xl mb-4 max-w-xs" />
                        @else
                            <div
                                class="w-full max-w-xs h-96 bg-gray-200 flex items-center justify-center rounded-lg mb-4 shadow-xl">
                                <span class="text-gray-500">{{ __('لا يوجد غلاف') }}</span>
                            </div>
                        @endif

                        <div class="w-full bg-gray-50 p-4 rounded-lg shadow-inner">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">{{ __('إجراء الحجز') }}</h3>

                            @auth
                                @if ($book->available_copies > 0)
                                    <form action="{{ route('books.reserve', $book) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-base transition duration-200 shadow-md">
                                            {{ __('احجز الآن') }}
                                        </button>
                                    </form>
                                @else
                                    <button disabled
                                        class="w-full bg-gray-400 text-white font-bold py-2 px-4 rounded-lg cursor-not-allowed">
                                        {{ __('غير متاح للحجز') }}
                                    </button>
                                @endif
                                <p class="mt-4 text-xs text-gray-500 text-center">
                                    {{ __('سيتم تأكيد الحجز مباشرة في سجل حجوزاتك.') }}
                                </p>
                            @else
                                <p class="text-sm text-red-500 font-semibold text-center">
                                    {{ __('يجب تسجيل الدخول للحجز.') }}</p>
                                <a href="{{ route('login') }}"
                                    class="w-full block text-center bg-indigo-500 hover:bg-indigo-600 text-white py-2 rounded-lg mt-2">
                                    {{ __('تسجيل الدخول') }}
                                </a>
                            @endauth
                        </div>
                    </div>


                    <div class="flex-1 w-full md:w-2/3">
                        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">{{ $book->title }}</h1>

                        <div class="space-y-3 mb-6 border-b pb-4">
                            <p class="text-lg text-gray-700">
                                <span class="font-semibold">{{ __('المؤلف:') }}</span>
                                @if ($book->author)
                                    <span class="text-indigo-600">{{ $book->author->name }}</span>
                                @else
                                    <span class="text-red-500">{{ __('مؤلف مجهول أو محذوف') }}</span>
                                @endif
                            </p>
                            <p class="text-lg text-gray-700">
                                <span class="font-semibold">{{ __('الإصدارات الكلية:') }}</span>
                                {{ $book->total_copies }}
                            </p>
                            <p class="text-lg text-gray-700">
                                <span class="font-semibold">{{ __('النسخ المتاحة:') }}</span>
                                <span
                                    class="{{ $book->available_copies > 0 ? 'text-green-600 font-bold' : 'text-red-600 font-bold' }}">
                                    {{ $book->available_copies }}
                                </span>
                            </p>
                            <p class="text-lg text-gray-700">
                                <span class="font-semibold">{{ __('سعر الإيجار:') }}</span>
                                {{ number_format($book->price, 2) }} {{ __('ر.س') }}
                            </p>
                        </div>

                        <!-- الوصف -->
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ __('الوصف:') }}</h2>
                        <p class="text-gray-600 leading-relaxed whitespace-pre-line text-justify">
                            {{ $book->description ?: __('لا يوجد وصف متاح لهذا الكتاب.') }}
                        </p>

                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
