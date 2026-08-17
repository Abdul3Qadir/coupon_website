<?php

namespace App\Http\Controllers;

use App\Enums\BlogStatus;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $this->autoPublishScheduled();

        $query = Blog::with(['blogCategory', 'admin', 'tags'])
            ->where(function ($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            });

        if ($request->filled('category') && $request->category !== 'all') {
            $category = BlogCategory::where('slug', $request->category)->first();
            if ($category) {
                $query->where('blog_category_id', $category->id);
            }
        }

        return view('blog', [
            'blogs' => $query->latest('published_at')->paginate(9)->withQueryString(),
            'categories' => BlogCategory::withCount('blogs')->orderBy('name')->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $this->autoPublishScheduled();

        $blog = Blog::with(['blogCategory', 'admin', 'tags'])
            ->where('slug', $slug)
            ->where(function ($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            })
            ->firstOrFail();

        $relatedBlogs = Blog::with('blogCategory')
            ->where('id', '!=', $blog->id)
            ->where(function ($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            })
            ->when($blog->blog_category_id, function ($query) use ($blog) {
                $query->orderByRaw('blog_category_id = ? DESC', [$blog->blog_category_id]);
            })
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('blog-article', compact('blog', 'relatedBlogs'));
    }

    private function autoPublishScheduled(): void
    {
        Blog::where('status', BlogStatus::Scheduled)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->update(['status' => BlogStatus::Published]);
    }
}