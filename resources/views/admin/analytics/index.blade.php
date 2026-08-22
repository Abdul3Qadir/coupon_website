<x-layouts.admin :title="'Platform Analytics'">
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="font-Manrope text-4xl font-extrabold text-gray-900 mb-8">Platform Analytics</h1>

        <!-- Section 1: Platform Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <p class="font-Inter text-sm text-gray-500">Total Brands</p>
                <p class="font-Manrope text-3xl font-extrabold text-gray-900 mt-2">{{ $brandsStats['totalBrands'] }}</p>
                <p class="font-Inter text-xs text-green-600 mt-2">{{ $brandsStats['verifiedBrands'] }} verified</p>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <p class="font-Inter text-sm text-gray-500">Total Offers</p>
                <p class="font-Manrope text-3xl font-extrabold text-gray-900 mt-2">{{ number_format($offersStats['totalOffers']) }}</p>
                <p class="font-Inter text-xs text-blue-600 mt-2">{{ $offersStats['activeOffers'] }} active</p>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <p class="font-Inter text-sm text-gray-500">Platform Views</p>
                <p class="font-Manrope text-3xl font-extrabold text-gray-900 mt-2">{{ number_format($offersStats['totalViews']) }}</p>
                <p class="font-Inter text-xs text-purple-600 mt-2">{{ $offersStats['ctr'] }}% CTR</p>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <p class="font-Inter text-sm text-gray-500">Blog Posts</p>
                <p class="font-Manrope text-3xl font-extrabold text-gray-900 mt-2">{{ $blogsStats['totalPosts'] }}</p>
                <p class="font-Inter text-xs text-pink-600 mt-2">{{ $blogsStats['publishedPosts'] }} published</p>
            </div>
        </div>

        <!-- Section 2: Brand Status Distribution -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <h3 class="font-Manrope font-bold text-gray-900 mb-4">Brand Status</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-Inter text-sm text-gray-600">Verified</span>
                        <div class="flex items-center gap-2">
                            <div class="w-32 h-2 bg-gray-200 rounded-full"><div class="h-full bg-green-600" style="width: {{ ($brandsStats['verifiedBrands'] / max($brandsStats['totalBrands'], 1)) * 100 }}%"></div></div>
                            <span class="font-Manrope font-semibold text-gray-900 w-12">{{ $brandsStats['verifiedBrands'] }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-Inter text-sm text-gray-600">Pending</span>
                        <div class="flex items-center gap-2">
                            <div class="w-32 h-2 bg-gray-200 rounded-full"><div class="h-full bg-yellow-600" style="width: {{ ($brandsStats['pendingBrands'] / max($brandsStats['totalBrands'], 1)) * 100 }}%"></div></div>
                            <span class="font-Manrope font-semibold text-gray-900 w-12">{{ $brandsStats['pendingBrands'] }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-Inter text-sm text-gray-600">Rejected</span>
                        <div class="flex items-center gap-2">
                            <div class="w-32 h-2 bg-gray-200 rounded-full"><div class="h-full bg-red-600" style="width: {{ ($brandsStats['rejectedBrands'] / max($brandsStats['totalBrands'], 1)) * 100 }}%"></div></div>
                            <span class="font-Manrope font-semibold text-gray-900 w-12">{{ $brandsStats['rejectedBrands'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <h3 class="font-Manrope font-bold text-gray-900 mb-4">Offer Type Split</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-Inter text-sm text-gray-600">Coupons</span>
                        <div class="flex items-center gap-2">
                            <div class="w-32 h-2 bg-gray-200 rounded-full"><div class="h-full bg-blue-600" style="width: {{ ($offersStats['coupons'] / max($offersStats['totalOffers'], 1)) * 100 }}%"></div></div>
                            <span class="font-Manrope font-semibold text-gray-900 w-12">{{ $offersStats['coupons'] }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-Inter text-sm text-gray-600">Deals</span>
                        <div class="flex items-center gap-2">
                            <div class="w-32 h-2 bg-gray-200 rounded-full"><div class="h-full bg-purple-600" style="width: {{ ($offersStats['deals'] / max($offersStats['totalOffers'], 1)) * 100 }}%"></div></div>
                            <span class="font-Manrope font-semibold text-gray-900 w-12">{{ $offersStats['deals'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Top Brands Table -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm mb-8">
            <h3 class="font-Manrope font-bold text-gray-900 mb-6">Top Brands Performance</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-4 py-3 text-left font-Manrope font-semibold text-sm text-gray-700">Brand</th>
                            <th class="px-4 py-3 text-right font-Manrope font-semibold text-sm text-gray-700">Offers</th>
                            <th class="px-4 py-3 text-right font-Manrope font-semibold text-sm text-gray-700">Views</th>
                            <th class="px-4 py-3 text-right font-Manrope font-semibold text-sm text-gray-700">Clicks</th>
                            <th class="px-4 py-3 text-right font-Manrope font-semibold text-sm text-gray-700">CTR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topBrands as $brand)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-4 font-Manrope font-semibold text-gray-900">{{ $brand['name'] }}</td>
                            <td class="px-4 py-4 font-Inter text-sm text-gray-900 text-right">{{ $brand['offers'] }}</td>
                            <td class="px-4 py-4 font-Inter text-sm text-gray-900 text-right font-semibold">{{ number_format($brand['views']) }}</td>
                            <td class="px-4 py-4 font-Inter text-sm text-gray-900 text-right font-semibold">{{ number_format($brand['clicks']) }}</td>
                            <td class="px-4 py-4 font-Inter text-sm text-red-600 text-right font-semibold">{{ $brand['ctr'] }}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Charts Section - Trends -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <h3 class="font-Manrope font-bold text-gray-900 mb-6">Offers Performance (30 Days)</h3>
                <div style="height: 300px;">
                    <canvas id="offersChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <h3 class="font-Manrope font-bold text-gray-900 mb-6">Blog Views Trend (30 Days)</h3>
                <div style="height: 300px;">
                    <canvas id="blogsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Offers by Category -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm mb-8">
            <h3 class="font-Manrope font-bold text-gray-900 mb-6">Offers by Category</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-4 py-3 text-left font-Manrope font-semibold text-sm text-gray-700">Category</th>
                            <th class="px-4 py-3 text-right font-Manrope font-semibold text-sm text-gray-700">Total</th>
                            <th class="px-4 py-3 text-right font-Manrope font-semibold text-sm text-gray-700">Views</th>
                            <th class="px-4 py-3 text-right font-Manrope font-semibold text-sm text-gray-700">Clicks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($offersByCategory as $cat)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-4 font-Manrope font-semibold text-gray-900">{{ $cat['category'] }}</td>
                            <td class="px-4 py-4 font-Inter text-sm text-gray-900 text-right">{{ $cat['offers'] }}</td>
                            <td class="px-4 py-4 font-Inter text-sm text-gray-900 text-right font-semibold">{{ number_format($cat['views']) }}</td>
                            <td class="px-4 py-4 font-Inter text-sm text-gray-900 text-right font-semibold">{{ number_format($cat['clicks']) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pending Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-red-50 rounded-2xl p-6 border border-red-100">
                <p class="font-Inter text-sm text-red-700">Pending Brand Verifications</p>
                <p class="font-Manrope text-3xl font-extrabold text-red-900 mt-2">{{ $pendingActions['pendingBrands'] }}</p>
                @if($pendingActions['pendingBrandsUrgent'] > 0)
                <p class="font-Inter text-xs text-red-600 mt-2">⚠️ {{ $pendingActions['pendingBrandsUrgent'] }} urgent (>48h)</p>
                @endif
            </div>

            <div class="bg-yellow-50 rounded-2xl p-6 border border-yellow-100">
                <p class="font-Inter text-sm text-yellow-700">Pending Offer Approvals</p>
                <p class="font-Manrope text-3xl font-extrabold text-yellow-900 mt-2">{{ $pendingActions['pendingOffers'] }}</p>
                @if($pendingActions['pendingOffersUrgent'] > 0)
                <p class="font-Inter text-xs text-yellow-600 mt-2">⚠️ {{ $pendingActions['pendingOffersUrgent'] }} urgent (>3d)</p>
                @endif
            </div>

            <div class="bg-purple-50 rounded-2xl p-6 border border-purple-100">
                <p class="font-Inter text-sm text-purple-700">Pending Sub-Admin Approvals</p>
                <p class="font-Manrope text-3xl font-extrabold text-purple-900 mt-2">{{ $pendingActions['pendingAdmins'] }}</p>
                @if($pendingActions['pendingAdminsUrgent'] > 0)
                <p class="font-Inter text-xs text-purple-600 mt-2">⚠️ {{ $pendingActions['pendingAdminsUrgent'] }} urgent (>2d)</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const offersTrendData = {!! json_encode($offersTrend) !!};
const blogsTrendData = {!! json_encode($blogsTrend) !!};

const offersCtx = document.getElementById('offersChart').getContext('2d');
new Chart(offersCtx, {
    type: 'line',
    data: {
        labels: offersTrendData.map(d => d.date),
        datasets: [
            {
                label: 'Views',
                data: offersTrendData.map(d => d.views),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true,
            },
            {
                label: 'Clicks',
                data: offersTrendData.map(d => d.clicks),
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                tension: 0.4,
                fill: true,
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: true, position: 'top' } },
        scales: { y: { beginAtZero: true } }
    }
});

const blogsCtx = document.getElementById('blogsChart').getContext('2d');
new Chart(blogsCtx, {
    type: 'line',
    data: {
        labels: blogsTrendData.map(d => d.date),
        datasets: [{
            label: 'Views',
            data: blogsTrendData.map(d => d.views),
            borderColor: '#8b5cf6',
            backgroundColor: 'rgba(139, 92, 246, 0.1)',
            tension: 0.4,
            fill: true,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: true, position: 'top' } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>
</x-layouts.admin>