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
        $query = Blog::with(['blogCategory', 'admin', 'tags'])
            ->where('status', BlogStatus::Published);

        if ($request->filled('category') && $request->category !== 'all') {
            $category = BlogCategory::where('slug', $request->category)->first();
            if ($category) {
                $query->where('blog_category_id', $category->id);
            }
        }

        return view('blog', [
            'blogs' => $query->latest()->paginate(9)->withQueryString(),
            'categories' => BlogCategory::withCount('blogs')->orderBy('name')->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $blog = Blog::with(['blogCategory', 'admin', 'tags'])
            ->where('slug', $slug)
            ->where('status', BlogStatus::Published)
            ->firstOrFail();

        $relatedBlogs = Blog::with('blogCategory')
            ->where('id', '!=', $blog->id)
            ->where('status', BlogStatus::Published)
            ->when($blog->blog_category_id, function ($query) use ($blog) {
                $query->orderByRaw('blog_category_id = ? DESC', [$blog->blog_category_id]);
            })
            ->latest()
            ->limit(3)
            ->get();

        return view('blog-article', compact('blog', 'relatedBlogs'));
    }
}