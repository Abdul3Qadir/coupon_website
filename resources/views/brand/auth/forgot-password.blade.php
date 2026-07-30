<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    <x-auth-card title="Forgot Password?" subtitle="Enter your email and we'll send you a verification code">
        <x-slot:footer>
            Remembered it?
            <a href="{{ route('brand.login') }}" class="font-semibold text-red-600 hover:text-red-700">Back to login</a>
        </x-slot:footer>

        <form method="POST" action="{{ route('brand.password.email') }}" class="space-y-4">
            @csrf

            <div>
                <x-label value="Email Address" />
                <x-input type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <x-primary-button>Send Verification Code</x-primary-button>
        </form>
    </x-auth-card>
</body>
</html>