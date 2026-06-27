@php
    $fieldId = $id ?? $name;
    $fieldLabel = $label ?? 'Page Link';
    $currentValue = old($name, $currentValue ?? '');
    $pages = \App\Support\SitePages::all();
    $matchedPage = collect($pages)->first(fn ($page) => \App\Support\PageLink::matchesSitePage($currentValue, $page['url']));
    $useCustomLink = $currentValue !== '' && ! $matchedPage;
    $selectedPageUrl = $matchedPage['url'] ?? '';
@endphp

<div class="form-group mb-3">
    <label class="form-label" for="{{ $fieldId }}_page">{{ $fieldLabel }}</label>
    <select
        id="{{ $fieldId }}_page"
        class="form-select mb-2 js-page-link-select @error($name) is-invalid @enderror"
        data-target="{{ $fieldId }}"
        data-custom-wrap="{{ $fieldId }}_custom_wrap"
    >
        <option value="">Select a page</option>
        @foreach ($pages as $page)
            <option value="{{ $page['url'] }}" @selected(! $useCustomLink && $selectedPageUrl === $page['url'])>
                {{ $page['label'] }} — {{ $page['url'] }}
            </option>
        @endforeach
        <option value="__custom__" @selected($useCustomLink)>Custom link</option>
    </select>

    <div id="{{ $fieldId }}_custom_wrap" @class(['d-none' => ! $useCustomLink])>
        <input
            type="text"
            class="form-control @error($name) is-invalid @enderror"
            id="{{ $fieldId }}_custom"
            value="{{ $useCustomLink ? $currentValue : '' }}"
            placeholder="https://www.youtube.com/watch?v=..."
        >
    </div>

    <input
        type="hidden"
        name="{{ $name }}"
        id="{{ $fieldId }}"
        value="{{ $currentValue }}"
    >

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.js-page-link-select').forEach(function (select) {
                    const targetId = select.dataset.target;
                    const customWrapId = select.dataset.customWrap;
                    const targetInput = document.getElementById(targetId);
                    const customWrap = document.getElementById(customWrapId);
                    const customInput = customWrap ? customWrap.querySelector('input') : null;

                    if (!targetInput) {
                        return;
                    }

                    function syncValue() {
                        if (select.value === '__custom__') {
                            if (customWrap) {
                                customWrap.classList.remove('d-none');
                            }

                            targetInput.value = customInput ? customInput.value.trim() : '';
                            return;
                        }

                        if (customWrap) {
                            customWrap.classList.add('d-none');
                        }

                        targetInput.value = select.value;
                    }

                    select.addEventListener('change', syncValue);

                    if (customInput) {
                        customInput.addEventListener('input', syncValue);
                    }

                    syncValue();
                });
            });
        </script>
    @endpush
@endonce
