<x-layouts.admin title="Profile Settings">

    <div>
        <h1 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">Profile Settings</h1>
        <p class="mt-1 font-Inter text-sm text-gray-500">Manage your account information and password</p>
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
                    @if ($admin->avatar)
                        <img src="{{ asset('storage/' . $admin->avatar) }}" alt="{{ $admin->name }}" class="h-full w-full object-cover">
                    @else
                        <x-avatar :name="$admin->name" size="lg" />
                    @endif
                </div>
                <div class="min-w-0">
                    <p class="font-Manrope text-base font-bold text-gray-900 truncate">{{ $admin->name }}</p>
                    <p class="font-Inter text-sm text-gray-500">{{ $admin->email }}</p>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 font-Inter text-xs font-semibold
                    {{ $admin->role->value === 'super_admin' ? 'bg-purple-50 text-purple-700' : 'bg-blue-50 text-blue-700' }}">
                    <span class="h-1.5 w-1.5 rounded-full {{ $admin->role->value === 'super_admin' ? 'bg-purple-500' : 'bg-blue-500' }}"></span>
                    {{ $admin->role->label() }}
                </span>
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 font-Inter text-xs font-semibold
                    {{ $admin->status->value === 'approved' ? 'bg-emerald-50 text-emerald-700' : ($admin->status->value === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700') }}">
                    <span class="h-1.5 w-1.5 rounded-full {{ $admin->status->value === 'approved' ? 'bg-emerald-500' : ($admin->status->value === 'pending' ? 'bg-amber-500' : 'bg-red-500') }}"></span>
                    {{ ucfirst($admin->status->value) }}
                </span>
            </div>
        </div>

        <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="rounded-xl bg-gray-50 p-4">
                <p class="font-Inter text-xs font-medium text-gray-500 uppercase tracking-wide">Member Since</p>
                <p class="mt-1 font-Manrope text-sm font-bold text-gray-900">{{ $admin->created_at->format('M d, Y') }}</p>
            </div>
            @if (!$admin->isSuperAdmin())
                <div class="rounded-xl bg-gray-50 p-4">
                    <p class="font-Inter text-xs font-medium text-gray-500 uppercase tracking-wide">Auto Publish</p>
                    <p class="mt-1 font-Manrope text-sm font-bold {{ $admin->auto_publish_offers ? 'text-emerald-600' : 'text-gray-900' }}">{{ $admin->auto_publish_offers ? 'Enabled' : 'Disabled' }}</p>
                </div>
            @else
                <div class="rounded-xl bg-gray-50 p-4">
                    <p class="font-Inter text-xs font-medium text-gray-500 uppercase tracking-wide">Total Offers</p>
                    <p class="mt-1 font-Manrope text-sm font-bold text-gray-900">{{ $admin->offers()->count() }}</p>
                </div>
            @endif
            <div class="rounded-xl bg-gray-50 p-4">
                <p class="font-Inter text-xs font-medium text-gray-500 uppercase tracking-wide">Total Blogs</p>
                <p class="mt-1 font-Manrope text-sm font-bold text-gray-900">{{ $admin->blogs()->count() }}</p>
            </div>
        </div>
    </div>

    {{-- Profile Form --}}
    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">
        <p class="font-Manrope text-base font-bold text-gray-900">Admin Profile</p>
        <p class="mt-1 font-Inter text-sm text-gray-500">Update your personal information and contact details</p>

        <form method="POST" action="{{ route('admin.settings.profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- Avatar --}}
            <div>
                <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Profile Picture</label>
                <div class="flex items-center gap-4">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white overflow-hidden">
                        <img id="avatarPreview" src="{{ $admin->avatar ? asset('storage/' . $admin->avatar) : '' }}" alt="Avatar" class="h-full w-full object-cover {{ $admin->avatar ? '' : 'hidden' }}">
                        <span id="avatarPlaceholder" class="font-Inter text-[10px] text-gray-400 {{ $admin->avatar ? 'hidden' : '' }}">No image</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <input type="file" name="avatar" accept="image/*" id="avatarInput" class="w-full font-Inter text-xs text-gray-500 file:mr-3 file:rounded-full file:border-0 file:bg-red-50 file:px-3 file:py-1.5 file:font-Inter file:text-xs file:font-semibold file:text-red-600 hover:file:bg-red-100 cursor-pointer">
                        <p class="mt-1 font-Inter text-[11px] text-gray-400">Square, max 1MB</p>
                    </div>
                </div>
                @error('avatar')
                    <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Name + Email --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $admin->name) }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                    @error('name')
                        <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                    @error('email')
                        <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Phone --}}
            <div>
                <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Phone Number</label>
                <input type="tel" name="phone" value="{{ old('phone', $admin->phone) }}" placeholder="+1 234 567 890" class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                @error('phone')
                    <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bio --}}
            <div>
                <label class="block font-Inter text-sm font-semibold text-gray-700 mb-1.5">Bio</label>
                <textarea name="bio" rows="4" maxlength="1000" placeholder="Tell us a little about yourself..." class="w-full rounded-xl border border-gray-200 px-4 py-3 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">{{ old('bio', $admin->bio) }}</textarea>
                <p class="mt-1 font-Inter text-[11px] text-gray-400">Max 1000 characters</p>
                @error('bio')
                    <p class="mt-1.5 font-Inter text-xs text-red-600">{{ $message }}</p>
                @enderror
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

        <form method="POST" action="{{ route('admin.settings.password.update') }}" class="mt-6 space-y-5 max-w-md">
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
        document.getElementById('avatarInput').addEventListener('change', function() {
            previewImage(this, 'avatarPreview', 'avatarPlaceholder');
        });
    </script>
</x-layouts.admin>
