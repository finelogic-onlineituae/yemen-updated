<x-app-layout>
    <x-slot name="header">
        <h2 class="w-100 text-center">
            {{ __('التحقق من البريد الإلكتروني') }}
        </h2>
    </x-slot>

    <div class="bg-ash p-2 rounded text-center rounded m-2 shadow">
        <h4>مرحباً!</h4>
        <p>يجب التحقق من بريدك الإلكتروني قبل التقديم. انقر على الرابط لتلقي رسالة تأكيد على بريدك الإلكتروني المسجل!</p>
        معرف البريد الإلكتروني المسجل الخاص بك هو <b>{{ auth()->user()->email }}</b>
        <p class="mt-2">
            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <button class="btn btn-primary">إرسال رابط التحقق</button>
            </form>
        @if(session('verification-sent')) 
            <p class="mt-2 text-success">{{ session('verification-sent') }}</p>
        @endif
    </div>
      
</x-app-layout>
