<x-layouts.brand title="Settings">
    {{-- Page Header --}}
    <div>
        <h1 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">Settings</h1>
        <p class="mt-1 font-Inter text-sm text-gray-500">Update your brand profile and password</p>
    </div>

    @session('status')
        <div class="mt-5 rounded-lg bg-emerald-50 px-4 py-3 font-Inter text-sm font-semibold text-emerald-700">
            {{ $value }}
        </div>
    @endsession

    {{-- Status Card --}}
    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-gray-200 bg-white overflow-hidden">
                    @if ($brand->small_logo)
                        <img src="{{ asset('storage/' . $brand->small_logo) }}" alt="{{ $brand->name }}" class="h-full w-full object-contain p-1">
                    @else
                        <x-avatar :name="$brand->name" size="lg" />
                    @endif
                </div>
                <div class="min-w-0">
                    <p class="font-Manrope text-base font-bold text-gray-900 truncate">{{ $brand->name }}</p>
                    <p class="font-Inter text-sm text-gray-500">{{ $brand->email }}</p>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 font-Inter text-xs font-semibold
                    {{ $brand->status->value === 'verified' ? 'bg-emerald-50 text-emerald-700' : ($brand->status->value === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700') }}">
                    <span class="h-1.5 w-1.5 rounded-full {{ $brand->status->value === 'verified' ? 'bg-emerald-500' : ($brand->status->value === 'pending' ? 'bg-amber-500' : 'bg-red-500') }}"></span>
                    {{ ucfirst($brand->status->value) }}
                </span>
                @if ($brand->verified_at)
                    <span class="rounded-full bg-gray-100 px-3 py-1.5 font-Inter text-xs font-medium text-gray-600">Verified {{ $brand->verified_at->diffForHumans() }}</span>
                @endif
            </div>
        </div>

        <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="rounded-xl bg-gray-50 p-4">
                <p class="font-Inter text-xs font-medium text-gray-500 uppercase tracking-wide">Member Since</p>
                <p class="mt-1 font-Manrope text-sm font-bold text-gray-900">{{ $brand->created_at->format('M d, Y') }}</p>
            </div>
            <div class="rounded-xl bg-gray-50 p-4">
                <p class="font-Inter text-xs font-medium text-gray-500 uppercase tracking-wide">Auto Publish</p>
                <p class="mt-1 font-Manrope text-sm font-bold {{ $brand->auto_publish_offers ? 'text-emerald-600' : 'text-gray-900' }}">{{ $brand->auto_publish_offers ? 'Enabled' : 'Disabled' }}</p>
            </div>
            <div class="rounded-xl bg-gray-50 p-4">
                <p class="font-Inter text-xs font-medium text-gray-500 uppercase tracking-wide">Total Offers</p>
                <p class="mt-1 font-Manrope text-sm font-bold text-gray-900">{{ $brand->offers()->count() }}</p>
            </div>
        </div>
    </div>

    {{-- Profile Form --}}
    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">
        <p class="font-Manrope text-base font-bold text-gray-900">Brand Profile</p>
        <p class="mt-1 font-Inter text-sm text-gray-500">This is what shoppers see on your store page</p>

        <form method="POST" action="{{ route('brand.settings.profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- Logos Row --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Small Logo</label>
                    <div class="flex items-center gap-4">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white overflow-hidden">
                            <img id="smallLogoPreview" src="{{ $brand->small_logo ? asset('storage/' . $brand->small_logo) : '' }}" alt="Small logo" class="h-full w-full object-contain p-1 {{ $brand->small_logo ? '' : 'hidden' }}">
                            <span id="smallLogoPlaceholder" class="font-Inter text-[10px] text-gray-400 {{ $brand->small_logo ? 'hidden' : '' }}">No image</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <input type="file" name="small_logo" accept="image/*" id="smallLogoInput" class="w-full font-Inter text-xs text-gray-500 file:mr-3 file:rounded-full file:border-0 file:bg-red-50 file:px-3 file:py-1.5 file:font-Inter file:text-xs file:font-semibold file:text-red-600 hover:file:bg-red-100 cursor-pointer">
                            <p class="mt-1 font-Inter text-[11px] text-gray-400">Square, max 1MB</p>
                        </div>
                    </div>
                    @error('small_logo')
                        <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Large Logo</label>
                    <div class="flex items-center gap-4">
                        <div class="flex h-16 w-24 shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white overflow-hidden">
                            <img id="largeLogoPreview" src="{{ $brand->large_logo ? asset('storage/' . $brand->large_logo) : '' }}" alt="Large logo" class="h-full w-full object-contain p-1 {{ $brand->large_logo ? '' : 'hidden' }}">
                            <span id="largeLogoPlaceholder" class="font-Inter text-[10px] text-gray-400 {{ $brand->large_logo ? 'hidden' : '' }}">No image</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <input type="file" name="large_logo" accept="image/*" id="largeLogoInput" class="w-full font-Inter text-xs text-gray-500 file:mr-3 file:rounded-full file:border-0 file:bg-red-50 file:px-3 file:py-1.5 file:font-Inter file:text-xs file:font-semibold file:text-red-600 hover:file:bg-red-100 cursor-pointer">
                            <p class="mt-1 font-Inter text-[11px] text-gray-400">Wide, max 2MB</p>
                        </div>
                    </div>
                    @error('large_logo')
                        <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Brand Name --}}
            <div>
                <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Brand Name</label>
                <input type="text" name="name" value="{{ old('name', $brand->name) }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                @error('name')
                    <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Website + Category --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Website URL</label>
                    <input type="url" name="website_url" value="{{ old('website_url', $brand->website_url) }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                    @error('website_url')
                        <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Category</label>
                    <select name="category_id" required class="custom-select w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $brand->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Short Description --}}
            <div>
                <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Short Description</label>
                <input type="text" name="short_description" value="{{ old('short_description', $brand->short_description) }}" maxlength="255" required class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                @error('short_description')
                    <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- About --}}
            <div>
                <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">About Your Brand</label>
                <textarea name="about_description" rows="4" maxlength="3000" class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">{{ old('about_description', $brand->about_description) }}</textarea>
                @error('about_description')
                    <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Social Links --}}
            <div>
                <p class="font-Inter text-sm font-semibold text-gray-700 mb-2">Social Links (optional)</p>
                <div class="space-y-3">
                    <input type="url" name="facebook_url" value="{{ old('facebook_url', $brand->social_links['facebook'] ?? '') }}" placeholder="Facebook URL" class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $brand->social_links['instagram'] ?? '') }}" placeholder="Instagram URL" class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                    <input type="url" name="twitter_url" value="{{ old('twitter_url', $brand->social_links['twitter'] ?? '') }}" placeholder="X / Twitter URL" class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                </div>
            </div>

            {{-- Allow Admin Toggle --}}
            <div class="rounded-xl border border-gray-200 bg-gray-50/50 p-4 sm:p-5">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                    <div class="flex-1">
                        <p class="font-Inter text-sm font-semibold text-gray-900">Allow Admin to Add Offers</p>
                        <p class="mt-0.5 font-Inter text-xs text-gray-500 leading-relaxed">When enabled, Super Admins and Sub-Admins can create coupons and deals on your behalf. You'll be notified when they do.</p>
                    </div>
                    <label class="relative inline-flex cursor-pointer items-center shrink-0">
                        <input type="checkbox" name="allow_admin_to_add_offers" value="1" class="peer sr-only" @checked(old('allow_admin_to_add_offers', $brand->allow_admin_to_add_offers))>
                        <div class="h-6 w-11 rounded-full bg-gray-300 transition peer-checked:bg-red-600 peer-focus:ring-2 peer-focus:ring-red-200"></div>
                        <div class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white shadow transition peer-checked:translate-x-5"></div>
                    </label>
                </div>
            </div>

            {{-- Save Button --}}
            <div class="pt-2">
                <button type="submit" class="cursor-pointer rounded-full bg-red-600 hover:bg-red-700 px-6 py-3 font-Manrope text-sm font-bold text-white transition">
                    Save Profile
                </button>
            </div>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">
        <p class="font-Manrope text-base font-bold text-gray-900">Change Password</p>
        <p class="mt-1 font-Inter text-sm text-gray-500">Choose a strong password you haven't used before</p>

        <form method="POST" action="{{ route('brand.settings.password.update') }}" class="mt-6 space-y-5 max-w-md">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Current Password</label>
                <input type="password" name="current_password" required class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                @error('current_password')
                    <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">New Password</label>
                <input type="password" name="password" required class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                <p class="mt-1.5 font-Inter text-[11px] text-gray-400">At least 8 characters, mixed case, a number, and a symbol.</p>
                @error('password')
                    <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Confirm New Password</label>
                <input type="password" name="password_confirmation" required class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
            </div>

            <div class="pt-2">
                <button type="submit" class="cursor-pointer rounded-full bg-gray-900 hover:bg-gray-800 px-6 py-3 font-Manrope text-sm font-bold text-white transition">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input, previewId, placeholderId) {
            const preview = document.getElementById(previewId);
            const placeholder = document.getElementById(placeholderId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        document.getElementById('smallLogoInput').addEventListener('change', function() {
            previewImage(this, 'smallLogoPreview', 'smallLogoPlaceholder');
        });
        document.getElementById('largeLogoInput').addEventListener('change', function() {
            previewImage(this, 'largeLogoPreview', 'largeLogoPlaceholder');
        });
    </script>
</x-layouts.brand>