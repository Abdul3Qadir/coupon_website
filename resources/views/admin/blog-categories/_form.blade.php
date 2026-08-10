<div>
    <x-label value="Category Name" />
    <x-input type="text" name="name" :value="old('name', $blogCategory->name ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('name')" />
</div>

<div class="mt-4">
    <x-label value="Slug" />
    <x-input type="text" name="slug" :value="old('slug', $blogCategory->slug ?? '')" required />
    <p class="mt-1 font-Inter text-xs text-gray-400">URL-friendly identifier. Auto-generated if left blank.</p>
    <x-input-error :messages="$errors->get('slug')" />
</div>