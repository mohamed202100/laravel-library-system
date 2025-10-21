<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibraryEase - نظام إدارة المكتبة الافتراضية</title>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>

<body class="antialiased bg-gray-50">
    <div class="relative min-h-screen">

        <header class="p-6 bg-white border-b border-gray-200 shadow-lg">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="text-2xl font-bold text-blue-600">LibraryEase</div>

                <nav class="flex items-center space-x-4 space-x-reverse">
                    @auth
                        <span class="text-gray-700 font-medium">مرحباً، {{ Auth::user()->name }}</span>

                        @if (Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-white bg-green-500 hover:bg-green-600 px-3 py-1.5 rounded-lg font-semibold transition duration-150 shadow-md">
                                لوحة المدير
                            </a>
                        @endif

                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-semibold">
                            تصفح المكتبة
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-red-500 hover:text-red-700 font-semibold border-2 border-red-500 rounded-lg px-3 py-1.5 transition duration-150">
                                تسجيل الخروج
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-semibold">
                            تسجيل الدخول
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg font-semibold transition duration-150 shadow-md">
                                التسجيل
                            </a>
                        @endif
                    @endauth
                </nav>
            </div>
        </header>

        <main class="py-20 text-center">
            <div class="max-w-4xl mx-auto px-4">
                <h1 class="text-6xl font-extrabold text-gray-900 mb-6">
                    مستقبلك يبدأ من هنا
                </h1>
                <h2 class="text-7xl font-extrabold text-blue-600 mb-8">
                    LibraryEase
                </h2>
                <p class="text-xl text-gray-700 mb-10 leading-relaxed">
                    نظام إدارة المكتبة الافتراضية، يجمع بين سهولة حجز الكتب للقارئ وكفاءة إدارة المخزون للمدير.
                </p>

                @guest
                    <a href="{{ route('register') }}"
                        class="inline-block bg-green-600 hover:bg-green-700 text-white text-2xl font-bold px-10 py-4 rounded-xl shadow-2xl transform hover:scale-105 transition duration-300">
                        ابدأ رحلة القراءة الآن
                    </a>
                @endguest

                @auth
                    <p class="text-xl text-gray-700">
                        للانتقال إلى لوحة التحكم الخاصة بك، اضغط على زر
                        <a href="{{ route('dashboard') }}" class="text-blue-600 font-bold hover:text-blue-800">تصفح
                            المكتبة</a> في شريط التنقل.
                    </p>
                @endauth

            </div>
        </main>

    </div>
</body>

</html>
