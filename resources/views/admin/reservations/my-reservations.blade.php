<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            📖 حجوزاتي
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($reservations->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 text-center text-gray-500">
                    لا توجد حجوزات حالياً 📚
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 space-y-4">
                    @foreach ($reservations as $reservation)
                        <div class="border-b pb-4 flex flex-col md:flex-row md:items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                                    {{ $reservation->book->title }}
                                </h3>
                                <p class="text-gray-600">✍️ {{ $reservation->book->author->name ?? 'غير معروف' }}</p>
                                <p class="text-gray-500">📅 تاريخ الإرجاع: {{ $reservation->return_date }}</p>
                                <p class="text-gray-500">
                                    📦 الحالة:
                                    <span
                                        class="font-semibold {{ $reservation->status === 'borrowed' ? 'text-blue-600' : 'text-green-600' }}">
                                        {{ $reservation->status === 'borrowed' ? 'قيد الإعارة' : 'تم الإرجاع' }}
                                    </span>
                                </p>
                            </div>

                            @if ($reservation->status === 'returned')
                                <form action="{{ route('reservations.rate', $reservation->id) }}" method="POST"
                                    class="mt-3 md:mt-0">
                                    @csrf
                                    <label for="rating" class="text-sm text-gray-700">قيّم الكتاب:</label>
                                    <select name="rating" id="rating"
                                        class="border border-gray-300 rounded-lg px-2 py-1 focus:ring-2 focus:ring-indigo-500"
                                        onchange="this.form.submit()">
                                        <option value="">اختر ⭐</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}"
                                                {{ $reservation->rating == $i ? 'selected' : '' }}>{{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </form>
                            @endif

                        </div>
                    @endforeach

                    <div class="mt-6">
                        {{ $reservations->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
