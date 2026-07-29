<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub-Admin Registration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    <x-auth-card title="Sub-Admin Registration" subtitle="Your account needs Super Admin approval before you can start">
        <x-slot:footer>
            Already have an account?
            <a href="{{ route('admin.login') }}" class="font-semibold text-red-600 hover:text-red-700">Log in</a>
        </x-slot:footer>

        <form method="POST" action="{{ route('admin.register') }}" class="space-y-4">
            @csrf

            <div>
                <x-label value="Full Name" />
                <x-input type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div>
                <x-label value="Email Address" />
                <x-input type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div>
                <x-label value="Password" />
                <x-input type="password" name="password" required />
                <p class="mt-1 font-Inter text-[11px] text-gray-400">At least 8 characters, mixed case, a number, and a symbol.</p>
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <div>
                <x-label value="Confirm Password" />
                <x-input type="password" name="password_confirmation" required />
            </div>

            <x-primary-button>Request Access</x-primary-button>
        </form>
    </x-auth-card>
</body>
</html>
