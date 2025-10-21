<?php
// يتم تمرير هذا الـ View من مسار /register
?>
<x-guest-layout>

    {{-- محتوى الشعار والبطاقة --}}
    <x-slot name="logo">
        <a href="/">
            <div class="text-3xl font-extrabold text-blue-700">📚 LibraryEase</div>
        </a>
        <h2 class="text-xl font-semibold text-gray-700 mt-4">{{ __('إنشاء حساب قارئ جديد') }}</h2>
    </x-slot>

    <form method="POST" action="{{ route('register') }}" dir="rtl">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('الاسم')" />
            <x-text-input id="name" class="block mt-1 w-full text-right" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('البريد الإلكتروني')" />
            <x-text-input id="email" class="block mt-1 w-full text-right" type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('كلمة المرور')" />

            <x-text-input id="password" class="block mt-1 w-full text-right" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full text-right" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- زر التسجيل الأساسي -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4 w-full justify-center bg-blue-600 hover:bg-blue-700">
                {{ __('إنشاء حساب') }}
            </x-primary-button>
        </div>

        <!-- قسم المصادقة عبر GitHub (جاهز للتفعيل) -->
        <div class="mt-4 border-t pt-4">
            <a href="{{ route('github.login') }}"
                class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                <i class="fab fa-github me-2"></i>
                {{ __('التسجيل عبر GitHub') }}
            </a>
        </div>

        <!-- رابط تسجيل الدخول -->
        <div class="mt-4 text-center">
            <a class="underline text-sm text-gray-600 hover:text-indigo-600" href="{{ route('login') }}">
                {{ __('لديك حساب بالفعل؟ تسجيل الدخول') }}
            </a>
        </div>

    </form>
</x-guest-layout>
