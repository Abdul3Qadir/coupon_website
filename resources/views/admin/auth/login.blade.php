<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    <x-auth-card title="Admin Login" subtitle="Manage stores, offers, and blogs">
        <x-slot:footer>
            Need Sub-Admin access?
            <a href="{{ route('admin.register') }}" class="font-semibold text-red-600 hover:text-red-700">Request access</a>
        </x-slot:footer>

        @session('status')
            <div class="mb-4 rounded-lg bg-emerald-50 px-3 py-2.5 font-Inter text-xs font-semibold text-emerald-700">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
            @csrf

            <div>
                <x-label value="Email Address" />
                <x-input type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div>
                <x-label value="Password" />
                <x-input type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-red-600 focus:ring-red-200">
                <span class="font-Inter text-sm text-gray-600">Remember me</span>
            </label>

            <x-primary-button>Log In</x-primary-button>
        </form>
    </x-auth-card>
</body>
</html>
