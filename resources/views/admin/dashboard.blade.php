<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            لوحة تحكم المدير
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-medium mb-4 text-blue-600">أهلاً بك أيها المدير!</h3>

                    <p class="mb-6">من هنا يمكنك إدارة المخزون، والمؤلفين، ومتابعة الحجوزات.</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- بطاقة إدارة الكتب --}}
                        <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-500 shadow-md">
                            <h4 class="text-lg font-semibold mb-2">إدارة الكتب</h4>
                            <p class="text-gray-600 mb-4">إضافة، تعديل، وحذف الكتب.</p>
                            <a href="{{ route('admin.books.index') }}"
                                class="text-blue-600 hover:text-blue-800 font-medium">
                                الانتقال »
                            </a>
                        </div>

                        {{-- بطاقة إدارة المؤلفين --}}
                        <div class="bg-green-50 p-6 rounded-lg border-l-4 border-green-500 shadow-md">
                            <h4 class="text-lg font-semibold mb-2">إدارة المؤلفين</h4>
                            <p class="text-gray-600 mb-4">إدارة بيانات المؤلفين.</p>
                            <a href="#" class="text-green-600 hover:text-green-800 font-medium">
                                الانتقال » (سنفعلها لاحقاً)
                            </a>
                        </div>

                        {{-- بطاقة إدارة الحجوزات --}}
                        <div class="bg-yellow-50 p-6 rounded-lg border-l-4 border-yellow-500 shadow-md">
                            <h4 class="text-lg font-semibold mb-2">متابعة الحجوزات</h4>
                            <p class="text-gray-600 mb-4">عرض سجلات الإعارة وحالات الإرجاع.</p>
                            <a href="#" class="text-yellow-600 hover:text-yellow-800 font-medium">
                                الانتقال » (سنفعلها لاحقاً)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
