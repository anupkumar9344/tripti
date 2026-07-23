@php
    $isEdit = isset($heroBanner);
    $secondaryType = old('secondary_type', $heroBanner->secondary_type ?? '');
    $mediaType = old('media_type', $heroBanner->media_type ?? 'image');
@endphp

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Slide Content</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="eyebrow">Eyebrow</label>
                    <input type="text" class="form-control @error('eyebrow') is-invalid @enderror" id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $heroBanner->eyebrow ?? '') }}" placeholder="Welcome to Tripti Hotel">
                    @error('eyebrow')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="title">Heading <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $heroBanner->title ?? '') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="text">Description</label>
                    <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text" rows="2">{{ old('text', $heroBanner->text ?? '') }}</textarea>
                    @error('text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="media_type">Banner Media <span class="text-danger">*</span></label>
                    <select class="form-select @error('media_type') is-invalid @enderror" id="media_type" name="media_type" required>
                        <option value="image" @selected($mediaType === 'image')>Image</option>
                        <option value="video" @selected($mediaType === 'video')>Video</option>
                    </select>
                    @error('media_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div id="bannerImageField" class="form-group mb-3">
                    @include('admin.media.partials.url-field', [
                        'name' => 'image',
                        'currentValue' => $isEdit ? ($heroBanner->image ?? '') : '',
                        'label' => 'Banner Image',
                        'required' => ! $isEdit && $mediaType === 'image',
                    ])
                    <span id="bannerImageHelp" class="form-text text-muted font-12">
                        {{ $mediaType === 'video' ? 'Optional poster image shown before the video loads.' : 'Used as the full banner background image.' }}
                    </span>
                </div>

                <div id="bannerVideoField" @class(['form-group mb-0', 'd-none' => $mediaType !== 'video'])>
                    <label class="form-label" for="video">Banner Video URL <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('video') is-invalid @enderror" id="video" name="video" value="{{ old('video', $heroBanner->video ?? '') }}" placeholder="https://www.youtube.com/watch?v=... or direct MP4 URL">
                    @error('video')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Supports YouTube, Vimeo, or a direct MP4 link from the media library.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Buttons &amp; Display</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="primary_label">Primary Button Text</label>
                    <input type="text" class="form-control @error('primary_label') is-invalid @enderror" id="primary_label" name="primary_label" value="{{ old('primary_label', $heroBanner->primary_label ?? 'Book Appointment') }}">
                    @error('primary_label')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    @include('admin.partials.page-link-field', [
                        'name' => 'primary_url',
                        'id' => 'primary_url',
                        'label' => 'Primary Button Link',
                        'currentValue' => $isEdit ? ($heroBanner->primary_url ?? '') : url('/contact-us'),
                    ])
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="secondary_type">Secondary Action</label>
                    <select class="form-select @error('secondary_type') is-invalid @enderror" id="secondary_type" name="secondary_type">
                        <option value="">None</option>
                        <option value="link" @selected($secondaryType === 'link')>Button Link</option>
                        <option value="video" @selected($secondaryType === 'video')>Video Popup</option>
                    </select>
                    @error('secondary_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div id="secondaryActionFields" @class(['d-none' => ! filled($secondaryType)])>
                    <div class="form-group mb-3">
                        <label class="form-label" for="secondary_label">Secondary Button Text</label>
                        <input type="text" class="form-control @error('secondary_label') is-invalid @enderror" id="secondary_label" name="secondary_label" value="{{ old('secondary_label', $heroBanner->secondary_label ?? '') }}" placeholder="Watch Video">
                        @error('secondary_label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        @include('admin.partials.page-link-field', [
                            'name' => 'secondary_url',
                            'id' => 'secondary_url',
                            'label' => 'Secondary Button Link',
                            'currentValue' => $isEdit ? ($heroBanner->secondary_url ?? '') : '',
                        ])
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="sort_order">Order</label>
                            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $heroBanner->sort_order ?? 0) }}">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group mb-0">
                            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                            @php
                                $statusValue = (string) old('status', $isEdit ? (int) $heroBanner->status : 1);
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
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const secondaryType = document.getElementById('secondary_type');
            const secondaryFields = document.getElementById('secondaryActionFields');
            const mediaType = document.getElementById('media_type');
            const imageField = document.getElementById('bannerImageField');
            const videoField = document.getElementById('bannerVideoField');

            if (secondaryType && secondaryFields) {
                secondaryType.addEventListener('change', function () {
                    secondaryFields.classList.toggle('d-none', secondaryType.value === '');
                });
            }

            if (!mediaType || !imageField || !videoField) {
                return;
            }

            const syncMediaFields = function () {
                const isVideo = mediaType.value === 'video';
                const imageHelp = document.getElementById('bannerImageHelp');

                videoField.classList.toggle('d-none', !isVideo);

                if (imageHelp) {
                    imageHelp.textContent = isVideo
                        ? 'Optional poster image shown before the video loads.'
                        : 'Used as the full banner background image.';
                }
            };

            mediaType.addEventListener('change', syncMediaFields);
            syncMediaFields();
        });
    </script>
@endpush
