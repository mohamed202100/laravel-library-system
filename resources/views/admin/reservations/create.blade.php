<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📚 {{ __('حجز كتاب') }}
        </h2>
    </x-slot>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-6 border-b pb-4">
                    <h3 class="text-xl font-semibold">{{ $book->title }}</h3>
                    <p class="text-gray-600">✍️ المؤلف: {{ $book->author->name ?? 'غير معروف' }}</p>
                    <p class="text-gray-500">📦 النسخ المتاحة: {{ $book->available_copies }}</p>
                </div>

                @if ($book->available_copies > 0)
                    <form action="{{ route('reservations.store', $book->id) }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label for="return_date" class="block text-sm font-medium text-gray-700 mb-1">
                                🗓️ اختر تاريخ الإرجاع:
                            </label>
                            <input type="date" name="return_date" id="return_date" value="{{ old('return_date') }}"
                                min="{{ now()->toDateString() }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                                required>
                            @error('return_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                            ✅ تأكيد الحجز
                        </button>
                    </form>
                @else
                    <p class="text-center text-red-500 font-semibold">
                        ❌ لا توجد نسخ متاحة للحجز حالياً.
                    </p>
                @endif

                <div class="text-center mt-6">
                    <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:underline">
                        ⬅️ الرجوع إلى قائمة الكتب
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
