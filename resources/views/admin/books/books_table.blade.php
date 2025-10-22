<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 text-center">
        <thead class="bg-indigo-50">
            <tr>
                <th class="px-6 py-3 text-xs font-bold text-gray-700 uppercase">{{ __('الغلاف') }}</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-700 uppercase">{{ __('العنوان') }}</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-700 uppercase">{{ __('المؤلف') }}</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-700 uppercase">{{ __('المتوفر') }}</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-700 uppercase">{{ __('السعر') }}</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-700 uppercase">{{ __('الإجراءات') }}</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @forelse ($books as $book)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        @if ($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                class="w-16 h-20 object-cover rounded-md shadow">
                        @else
                            <div
                                class="w-16 h-20 flex items-center justify-center bg-gray-200 text-gray-500 text-xs rounded-md">
                                {{ __('بدون غلاف') }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-bold text-indigo-700">
                        <a href="{{ route('books.show', $book) }}"
                            class="hover:underline hover:text-indigo-900">{{ $book->title }}</a>
                    </td>
                    <td class="px-6 py-4 text-gray-700">{{ $book->author->name ?? __('غير معروف') }}</td>
                    <td
                        class="px-6 py-4 font-semibold {{ $book->available_copies > 0 ? 'text-green-600' : 'text-red-500' }}">
                        {{ $book->available_copies }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ number_format($book->price, 2) }} {{ __('ر.س') }}</td>
                    <td class="px-6 py-4">
                        @if ($book->available_copies > 0)
                            <a href="{{ route('reservations.create', $book) }}"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2 px-4 rounded-lg shadow transition">
                                {{ __('احجز الآن') }}
                            </a>
                        @else
                            <span class="text-red-600 font-semibold text-sm">{{ __('غير متاح') }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-gray-500 text-center text-lg">
                        {{ __('📭 لا توجد كتب متاحة حالياً.') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-6">
        {{ $books->links() }}
    </div>
</div>
