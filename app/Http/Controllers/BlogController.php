<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\View\View;

/**
 * Handles the public blog pages.
 */
class BlogController extends Controller
{
    /**
     * Display the blog listing page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $posts = BlogPost::query()->activeOrdered()->paginate(9);

        return view('blog.index', compact('posts'));
    }

    /**
     * Display a single blog post.
     *
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View
    {
        $post = BlogPost::query()
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $relatedPosts = BlogPost::query()
            ->where('status', true)
            ->where('id', '!=', $post->id)
            ->activeOrdered()
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
