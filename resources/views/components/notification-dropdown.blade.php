@php
    // Auto-detect guard if not passed as prop
    if (!isset($guard)) {
        if (auth('admin')->check()) {
            $guard = 'admin';
        } elseif (auth('brand')->check()) {
            $guard = 'brand';
        } else {
            $guard = 'web';
        }
    }

    $user = auth($guard)->user();
    $notifications = collect();
    $unreadCount = 0;

    if ($user) {
        $notifications = $user->notifications()->latest()->take(6)->get();
        $unreadCount = $user->unreadNotifications()->count();
    }
@endphp

<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="relative p-2 text-gray-600 hover:text-gray-900 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <div x-show="open" @click.away="open = false"
         class="absolute right-0 z-50 w-80 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
         style="display: none;">
        
        <div class="px-4 py-2 border-b border-gray-200">
            <h3 class="text-sm font-semibold text-gray-700">Notifications</h3>
        </div>

        <div class="max-h-64 overflow-y-auto">
            @if($notifications->count() > 0)
                @foreach($notifications as $notification)
                    <a href="{{ $notification->data['url'] ?? ($guard === 'admin' ? route('admin.notifications.index') : route('brand.notifications.index')) }}"
                       class="block px-4 py-3 hover:bg-gray-50 {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }}">
                        <p class="text-sm text-gray-800">
                            {{ $notification->data['message'] ?? 'New notification' }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $notification->created_at->diffForHumans() }}
                        </p>
                    </a>
                @endforeach
            @else
                <div class="px-4 py-6 text-center text-sm text-gray-500">
                    No notifications yet
                </div>
            @endif
        </div>

        @if($notifications->count() > 0)
            <div class="border-t border-gray-200 px-4 py-2 text-center">
                <a href="{{ $guard === 'admin' ? route('admin.notifications.index') : route('brand.notifications.index') }}"
                   class="text-xs font-medium text-indigo-600 hover:text-indigo-500">
                    View all
                </a>
            </div>
        @endif
    </div>
</div>