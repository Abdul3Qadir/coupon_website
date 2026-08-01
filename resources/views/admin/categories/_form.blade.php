<div>
    <x-label value="Category Name" />
    <x-input type="text" name="name" :value="old('name', $category->name ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('name')" />
</div>

<div class="mt-4">
    <x-label value="Parent Category (optional)" />
    <select name="parent_id" class="w-full rounded-lg border border-gray-200 px-4 py-2.5 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">
        <option value="">None — this is a top-level category</option>
        @foreach ($parentOptions as $option)
            <option value="{{ $option->id }}" @selected(old('parent_id', $category->parent_id ?? '') == $option->id)>{{ $option->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('parent_id')" />
</div>

<div class="mt-4">
    <x-label value="Icon (SVG code)" />
    <p class="mb-1.5 font-Inter text-xs text-gray-400">Paste the full SVG markup, e.g. &lt;svg xmlns=... &gt;...&lt;/svg&gt;</p>
    <div class="grid grid-cols-1 sm:grid-cols-[1fr_auto] gap-3 items-start">
        <textarea id="iconInput" name="icon" rows="5" required class="w-full rounded-lg border border-gray-200 px-4 py-2.5 font-mono text-xs text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition">{{ old('icon', $category->icon ?? '') }}</textarea>
        <div class="flex flex-col items-center gap-2">
            <span class="font-Inter text-xs text-gray-400">Preview</span>
            <div id="iconPreview" class="flex h-16 w-16 items-center justify-center rounded-xl bg-red-50 text-red-600 [&>svg]:h-8 [&>svg]:w-8"></div>
        </div>
    </div>
    <x-input-error :messages="$errors->get('icon')" />
</div>