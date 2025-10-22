<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibraryEase - نظام إدارة المكتبة الافتراضية</title>

    <!-- Scripts & Styles -->@vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome for Icons (Required for icons used in Features) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap');

        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f7f9fc;
        }

        .hero-bg {
            /* تصميم الخلفية الهادئ من التصميم المدمج */
            background: linear-gradient(to bottom right, #1e3a8a, #3b82f6);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
            pointer-events: none;
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body class="antialiased bg-gray-50">
    <div class="relative min-h-screen">

        <!-- Header -->
        <header class="p-6 bg-white border-b border-gray-200 shadow-md fixed w-full top-0 z-50">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="text-2xl font-extrabold text-blue-700">📚 LibraryEase</div>

                <nav class="flex items-center space-x-4 space-x-reverse">
                    @auth
                        <span class="text-gray-700 font-medium hidden sm:inline">مرحباً، {{ Auth::user()->name }}</span>

                        @if (Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg font-semibold transition duration-150 shadow-md">
                                لوحة المدير
                            </a>
                        @endif

                        <a href="{{ route('dashboard') }}" class="text-blue-700 hover:text-blue-900 font-semibold">
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
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-semibold">تسجيل
                            الدخول</a>
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

        <main class="pt-16">
            <!-- Hero Section -->
            <section class="hero-bg text-center py-32">
                <div class="max-w-4xl mx-auto px-4 relative z-10">
                    <h1 class="text-6xl sm:text-7xl font-extrabold mb-6 text-shadow">مرحباً بك في <span
                            class="text-yellow-300">LibraryEase</span></h1>
                    <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed mb-8">
                        منصة ذكية لإدارة المكتبات وحجز الكتب بسهولة — اجمع بين متعة القراءة وسهولة الوصول إلى المعرفة.
                    </p>

                    @guest
                        <a href="{{ route('register') }}"
                            class="inline-block bg-yellow-400 hover:bg-yellow-500 text-blue-900 text-2xl font-bold px-10 py-4 rounded-xl shadow-2xl transform hover:scale-105 transition duration-300">
                            انضم إلينا الآن
                        </a>
                    @endguest
                </div>
            </section>

            <!-- About Section -->
            <section class="bg-white py-20">
                <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                    <!-- Text Content -->
                    <div class="lg:order-1 text-center lg:text-right">
                        <h2
                            class="text-4xl font-extrabold text-blue-700 mb-6 border-r-4 border-yellow-400 pr-4 inline-block">
                            عن المكتبة</h2>
                        <p class="text-gray-700 text-lg leading-relaxed mb-8">
                            تأسست <strong>LibraryEase</strong> عام <strong>2015</strong> فى قلب الرياض,
                            بهدف تسهيل الوصول إلى المعرفة لجميع القراء عبر منصة رقمية حديثة.
                            نقدم تجربة تصفح وحجز سهلة وسريعة، تجمع بين الراحة والتقنية الحديثة.
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-10">
                            <div class="p-4 bg-blue-50 rounded-xl shadow-sm">
                                <div class="text-4xl mb-2">📍</div>
                                <h3 class="text-lg font-bold text-blue-800">موقعنا</h3>
                                <p class="text-gray-600 text-sm">الرياض, السعودية</p>
                            </div>

                            <div class="p-4 bg-blue-50 rounded-xl shadow-sm">
                                <div class="text-4xl mb-2">📖</div>
                                <h3 class="text-lg font-bold text-blue-800">المخزون</h3>
                                <p class="text-gray-600 text-sm">آلاف الكتب المتاحة للحجز الفوري.</p>
                            </div>

                            <div class="p-4 bg-blue-50 rounded-xl shadow-sm">
                                <div class="text-4xl mb-2">📅</div>
                                <h3 class="text-lg font-bold text-blue-800">التأسيس</h3>
                                <p class="text-gray-600 text-sm">منذ 2015</p>
                            </div>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="flex justify-center lg:justify-start lg:order-2">

                        <img src="https://image.pollinations.ai/prompt/An%20abstract%20image%20representing%20reading%20and%20mind%20expansion.%20A%20person's%20silhouette%20is%20seen%20with%20gears%20and%20light%20radiating%20from%20their%20head,%20merging%20with%20open%20books%20and%20a%20dynamic,%20flowing%20network%20of%20information.%20The%20style%20is%20modern,%20fluid,%20and%20uses%20a%20palette%20of%20deep%20blues,%20purples,%20and%20bright%20yellows%20or%20golds%20to%20symbolize%20knowledge%20and%20creativity.%20Focus%20on%20flexibility%20and%20growth."
                            alt="صورة تجريدية للقراءة وتوسع العقل" class="rounded-3xl shadow-2xl max-w-full h-auto" />
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="bg-blue-700 text-white py-20 text-center">
                <div class="max-w-6xl mx-auto px-6">
                    <h2 class="text-4xl font-extrabold mb-10 border-b-4 border-yellow-400 pb-2 inline-block">مميزات
                        LibraryEase</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10">
                        <div
                            class="p-6 bg-blue-800 rounded-2xl shadow-xl transform hover:scale-105 transition duration-300">
                            <i class="fas fa-search text-5xl mb-4 text-yellow-400"></i>
                            <h3 class="text-2xl font-bold mb-2">حجز فوري وسهل</h3>
                            <p class="text-blue-100">احجز أي كتاب في ثوانٍ واستمتع بواجهة مستخدم بسيطة وسريعة.</p>
                        </div>

                        <div
                            class="p-6 bg-blue-800 rounded-2xl shadow-xl transform hover:scale-105 transition duration-300">
                            <i class="fab fa-github text-5xl mb-4 text-yellow-400"></i>
                            <h3 class="text-2xl font-bold mb-2">مصادقة متعددة</h3>
                            <p class="text-blue-100">دعم تسجيل الدخول التقليدي وعبر منصات التواصل (مثل GitHub) لسرعة
                                الوصول.</p>
                        </div>

                        <div
                            class="p-6 bg-blue-800 rounded-2xl shadow-xl transform hover:scale-105 transition duration-300">
                            <i class="fas fa-handshake text-5xl mb-4 text-yellow-400"></i>
                            <h3 class="text-2xl font-bold mb-2">إدارة احترافية</h3>
                            <p class="text-blue-100">واجهة إدارة مخصصة للمديرين لمتابعة الكتب والمخزون والحجوزات بسهولة.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-16 bg-indigo-600 text-white text-center">
                <div class="max-w-4xl mx-auto px-4">
                    <h3 class="text-4xl font-bold mb-4">ابدأ رحلتك المعرفية الآن</h3>
                    <p class="text-xl mb-8">تسجيل سريع، قراءة ممتعة.</p>
                    @guest
                        <a href="{{ route('register') }}"
                            class="inline-block bg-white text-indigo-600 hover:bg-gray-100 font-bold text-lg px-8 py-3 rounded-lg shadow-2xl transition duration-300 transform hover:translate-y-0.5">
                            إنشاء حساب مجاني
                        </a>
                    @endguest
                </div>
            </section>
        </main>

        <!-- Contact Section -->
        <section class="bg-gray-100 py-16">
            <div class="max-w-6xl mx-auto px-6 text-center">
                <h2 class="text-4xl font-extrabold text-gray-800 mb-6 border-b-4 border-yellow-400 inline-block pb-2">
                    تواصل معنا</h2>
                <p class="text-gray-600 mb-10">هل لديك أي استفسار أو اقتراح؟ نحن هنا لمساعدتك.</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
                        <i class="fas fa-map-marker-alt text-3xl text-yellow-400 mb-4"></i>
                        <h3 class="text-xl font-bold mb-2">موقعنا</h3>
                        <p class="text-gray-600">الرياض، المملكة العربية السعودية</p>
                    </div>

                    <div class="p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
                        <i class="fas fa-envelope text-3xl text-yellow-400 mb-4"></i>
                        <h3 class="text-xl font-bold mb-2">البريد الإلكتروني</h3>
                        <p class="text-gray-600">support@libraryease.com</p>
                    </div>

                    <div class="p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
                        <i class="fas fa-phone-alt text-3xl text-yellow-400 mb-4"></i>
                        <h3 class="text-xl font-bold mb-2">الهاتف</h3>
                        <p class="text-gray-600">+966 555 123 456</p>
                    </div>
                </div>

                <form action="#" method="POST" class="mt-12 max-w-2xl mx-auto text-left">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">الاسم</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 font-semibold mb-2">الرسالة</label>
                        <textarea id="message" name="message" rows="5" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-400 focus:outline-none"></textarea>
                    </div>
                    <button type="submit"
                        class="bg-yellow-400 hover:bg-yellow-500 text-indigo-900 font-bold px-6 py-3 rounded-lg shadow-lg transition duration-300">
                        إرسال الرسالة
                    </button>
                </form>
            </div>
        </section>

        <!-- Social Links -->
        <div class="mt-12 flex justify-center space-x-6 space-x-reverse">
            <a href="https://facebook.com/LibraryEase" target="_blank"
                class="text-blue-600 hover:text-blue-800 text-3xl transition duration-300">
                <i class="fab fa-facebook-square"></i>
            </a>

            <a href="https://twitter.com/LibraryEase" target="_blank"
                class="text-sky-500 hover:text-sky-700 text-3xl transition duration-300">
                <i class="fab fa-twitter-square"></i>
            </a>

            <a href="https://instagram.com/LibraryEase" target="_blank"
                class="text-pink-500 hover:text-pink-700 text-3xl transition duration-300">
                <i class="fab fa-instagram-square"></i>
            </a>
        </div>



        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300 text-center py-6 border-t-4 border-yellow-400">
            <p>© {{ date('Y') }} LibraryEase. جميع الحقوق محفوظة.</p>
        </footer>

    </div>
</body>

</html>
