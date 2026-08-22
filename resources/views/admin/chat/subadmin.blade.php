<x-layouts.admin title="Chat">

<div class="flex h-screen bg-white">
    <!-- Chat -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <div class="h-16 border-b border-gray-200 flex items-center px-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr($superAdmin->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-Manrope font-bold text-gray-900">{{ $superAdmin->name }}</p>
                    <p class="font-Inter text-xs text-gray-500">Super Admin</p>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div class="flex-1 overflow-y-auto p-6 space-y-4" id="messagesContainer">
            @forelse($messages as $message)
                <div class="flex {{ $message->sender_admin_id === auth('admin')->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-xs {{ $message->sender_admin_id === auth('admin')->id() ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-900' }} rounded-2xl px-4 py-2">
                        <p class="font-Inter text-sm">{{ $message->message }}</p>
                        <p class="font-Inter text-xs {{ $message->sender_admin_id === auth('admin')->id() ? 'text-red-200' : 'text-gray-500' }} mt-1">
                            {{ $message->created_at->format('H:i') }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="flex items-center justify-center h-full">
                    <p class="text-gray-500">No messages yet. Start the conversation!</p>
                </div>
            @endforelse
        </div>

        <!-- Message Input -->
        <div class="h-20 border-t border-gray-200 p-4">
            <form action="{{ route('admin.chat.send') }}" method="POST" class="flex gap-3">
                @csrf
                <input type="hidden" name="receiver_admin_id" value="{{ $superAdmin->id }}">
                <input type="text" name="message" placeholder="Type a message..." class="flex-1 rounded-full border border-gray-200 px-4 py-2 font-Inter text-sm focus:outline-none focus:border-red-300 focus:ring-2 focus:ring-red-100" required>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white rounded-full px-6 py-2 font-Manrope font-semibold text-sm transition">Send</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-scroll to bottom
    const messagesContainer = document.getElementById('messagesContainer');
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
</script>
</x-layouts.admin>