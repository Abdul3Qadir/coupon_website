<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BlogStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogManagementController extends Controller
{
    public function index(): View
    {
        return view('admin.blogs.index', [
            'blogs' => Blog::with(['blogCategory', 'admin', 'tags'])->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.blogs.create', [
            'categories' => BlogCategory::orderBy('name')->get(),
        ]);
    }

        public function store(BlogCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        
        if (empty($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['name']);
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        BlogCategory::create($data);

        return redirect()->route('admin.blog-categories.index')->with('status', 'Blog category created successfully.');
    }

    public function edit(Blog $blog): View
    {
        return view('admin.blogs.edit', [
            'blog' => $blog,
            'categories' => BlogCategory::orderBy('name')->get(),
        ]);
    }

    public function update(BlogCategoryRequest $request, BlogCategory $blogCategory): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['name'], $blogCategory->id);
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        $blogCategory->update($data);

        return redirect()->route('admin.blog-categories.index')->with('status', 'Blog category updated successfully.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        if ($blog->feature_image) {
            Storage::disk('public')->delete($blog->feature_image);
        }

        $blog->delete();

        return back()->with('status', 'Blog post deleted.');
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $counter = 1;

        while (Blog::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $original . '-' . $counter++;
        }

        return $slug;
    }

    private function parseTags(string $tagsString): array
    {
        if (empty($tagsString)) {
            return [];
        }

        $names = array_filter(array_map('trim', explode(',', $tagsString)));
        $ids = [];

        foreach ($names as $name) {
            $slug = Str::slug($name);
            if (empty($slug)) continue;

            $tag = Tag::firstOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
            $ids[] = $tag->id;
        }

        return $ids;
    }
}