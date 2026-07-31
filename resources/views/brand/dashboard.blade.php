<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter bg-[#f8f9fb]">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-50">
                <svg class="h-8 w-8 text-emerald-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h1 class="mt-6 font-Manrope text-2xl font-extrabold text-gray-900">Welcome, {{ auth('brand')->user()->name }}</h1>
            <p class="mt-3 font-Inter text-sm sm:text-base text-gray-600">Your brand is verified. The full dashboard (coupons, deals, analytics, settings) is coming soon.</p>

            <form method="POST" action="{{ route('brand.logout') }}" class="mt-8">
                @csrf
                <button type="button" class="confirm-action cursor-pointer rounded-full bg-gray-100 hover:bg-gray-200 px-5 py-2.5 font-Manrope text-sm font-bold text-gray-800 transition" data-confirm-title="Log out?" data-confirm-message="You'll need to sign in again to access your dashboard." data-confirm-button="Yes, Log Out">
                    Log Out
                </button>
            </form>
        </div>
    </div>

    <x-confirm-modal />
</body>
</html>