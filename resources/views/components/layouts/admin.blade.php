<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} — Coupono Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter bg-[#f8f9fb]">
    @php
        $admin = auth('admin')->user();
        $isSuperAdmin = $admin->isSuperAdmin();
    @endphp

    <div id="mobileSidebarBackdrop" class="fixed inset-0 z-40 hidden bg-gray-900/50 lg:hidden"></div>

    <aside id="dashboardSidebar" class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col -translate-x-full border-r border-gray-200 bg-white transition-transform duration-200 lg:translate-x-0">
        <div class="flex h-16 shrink-0 items-center justify-between px-5 border-b border-gray-100">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-linear-to-br from-red-500 to-rose-600 font-Manrope text-sm font-extrabold text-white">C</span>
                <span class="font-Manrope text-base font-extrabold text-gray-900">Coupono<span class="text-red-600"> Admin</span></span>
            </a>
            <button type="button" id="closeSidebarBtn" class="cursor-pointer lg:hidden text-gray-400 hover:text-gray-600">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto custom-scrollbar px-3 py-4">
            <x-admin.sidebar-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                <x-slot:icon><svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg></x-slot:icon>
                Dashboard
            </x-admin.sidebar-link>

            @if ($isSuperAdmin)
                <x-admin.sidebar-group label="Management" />
                <x-admin.sidebar-link :href="route('admin.brands.index')" :active="request()->routeIs('admin.brands.*')" :badge="$pendingBrandsCount ?? null">
                    <x-slot:icon><svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21V7l9-4 9 4v14"/><path d="M9 21V12h6v9"/></svg></x-slot:icon>
                    Brands
                </x-admin.sidebar-link>
                <x-admin.sidebar-link href="#" :badge="$pendingSubAdminsCount ?? null">
                    <x-slot:icon><svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg></x-slot:icon>
                    Sub-Admins
                </x-admin.sidebar-link>
                <x-admin.sidebar-link href="#">
                    <x-slot:icon><svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg></x-slot:icon>
                    Categories
                </x-admin.sidebar-link>
                <x-admin.sidebar-link href="#">
                    <x-slot:icon><svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg></x-slot:icon>
                    Blog Categories
                </x-admin.sidebar-link>
            @endif

            <x-admin.sidebar-group label="Content" />
            <x-admin.sidebar-link href="#" :badge="$pendingOffersCount ?? null">
                <x-slot:icon><svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41L11 3.83A2 2 0 009.59 3.24H4a1 1 0 00-1 1v5.59a2 2 0 00.59 1.41l9.58 9.58a2 2 0 002.82 0l5.59-5.59a2 2 0 000-2.82z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg></x-slot:icon>
                Offers
            </x-admin.sidebar-link>
            <x-admin.sidebar-link href="#">
                <x-slot:icon><svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg></x-slot:icon>
                Blogs
            </x-admin.sidebar-link>

            @if ($isSuperAdmin)
                <x-admin.sidebar-group label="Insights" />
                <x-admin.sidebar-link href="#">
                    <x-slot:icon><svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></x-slot:icon>
                    Analytics
                </x-admin.sidebar-link>
            @endif

            <x-admin.sidebar-group label="Communication" />
            <x-admin.sidebar-link href="#" :badge="$unreadMessagesCount ?? null">
                <x-slot:icon><svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></x-slot:icon>
                Chat
            </x-admin.sidebar-link>

            <x-admin.sidebar-group label="Account" />
            <x-admin.sidebar-link href="#">
                <x-slot:icon><svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></x-slot:icon>
                Profile
            </x-admin.sidebar-link>
        </nav>

        <div class="shrink-0 border-t border-gray-100 p-4">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="button" class="confirm-action cursor-pointer flex w-full items-center gap-2 rounded-lg px-3 py-2 font-Inter text-sm font-semibold text-gray-500 hover:bg-gray-50 hover:text-red-600 transition" data-confirm-title="Log out?" data-confirm-message="You'll need to sign in again to access the dashboard." data-confirm-button="Yes, Log Out">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="lg:pl-64">
        <header class="sticky top-0 z-30 flex h-16 items-center justify-between gap-4 border-b border-gray-200 bg-white/90 backdrop-blur px-4 sm:px-6">
            <button type="button" id="openSidebarBtn" class="cursor-pointer lg:hidden text-gray-500 hover:text-gray-900">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>

            <div class="hidden sm:flex flex-1 max-w-md items-center gap-2 rounded-full border border-gray-200 bg-gray-50 px-4 py-2 transition focus-within:border-red-200 focus-within:bg-white">
                <svg class="h-4 w-4 shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                <input type="text" placeholder="Search brands, offers, blogs..." class="w-full bg-transparent outline-none font-Inter text-sm text-gray-700 placeholder:text-gray-400">
                <kbd class="hidden md:inline-block rounded border border-gray-300 bg-white px-1.5 py-0.5 font-Inter text-[10px] font-semibold text-gray-400">⌘K</kbd>
            </div>

            <div class="flex items-center gap-1.5 sm:gap-3 ml-auto">
                <a href="#" class="relative flex h-9 w-9 items-center justify-center rounded-full text-gray-500 hover:bg-gray-50 hover:text-gray-900 transition">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                    @if (($unreadNotificationsCount ?? 0) > 0)
                        <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-600 ring-2 ring-white"></span>
                    @endif
                </a>

                <a href="#" class="relative flex h-9 w-9 items-center justify-center rounded-full text-gray-500 hover:bg-gray-50 hover:text-gray-900 transition">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>
                    @if (($unreadMessagesCount ?? 0) > 0)
                        <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-600 ring-2 ring-white"></span>
                    @endif
                </a>

                <div class="flex items-center gap-2 pl-2 sm:pl-3 border-l border-gray-200">
                    <x-avatar :name="$admin->name" size="sm" class="ring-2 ring-red-100" />
                    <div class="hidden sm:block">
                        <p class="font-Manrope text-sm font-bold text-gray-900 leading-tight">{{ $admin->name }}</p>
                        <p class="font-Inter text-xs text-gray-500 leading-tight">{{ $admin->role->label() }}</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            {{ $slot }}
        </main>
    </div>

    <x-confirm-modal />
</body>
</html>