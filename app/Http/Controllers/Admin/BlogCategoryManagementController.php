<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCategoryRequest;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogCategoryManagementController extends Controller
{
    public function index(): View
    {
        return view('admin.blog-categories.index', [
            'categories' => BlogCategory::withCount('blogs')->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.blog-categories.create');
    }

    public function store(BlogCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        
        if (empty($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['name']);
        }

        BlogCategory::create($data);

        return redirect()->route('admin.blog-categories.index')->with('status', 'Blog category created successfully.');
    }

    public function edit(BlogCategory $blogCategory): View
    {
        return view('admin.blog-categories.edit', [
            'blogCategory' => $blogCategory,
        ]);
    }

    public function update(BlogCategoryRequest $request, BlogCategory $blogCategory): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['name'], $blogCategory->id);
        }

        $blogCategory->update($data);

        return redirect()->route('admin.blog-categories.index')->with('status', 'Blog category updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory): RedirectResponse
    {
        if ($blogCategory->blogs()->exists()) {
            return back()->withErrors(['blogCategory' => 'This category has blogs assigned and cannot be deleted.']);
        }

        $blogCategory->delete();

        return back()->with('status', 'Blog category deleted.');
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $counter = 1;

        while (BlogCategory::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $original . '-' . $counter++;
        }

        return $slug;
    }
}