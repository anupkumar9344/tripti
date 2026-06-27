@php
    $fieldName = $name ?? 'gallery_images_text';
    $fieldLabel = $label ?? 'Gallery Image URLs';
    $existingImages = $existingImages ?? collect();
    $currentValue = old($fieldName, $currentValue ?? '');
@endphp

<div class="media-gallery-url-field">
    <label class="form-label" for="{{ $fieldName }}">{{ $fieldLabel }}</label>

    @if ($existingImages->isNotEmpty())
        <label class="form-label font-12 text-muted d-block">Existing Images</label>
        <div class="row g-2 mb-3">
            @foreach ($existingImages as $image)
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="border rounded p-2 h-100">
                        <img src="{{ $image->imageUrl() }}" alt="Gallery image" class="img-fluid rounded mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remove_images[]" value="{{ $image->id }}" id="remove_image_{{ $image->id }}">
                            <label class="form-check-label font-12" for="remove_image_{{ $image->id }}">Remove</label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <textarea
        class="form-control @error($fieldName) is-invalid @enderror @error('gallery_images') is-invalid @enderror @error('gallery_images.*') is-invalid @enderror"
        id="{{ $fieldName }}"
        name="{{ $fieldName }}"
        rows="4"
        placeholder="Paste one image URL per line (copy from Media Library)"
    >{{ $currentValue }}</textarea>
    @error($fieldName)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
    @error('gallery_images')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
    @error('gallery_images.*')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
    <span class="form-text text-muted font-12">
        Add new gallery images by pasting URLs from <a href="{{ route('admin.media.index') }}" target="_blank">Media Library</a>, one per line.
    </span>
</div>
