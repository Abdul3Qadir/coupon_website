<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} — Coupono</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter bg-[#f8f9fb]">
    @php $brand = auth('brand')->user(); @endphp

    <div id="mobileSidebarBackdrop" class="fixed inset-0 z-40 hidden bg-gray-900/50 lg:hidden"></div>

    {{-- Sidebar --}}
    <aside id="dashboardSidebar" class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col -translate-x-full border-r border-gray-200 bg-white transition-transform duration-200 lg:translate-x-0">
        <div class="flex h-16 shrink-0 items-center justify-between px-5 border-b border-gray-100">
            <a href="{{ route('brand.dashboard') }}" class="flex items-center gap-2">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-linear-to-br from-red-500 to-rose-600 font-Manrope text-sm font-extrabold text-white">C</span>
                <span class="font-Manrope text-base font-extrabold text-gray-900">Coupono</span>
            </a>
            <button type="button" id="closeSidebarBtn" class="cursor-pointer lg:hidden text-gray-400 hover:text-gray-600">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto custom-scrollbar px-3 py-5 space-y-1.5">
            <x-brand.sidebar-link :href="route('brand.dashboard')" :active="request()->routeIs('brand.dashboard')">
                <x-slot:icon><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg></x-slot:icon>
                Dashboard
            </x-brand.sidebar-link>

            <x-brand.sidebar-link :href="route('brand.offers.index')" :active="request()->routeIs('brand.offers.*')" :badge="$pendingOffersCount ?? null">
                <x-slot:icon><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41L11 3.83A2 2 0 009.59 3.24H4a1 1 0 00-1 1v5.59a2 2 0 00.59 1.41l9.58 9.58a2 2 0 002.82 0l5.59-5.59a2 2 0 000-2.82z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg></x-slot:icon>
                My Coupons &amp; Deals
            </x-brand.sidebar-link>

            <x-brand.sidebar-link href="{{ route('brand.analytics.index') }}" :active="request()->routeIs('brand.analytics.*')">
                <x-slot:icon><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></x-slot:icon>
                Analytics
            </x-brand.sidebar-link>

            <x-brand.sidebar-link :href="route('brand.settings.edit')" :active="request()->routeIs('brand.settings.*')">
                <x-slot:icon><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg></x-slot:icon>
                Settings
            </x-brand.sidebar-link>
        </nav>

        <div class="shrink-0 border-t border-gray-100 p-4">
            <div class="flex items-center gap-3 rounded-xl bg-gray-50 p-3 mb-3">
                @if ($brand->small_logo)
                    <img src="{{ asset('storage/' . $brand->small_logo) }}" alt="{{ $brand->name }}" class="h-8 w-8 rounded-full object-cover">
                @else
                    <x-avatar :name="$brand->name" size="sm" />
                @endif
                <div class="min-w-0">
                    <p class="font-Manrope text-sm font-bold text-gray-900 truncate">{{ $brand->name }}</p>
                    <p class="font-Inter text-xs text-gray-500 truncate">{{ $brand->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('brand.logout') }}">
                @csrf
                <button type="button" class="confirm-action cursor-pointer flex w-full items-center justify-center gap-2 rounded-lg px-3 py-2.5 font-Inter text-sm font-semibold text-gray-500 hover:bg-gray-50 hover:text-red-600 transition" data-confirm-title="Log out?" data-confirm-message="You'll need to sign in again to access your dashboard." data-confirm-button="Yes, Log Out">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="lg:pl-72">
        <header class="sticky top-0 z-30 flex h-16 items-center justify-between gap-4 border-b border-gray-200 bg-white/90 backdrop-blur px-4 sm:px-6">
            <button type="button" id="openSidebarBtn" class="cursor-pointer lg:hidden text-gray-500 hover:text-gray-900">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>

            <p class="hidden sm:block font-Manrope text-base font-bold text-gray-900">{{ $title ?? 'Dashboard' }}</p>

            <div class="flex items-center gap-3 ml-auto">
                <x-notification-dropdown />
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            {{ $slot }}
        </main>
    </div>

    <x-confirm-modal />
</body>
</html>
