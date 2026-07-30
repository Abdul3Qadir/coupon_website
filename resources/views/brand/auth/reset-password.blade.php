<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    <x-auth-card title="Set a New Password" subtitle="Choose a strong password you haven't used before">
        <form method="POST" action="{{ route('brand.password.update') }}" class="space-y-4">
            @csrf

            <div>
                <x-label value="New Password" />
                <x-input type="password" name="password" required autofocus />
                <p class="mt-1 font-Inter text-[11px] text-gray-400">At least 8 characters, mixed case, a number, and a symbol.</p>
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <div>
                <x-label value="Confirm New Password" />
                <x-input type="password" name="password_confirmation" required />
            </div>

            <x-primary-button>Reset Password</x-primary-button>
        </form>
    </x-auth-card>
</body>
</html>