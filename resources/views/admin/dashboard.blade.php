<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 17v-2a4 4 0 00-4-4H4m6 6v2m0-2h4a4 4 0 014 4v2M9 17h4m6 0h.01M6 9h.01M18 9h.01M12 9h.01" />
            </svg>
            {{ __('لوحة تحكم المدير') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                <div class="p-8 text-gray-900">

                    <h3 class="text-3xl font-bold mb-10 text-indigo-700 text-center border-b pb-4">
                        {{ __('مرحباً بك في لوحة إدارة النظام') }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                        <!-- إدارة الكتب -->
                        <div
                            class="group bg-gradient-to-br from-indigo-50 to-indigo-100 p-6 rounded-2xl border border-indigo-200 shadow-md hover:shadow-2xl hover:scale-[1.03] transition duration-300">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-xl font-semibold text-indigo-800">{{ __('إدارة الكتب') }}</h4>
                                <i class="fa-solid fa-book text-indigo-500 text-3xl"></i>
                            </div>
                            <p class="text-gray-700 mb-4 leading-relaxed">
                                {{ __('إضافة، تعديل، حذف الكتب ومتابعة النسخ المتاحة.') }}
                            </p>
                            <a href="{{ route('admin.books.index') }}"
                                class="text-indigo-700 font-semibold group-hover:text-indigo-900 transition">
                                {{ __('الانتقال »') }}
                            </a>
                        </div>

                        <!-- إدارة المؤلفين -->
                        <div
                            class="group bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl border border-green-200 shadow-md hover:shadow-2xl hover:scale-[1.03] transition duration-300">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-xl font-semibold text-green-800">{{ __('إدارة المؤلفين') }}</h4>
                                <i class="fa-solid fa-feather-pointed text-green-500 text-3xl"></i>
                            </div>
                            <p class="text-gray-700 mb-4 leading-relaxed">
                                {{ __('إضافة، تعديل، أو حذف المؤلفين ومتابعة أعمالهم.') }}
                            </p>
                            <a href="{{ route('admin.authors.index') }}"
                                class="text-green-700 font-semibold group-hover:text-green-900 transition">
                                {{ __('الانتقال »') }}
                            </a>
                        </div>

                        <!-- الحجوزات -->
                        <div
                            class="group bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-2xl border border-yellow-200 shadow-md hover:shadow-2xl hover:scale-[1.03] transition duration-300">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-xl font-semibold text-yellow-800">{{ __('متابعة الحجوزات') }}</h4>
                                <i class="fa-solid fa-calendar-check text-yellow-500 text-3xl"></i>
                            </div>
                            <p class="text-gray-700 mb-4 leading-relaxed">
                                {{ __('عرض وتحديث حالات حجز الكتب والإرجاع بسهولة.') }}
                            </p>
                            <a href="{{ route('admin.reservations.index') }}"
                                class="text-yellow-700 font-semibold group-hover:text-yellow-900 transition">
                                {{ __('الانتقال »') }}
                            </a>
                        </div>

                        <!-- المستخدمين -->
                        <div
                            class="group bg-gradient-to-br from-rose-50 to-rose-100 p-6 rounded-2xl border border-rose-200 shadow-md hover:shadow-2xl hover:scale-[1.03] transition duration-300">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-xl font-semibold text-rose-800">{{ __('إدارة المستخدمين') }}</h4>
                                <i class="fa-solid fa-users text-rose-500 text-3xl"></i>
                            </div>
                            <p class="text-gray-700 mb-4 leading-relaxed">
                                {{ __('عرض تفاصيل المستخدمين وإدارة حساباتهم.') }}
                            </p>
                            <a href="{{ route('admin.users.index') }}"
                                class="text-rose-700 font-semibold group-hover:text-rose-900 transition">
                                {{ __('الانتقال »') }}
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
