<div class="form-group mb-3">
    <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $galleryItem->title ?? '') }}" required placeholder="Ayurveda & Panchakarma">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label class="form-label" for="description">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Short caption shown on the home gallery panels.">{{ old('description', $galleryItem->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="type">Media Type <span class="text-danger">*</span></label>
            @php
                $typeValue = old('type', $galleryItem->type ?? 'image');
            @endphp
            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                <option value="image" @selected($typeValue === 'image')>Image</option>
                <option value="video" @selected($typeValue === 'video')>Video</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="sort_order">Display Order</label>
            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $galleryItem->sort_order ?? 0) }}">
            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            @php
                $statusValue = (string) old('status', isset($galleryItem) ? (int) $galleryItem->status : 1);
            @endphp
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="1" @selected($statusValue === '1')>Active</option>
                <option value="0" @selected($statusValue === '0')>Inactive</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            @include('admin.media.partials.url-field', [
                'name' => 'source',
                'currentValue' => old('source', isset($galleryItem) ? $galleryItem->source : ''),
                'label' => 'Source URL',
                'required' => true,
            ])
            <span class="form-text text-muted font-12">For a photo, choose the image. For a video, paste the YouTube, Vimeo, or direct MP4 link.</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            @include('admin.media.partials.url-field', [
                'name' => 'thumbnail',
                'currentValue' => old('thumbnail', isset($galleryItem) ? $galleryItem->thumbnail : ''),
                'label' => 'Thumbnail URL',
            ])
            <span class="form-text text-muted font-12">Preview image shown in the grid. Recommended for videos; optional for photos.</span>
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="icon_tags">Home Panel Icons @include('admin.partials.icon-reference-link')</label>
    <input type="text" class="form-control @error('icon_tags') is-invalid @enderror" id="icon_tags" name="icon_tags" value="{{ old('icon_tags', $galleryItem->icon_tags ?? '') }}" placeholder="fa-leaf, fa-spa, fa-heart-pulse">
    @error('icon_tags')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="display_on_home">Show on Home <span class="text-danger">*</span></label>
            @php
                $homeValue = (string) old('display_on_home', isset($galleryItem) ? (int) $galleryItem->display_on_home : 0);
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

    <div class="col-md-4">
        <div class="form-group mb-0">
            <label class="form-label" for="is_featured">Featured Home Panel <span class="text-danger">*</span></label>
            @php
                $featuredValue = (string) old('is_featured', isset($galleryItem) ? (int) $galleryItem->is_featured : 0);
            @endphp
            <select class="form-select @error('is_featured') is-invalid @enderror" id="is_featured" name="is_featured" required>
                <option value="1" @selected($featuredValue === '1')>Yes</option>
                <option value="0" @selected($featuredValue === '0')>No</option>
            </select>
            @error('is_featured')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
