<section class="py-10">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto">
        <h2 class="mt-4 font-Manrope text-3xl sm:text-4xl font-extrabold tracking-tight text-gray-900">Exclusive Hot Deals</h2>
        <p class="mt-2 text-sm sm:text-base text-gray-600">Automatic discounts, live sales, and limited-time drops</p>
    </div>

    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse ($topDeals as $deal)
      <a href="{{ $deal->redirect_url ?? '#' }}" target="_blank" class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
        <div class="relative flex items-center justify-between mb-5">
          <div class="flex items-center justify-center rounded-xl bg-gray-100 p-2 border border-gray-200">
            @if($deal->brand && $deal->brand->small_logo)
                <img src="{{ asset('storage/' . $deal->brand->small_logo) }}" alt="{{ $deal->brand->name }}" class="max-h-10 w-auto object-contain">
            @else
                <span class="font-Manrope text-xs font-bold text-gray-400">{{ $deal->brand->name ?? 'Brand' }}</span>
            @endif
          </div>
          <span class="rounded-full bg-red-600 px-3 py-1 font-Manrope text-xs font-bold text-white">
            @if($deal->discount_type?->value === 'percentage')
                {{ round($deal->discount_value) }}% OFF
            @elseif($deal->discount_type?->value === 'fixed')
                Rs. {{ number_format($deal->discount_value) }} OFF
            @elseif($deal->discount_type?->value === 'free_shipping')
                FREE SHIPPING
            @else
                DEAL
            @endif
          </span>
        </div>
        <div class="grow">
          <h3 class="font-Manrope text-lg font-bold text-gray-900 group-hover:text-red-600 transition-colors">{{ $deal->title }}</h3>
          <p class="mt-2 text-xs sm:text-sm text-gray-600 leading-relaxed">{{ $deal->description ?? 'Limited time offer. Grab it before it ends!' }}</p>
        </div>
        <div class="mt-6 flex items-center justify-between pt-4 border-t border-gray-100">
          <span class="inline-flex items-center gap-1 font-Inter text-xs font-medium {{ $deal->expires_at && $deal->expires_at->isToday() ? 'text-red-600 font-bold' : 'text-red-600' }}">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            @if($deal->expires_at)
                @if($deal->expires_at->isToday())
                    Ends today
                @else
                    Ends {{ $deal->expires_at->diffForHumans() }}
                @endif
            @else
                Limited time
            @endif
          </span>
          <span class="inline-flex items-center gap-1 font-Manrope text-xs font-bold text-gray-900 group-hover:text-red-600 transition-colors">
            Get Deal
            <svg class="h-4 w-4 transform transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
          </span>
        </div>
      </a>
      @empty
      <div class="col-span-full text-center py-12">
          <p class="font-Inter text-gray-400">No active deals available right now.</p>
      </div>
      @endforelse
    </div>
  </div>
</section>