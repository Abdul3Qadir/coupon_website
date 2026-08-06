<x-layouts.admin title="Edit Offer">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.offers.index') }}" class="inline-flex items-center gap-1.5 font-Inter text-sm font-semibold text-gray-500 hover:text-gray-700 transition">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Back to Offers
            </a>
            <h1 class="mt-4 font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Edit Offer</h1>
            <p class="mt-1 font-Inter text-sm text-gray-500">Update offer details for {{ $offer->brand->name }}</p>
        </div>

        <div class="rounded-2xl bg-white border border-gray-200 p-6 sm:p-8">
            <form method="POST" action="{{ route('admin.offers.update', $offer) }}">
                @csrf
                @method('PUT')
                @include('admin.offers._form')
                <div class="mt-8 flex items-center gap-3 pt-6 border-t border-gray-100">
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-red-600 px-6 py-2.5 font-Inter text-sm font-semibold text-white hover:bg-red-700 transition">
                        Save Changes
                    </button>
                    <a href="{{ route('admin.offers.index') }}" class="inline-flex items-center justify-center rounded-xl bg-gray-100 px-6 py-2.5 font-Inter text-sm font-semibold text-gray-700 hover:bg-gray-200 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>