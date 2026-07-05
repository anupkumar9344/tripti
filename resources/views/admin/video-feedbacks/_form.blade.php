@php
    $isEdit = isset($videoFeedback);
@endphp

<div class="form-group mb-3">
    <label class="form-label" for="title">Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $videoFeedback->title ?? '') }}" placeholder="Luxury Suite, Fine Dining, Spa...">
    <small class="text-muted">Shown as the short label on the homepage (e.g. luxury suite).</small>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label class="form-label" for="video_url">Video URL <span class="text-danger">*</span></label>
    <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url', isset($videoFeedback) ? $videoFeedback->playableUrl() : '') }}" required placeholder="https://www.youtube.com/shorts/... or paste MP4 URL from Media Library">
    <small class="text-muted">YouTube Shorts, Vimeo, or direct MP4/WebM links from the media library.</small>
    @error('video_url')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    @include('admin.media.partials.url-field', [
        'name' => 'thumbnail',
        'currentValue' => old('thumbnail', $isEdit ? ($videoFeedback->thumbnail ?? '') : ''),
        'label' => 'Hotel Poster Image',
    ])
    <span class="form-text text-muted font-12">Use a hotel room, dining, spa, or gallery image so each short looks unique.</span>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="display_on_home">Show on Home <span class="text-danger">*</span></label>
            @php
                $homeValue = (string) old('display_on_home', $isEdit ? (int) $videoFeedback->display_on_home : 0);
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
        <div class="form-group mb-3">
            <label class="form-label" for="sort_order">Display Order</label>
            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $videoFeedback->sort_order ?? 0) }}">
            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-0">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            @php
                $statusValue = (string) old('status', $isEdit ? (int) $videoFeedback->status : 1);
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
