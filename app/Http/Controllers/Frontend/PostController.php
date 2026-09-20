<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of blog articles.
     */
    public function index(Request $request): View
    {
        $selectedCategory = $request->query('category');
        $search = $request->query('q');

        $categories = Post::posts()
            ->published()
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values();

        $posts = Post::posts()
            ->published()
            ->when($selectedCategory, fn ($query) => $query->where('category', $selectedCategory))
            ->when($search, fn ($query) => $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            }))
            ->latest('published_at')
            ->paginate(6)
            ->withQueryString();

        return view('pages.posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'search' => $search,
        ]);
    }

    /**
     * Display a single blog article.
     */
    public function show(Post $post): View
    {
        abort_unless($post->isPost() && $post->status === 'published' && $post->published_at?->isPast(), 404);

        $relatedPosts = Post::posts()
            ->published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->take(3)
            ->get();

        if ($relatedPosts->isEmpty()) {
            $relatedPosts = Post::posts()
                ->published()
                ->where('id', '!=', $post->id)
                ->take(3)
                ->get();
        }

        return view('pages.posts.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }
}
