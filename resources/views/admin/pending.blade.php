<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Under Review</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    @include("pages-components.navbar")
    <div class="min-h-screen flex items-center justify-center bg-[#f8f9fb] px-4">
        <div class="w-full max-w-md text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-amber-50">
                <svg class="h-8 w-8 text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                </svg>
            </div>

            <h1 class="mt-6 font-Manrope text-2xl font-extrabold text-gray-900">Your Access is Pending</h1>
            <p class="mt-3 font-Inter text-sm sm:text-base text-gray-600">
                Hi <strong>{{ auth('admin')->user()->name }}</strong>, the Super Admin needs to approve your Sub-Admin access before you can manage coupons, deals, or blogs.
            </p>

            <form method="POST" action="{{ route('admin.logout') }}" class="mt-8">
                @csrf
                <button type="button" class="confirm-action cursor-pointer font-Inter text-sm font-semibold text-gray-500 hover:text-gray-700" data-confirm-title="Log out?" data-confirm-message="You will need to sign in again to check your approval status." data-confirm-button="Yes, Log Out">
                    Log Out
                </button>
            </form>
        </div>
    </div>

    <x-confirm-modal />
    @include("pages-components.footer")
</body>
</html>
