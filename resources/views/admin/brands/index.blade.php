<x-layouts.admin title="Brands">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h1 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">Brands</h1>
            <p class="mt-1 font-Inter text-sm text-gray-500">Manage brand registrations and settings</p>
        </div>

        <form method="GET" class="flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2">
            <input type="hidden" name="status" value="{{ $activeStatus }}">
            <svg class="h-4 w-4 shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
            <input type="text" name="q" value="{{ $search }}" placeholder="Search brands..." class="bg-transparent outline-none font-Inter text-sm text-gray-700 placeholder:text-gray-400">
        </form>
    </div>

    <div class="mt-6 flex items-center gap-2 overflow-x-auto">
        @foreach (['all' => 'All', 'pending' => 'Pending', 'verified' => 'Verified', 'rejected' => 'Rejected', 'suspended' => 'Suspended'] as $key => $label)
            <a href="{{ route('admin.brands.index', ['status' => $key]) }}" @class([
                'shrink-0 inline-flex items-center gap-1.5 rounded-full px-4 py-2 font-Inter text-sm font-semibold transition',
                'bg-gray-900 text-white' => $activeStatus === $key,
                'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' => $activeStatus !== $key,
            ])>
                {{ $label }}
                <span @class([
                    'rounded-full px-1.5 py-0.5 text-xs font-bold',
                    'bg-white/20' => $activeStatus === $key,
                    'bg-gray-100 text-gray-500' => $activeStatus !== $key,
                ])>{{ $statusCounts[$key] }}</span>
            </a>
        @endforeach
    </div>

    <div class="mt-6 rounded-2xl border border-gray-200 bg-white overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left">
                <thead class="border-b border-gray-100 bg-gray-50/50">
                    <tr>
                        <th class="px-5 py-3 font-Inter text-xs font-semibold uppercase tracking-wide text-gray-500">Brand</th>
                        <th class="px-5 py-3 font-Inter text-xs font-semibold uppercase tracking-wide text-gray-500">Category</th>
                        <th class="px-5 py-3 font-Inter text-xs font-semibold uppercase tracking-wide text-gray-500">Offers</th>
                        <th class="px-5 py-3 font-Inter text-xs font-semibold uppercase tracking-wide text-gray-500">Status</th>
                        <th class="px-5 py-3 font-Inter text-xs font-semibold uppercase tracking-wide text-gray-500">Registered</th>
                        <th class="px-5 py-3 font-Inter text-xs font-semibold uppercase tracking-wide text-gray-500"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($brands as $brand)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <x-avatar :name="$brand->name" size="sm" />
                                    <div class="min-w-0">
                                        <p class="font-Manrope text-sm font-bold text-gray-900 truncate">{{ $brand->name }}</p>
                                        <p class="font-Inter text-xs text-gray-500 truncate">{{ $brand->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 font-Inter text-sm text-gray-600">{{ $brand->category->name ?? '—' }}</td>
                            <td class="px-5 py-3.5 font-Inter text-sm text-gray-600">{{ $brand->offers_count }}</td>
                            <td class="px-5 py-3.5"><x-status-badge :status="$brand->status" /></td>
                            <td class="px-5 py-3.5 font-Inter text-sm text-gray-500">{{ $brand->created_at->format('M j, Y') }}</td>
                            <td class="px-5 py-3.5 text-right">
                                <a href="{{ route('admin.brands.show', $brand) }}" class="font-Inter text-sm font-semibold text-red-600 hover:text-red-700">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center font-Inter text-sm text-gray-400">No brands found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $brands->links() }}
    </div>
</x-layouts.admin>