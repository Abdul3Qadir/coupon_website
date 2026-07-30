<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    <x-auth-card title="Enter Verification Code" subtitle="We've sent a 6-digit code to your email address">
        @session('status')
            <div class="mb-4 rounded-lg bg-emerald-50 px-3 py-2.5 font-Inter text-xs font-semibold text-emerald-700">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('brand.password.verify') }}" class="space-y-4">
            @csrf

            <div>
                <x-label value="Verification Code" />
                <x-input type="text" name="code" inputmode="numeric" maxlength="6" placeholder="123456" required autofocus class="text-center tracking-[0.5em] font-Manrope text-lg font-bold" />
                <x-input-error :messages="$errors->get('code')" />
            </div>

            <x-primary-button>Verify Code</x-primary-button>
        </form>

        <form method="POST" action="{{ route('brand.password.resend') }}" class="mt-4">
            @csrf
            <button type="submit" class="cursor-pointer w-full text-center font-Inter text-sm font-semibold text-red-600 hover:text-red-700">
                Resend Code
            </button>
        </form>
    </x-auth-card>
</body>
</html>