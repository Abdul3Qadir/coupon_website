@php
    $admin = auth('admin')->user();
    if (!$admin) return;

    $unreadMessagesCount = $admin->receivedMessages()->whereNull('read_at')->count();
@endphp

<div class="relative" id="chatDropdownContainer">
    <button type="button" id="chatBellBtn" class="relative flex h-9 w-9 cursor-pointer items-center justify-center rounded-full text-gray-500 hover:text-gray-900 transition">
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/>
        </svg>
        @if($unreadMessagesCount > 0)
            <span class="absolute top-1 right-1 h-2.5 w-2.5 rounded-full bg-red-600 ring-2 ring-white"></span>
        @endif
    </button>

    <div id="chatDropdown" class="hidden absolute right-0 mt-2 w-[calc(100vw-1.5rem)] sm:w-96 rounded-2xl bg-white border border-gray-200 shadow-xl shadow-gray-200/50 z-50 overflow-hidden origin-top-right">
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-100">
            <h3 class="font-Manrope text-sm font-extrabold text-gray-900">Messages</h3>
            <a href="{{ route('admin.chat.index') }}" class="font-Inter text-xs font-semibold text-red-600 hover:text-red-700 transition">Open Chat</a>
        </div>

        <div class="max-h-80 overflow-y-auto custom-scrollbar">
            @php
                $recentMessages = \App\Models\AdminMessage::where(function ($query) use ($admin) {
                    $query->where('sender_admin_id', $admin->id)
                        ->orWhere('receiver_admin_id', $admin->id);
                })
                ->with(['sender', 'receiver'])
                ->latest()
                ->take(6)
                ->get();
            @endphp

            @forelse ($recentMessages as $message)
                @php
                    $isFromMe = $message->sender_admin_id === $admin->id;
                    $otherPerson = $isFromMe ? $message->receiver : $message->sender;
                    $isUnread = !$isFromMe && is_null($message->read_at);
                @endphp

                <a href="{{ route('admin.chat.index', $admin->isSuperAdmin() ? ['subadmin' => $otherPerson->id] : []) }}" class="block flex items-start gap-3.5 px-5 py-3.5 transition {{ $isUnread ? 'bg-gray-50/80' : 'bg-white' }} hover:bg-gray-100 border-b border-gray-100 last:border-b-0">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-600 text-white font-bold text-sm">
                        {{ strtoupper(substr($otherPerson->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between">
                            <p class="font-Inter text-sm font-semibold text-gray-900">{{ $otherPerson->name }}</p>
                            <p class="font-Inter text-[11px] text-gray-400">{{ $message->created_at->diffForHumans() }}</p>
                        </div>
                        <p class="mt-0.5 font-Inter text-xs text-gray-500 line-clamp-1">
                            @if($isFromMe) You: @endif{{ $message->message }}
                        </p>
                    </div>
                    @if($isUnread)
                        <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-red-500"></span>
                    @endif
                </a>
            @empty
                <div class="px-5 py-10 text-center">
                    <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-gray-100">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/>
                        </svg>
                    </div>
                    <p class="mt-3 font-Inter text-sm font-semibold text-gray-900">No messages yet</p>
                    <p class="mt-0.5 font-Inter text-xs text-gray-500">Start a conversation from the chat page.</p>
                </div>
            @endforelse
        </div>

        <div class="border-t border-gray-100 px-5 py-3 bg-gray-50/60">
            <a href="{{ route('admin.chat.index') }}" class="block text-center font-Inter text-xs font-semibold text-gray-600 hover:text-gray-900 transition">View all messages</a>
        </div>
    </div>
</div>