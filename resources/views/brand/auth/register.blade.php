<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Your Brand</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    <x-auth-card title="Register Your Brand" subtitle="Get verified and start listing your coupons & deals">
        <x-slot:footer>
            Already registered?
            <a href="{{ route('brand.login') }}" class="font-semibold text-red-600 hover:text-red-700">Log in</a>
        </x-slot:footer>

        <form method="POST" action="{{ route('brand.register') }}" class="space-y-4">
            @csrf

            <div>
                <x-label value="Brand Name" />
                <x-input type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div>
                <x-label value="Email Address" />
                <x-input type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div>
                <x-label value="Website URL" />
                <x-input type="url" name="website_url" :value="old('website_url')" placeholder="https://" required />
                <x-input-error :messages="$errors->get('website_url')" />
            </div>

            <div>
                <x-label value="Category" />
                <select name="category_id" required class="w-full rounded-lg border border-gray-200 px-4 py-2.5 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" />
            </div>

            <div>
                <x-label value="Short Description" />
                <x-input type="text" name="short_description" :value="old('short_description')" maxlength="255" required />
                <x-input-error :messages="$errors->get('short_description')" />
            </div>

            <div>
                <x-label value="Password" />
                <x-input type="password" name="password" required />
                <p class="mt-1 font-Inter text-[11px] text-gray-400">At least 8 characters, mixed case, a number, and a symbol.</p>
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <div>
                <x-label value="Confirm Password" />
                <x-input type="password" name="password_confirmation" required />
            </div>

            <x-primary-button>Create Brand Account</x-primary-button>
        </form>
    </x-auth-card>
</body>
</html>
