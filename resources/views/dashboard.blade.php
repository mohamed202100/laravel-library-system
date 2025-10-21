<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">

            <p class="text-sm text-gray-500">{{ __('اكتشف، اقرأ، واستمتع بعالم المعرفة!') }}</p>
        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-b from-gray-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div
                class="relative mb-10 bg-gradient-to-r from-indigo-600 via-indigo-500 to-indigo-400 text-white rounded-2xl shadow-xl overflow-hidden">
                <div
                    class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f')] bg-cover bg-center opacity-20">
                </div>
                <div class="relative z-10 p-8 text-center sm:text-left">
                    <h3 class="text-3xl font-extrabold mb-3">مرحباً بك في <span
                            class="text-yellow-300">LibraryEase</span>!</h3>
                    <p class="text-lg text-indigo-100 leading-relaxed">
                        مكتبة رقمية تأسست عام <span class="font-semibold text-yellow-200">2024</span>، تهدف لتوفير تجربة
                        قراءة سلسة وتفاعلية.
                        تصفح مجموعتنا الواسعة من الكتب وابدأ رحلتك مع القراءة الآن!
                    </p>
                    <div class="mt-6 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('reservations.my') }}"
                            class="flex-1 text-center bg-yellow-400 hover:bg-yellow-500 text-indigo-900 font-bold py-3 px-4 rounded-lg shadow-lg transition">
                            📖 {{ __('مشاهدة حجوزاتي') }}
                        </a>
                        <a href="{{ route('dashboard') }}"
                            class="flex-1 text-center bg-white/20 hover:bg-white/30 text-white font-semibold py-3 px-4 rounded-lg shadow-lg transition">
                            🔍 {{ __('تصفح الكتب') }}
                        </a>
                    </div>
                </div>
            </div>

            {{-- 🔹 قائمة الكتب --}}
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
                <div class="p-6">

                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-book text-indigo-600"></i> {{ __('الكتب المتاحة للحجز') }}
                    </h3>

                    {{-- تنبيهات --}}
                    @if (session('status'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- جدول الكتب --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-center">
                            <thead class="bg-indigo-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-700 uppercase">{{ __('الغلاف') }}
                                    </th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-700 uppercase">{{ __('العنوان') }}
                                    </th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-700 uppercase">{{ __('المؤلف') }}
                                    </th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-700 uppercase">{{ __('المتوفر') }}
                                    </th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-700 uppercase">{{ __('السعر') }}
                                    </th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-700 uppercase">
                                        {{ __('الإجراءات') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse ($books as $book)
                                    <tr class="hover:bg-gray-50 transition">
                                        {{-- الغلاف --}}
                                        <td class="px-6 py-4">
                                            @if ($book->cover_image)
                                                <img src="{{ asset('storage/' . $book->cover_image) }}"
                                                    alt="{{ $book->title }}"
                                                    class="w-16 h-20 object-cover rounded-md shadow">
                                            @else
                                                <div
                                                    class="w-16 h-20 flex items-center justify-center bg-gray-200 text-gray-500 text-xs rounded-md">
                                                    {{ __('بدون غلاف') }}
                                                </div>
                                            @endif
                                        </td>

                                        {{-- العنوان --}}
                                        <td class="px-6 py-4 font-bold text-indigo-700">
                                            <a href="{{ route('books.show', $book) }}"
                                                class="hover:underline hover:text-indigo-900">{{ $book->title }}</a>
                                        </td>

                                        {{-- المؤلف --}}
                                        <td class="px-6 py-4 text-gray-700">
                                            {{ $book->author->name ?? __('غير معروف') }}
                                        </td>

                                        {{-- المتوفر --}}
                                        <td
                                            class="px-6 py-4 font-semibold {{ $book->available_copies > 0 ? 'text-green-600' : 'text-red-500' }}">
                                            {{ $book->available_copies }}
                                        </td>

                                        {{-- السعر --}}
                                        <td class="px-6 py-4 text-gray-600">
                                            {{ number_format($book->price, 2) }} {{ __('ر.س') }}
                                        </td>

                                        {{-- الحجز --}}
                                        <td class="px-6 py-4">
                                            @if ($book->available_copies > 0)
                                                <form action="{{ route('books.reserve', $book) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2 px-4 rounded-lg shadow transition">
                                                        {{ __('احجز الآن') }}
                                                    </button>
                                                </form>
                                            @else
                                                <span
                                                    class="text-red-600 font-semibold text-sm">{{ __('غير متاح') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-gray-500 text-center text-lg">
                                            {{ __('📭 لا توجد كتب متاحة حالياً.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- ترقيم الصفحات --}}
                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
