<?php
?>
<x-guest-layout>

    <x-slot name="logo">
        <a href="/">
            <div class="text-3xl font-extrabold text-blue-700">📚 LibraryEase</div>
        </a>
    </x-slot>

    <div class="mb-4 text-sm text-gray-600 text-right" dir="rtl">
        {{ __('شكراً لتسجيلك! قبل البدء، نرجو منك تأكيد عنوان بريدك الإلكتروني بالنقر على الرابط الذي أرسلناه للتو. إذا لم تستلم الرسالة، سنكون سعداء بإرسال رابط آخر.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 text-right" dir="rtl">
            {{ __('تم إرسال رابط تأكيد جديد إلى عنوان البريد الإلكتروني الذي قدمته أثناء التسجيل.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between" dir="rtl">

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                    {{ __('إعادة إرسال رابط التأكيد') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('تسجيل الخروج') }}
            </button>
        </form>
    </div>
</x-guest-layout>
