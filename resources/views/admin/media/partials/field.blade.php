@php
    $fieldName = $name ?? 'media_id';
    $pathFieldName = $pathName ?? null;
    $currentPath = $currentPath ?? '';
    $mediaId = old($fieldName, $value ?? '');
    $storedPath = $pathFieldName ? old($pathFieldName, $currentPath) : '';
    $pickerType = $pickerType ?? 'image';
    $fieldLabel = $label ?? 'Media';
    $isRequired = $required ?? false;

    $selectedMedia = $mediaId ? \App\Models\MediaFile::find($mediaId) : null;

    if (! $selectedMedia && $storedPath) {
        $selectedMedia = \App\Models\MediaFile::query()->where('file_path', $storedPath)->first();
        if ($selectedMedia) {
            $mediaId = $selectedMedia->id;
        }
    }
@endphp

<div
    class="media-picker-field"
    data-media-field
    data-picker-type="{{ $pickerType }}"
    @if ($selectedMedia) data-selected-media='@json($selectedMedia->toLibraryArray())' @endif
    @if ($pathFieldName) data-path-field="{{ $pathFieldName }}" @endif
>
    <label class="form-label">
        {{ $fieldLabel }}
        @if ($isRequired)
            <span class="text-danger">*</span>
        @endif
    </label>

    <input type="hidden" name="{{ $fieldName }}" value="{{ $mediaId }}" class="media-picker-id-input">
    @if ($pathFieldName)
        <input type="hidden" name="{{ $pathFieldName }}" value="{{ $storedPath }}" class="media-picker-path-input">
    @endif

    <div class="media-picker-preview border rounded p-3 mb-2 {{ ($selectedMedia || $storedPath) ? '' : 'd-none' }}" data-media-preview>
        @if ($selectedMedia)
            <div class="d-flex align-items-center gap-3">
                <div class="media-picker-preview-thumb">
                    @if ($selectedMedia->isImage())
                        <img src="{{ $selectedMedia->url() }}" alt="{{ $selectedMedia->display_name }}">
                    @else
                        <i class="ti ti-file-text"></i>
                    @endif
                </div>
                <div class="flex-grow-1 min-w-0">
                    <strong class="d-block text-truncate">{{ $selectedMedia->display_name }}</strong>
                    <span class="text-muted font-12 d-block text-truncate">{{ $selectedMedia->original_name }}</span>
                    <span class="text-muted font-12">{{ $selectedMedia->formattedSize() }} · {{ $selectedMedia->categoryLabel() }}</span>
                </div>
            </div>
        @elseif ($storedPath)
            <div class="d-flex align-items-center gap-3">
                <div class="media-picker-preview-thumb">
                    <img src="{{ str_starts_with($storedPath, 'media-management/') ? asset($storedPath) : asset('storage/'.$storedPath) }}" alt="Selected media">
                </div>
                <div class="flex-grow-1 min-w-0">
                    <strong class="d-block text-truncate">Current file</strong>
                    <span class="text-muted font-12 d-block text-truncate">{{ basename($storedPath) }}</span>
                </div>
            </div>
        @endif
    </div>

    <div class="d-flex flex-wrap gap-2">
        <button type="button" class="btn btn-outline-primary btn-sm js-open-media-picker">
            <i class="ti ti-photo me-1"></i> Choose Media
        </button>
        <button type="button" class="btn btn-light btn-sm {{ ($selectedMedia || $storedPath) ? '' : 'd-none' }}" data-media-clear>
            Clear
        </button>
    </div>

    @error($fieldName)
        <div class="text-danger font-12 mt-1">{{ $message }}</div>
    @enderror
    @if ($pathFieldName)
        @error($pathFieldName)
            <div class="text-danger font-12 mt-1">{{ $message }}</div>
        @enderror
    @endif
</div>
