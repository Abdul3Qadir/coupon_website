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
        $this->autoPublishScheduled();

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

    public function store(BlogRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['admin_id'] = $request->user('admin')->id;

        if (empty($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['title']);
        }

        if ($request->hasFile('feature_image')) {
            $data['feature_image'] = $request->file('feature_image')->store('blog-images', 'public');
        }

        $data['status'] = $this->resolveStatus($data['status'], $data['published_at'] ?? null);

        $tags = $this->parseTags($data['tags'] ?? '');
        unset($data['tags']);

        $blog = Blog::create($data);
        $blog->tags()->sync($tags);

        $message = match ($blog->status) {
            BlogStatus::Published => 'Blog post published successfully.',
            BlogStatus::Scheduled => 'Blog post scheduled successfully.',
            default => 'Blog post saved as draft.',
        };

        return redirect()->route('admin.blogs.index')->with('status', $message);
    }

    public function edit(Blog $blog): View
    {
        return view('admin.blogs.edit', [
            'blog' => $blog,
            'categories' => BlogCategory::orderBy('name')->get(),
        ]);
    }

    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['title'], $blog->id);
        } elseif ($data['slug'] !== $blog->slug && empty($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['title'], $blog->id);
        }

        if ($request->hasFile('feature_image')) {
            if ($blog->feature_image) {
                Storage::disk('public')->delete($blog->feature_image);
            }
            $data['feature_image'] = $request->file('feature_image')->store('blog-images', 'public');
        }

        $data['status'] = $this->resolveStatus($data['status'], $data['published_at'] ?? null);

        if ($data['status'] === BlogStatus::Draft) {
            $data['published_at'] = null;
        }

        $tags = $this->parseTags($data['tags'] ?? '');
        unset($data['tags']);

        $blog->update($data);
        $blog->tags()->sync($tags);

        $message = match ($blog->status) {
            BlogStatus::Published => 'Blog post updated and published.',
            BlogStatus::Scheduled => 'Blog post updated and scheduled.',
            default => 'Blog post updated and saved as draft.',
        };

        return redirect()->route('admin.blogs.index')->with('status', $message);
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        if ($blog->feature_image) {
            Storage::disk('public')->delete($blog->feature_image);
        }

        $blog->delete();

        return back()->with('status', 'Blog post deleted.');
    }

    private function autoPublishScheduled(): void
    {
        Blog::where('status', BlogStatus::Scheduled)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->update(['status' => BlogStatus::Published]);
    }

    private function resolveStatus(string $status, ?string $publishedAt): BlogStatus
    {
        if ($status === 'draft') {
            return BlogStatus::Draft;
        }

        if (!empty($publishedAt)) {
            $date = \Carbon\Carbon::parse($publishedAt);
            if ($date->isFuture()) {
                return BlogStatus::Scheduled;
            }
        }

        return BlogStatus::Published;
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