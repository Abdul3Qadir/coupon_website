<?php

namespace App\Http\Controllers;

use App\Enums\BlogStatus;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('blog', [
            'blogs' => Blog::with(['blogCategory', 'admin', 'tags'])
                ->whereIn('status', [BlogStatus::Published, BlogStatus::Scheduled])
                ->where(function ($q) {
                    $q->whereNull('published_at')
                      ->orWhere('published_at', '<=', now());
                })
                ->latest('published_at')
                ->paginate(12),
            'categories' => BlogCategory::withCount('blogs')->orderBy('name')->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $blog = Blog::with(['blogCategory', 'admin', 'tags'])
            ->where('slug', $slug)
            ->whereIn('status', [BlogStatus::Published, BlogStatus::Scheduled])
            ->firstOrFail();

        $relatedBlogs = Blog::with('blogCategory')
            ->where('id', '!=', $blog->id)
            ->whereIn('status', [BlogStatus::Published, BlogStatus::Scheduled])
            ->where(function ($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            })
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('blog-article', compact('blog', 'relatedBlogs'));
    }
}