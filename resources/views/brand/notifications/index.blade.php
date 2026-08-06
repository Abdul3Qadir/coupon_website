<x-layouts.brand title="Notifications">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Notifications</h1>
            <p class="mt-1 font-Inter text-sm text-gray-500">Stay updated with everything happening</p>
        </div>
        @if($unreadCount > 0)
            <form method="POST" action="{{ route('brand.notifications.mark-all-read') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 rounded-xl bg-gray-900 px-4 py-2.5 font-Inter text-sm font-semibold text-white hover:bg-gray-800 transition">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                    Mark all as read
                </button>
            </form>
        @endif
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 font-Inter text-sm font-medium text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-6 flex items-center gap-2 overflow-x-auto scrollbar-hide pb-1">
        <a href="{{ route('brand.notifications.index', ['filter' => 'all']) }}" @class([
            'shrink-0 inline-flex items-center rounded-full px-4 py-2 font-Inter text-sm font-semibold transition',
            'bg-gray-900 text-white' => $activeFilter === 'all',
            'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' => $activeFilter !== 'all',
        ])>All</a>
        <a href="{{ route('brand.notifications.index', ['filter' => 'unread']) }}" @class([
            'shrink-0 inline-flex items-center gap-1.5 rounded-full px-4 py-2 font-Inter text-sm font-semibold transition',
            'bg-red-600 text-white' => $activeFilter === 'unread',
            'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' => $activeFilter !== 'unread',
        ])>
            Unread
            @if($unreadCount > 0)
                <span class="rounded-full px-1.5 py-0.5 text-xs font-bold {{ $activeFilter === 'unread' ? 'bg-white/20' : 'bg-red-50 text-red-600' }}">{{ $unreadCount }}</span>
            @endif
        </a>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white overflow-hidden">
        @forelse ($notifications as $notification)
            @php
                $isUnread = is_null($notification->read_at);
                $data = $notification->data;
                $title = $data['title'] ?? 'Notification';
                $message = $data['message'] ?? '';

                if (str_contains($title, 'Approved') || str_contains($title, 'Verified')) {
                    $iconColor = 'text-emerald-600 bg-emerald-50';
                    $iconSvg = '<svg class=\"h-5 w-5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M20 6 9 17l-5-5\"/></svg>';
                } elseif (str_contains($title, 'Rejected') || str_contains($title, 'Not Approved')) {
                    $iconColor = 'text-red-600 bg-red-50';
                    $iconSvg = '<svg class=\"h-5 w-5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M18 6 6 18\"/><path d=\"m6 6 12 12\"/></svg>';
                } else {
                    $iconColor = 'text-blue-600 bg-blue-50';
                    $iconSvg = '<svg class=\"h-5 w-5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9\"/><path d=\"M13.73 21a2 2 0 01-3.46 0\"/></svg>';
                }
            @endphp

            <div class="flex items-start gap-4 px-5 py-4 border-b border-gray-100 last:border-b-0 {{ $isUnread ? 'bg-gray-50' : 'bg-white' }}">
                <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-full {{ $iconColor }}">
                    {!! $iconSvg !!}
                </span>
                <div class="min-w-0 flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-1">
                        <div>
                            <p class="font-Inter text-sm font-semibold text-gray-900">{{ $title }}</p>
                            <p class="mt-0.5 font-Inter text-sm text-gray-600">{{ $message }}</p>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <span class="font-Inter text-xs text-gray-400 whitespace-nowrap">{{ $notification->created_at->diffForHumans() }}</span>
                            @if($isUnread)
                                <form method="POST" action="{{ route('brand.notifications.read', $notification->id) }}">
                                    @csrf
                                    <button type="submit" class="rounded-lg bg-gray-100 px-2.5 py-1 font-Inter text-xs font-semibold text-gray-600 hover:bg-gray-200 transition whitespace-nowrap">Mark read</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-12 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">
                    <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                </div>
                <h3 class="mt-3 font-Manrope text-sm font-semibold text-gray-900">No notifications</h3>
                <p class="mt-1 font-Inter text-sm text-gray-500">
                    {{ $activeFilter === 'unread' ? 'You have read all notifications.' : 'Nothing here yet.' }}
                </p>
            </div>
        @endforelse
    </div>

    @if ($notifications->hasPages())
        <div class="mt-6">{{ $notifications->links() }}</div>
    @endif
</x-layouts.brand>