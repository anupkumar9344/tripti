@php
    $fieldName = $name ?? 'image_url';
    $fieldLabel = $label ?? 'Image URL';
    $storedValue = $currentValue ?? '';
    $fieldValue = old($fieldName, $storedValue ? \App\Support\MediaPath::url($storedValue) : '');
    $previewUrl = $fieldValue ?: ($storedValue ? \App\Support\MediaPath::url($storedValue) : '');
    $isRequired = $required ?? false;
    $inputId = $inputId ?? $fieldName;
@endphp

<div class="media-url-field" data-media-url-field>
    <label class="form-label" for="{{ $inputId }}">
        {{ $fieldLabel }}
        @if ($isRequired)
            <span class="text-danger">*</span>
        @endif
    </label>
    <input
        type="url"
        class="form-control @error($fieldName) is-invalid @enderror"
        id="{{ $inputId }}"
        name="{{ $fieldName }}"
        value="{{ $fieldValue }}"
        placeholder="Paste image URL copied from Media Library"
        @if ($isRequired) required @endif
    >
    @error($fieldName)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <span class="form-text text-muted font-12">
        Copy the URL from <a href="{{ route('admin.media.index') }}" target="_blank">Media Library</a> and paste it here.
    </span>
    <div class="media-url-preview mt-2 {{ $previewUrl ? '' : 'd-none' }}" data-url-preview>
        @if ($previewUrl)
            <img src="{{ $previewUrl }}" alt="Preview" class="img-thumbnail" style="max-height: 100px;">
        @endif
    </div>
</div>
