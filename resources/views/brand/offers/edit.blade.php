<x-layouts.brand title="Edit Coupon or Deal">
    <div class="max-w-2xl mx-auto px-4 sm:px-0">
        <div class="mb-8 text-center sm:text-left">
            <a href="{{ route('brand.offers.index') }}" class="inline-flex items-center gap-1.5 font-Inter text-sm font-semibold text-gray-500 hover:text-gray-700 transition">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Back to My Offers
            </a>
            <h1 class="mt-4 font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Edit Offer</h1>
            <p class="mt-1 font-Inter text-sm text-gray-500">Update your coupon or deal details</p>
        </div>

        @if ($offer->status->value === 'rejected' && $offer->rejection_reason)
            <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 font-Inter text-sm text-red-700">
                <span class="font-semibold">Rejection reason:</span> {{ $offer->rejection_reason }}
            </div>
        @endif

        <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-5 sm:p-8">
            <form method="POST" action="{{ route('brand.offers.update', $offer) }}">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block font-Inter text-sm font-semibold text-gray-900 mb-3">What are you adding?</label>
                    <div class="grid grid-cols-2 gap-3 sm:gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="coupon" class="peer sr-only" @checked(old('type', $offer->type->value) === 'coupon')>
                            <div class="rounded-xl border-2 border-gray-200 peer-checked:border-red-500 peer-checked:bg-red-50 px-3 py-4 sm:px-4 sm:py-5 text-center transition hover:border-gray-300 h-full flex flex-col items-center justify-center">
                                <svg class="mx-auto h-8 w-8 text-gray-400 peer-checked:text-red-500 mb-2 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" color="currentColor" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8.06805 2.72546L7.89604 2.86189C7.71084 3.00878 7.61823 3.08223 7.52605 3.12852C7.20698 3.28874 6.8259 3.26781 6.52663 3.07364C6.44017 3.01754 6.35631 2.93441 6.1886 2.76813C5.78856 2.37152 5.58853 2.17321 5.43777 2.10043C4.89824 1.83999 4.25045 2.10601 4.0547 2.6684C4 2.82556 4 3.10601 4 3.66691V20.698C4 20.9548 4 21.0832 4.01158 21.158C4.12554 21.8938 4.98624 22.2473 5.59159 21.8069C5.65313 21.7621 5.74474 21.6713 5.92789 21.4897C6.0431 21.3755 6.10079 21.3183 6.15539 21.2735C6.66242 20.8578 7.38352 20.8182 7.93376 21.1759C7.99303 21.2144 8.05667 21.2649 8.18395 21.3658L8.32009 21.4738C8.55044 21.6565 8.66564 21.7479 8.78105 21.8104C9.22912 22.053 9.77088 22.053 10.219 21.8104C10.3344 21.7479 10.4495 21.6565 10.6799 21.4738L10.75 21.4182C11.047 21.1827 11.1955 21.0649 11.3484 20.9918C11.7601 20.7949 12.2399 20.7949 12.6516 20.9918C12.8045 21.0649 12.953 21.1827 13.25 21.4182L13.3201 21.4738C13.5505 21.6565 13.6656 21.7479 13.781 21.8104C14.2291 22.053 14.7709 22.053 15.219 21.8104C15.3344 21.7479 15.4496 21.6565 15.6799 21.4738L15.816 21.3658C15.9433 21.2649 16.007 21.2144 16.0662 21.1759C16.6165 20.8182 17.3376 20.8578 17.8446 21.2735C17.8992 21.3183 17.9569 21.3755 18.0721 21.4897C18.2553 21.6713 18.3469 21.7621 18.4084 21.8069C19.0138 22.2473 19.8745 21.8938 19.9884 21.158C20 21.0832 20 20.9548 20 20.698V3.66691C20 3.10601 20 2.82556 19.9453 2.6684C19.7495 2.10601 19.1018 1.83999 18.5622 2.10043C18.4115 2.17321 18.2114 2.37152 17.8114 2.76813C17.6437 2.93441 17.5598 3.01754 17.4734 3.07364C17.1741 3.26781 16.793 3.28874 16.4739 3.12852C16.3818 3.08223 16.2892 3.00878 16.104 2.86189L15.932 2.72546C15.4614 2.35223 15.2261 2.16562 14.9695 2.08178C14.6646 1.98214 14.3354 1.98214 14.0305 2.08178C13.7739 2.16562 13.5386 2.35224 13.068 2.72546L13 2.77943C12.6428 3.06273 12.4642 3.20438 12.2661 3.2586C12.092 3.30627 11.908 3.30627 11.7339 3.2586C11.5358 3.20438 11.3572 3.06273 11 2.77943L10.932 2.72546C10.4614 2.35223 10.2261 2.16562 9.96953 2.08178C9.66458 1.98214 9.33542 1.98214 9.03047 2.08178C8.7739 2.16562 8.53862 2.35223 8.06805 2.72546Z"></path>
                                    <path d="M15 9L9 15"></path>
                                    <path d="M9.375 9.25H9.25M9.5 9.25C9.5 9.38807 9.38807 9.5 9.25 9.5C9.11193 9.5 9 9.38807 9 9.25C9 9.11193 9.11193 9 9.25 9C9.38807 9 9.5 9.11193 9.5 9.25Z"></path>
                                    <path d="M14.875 14.75H14.75M15 14.75C15 14.8881 14.8881 15 14.75 15C14.6119 15 14.5 14.8881 14.5 14.75C14.5 14.6119 14.6119 14.5 14.75 14.5C14.8881 14.5 15 14.6119 15 14.75Z"></path>
                                </svg>
                                <p class="font-Manrope text-sm font-bold text-gray-900">Coupon Code</p>
                                <p class="mt-0.5 font-Inter text-xs text-gray-500 hidden sm:block">Customer enters a code</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="deal" class="peer sr-only" @checked(old('type', $offer->type->value) === 'deal')>
                            <div class="rounded-xl border-2 border-gray-200 peer-checked:border-red-500 peer-checked:bg-red-50 px-3 py-4 sm:px-4 sm:py-5 text-center transition hover:border-gray-300 h-full flex flex-col items-center justify-center">
                                <svg class="mx-auto h-8 w-8 text-gray-400 peer-checked:text-red-500 mb-2 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" color="currentColor" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                    <path d="M18 9L12 15" stroke-linecap="round"></path>
                                    <path d="M12.375 9.25H12.25M12.5 9.25C12.5 9.38807 12.3881 9.5 12.25 9.5C12.1119 9.5 12 9.38807 12 9.25C12 9.11193 12.1119 9 12.25 9C12.3881 9 12.5 9.11193 12.5 9.25Z" stroke-linecap="round"></path>
                                    <path d="M17.875 14.75H17.75M18 14.75C18 14.8881 17.8881 15 17.75 15C17.6119 15 17.5 14.8881 17.5 14.75C17.5 14.6119 17.6119 14.5 17.75 14.5C17.8881 14.5 18 14.6119 18 14.75Z" stroke-linecap="round"></path>
                                    <path d="M22.0039 8.87895C21.937 7.33687 21.7495 6.33298 21.2242 5.53884C20.922 5.08196 20.5467 4.68459 20.1151 4.36468C18.9486 3.5 17.3029 3.5 14.0117 3.5H9.99696C6.70569 3.5 5.06005 3.5 3.89353 4.36468C3.46195 4.68459 3.08657 5.08196 2.78438 5.53884C2.25916 6.33289 2.07167 7.33665 2.00473 8.87843C1.99329 9.14208 2.22038 9.34375 2.46921 9.34375C3.855 9.34375 4.97839 10.533 4.97839 12C4.97839 13.467 3.855 14.6562 2.46921 14.6562C2.22038 14.6562 1.99329 14.8579 2.00473 15.1216C2.07167 16.6634 2.25916 17.6671 2.78438 18.4612C3.08657 18.918 3.46195 19.3154 3.89353 19.6353C5.06005 20.5 6.70569 20.5 9.99696 20.5H14.0117C17.3029 20.5 18.9486 20.5 20.1151 19.6353C20.5467 19.3154 20.922 18.918 21.2242 18.4612C21.7495 17.667 21.937 16.6631 22.0039 15.1211V8.87895Z"></path>
                                </svg>
                                <p class="font-Manrope text-sm font-bold text-gray-900">Automatic Deal</p>
                                <p class="mt-0.5 font-Inter text-xs text-gray-500 hidden sm:block">No code, applies on click</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block font-Inter text-sm font-semibold text-gray-900">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $offer->title) }}" placeholder="e.g. 20% Off All Summer Styles" required class="mt-2 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 font-Inter text-sm text-gray-900 outline-none focus:border-red-300 focus:ring-2 focus:ring-red-100 transition">
                    @error('title')<p class="mt-1.5 font-Inter text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="mt-6">
                    <label class="block font-Inter text-sm font-semibold text-gray-900">Category <span class="text-red-500">*</span></label>
                    <select name="category_id" required class="custom-select mt-2 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 font-Inter text-sm text-gray-900 outline-none focus:border-red-300 focus:ring-2 focus:ring-red-100 transition cursor-pointer">
                        <option value="">Select a category...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $offer->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="mt-1.5 font-Inter text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-Inter text-sm font-semibold text-gray-900">Discount Type <span class="text-red-500">*</span></label>
                        <select name="discount_type" required class="custom-select mt-2 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 font-Inter text-sm text-gray-900 outline-none focus:border-red-300 focus:ring-2 focus:ring-red-100 transition cursor-pointer">
                            <option value="percentage" @selected(old('discount_type', $offer->discount_type->value) === 'percentage')>Percentage Off</option>
                            <option value="fixed" @selected(old('discount_type', $offer->discount_type->value) === 'fixed')>Fixed Amount Off</option>
                            <option value="free_shipping" @selected(old('discount_type', $offer->discount_type->value) === 'free_shipping')>Free Shipping</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-Inter text-sm font-semibold text-gray-900">Value</label>
                        <input type="number" name="discount_value" min="0" step="0.01" value="{{ old('discount_value', $offer->discount_value) }}" placeholder="e.g. 20" class="mt-2 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 font-Inter text-sm text-gray-900 outline-none focus:border-red-300 focus:ring-2 focus:ring-red-100 transition">
                    </div>
                </div>

                <div id="codeFieldWrapper" class="mt-6">
                    <label class="block font-Inter text-sm font-semibold text-gray-900">Coupon Code</label>
                    <input id="codeInput" type="text" name="code" value="{{ old('code', $offer->code) }}" placeholder="e.g. SUMMER20" class="mt-2 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 font-Inter text-sm text-gray-900 uppercase outline-none focus:border-red-300 focus:ring-2 focus:ring-red-100 transition">
                    @error('code')<p class="mt-1.5 font-Inter text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="mt-6">
                    <label class="block font-Inter text-sm font-semibold text-gray-900">Where should we send customers? <span class="text-red-500">*</span></label>
                    <input type="url" name="redirect_url" value="{{ old('redirect_url', $offer->redirect_url) }}" placeholder="https://yourstore.com/sale" required class="mt-2 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 font-Inter text-sm text-gray-900 outline-none focus:border-red-300 focus:ring-2 focus:ring-red-100 transition">
                    @error('redirect_url')<p class="mt-1.5 font-Inter text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="mt-6">
                    <label class="block font-Inter text-sm font-semibold text-gray-900">Short Description</label>
                    <textarea name="description" rows="3" maxlength="1000" placeholder="A quick line about this offer" class="mt-2 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 font-Inter text-sm text-gray-900 placeholder:text-gray-400 outline-none focus:border-red-300 focus:ring-2 focus:ring-red-100 transition">{{ old('description', $offer->description) }}</textarea>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-Inter text-sm font-semibold text-gray-900">Starts On <span class="font-normal text-gray-400">(optional)</span></label>
                        <input type="date" name="starts_at" value="{{ old('starts_at', optional($offer->starts_at)->format('Y-m-d')) }}" class="mt-2 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 font-Inter text-sm text-gray-900 outline-none focus:border-red-300 focus:ring-2 focus:ring-red-100 transition">
                    </div>
                    <div>
                        <label class="block font-Inter text-sm font-semibold text-gray-900">Expires On <span class="font-normal text-gray-400">(optional)</span></label>
                        <input type="date" name="expires_at" value="{{ old('expires_at', optional($offer->expires_at)->format('Y-m-d')) }}" class="mt-2 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 font-Inter text-sm text-gray-900 outline-none focus:border-red-300 focus:ring-2 focus:ring-red-100 transition">
                        @error('expires_at')<p class="mt-1.5 font-Inter text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <button type="submit" class="w-full inline-flex items-center justify-center rounded-xl bg-red-600 px-6 py-3 font-Inter text-sm font-semibold text-white hover:bg-red-700 transition">
                        Save Changes
                    </button>
                    <a href="{{ route('brand.offers.index') }}" class="w-full inline-flex items-center justify-center rounded-xl bg-gray-100 px-6 py-3 font-Inter text-sm font-semibold text-gray-700 hover:bg-gray-200 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.brand>