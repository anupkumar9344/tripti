<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Support\MediaPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for blog posts.
 */
class BlogPostController extends Controller
{
    /**
     * Display the list of blog posts.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $posts = BlogPost::query()
            ->orderByDesc('published_at')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.blog-posts.index', compact('posts'));
    }

    /**
     * Show the form to create a new blog post.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.blog-posts.create');
    }

    /**
     * Store a newly created blog post.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePost($request, true);

        $featuredImage = MediaPath::normalize($validated['featured_image'] ?? null);

        if (! $featuredImage) {
            return back()
                ->withErrors(['featured_image' => 'Please paste a featured image URL from the media library.'])
                ->withInput();
        }

        BlogPost::create($this->postAttributes($validated, $featuredImage));

        return redirect()
            ->route('admin.blog-posts.index')
            ->with('success', 'Blog post created successfully.');
    }

    /**
     * Show the form to edit a blog post.
     *
     * @return \Illuminate\View\View
     */
    public function edit(BlogPost $blogPost): View
    {
        return view('admin.blog-posts.edit', compact('blogPost'));
    }

    /**
     * Update the given blog post.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BlogPost $blogPost): RedirectResponse
    {
        $validated = $this->validatePost($request, false);

        $featuredImage = MediaPath::normalize($validated['featured_image'] ?? null) ?: $blogPost->featured_image;

        $blogPost->fill($this->postAttributes($validated, $featuredImage, $blogPost->id));
        $blogPost->save();

        return redirect()
            ->route('admin.blog-posts.index')
            ->with('success', 'Blog post updated successfully.');
    }

    /**
     * Delete a blog post.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BlogPost $blogPost): RedirectResponse
    {
        $blogPost->delete();

        return redirect()
            ->route('admin.blog-posts.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    /**
     * Validate blog post form input.
     *
     * @return array<string, mixed>
     */
    private function validatePost(Request $request, bool $isCreate): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'featured_image' => [$isCreate ? 'required' : 'nullable', 'string', 'max:500'],
            'author' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['nullable', 'string'],
            'tags' => ['nullable', 'string', 'max:500'],
            'published_at' => ['nullable', 'date'],
            'display_on_home' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
            'seo_meta_title' => ['nullable', 'string', 'max:255'],
            'seo_meta_description' => ['nullable', 'string', 'max:500'],
            'seo_meta_keywords' => ['nullable', 'string', 'max:500'],
            'seo_og_title' => ['nullable', 'string', 'max:255'],
            'seo_og_description' => ['nullable', 'string', 'max:500'],
            'seo_og_image' => ['nullable', 'string', 'max:500'],
            'seo_robots' => ['nullable', 'string', 'max:100'],
        ]);
    }

    /**
     * Map validated input to model attributes.
     *
     * @return array<string, mixed>
     */
    private function postAttributes(array $validated, string $featuredImage, ?int $ignoreId = null): array
    {
        $slugSource = $validated['slug'] ?? $validated['title'];

        return [
            'title' => $validated['title'],
            'slug' => BlogPost::generateUniqueSlug($slugSource, $ignoreId),
            'featured_image' => $featuredImage,
            'author' => $validated['author'] ?? null,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
            'display_on_home' => (bool) $validated['display_on_home'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
            'seo_meta_title' => $validated['seo_meta_title'] ?? null,
            'seo_meta_description' => $validated['seo_meta_description'] ?? null,
            'seo_meta_keywords' => $validated['seo_meta_keywords'] ?? null,
            'seo_og_title' => $validated['seo_og_title'] ?? null,
            'seo_og_description' => $validated['seo_og_description'] ?? null,
            'seo_og_image' => MediaPath::normalize($validated['seo_og_image'] ?? null),
            'seo_robots' => $validated['seo_robots'] ?? 'index, follow',
        ];
    }
}
