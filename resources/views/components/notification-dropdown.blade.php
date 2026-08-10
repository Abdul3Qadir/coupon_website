@php
    if (request()->is('admin/*')) {
        $guard = 'admin';
    } elseif (request()->is('brand/*')) {
        $guard = 'brand';
    } else {
        $guard = auth('admin')->check() ? 'admin' : (auth('brand')->check() ? 'brand' : null);
    }

    $user = $guard ? auth($guard)->user() : null;

    if (!$user) return;
@endphp

@if($guard)
@php
    $indexRoute = $guard === 'admin' 
        ? route('admin.notifications.index') 
        : route('brand.notifications.index');
    
    $markAllRoute = $guard === 'admin' 
        ? route('admin.notifications.mark-all-read') 
        : route('brand.notifications.mark-all-read');
    
    $readRoutePrefix = $guard === 'admin' 
        ? 'admin.notifications.read' 
        : 'brand.notifications.read';

    $recentNotifications = $user->notifications()->latest()->take(6)->get();
    $unreadNotificationsCount = $user->unreadNotifications()->count();
@endphp

<div class="relative" id="notificationDropdownContainer">
    <button type="button" id="notificationBellBtn" class="relative flex h-9 w-9 cursor-pointer items-center justify-center rounded-full text-gray-500 hover:text-gray-900 transition">
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 01-3.46 0"/>
        </svg>
        @if($unreadNotificationsCount > 0)
            <span class="absolute top-1 right-1 h-2.5 w-2.5 rounded-full bg-red-600 ring-2 ring-white"></span>
        @endif
    </button>

    <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-[calc(100vw-1.5rem)] sm:w-96 rounded-2xl bg-white border border-gray-200 shadow-xl shadow-gray-200/50 z-50 overflow-hidden origin-top-right">
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-100">
            <h3 class="font-Manrope text-sm font-extrabold text-gray-900">Notifications</h3>
            @if($unreadNotificationsCount > 0)
                <form method="POST" action="{{ $markAllRoute }}" class="inline">
                    @csrf
                    <button type="submit" class="font-Inter text-xs cursor-pointer font-semibold text-red-600 hover:text-red-700 transition">Mark all read</button>
                </form>
            @endif
        </div>

        <div class="max-h-80 overflow-y-auto custom-scrollbar">
            @forelse ($recentNotifications as $notification)
                @php
                    $isUnread = is_null($notification->read_at);
                    $data = $notification->data;
                    $title = $data['title'] ?? 'Notification';
                    $message = $data['message'] ?? '';

                    if (str_contains($title, 'Approved') || str_contains($title, 'Verified') || str_contains($title, 'Enabled')) {
                        $iconColor = 'text-emerald-600 bg-emerald-50';
                        $iconSvg = '<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>';
                    } elseif (str_contains($title, 'Rejected') || str_contains($title, 'Not Approved')) {
                        $iconColor = 'text-red-600 bg-red-50';
                        $iconSvg = '<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>';
                    } else {
                        $iconColor = 'text-blue-600 bg-blue-50';
                        $iconSvg = '<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>';
                    }
                @endphp

                <form method="POST" action="{{ route($readRoutePrefix, $notification->id) }}" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-start gap-3.5 px-5 py-3.5 transition {{ $isUnread ? 'bg-gray-50/80' : 'bg-white' }} hover:bg-gray-100 border-b border-gray-100 last:border-b-0">
                        <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-full {{ $iconColor }}">
                            {!! $iconSvg !!}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="font-Inter text-sm font-semibold text-gray-900 leading-snug">{{ $title }}</p>
                            <p class="mt-0.5 font-Inter text-xs text-gray-500 line-clamp-2 leading-relaxed">{{ $message }}</p>
                            <p class="mt-1.5 font-Inter text-[11px] text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        @if($isUnread)
                            <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-red-500"></span>
                        @endif
                    </button>
                </form>
            @empty
                <div class="px-5 py-10 text-center">
                    <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-gray-100">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 01-3.46 0"/>
                        </svg>
                    </div>
                    <p class="mt-3 font-Inter text-sm font-semibold text-gray-900">No notifications yet</p>
                    <p class="mt-0.5 font-Inter text-xs text-gray-500">We'll notify you when something happens.</p>
                </div>
            @endforelse
        </div>

        <div class="border-t border-gray-100 px-5 py-3 bg-gray-50/60">
            <a href="{{ $indexRoute }}" class="block text-center font-Inter text-xs font-semibold text-gray-600 hover:text-gray-900 transition">View all notifications</a>
        </div>
    </div>
</div>
@endif