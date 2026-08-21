<x-layouts.admin title="{{ $subAdmin->name }}">
    <div class="flex items-center gap-1.5 font-Inter text-sm text-gray-500 mb-5">
        <a href="{{ route('admin.sub-admins.index') }}" class="hover:text-red-600 transition">Sub-Admins</a>
        <span>/</span>
        <span class="text-gray-900 font-semibold">{{ $subAdmin->name }}</span>
    </div>

    @session('status')
        <div class="mb-5 rounded-lg bg-emerald-50 px-4 py-3 font-Inter text-sm font-semibold text-emerald-700">
            {{ $value }}
        </div>
    @endsession

    <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 justify-between">
            <div class="flex items-center gap-4">
                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-gray-200 bg-white overflow-hidden">
                    @if ($subAdmin->avatar)
                        <img src="{{ asset('storage/' . $subAdmin->avatar) }}" alt="{{ $subAdmin->name }}" class="h-full w-full object-cover">
                    @else
                        <x-avatar :name="$subAdmin->name" size="lg" />
                    @endif
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="font-Manrope text-lg sm:text-xl font-extrabold text-gray-900">{{ $subAdmin->name }}</h1>
                        <x-status-badge :status="$subAdmin->status" />
                    </div>
                    <p class="mt-0.5 font-Inter text-sm text-gray-500">{{ $subAdmin->email }} · Requested {{ $subAdmin->created_at->format('M j, Y') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                @if ($subAdmin->status->value === 'pending')
                    <form method="POST" action="{{ route('admin.sub-admins.approve', $subAdmin) }}">
                        @csrf
                        <button type="button" class="confirm-action cursor-pointer rounded-full bg-emerald-600 hover:bg-emerald-700 px-4 py-2 font-Manrope text-sm font-bold text-white transition" data-confirm-title="Approve this Sub-Admin?" data-confirm-message="{{ $subAdmin->name }} will be able to manage offers and blogs." data-confirm-button="Yes, Approve">
                            Approve
                        </button>
                    </form>
                    <button type="button" id="openRejectSubAdminModal" class="cursor-pointer rounded-full bg-white border border-gray-200 hover:bg-gray-50 px-4 py-2 font-Manrope text-sm font-bold text-gray-700 transition">
                        Reject
                    </button>
                @elseif ($subAdmin->status->value === 'approved')
                    <button type="button" id="openRejectSubAdminModal" class="cursor-pointer rounded-full bg-white border border-gray-200 hover:bg-gray-50 px-4 py-2 font-Manrope text-sm font-bold text-gray-700 transition">
                        Revoke Access
                    </button>
                @elseif ($subAdmin->status->value === 'rejected')
                    <form method="POST" action="{{ route('admin.sub-admins.approve', $subAdmin) }}">
                        @csrf
                        <button type="button" class="confirm-action cursor-pointer rounded-full bg-emerald-600 hover:bg-emerald-700 px-4 py-2 font-Manrope text-sm font-bold text-white transition" data-confirm-title="Approve this Sub-Admin?" data-confirm-message="{{ $subAdmin->name }} will be able to manage offers and blogs." data-confirm-button="Yes, Approve">
                            Approve Instead
                        </button>
                    </form>
                @endif

                <form method="POST" action="{{ route('admin.sub-admins.destroy', $subAdmin) }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="confirm-action cursor-pointer rounded-full bg-white border border-gray-200 hover:bg-red-50 hover:border-red-200 px-4 py-2 font-Manrope text-sm font-bold text-red-600 transition" data-confirm-title="Remove this Sub-Admin?" data-confirm-message="This will permanently remove {{ $subAdmin->name }}'s access. This cannot be undone." data-confirm-button="Yes, Remove">
                        Remove
                    </button>
                </form>
            </div>
        </div>

        @if ($subAdmin->status->value === 'rejected' && $subAdmin->rejection_reason)
            <div class="mt-4 rounded-lg bg-red-50 px-4 py-3 font-Inter text-sm text-red-700">
                <span class="font-semibold">Reason:</span> {{ $subAdmin->rejection_reason }}
            </div>
        @endif
    </div>

    {{-- Info + Stats Grid --}}
    <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Contact & Bio Info --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">
                <p class="font-Manrope text-base font-bold text-gray-900">Contact Information</p>
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="font-Inter text-xs font-medium text-gray-500 uppercase tracking-wide">Email</p>
                        <p class="mt-1 font-Inter text-sm font-semibold text-gray-900 break-all">{{ $subAdmin->email }}</p>
                    </div>
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="font-Inter text-xs font-medium text-gray-500 uppercase tracking-wide">Phone</p>
                        <p class="mt-1 font-Inter text-sm font-semibold text-gray-900">{{ $subAdmin->phone ?? '—' }}</p>
                    </div>
                    <div class="rounded-xl bg-gray-50 p-4 sm:col-span-2">
                        <p class="font-Inter text-xs font-medium text-gray-500 uppercase tracking-wide">Bio</p>
                        <p class="mt-1 font-Inter text-sm text-gray-700 leading-relaxed">{{ $subAdmin->bio ?? 'No bio provided.' }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="rounded-2xl border border-gray-200 bg-white p-5">
                    <p class="font-Inter text-sm text-gray-500">Offers Added</p>
                    <p class="mt-2 font-Manrope text-2xl font-extrabold text-gray-900">{{ $subAdmin->offers()->count() }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5">
                    <p class="font-Inter text-sm text-gray-500">Blogs Written</p>
                    <p class="mt-2 font-Manrope text-2xl font-extrabold text-gray-900">{{ $subAdmin->blogs()->count() }}</p>
                </div>
            </div>
        </div>

        {{-- Settings Sidebar --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-5">
                <p class="font-Manrope text-base font-bold text-gray-900">Settings</p>
                <div class="mt-4 flex items-center justify-between">
                    <div>
                        <p class="font-Inter text-sm font-semibold text-gray-900">Auto-Publish</p>
                        <p class="font-Inter text-xs text-gray-500">Skip manual review for this Sub-Admin</p>
                    </div>
                    <x-toggle-switch :checked="$subAdmin->auto_publish_offers" :action="route('admin.sub-admins.toggle-auto-publish', $subAdmin)" />
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5">
                <p class="font-Manrope text-base font-bold text-gray-900">Account Details</p>
                <div class="mt-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="font-Inter text-sm text-gray-500">Role</span>
                        <span class="font-Inter text-sm font-semibold text-gray-900">{{ $subAdmin->role->label() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-Inter text-sm text-gray-500">Status</span>
                        <x-status-badge :status="$subAdmin->status" />
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-Inter text-sm text-gray-500">Joined</span>
                        <span class="font-Inter text-sm font-semibold text-gray-900">{{ $subAdmin->created_at->format('M d, Y') }}</span>
                    </div>
                    @if ($subAdmin->last_login_at)
                        <div class="flex items-center justify-between">
                            <span class="font-Inter text-sm text-gray-500">Last Login</span>
                            <span class="font-Inter text-sm font-semibold text-gray-900">{{ $subAdmin->last_login_at->diffForHumans() }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Offers List --}}
    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5">
        <p class="font-Manrope text-base font-bold text-gray-900">Offers Added by {{ $subAdmin->name }}</p>

        <div class="mt-4 divide-y divide-gray-100">
            @forelse ($offers as $offer)
                <div class="flex items-center justify-between gap-3 py-3">
                    <div class="min-w-0">
                        <p class="font-Manrope text-sm font-bold text-gray-900 truncate">{{ $offer->title }}</p>
                        <p class="font-Inter text-xs text-gray-500">{{ $offer->brand->name ?? '—' }} · {{ $offer->created_at->diffForHumans() }}</p>
                    </div>
                    <x-status-badge :status="$offer->status" />
                </div>
            @empty
                <p class="py-6 text-center font-Inter text-sm text-gray-400">No offers added yet.</p>
            @endforelse
        </div>

        @if ($offers->hasPages())
            <div class="mt-4">{{ $offers->links() }}</div>
        @endif
    </div>

    <x-admin.reject-subadmin-modal :sub-admin="$subAdmin" />
</x-layouts.admin>
