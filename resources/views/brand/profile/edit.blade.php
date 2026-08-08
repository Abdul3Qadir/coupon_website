<x-layouts.brand title="Settings">
    <div>
        <h1 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">Settings</h1>
        <p class="mt-1 font-Inter text-sm text-gray-500">Update your brand profile and password</p>
    </div>

    @session('status')
        <div class="mt-5 rounded-lg bg-emerald-50 px-4 py-3 font-Inter text-sm font-semibold text-emerald-700">
            {{ $value }}
        </div>
    @endsession

    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-6">
        <p class="font-Manrope text-base font-bold text-gray-900">Brand Profile</p>
        <p class="mt-1 font-Inter text-sm text-gray-500">This is what shoppers see on your store page</p>

        <form method="POST" action="{{ route('brand.settings.profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Small Logo</label>
                    <div class="flex items-center gap-4">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white overflow-hidden">
                            @if ($brand->small_logo)
                                <img src="{{ asset('storage/' . $brand->small_logo) }}" alt="Small logo" class="h-full w-full object-contain">
                            @else
                                <x-avatar :name="$brand->name" />
                            @endif
                        </div>
                        <input type="file" name="small_logo" accept="image/*" class="w-full font-Inter text-xs text-gray-500 file:mr-3 file:rounded-full file:border-0 file:bg-red-50 file:px-3 file:py-1.5 file:font-Inter file:text-xs file:font-semibold file:text-red-600 hover:file:bg-red-100">
                    </div>
                    @error('small_logo')
                        <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Large Logo</label>
                    <div class="flex items-center gap-4">
                        <div class="flex h-16 w-24 shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white overflow-hidden">
                            @if ($brand->large_logo)
                                <img src="{{ asset('storage/' . $brand->large_logo) }}" alt="Large logo" class="h-full w-full object-contain">
                            @else
                                <span class="font-Inter text-[10px] text-gray-400">No image</span>
                            @endif
                        </div>
                        <input type="file" name="large_logo" accept="image/*" class="w-full font-Inter text-xs text-gray-500 file:mr-3 file:rounded-full file:border-0 file:bg-red-50 file:px-3 file:py-1.5 file:font-Inter file:text-xs file:font-semibold file:text-red-600 hover:file:bg-red-100">
                    </div>
                    @error('large_logo')
                        <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Brand Name</label>
                <input type="text" name="name" value="{{ old('name', $brand->name) }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                @error('name')
                    <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

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

            <div>
                <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Short Description</label>
                <input type="text" name="short_description" value="{{ old('short_description', $brand->short_description) }}" maxlength="255" required class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                @error('short_description')
                    <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">About Your Brand</label>
                <textarea name="about_description" rows="4" maxlength="3000" class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">{{ old('about_description', $brand->about_description) }}</textarea>
                @error('about_description')
                    <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <p class="font-Inter text-sm font-semibold text-gray-700 mb-2">Social Links (optional)</p>
                <div class="space-y-3">
                    <input type="url" name="facebook_url" value="{{ old('facebook_url', $brand->social_links['facebook'] ?? '') }}" placeholder="Facebook URL" class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $brand->social_links['instagram'] ?? '') }}" placeholder="Instagram URL" class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                    <input type="url" name="twitter_url" value="{{ old('twitter_url', $brand->social_links['twitter'] ?? '') }}" placeholder="X / Twitter URL" class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="cursor-pointer rounded-full bg-red-600 hover:bg-red-700 px-6 py-3 font-Manrope text-sm font-bold text-white transition">
                    Save Profile
                </button>
            </div>
        </form>
    </div>

    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-6">
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
</x-layouts.brand>