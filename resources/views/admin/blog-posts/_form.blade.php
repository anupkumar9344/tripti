@php
    $isEdit = isset($blogPost);
    $activeTab = 'content';
    $seoKeys = [
        'seo_meta_title',
        'seo_meta_description',
        'seo_meta_keywords',
        'seo_og_title',
        'seo_og_description',
        'seo_og_image',
        'seo_robots',
    ];

    if ($errors->hasAny($seoKeys)) {
        $activeTab = 'seo';
    }
@endphp

<div class="card mb-0">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'content' ? 'active' : '' }}" id="blog-content-tab" data-bs-toggle="tab" data-bs-target="#blog-content" type="button" role="tab">Content</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'seo' ? 'active' : '' }}" id="blog-seo-tab" data-bs-toggle="tab" data-bs-target="#blog-seo" type="button" role="tab">SEO</button>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade {{ $activeTab === 'content' ? 'show active' : '' }}" id="blog-content" role="tabpanel">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $blogPost->title ?? '') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label" for="slug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $blogPost->slug ?? '') }}" placeholder="Auto-generated if empty">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label" for="author">Author</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author', $blogPost->author ?? 'Sahaj Aarogyam') }}" placeholder="Sahaj Aarogyam">
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label" for="published_at">Published Date</label>
                            <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at', isset($blogPost) && $blogPost->published_at ? $blogPost->published_at->format('Y-m-d') : '') }}">
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label" for="sort_order">Display Order</label>
                            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $blogPost->sort_order ?? 0) }}">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                            @php
                                $statusValue = (string) old('status', $isEdit ? (int) $blogPost->status : 1);
                            @endphp
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="1" @selected($statusValue === '1')>Published</option>
                                <option value="0" @selected($statusValue === '0')>Draft</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label" for="display_on_home">Show on Home <span class="text-danger">*</span></label>
                            @php
                                $homeValue = (string) old('display_on_home', $isEdit ? (int) $blogPost->display_on_home : 0);
                            @endphp
                            <select class="form-select @error('display_on_home') is-invalid @enderror" id="display_on_home" name="display_on_home" required>
                                <option value="1" @selected($homeValue === '1')>Yes</option>
                                <option value="0" @selected($homeValue === '0')>No</option>
                            </select>
                            @error('display_on_home')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            @include('admin.media.partials.url-field', [
                                'name' => 'featured_image',
                                'currentValue' => old('featured_image', isset($blogPost) ? $blogPost->featured_image : ''),
                                'label' => 'Featured Image URL',
                                'required' => ! $isEdit,
                            ])
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="tags">Tags</label>
                            <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" value="{{ old('tags', $blogPost->tags ?? '') }}" placeholder="gut health, nutrition, wellness">
                            @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="excerpt">Excerpt</label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $blogPost->excerpt ?? '') }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label" for="content">Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="12">{{ old('content', $blogPost->content ?? '') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade {{ $activeTab === 'seo' ? 'show active' : '' }}" id="blog-seo" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_meta_title">Meta Title</label>
                            <input type="text" class="form-control @error('seo_meta_title') is-invalid @enderror" id="seo_meta_title" name="seo_meta_title" value="{{ old('seo_meta_title', $blogPost->seo_meta_title ?? '') }}">
                            @error('seo_meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_robots">Robots</label>
                            @php
                                $robotsValue = old('seo_robots', $blogPost->seo_robots ?? 'index, follow');
                            @endphp
                            <select class="form-select @error('seo_robots') is-invalid @enderror" id="seo_robots" name="seo_robots">
                                <option value="index, follow" @selected($robotsValue === 'index, follow')>index, follow</option>
                                <option value="noindex, follow" @selected($robotsValue === 'noindex, follow')>noindex, follow</option>
                                <option value="index, nofollow" @selected($robotsValue === 'index, nofollow')>index, nofollow</option>
                                <option value="noindex, nofollow" @selected($robotsValue === 'noindex, nofollow')>noindex, nofollow</option>
                            </select>
                            @error('seo_robots')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_meta_description">Meta Description</label>
                            <textarea class="form-control @error('seo_meta_description') is-invalid @enderror" id="seo_meta_description" name="seo_meta_description" rows="2">{{ old('seo_meta_description', $blogPost->seo_meta_description ?? '') }}</textarea>
                            @error('seo_meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control @error('seo_meta_keywords') is-invalid @enderror" id="seo_meta_keywords" name="seo_meta_keywords" value="{{ old('seo_meta_keywords', $blogPost->seo_meta_keywords ?? '') }}" placeholder="gut health, ayurveda, wellness">
                            @error('seo_meta_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_og_title">OG Title</label>
                            <input type="text" class="form-control @error('seo_og_title') is-invalid @enderror" id="seo_og_title" name="seo_og_title" value="{{ old('seo_og_title', $blogPost->seo_og_title ?? '') }}">
                            @error('seo_og_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            @include('admin.media.partials.url-field', [
                                'name' => 'seo_og_image',
                                'currentValue' => old('seo_og_image', isset($blogPost) ? $blogPost->seo_og_image : ''),
                                'label' => 'OG Image URL',
                            ])
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label" for="seo_og_description">OG Description</label>
                            <textarea class="form-control @error('seo_og_description') is-invalid @enderror" id="seo_og_description" name="seo_og_description" rows="2">{{ old('seo_og_description', $blogPost->seo_og_description ?? '') }}</textarea>
                            @error('seo_og_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
