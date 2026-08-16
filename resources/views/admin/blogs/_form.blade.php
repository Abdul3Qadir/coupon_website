@if ($errors->any())
    <div class="rounded-xl bg-red-50 border border-red-200 px-4 py-3">
        <p class="font-Inter text-sm font-semibold text-red-700">Please fix the following errors:</p>
        <ul class="mt-1 space-y-0.5 font-Inter text-xs text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8">
    <div>
        <label class="block font-Inter text-sm font-semibold text-gray-900 mb-2">Post Title</label>
        <input type="text" name="title" value="{{ old('title', $blog->title ?? '') }}" placeholder="Enter an engaging title..." required class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 font-Inter text-base text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition" />
    </div>

    <div class="mt-5">
        <label class="block font-Inter text-sm font-semibold text-gray-900 mb-2">Slug</label>
        <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 font-Inter text-sm text-gray-400 select-none">/blog/</span>
            <input type="text" name="slug" value="{{ old('slug', $blog->slug ?? '') }}" placeholder="auto-generated-from-title" required class="w-full rounded-xl border border-gray-200 bg-gray-50 pl-14 pr-4 py-3 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition" />
        </div>
        <p class="mt-1.5 font-Inter text-xs text-gray-400">URL-friendly identifier. Leave empty to auto-generate from title.</p>
    </div>

    <div class="mt-5">
        <label class="block font-Inter text-sm font-semibold text-gray-900 mb-2">Excerpt</label>
        <textarea name="excerpt" rows="3" placeholder="Short summary shown on the blog listing..." class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition resize-none">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
        <p class="mt-1.5 font-Inter text-xs text-gray-400">Keep it under 160 characters for best results.</p>
    </div>
</div>

<div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8">
    <label class="block font-Inter text-sm font-semibold text-gray-900 mb-3">Content</label>
    {{-- CKEditor 5 Classic build mein image upload plugin nahi hai by default.
         Article ke beech mein image add karne ke liye:
         1. External image ka URL paste karo, ya
         2. Image pehle upload karo (Imgur, Cloudinary etc), phir URL se embed karo
         Future mein: CKEditor custom build ya Superbuild use karo for native image upload --}}
    <textarea id="editor" name="content" rows="15" placeholder="Write your article content here..." class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition">{{ old('content', $blog->content ?? '') }}</textarea>
</div>

<div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8">
    <h3 class="font-Manrope text-sm font-bold text-gray-900 mb-5 flex items-center gap-2">
        <svg class="h-4 w-4 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        Featured Image
    </h3>

    {{-- IMAGE PREVIEW FIX (Issue #3) --}}
    <div id="imagePreviewContainer" class="{{ (isset($blog) && $blog->feature_image) ? '' : 'hidden' }} mb-4 relative rounded-xl overflow-hidden">
        <img id="imagePreview" src="{{ isset($blog) && $blog->feature_image ? asset('storage/' . $blog->feature_image) : '' }}" alt="" class="h-48 w-full object-cover">
    </div>

    <div>
        <input type="file" name="feature_image" id="featureImage" accept="image/jpeg,image/png,image/webp,image/jpg" class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 font-Inter text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-red-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-red-700 cursor-pointer outline-none focus:border-red-300 focus:ring-2 focus:ring-red-100 transition" />
        <p class="mt-1.5 font-Inter text-xs text-gray-400">JPG, PNG, WebP up to 2MB. Recommended: 1200 x 630px</p>
        @error('feature_image')
            <p class="mt-1 font-Inter text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block font-Inter text-xs font-semibold text-gray-700 mb-1.5">Image Alt Text</label>
            <input type="text" name="image_alt" value="{{ old('image_alt', $blog->image_alt ?? '') }}" placeholder="Describe the image for SEO..." class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition" />
        </div>
        <div>
            <label class="block font-Inter text-xs font-semibold text-gray-700 mb-1.5">Image Title</label>
            <input type="text" name="image_title" value="{{ old('image_title', $blog->image_title ?? '') }}" placeholder="Title attribute for image..." class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition" />
        </div>
    </div>

    <div class="mt-4">
        <label class="block font-Inter text-xs font-semibold text-gray-700 mb-1.5">Image Caption</label>
        <input type="text" name="image_caption" value="{{ old('image_caption', $blog->image_caption ?? '') }}" placeholder="Caption shown below image..." class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition" />
    </div>

    <div class="mt-4">
        <label class="block font-Inter text-xs font-semibold text-gray-700 mb-1.5">Image Description</label>
        <textarea name="image_description" rows="2" placeholder="Long description for accessibility..." class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition resize-none">{{ old('image_description', $blog->image_description ?? '') }}</textarea>
    </div>
</div>

<div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8">
    <h3 class="font-Manrope text-sm font-bold text-gray-900 mb-5 flex items-center gap-2">
        <svg class="h-4 w-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
        SEO Settings
    </h3>

    <div>
        <label class="block font-Inter text-xs font-semibold text-gray-700 mb-1.5">Focus Keyword</label>
        <input type="text" name="focus_keyword" value="{{ old('focus_keyword', $blog->focus_keyword ?? '') }}" placeholder="Main keyword for this article..." class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition" />
    </div>

    <div class="mt-4">
        <label class="block font-Inter text-xs font-semibold text-gray-700 mb-1.5">Meta Title</label>
        <input type="text" name="seo_title" value="{{ old('seo_title', $blog->seo_title ?? '') }}" placeholder="SEO optimized page title..." class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition" />
    </div>

    <div class="mt-4">
        <label class="block font-Inter text-xs font-semibold text-gray-700 mb-1.5">Meta Description</label>
        <textarea name="seo_description" rows="2" placeholder="Brief description for search engines..." class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition resize-none">{{ old('seo_description', $blog->seo_description ?? '') }}</textarea>
    </div>
</div>

<div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8">
    <h3 class="font-Manrope text-sm font-bold text-gray-900 mb-5 flex items-center gap-2">
        <svg class="h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41L11 3.83A2 2 0 009.59 3.24H4a1 1 0 00-1 1v5.59a2 2 0 00.59 1.41l9.58 9.58a2 2 0 002.82 0l5.59-5.59a2 2 0 000-2.82z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg>
        Organization
    </h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block font-Inter text-xs font-semibold text-gray-700 mb-1.5">Category</label>
            <select name="blog_category_id" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 font-Inter text-sm text-gray-900 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition">
                <option value="">Uncategorized</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('blog_category_id', $blog->blog_category_id ?? '') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-Inter text-xs font-semibold text-gray-700 mb-1.5">Tags</label>
            <input type="text" name="tags" value="{{ old('tags', isset($blog) ? $blog->tags->pluck('name')->implode(', ') : '') }}" placeholder="social media, technology, deals" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:bg-white focus:ring-2 focus:ring-red-100 outline-none transition" />
            <p class="mt-1.5 font-Inter text-xs text-gray-400">Separate tags with commas</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('featureImage');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImg = document.getElementById('imagePreview');

        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        const editorElement = document.querySelector('#editor');
        if (!editorElement) return;

        ClassicEditor
            .create(editorElement, {
                toolbar: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    '|',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'blockQuote',
                    'insertTable',
                    '|',
                    'undo',
                    'redo'
                ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                },
                placeholder: 'Write your article content here...'
            })
            .then(editor => {
                console.log('CKEditor 5 initialized');
            })
            .catch(error => {
                console.error('CKEditor 5 error:', error);
            });
    });
</script>
@endpush