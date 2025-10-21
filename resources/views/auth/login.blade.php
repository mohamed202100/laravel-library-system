<?php
// يتم تمرير هذا الـ View من مسار /login
?>
<x-guest-layout>

    {{-- محتوى الشعار والبطاقة (الذي كان سابقاً slot logo) --}}
    <x-slot name="logo">
        <a href="/">
            <div class="text-3xl font-extrabold text-blue-700">📚 LibraryEase</div>
        </a>
        <h2 class="text-xl font-semibold text-gray-700 mt-4">{{ __('تسجيل الدخول إلى حسابك') }}</h2>
    </x-slot>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" dir="rtl">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('البريد الإلكتروني')" />
            <x-text-input id="email" class="block mt-1 w-full text-right" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('كلمة المرور')" />
            <x-text-input id="password" class="block mt-1 w-full text-right" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="block mt-4 flex justify-between items-center">

            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('تذكرني') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('هل نسيت كلمة المرور؟') }}
                </a>
            @endif
        </div>

        <!-- زر تسجيل الدخول الأساسي -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3 w-full justify-center bg-blue-600 hover:bg-blue-700">
                {{ __('تسجيل الدخول') }}
            </x-primary-button>
        </div>

        <!-- قسم المصادقة عبر GitHub (جاهز للتفعيل) -->
        <div class="mt-4 border-t pt-4">
            <a href="{{ route('github.login') }}"
                class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                <i class="fab fa-github me-2"></i>
                {{ __('تسجيل الدخول عبر GitHub') }}
            </a>
        </div>

        <!-- رابط التسجيل -->
        <div class="mt-4 text-center">
            <a class="underline text-sm text-gray-600 hover:text-indigo-600" href="{{ route('register') }}">
                {{ __('ليس لديك حساب؟ سجل الآن') }}
            </a>
        </div>

    </form>
</x-guest-layout>
