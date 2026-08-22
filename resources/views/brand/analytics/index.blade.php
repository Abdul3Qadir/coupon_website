<x-layouts.brand :title="'Analytics'">

<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-6 sm:py-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="font-Manrope text-3xl sm:text-4xl font-extrabold text-gray-900">Analytics</h1>
            <p class="font-Inter text-sm sm:text-base text-gray-600 mt-2">Track your offers performance in real-time</p>
        </div>

        <!-- Top 3 Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
            <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                <p class="font-Inter text-xs sm:text-sm text-gray-500">Total Offers</p>
                <p class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900 mt-2">{{ $offersStats['totalOffers'] }}</p>
                <p class="font-Inter text-xs text-green-600 mt-2">{{ $offersStats['activeOffers'] }} active</p>
            </div>

            <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                <p class="font-Inter text-xs sm:text-sm text-gray-500">Total Views</p>
                <p class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900 mt-2">{{ number_format($offersStats['totalViews']) }}</p>
                <p class="font-Inter text-xs text-blue-600 mt-2">{{ number_format($offersStats['monthlyViews']) }} this month</p>
            </div>

            <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                <p class="font-Inter text-xs sm:text-sm text-gray-500">Total Clicks</p>
                <p class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900 mt-2">{{ number_format($offersStats['totalClicks']) }}</p>
                <p class="font-Inter text-xs text-red-600 mt-2">{{ $offersStats['ctr'] }}% CTR</p>
            </div>
        </div>

        <!-- 2 Breakdown Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
            <!-- Offer Status -->
            <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-100 shadow-sm">
                <h3 class="font-Manrope font-bold text-gray-900 text-sm sm:text-base mb-4">Offer Status</h3>
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="font-Inter text-xs sm:text-sm text-gray-600">Approved</span>
                        <div class="flex items-center gap-2">
                            <div class="w-24 sm:w-32 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-green-600" style="width: {{ ($offersStats['activeOffers'] / max($offersStats['totalOffers'], 1)) * 100 }}%"></div>
                            </div>
                            <span class="font-Manrope font-semibold text-gray-900 text-xs sm:text-sm w-8 text-right">{{ $offersStats['activeOffers'] }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-Inter text-xs sm:text-sm text-gray-600">Pending</span>
                        <div class="flex items-center gap-2">
                            <div class="w-24 sm:w-32 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-yellow-600" style="width: {{ ($offersStats['pendingOffers'] / max($offersStats['totalOffers'], 1)) * 100 }}%"></div>
                            </div>
                            <span class="font-Manrope font-semibold text-gray-900 text-xs sm:text-sm w-8 text-right">{{ $offersStats['pendingOffers'] }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-Inter text-xs sm:text-sm text-gray-600">Rejected</span>
                        <div class="flex items-center gap-2">
                            <div class="w-24 sm:w-32 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-red-600" style="width: {{ ($offersStats['rejectedOffers'] / max($offersStats['totalOffers'], 1)) * 100 }}%"></div>
                            </div>
                            <span class="font-Manrope font-semibold text-gray-900 text-xs sm:text-sm w-8 text-right">{{ $offersStats['rejectedOffers'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Offer Type Distribution -->
            <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-100 shadow-sm">
                <h3 class="font-Manrope font-bold text-gray-900 text-sm sm:text-base mb-4">Offer Type Distribution</h3>
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="font-Inter text-xs sm:text-sm text-gray-600">Coupons</span>
                        <div class="flex items-center gap-2">
                            <div class="w-24 sm:w-32 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-600" style="width: {{ ($offersStats['coupons'] / max($offersStats['totalOffers'], 1)) * 100 }}%"></div>
                            </div>
                            <span class="font-Manrope font-semibold text-gray-900 text-xs sm:text-sm w-8 text-right">{{ $offersStats['coupons'] }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-Inter text-xs sm:text-sm text-gray-600">Deals</span>
                        <div class="flex items-center gap-2">
                            <div class="w-24 sm:w-32 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-600" style="width: {{ ($offersStats['deals'] / max($offersStats['totalOffers'], 1)) * 100 }}%"></div>
                            </div>
                            <span class="font-Manrope font-semibold text-gray-900 text-xs sm:text-sm w-8 text-right">{{ $offersStats['deals'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-100 shadow-sm mb-6 sm:mb-8">
            <h3 class="font-Manrope font-bold text-gray-900 text-sm sm:text-base mb-4 sm:mb-6">Performance (30 Days)</h3>
            <div style="height: 250px; position: relative;">
                <canvas id="offersChart"></canvas>
            </div>
        </div>

        <!-- Top Offers Table -->
        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-100 shadow-sm">
            <h3 class="font-Manrope font-bold text-gray-900 text-sm sm:text-base mb-4 sm:mb-6">Top Offers</h3>
            <div class="overflow-x-auto">
                <table class="w-full min-w-max">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-3 sm:px-4 py-3 text-left font-Manrope font-semibold text-xs sm:text-sm text-gray-700">Title</th>
                            <th class="px-3 sm:px-4 py-3 text-left font-Manrope font-semibold text-xs sm:text-sm text-gray-700">Type</th>
                            <th class="px-3 sm:px-4 py-3 text-right font-Manrope font-semibold text-xs sm:text-sm text-gray-700">Views</th>
                            <th class="px-3 sm:px-4 py-3 text-right font-Manrope font-semibold text-xs sm:text-sm text-gray-700">Clicks</th>
                            <th class="px-3 sm:px-4 py-3 text-right font-Manrope font-semibold text-xs sm:text-sm text-gray-700">CTR</th>
                            <th class="px-3 sm:px-4 py-3 text-left font-Manrope font-semibold text-xs sm:text-sm text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topOffers as $offer)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-3 sm:px-4 py-4 font-Inter text-xs sm:text-sm text-gray-900">{{ Str::limit($offer['title'], 20) }}</td>
                            <td class="px-3 sm:px-4 py-4 font-Inter text-xs sm:text-sm text-gray-600">{{ $offer['type'] instanceof \App\Enums\OfferType ? $offer['type']->label() : ucfirst($offer['type']) }}</td>
                            <td class="px-3 sm:px-4 py-4 font-Inter text-xs sm:text-sm text-gray-900 text-right font-semibold">{{ number_format($offer['views']) }}</td>
                            <td class="px-3 sm:px-4 py-4 font-Inter text-xs sm:text-sm text-gray-900 text-right font-semibold">{{ number_format($offer['clicks']) }}</td>
                            <td class="px-3 sm:px-4 py-4 font-Inter text-xs sm:text-sm text-red-600 text-right font-semibold">{{ $offer['ctr'] }}%</td>
                            <td class="px-3 sm:px-4 py-4">
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold whitespace-nowrap @if($offer['status'] === 'approved') bg-green-100 text-green-700 @elseif($offer['status'] === 'pending') bg-yellow-100 text-yellow-700 @else bg-red-100 text-red-700 @endif">
                                    {{ $offer['type'] instanceof \App\Enums\OfferType ? $offer['type']->label() : ucfirst($offer['type']) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-3 sm:px-4 py-8 text-center font-Inter text-xs sm:text-sm text-gray-500">No offers yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const offersTrendData = {!! json_encode($offersTrend) !!};

const ctx = document.getElementById('offersChart');
if (ctx) {
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: offersTrendData.map(d => new Date(d.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' })),
            datasets: [
                {
                    label: 'Views',
                    data: offersTrendData.map(d => d.views),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.05)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                },
                {
                    label: 'Clicks',
                    data: offersTrendData.map(d => d.clicks),
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.05)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#ef4444',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: window.innerWidth < 640 ? 11 : 12,
                            family: "'Inter', sans-serif",
                        },
                        padding: window.innerWidth < 640 ? 8 : 15,
                        usePointStyle: true,
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: window.innerWidth < 640 ? 10 : 11,
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: window.innerWidth < 640 ? 10 : 11,
                        }
                    }
                }
            }
        }
    });
}
</script>

</x-layouts.brand>