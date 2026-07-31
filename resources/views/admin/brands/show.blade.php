<x-layouts.admin title="{{ $brand->name }}">
    <div class="flex items-center gap-1.5 font-Inter text-sm text-gray-500 mb-5">
        <a href="{{ route('admin.brands.index') }}" class="hover:text-red-600 transition">Brands</a>
        <span>/</span>
        <span class="text-gray-900 font-semibold">{{ $brand->name }}</span>
    </div>

    @session('status')
        <div class="mb-5 rounded-lg bg-emerald-50 px-4 py-3 font-Inter text-sm font-semibold text-emerald-700">
            {{ $value }}
        </div>
    @endsession

    <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 justify-between">
            <div class="flex items-center gap-4">
                @if ($brand->small_logo)
                    <img src="{{ asset('storage/' . $brand->small_logo) }}" alt="{{ $brand->name }}" class="h-14 w-14 rounded-xl border border-gray-200 object-contain p-1.5">
                @else
                    <x-avatar :name="$brand->name" size="lg" />
                @endif
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="font-Manrope text-lg sm:text-xl font-extrabold text-gray-900">{{ $brand->name }}</h1>
                        <x-status-badge :status="$brand->status" />
                    </div>
                    <p class="mt-0.5 font-Inter text-sm text-gray-500">{{ $brand->email }} · {{ $brand->category->name ?? 'Uncategorized' }}</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                @if ($brand->status->value === 'pending')
                    <form method="POST" action="{{ route('admin.brands.verify', $brand) }}" class="confirm-action-wrapper">
                        @csrf
                        <button type="button" class="confirm-action cursor-pointer rounded-full bg-emerald-600 hover:bg-emerald-700 px-4 py-2 font-Manrope text-sm font-bold text-white transition" data-confirm-title="Verify this brand?" data-confirm-message="{{ $brand->name }} will be able to access their full dashboard." data-confirm-button="Yes, Verify">
                            Verify Brand
                        </button>
                    </form>
                    <button type="button" id="openRejectBrandModal" class="cursor-pointer rounded-full bg-white border border-gray-200 hover:bg-gray-50 px-4 py-2 font-Manrope text-sm font-bold text-gray-700 transition">
                        Reject
                    </button>
                @elseif ($brand->status->value === 'verified')
                    <form method="POST" action="{{ route('admin.brands.suspend', $brand) }}">
                        @csrf
                        <button type="button" class="confirm-action cursor-pointer rounded-full bg-white border border-gray-200 hover:bg-gray-50 px-4 py-2 font-Manrope text-sm font-bold text-gray-700 transition" data-confirm-title="Suspend this brand?" data-confirm-message="Their dashboard and offers will be disabled until reinstated." data-confirm-button="Yes, Suspend">
                            Suspend
                        </button>
                    </form>
                @elseif ($brand->status->value === 'suspended')
                    <form method="POST" action="{{ route('admin.brands.reinstate', $brand) }}">
                        @csrf
                        <button type="button" class="confirm-action cursor-pointer rounded-full bg-emerald-600 hover:bg-emerald-700 px-4 py-2 font-Manrope text-sm font-bold text-white transition" data-confirm-title="Reinstate this brand?" data-confirm-message="Their dashboard access will be restored." data-confirm-button="Yes, Reinstate">
                            Reinstate
                        </button>
                    </form>
                @endif
            </div>
        </div>

        @if ($brand->status->value === 'rejected' && $brand->rejection_reason)
            <div class="mt-4 rounded-lg bg-red-50 px-4 py-3 font-Inter text-sm text-red-700">
                <span class="font-semibold">Rejection reason:</span> {{ $brand->rejection_reason }}
            </div>
        @endif
    </div>

    <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 rounded-2xl border border-gray-200 bg-white p-5">
            <p class="font-Manrope text-base font-bold text-gray-900">Brand Details</p>
            <dl class="mt-4 space-y-3">
                <div class="flex justify-between gap-4">
                    <dt class="font-Inter text-sm text-gray-500">Website</dt>
                    <dd class="font-Inter text-sm font-medium text-gray-900 truncate"><a href="{{ $brand->website_url }}" target="_blank" class="text-red-600 hover:text-red-700">{{ $brand->website_url }}</a></dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="font-Inter text-sm text-gray-500">Short Description</dt>
                    <dd class="font-Inter text-sm font-medium text-gray-900 text-right">{{ $brand->short_description }}</dd>
                </div>
                @if ($brand->about_description)
                    <div>
                        <dt class="font-Inter text-sm text-gray-500 mb-1">About</dt>
                        <dd class="font-Inter text-sm text-gray-700 leading-relaxed">{{ $brand->about_description }}</dd>
                    </div>
                @endif
                <div class="flex justify-between gap-4">
                    <dt class="font-Inter text-sm text-gray-500">Registered</dt>
                    <dd class="font-Inter text-sm font-medium text-gray-900">{{ $brand->created_at->format('M j, Y') }}</dd>
                </div>
                @if ($brand->verifier)
                    <div class="flex justify-between gap-4">
                        <dt class="font-Inter text-sm text-gray-500">Reviewed By</dt>
                        <dd class="font-Inter text-sm font-medium text-gray-900">{{ $brand->verifier->name }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5">
            <p class="font-Manrope text-base font-bold text-gray-900">Settings</p>

            <div class="mt-4 flex items-center justify-between">
                <div>
                    <p class="font-Inter text-sm font-semibold text-gray-900">Auto-Publish</p>
                    <p class="font-Inter text-xs text-gray-500">Skip manual review for this brand</p>
                </div>
                <x-toggle-switch :checked="$brand->auto_publish_offers" :action="route('admin.brands.toggle-auto-publish', $brand)" />
            </div>

            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                <div>
                    <p class="font-Inter text-sm font-semibold text-gray-900">Allow Admin to Add Offers</p>
                    <p class="font-Inter text-xs text-gray-500">Controlled by the brand, view only</p>
                </div>
                <span @class([
                    'rounded-full px-2.5 py-1 font-Inter text-xs font-semibold',
                    'bg-emerald-50 text-emerald-700' => $brand->allow_admin_to_add_offers,
                    'bg-gray-100 text-gray-500' => !$brand->allow_admin_to_add_offers,
                ])>
                    {{ $brand->allow_admin_to_add_offers ? 'Allowed' : 'Not Allowed' }}
                </span>
            </div>
        </div>
    </div>

    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5">
        <p class="font-Manrope text-base font-bold text-gray-900">Offers by {{ $brand->name }}</p>

        <div class="mt-4 divide-y divide-gray-100">
            @forelse ($offers as $offer)
                <div class="flex items-center justify-between gap-3 py-3">
                    <div class="min-w-0">
                        <p class="font-Manrope text-sm font-bold text-gray-900 truncate">{{ $offer->title }}</p>
                        <p class="font-Inter text-xs text-gray-500">{{ ucfirst($offer->type->value) }} · {{ $offer->created_at->diffForHumans() }}</p>
                    </div>
                    <x-status-badge :status="$offer->status" />
                </div>
            @empty
                <p class="py-6 text-center font-Inter text-sm text-gray-400">No offers submitted yet.</p>
            @endforelse
        </div>

        @if ($offers->hasPages())
            <div class="mt-4">{{ $offers->links() }}</div>
        @endif
    </div>

    <x-admin.reject-brand-modal :brand="$brand" />
</x-layouts.admin>