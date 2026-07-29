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

    <aside id="dashboardSidebar" class="fixed inset-y-0 left-0 z-50 w-64 -translate-x-full border-r border-gray-200 bg-white transition-transform duration-200 lg:translate-x-0">
        <div class="flex h-16 items-center justify-between px-5 border-b border-gray-100">
            <a href="{{ route('admin.dashboard') }}" class="font-Manrope text-lg font-extrabold text-gray-900">Coupono<span class="text-red-600"> Admin</span></a>
            <button type="button" id="closeSidebarBtn" class="cursor-pointer lg:hidden text-gray-400 hover:text-gray-600">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-4" style="height: calc(100% - 8.5rem)">
            <x-admin.sidebar-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                <x-slot:icon>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                </x-slot:icon>
                Dashboard
            </x-admin.sidebar-link>

            @if ($isSuperAdmin)
                <x-admin.sidebar-group label="Management" />
                <x-admin.sidebar-link href="#" :badge="$pendingBrandsCount ?? null">Brands</x-admin.sidebar-link>
                <x-admin.sidebar-link href="#" :badge="$pendingSubAdminsCount ?? null">Sub-Admins</x-admin.sidebar-link>
                <x-admin.sidebar-link href="#">Categories</x-admin.sidebar-link>
                <x-admin.sidebar-link href="#">Blog Categories</x-admin.sidebar-link>
            @endif

            <x-admin.sidebar-group label="Content" />
            <x-admin.sidebar-link href="#" :badge="$pendingOffersCount ?? null">Offers</x-admin.sidebar-link>
            <x-admin.sidebar-link href="#">Blogs</x-admin.sidebar-link>

            @if ($isSuperAdmin)
                <x-admin.sidebar-group label="Insights" />
                <x-admin.sidebar-link href="#">Analytics</x-admin.sidebar-link>
            @endif

            <x-admin.sidebar-group label="Communication" />
            <x-admin.sidebar-link href="#" :badge="$unreadMessagesCount ?? null">Chat</x-admin.sidebar-link>

            <x-admin.sidebar-group label="Account" />
            <x-admin.sidebar-link href="#">Profile</x-admin.sidebar-link>
        </nav>

        <div class="absolute inset-x-0 bottom-0 border-t border-gray-100 p-4">
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

            <div class="hidden sm:flex flex-1 max-w-md items-center gap-2 rounded-full border border-gray-200 bg-gray-50 px-4 py-2">
                <svg class="h-4 w-4 shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                <input type="text" placeholder="Search..." class="w-full bg-transparent outline-none font-Inter text-sm text-gray-700 placeholder:text-gray-400">
            </div>

            <div class="flex items-center gap-2 sm:gap-4 ml-auto">
                <a href="#" class="relative flex h-9 w-9 items-center justify-center rounded-full text-gray-500 hover:bg-gray-50 hover:text-gray-900 transition">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                    @if (($unreadNotificationsCount ?? 0) > 0)
                        <span class="absolute top-1 right-1.5 h-2 w-2 rounded-full bg-red-600"></span>
                    @endif
                </a>

                <a href="#" class="relative flex h-9 w-9 items-center justify-center rounded-full text-gray-500 hover:bg-gray-50 hover:text-gray-900 transition">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>
                    @if (($unreadMessagesCount ?? 0) > 0)
                        <span class="absolute top-1 right-1.5 h-2 w-2 rounded-full bg-red-600"></span>
                    @endif
                </a>

                <div class="flex items-center gap-2 pl-2 sm:pl-3 border-l border-gray-200">
                    <x-avatar :name="$admin->name" size="sm" />
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
