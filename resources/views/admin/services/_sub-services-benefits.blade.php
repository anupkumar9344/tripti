@php
    $subServices = old('sub_services');

    if ($subServices === null) {
        $subServices = isset($service)
            ? $service->subServices->map(fn ($item) => [
                'title' => $item->title,
                'description' => $item->description,
            ])->values()->all()
            : [];
    }

    $benefits = old('benefits');

    if ($benefits === null) {
        $benefits = isset($service)
            ? $service->benefits->map(fn ($item) => ['title' => $item->title])->values()->all()
            : [];
    }

    if ($subServices === []) {
        $subServices = [['title' => '', 'description' => '']];
    }

    if ($benefits === []) {
        $benefits = [['title' => '']];
    }
@endphp

<div class="row g-3 mt-1">
    <div class="col-lg-7">
        <div class="card mb-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Sub Services</h4>
                <button type="button" class="btn btn-sm btn-outline-primary" id="addSubServiceRow">
                    <i class="ti ti-plus me-1"></i> Add Sub Service
                </button>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="sub_services_heading">Section Heading</label>
                    <input type="text" class="form-control @error('sub_services_heading') is-invalid @enderror" id="sub_services_heading" name="sub_services_heading" value="{{ old('sub_services_heading', $service->sub_services_heading ?? '') }}" placeholder="Our Aesthetic Wellness Services">
                    @error('sub_services_heading')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Shown above the sub-services grid on the detail page.</span>
                </div>

                <div id="subServicesRepeater" class="admin-repeater-list">
                    @foreach ($subServices as $index => $subService)
                        <div class="admin-repeater-item" data-repeater-item>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-semibold font-13">Sub Service {{ $loop->iteration }}</span>
                                <button type="button" class="btn btn-sm btn-outline-danger admin-repeater-remove" @if(count($subServices) === 1) disabled @endif>
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control @error('sub_services.'.$index.'.title') is-invalid @enderror" name="sub_services[{{ $index }}][title]" value="{{ $subService['title'] ?? '' }}" placeholder="Skin Rejuvenation Therapy">
                                @error('sub_services.'.$index.'.title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label class="form-label">Description</label>
                                <textarea class="form-control @error('sub_services.'.$index.'.description') is-invalid @enderror" name="sub_services[{{ $index }}][description]" rows="2" placeholder="Short description for this sub service.">{{ $subService['description'] ?? '' }}</textarea>
                                @error('sub_services.'.$index.'.description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card mb-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Benefits</h4>
                <button type="button" class="btn btn-sm btn-outline-primary" id="addBenefitRow">
                    <i class="ti ti-plus me-1"></i> Add Benefit
                </button>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="benefits_heading">Section Heading</label>
                    <input type="text" class="form-control @error('benefits_heading') is-invalid @enderror" id="benefits_heading" name="benefits_heading" value="{{ old('benefits_heading', $service->benefits_heading ?? '') }}" placeholder="Benefits of Mental Wellness Therapies">
                    @error('benefits_heading')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div id="benefitsRepeater" class="admin-repeater-list">
                    @foreach ($benefits as $index => $benefit)
                        <div class="admin-repeater-item admin-repeater-item-compact" data-repeater-item>
                            <div class="form-group mb-0">
                                <div class="d-flex gap-2 align-items-start">
                                    <input type="text" class="form-control @error('benefits.'.$index.'.title') is-invalid @enderror" name="benefits[{{ $index }}][title]" value="{{ $benefit['title'] ?? '' }}" placeholder="Improves skin health and glow">
                                    <button type="button" class="btn btn-sm btn-outline-danger admin-repeater-remove flex-shrink-0" @if(count($benefits) === 1) disabled @endif>
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                                @error('benefits.'.$index.'.title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<template id="subServiceRowTemplate">
    <div class="admin-repeater-item" data-repeater-item>
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="fw-semibold font-13 sub-service-label">Sub Service</span>
            <button type="button" class="btn btn-sm btn-outline-danger admin-repeater-remove">
                <i class="ti ti-trash"></i>
            </button>
        </div>
        <div class="form-group mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" data-name="sub_services[__INDEX__][title]" placeholder="Skin Rejuvenation Therapy">
        </div>
        <div class="form-group mb-0">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="2" data-name="sub_services[__INDEX__][description]" placeholder="Short description for this sub service."></textarea>
        </div>
    </div>
</template>

<template id="benefitRowTemplate">
    <div class="admin-repeater-item admin-repeater-item-compact" data-repeater-item>
        <div class="form-group mb-0">
            <div class="d-flex gap-2 align-items-start">
                <input type="text" class="form-control" data-name="benefits[__INDEX__][title]" placeholder="Improves skin health and glow">
                <button type="button" class="btn btn-sm btn-outline-danger admin-repeater-remove flex-shrink-0">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
        </div>
    </div>
</template>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const subServicesRepeater = document.getElementById('subServicesRepeater');
            const benefitsRepeater = document.getElementById('benefitsRepeater');
            const subServiceTemplate = document.getElementById('subServiceRowTemplate');
            const benefitTemplate = document.getElementById('benefitRowTemplate');

            function refreshRemoveButtons(container) {
                const items = container.querySelectorAll('[data-repeater-item]');
                items.forEach(function (item, index) {
                    const removeButton = item.querySelector('.admin-repeater-remove');
                    const label = item.querySelector('.sub-service-label');

                    if (removeButton) {
                        removeButton.disabled = items.length === 1;
                    }

                    if (label) {
                        label.textContent = 'Sub Service ' + (index + 1);
                    }
                });
            }

            function addRepeaterRow(container, template, indexPrefix) {
                const nextIndex = container.querySelectorAll('[data-repeater-item]').length;
                const fragment = template.content.cloneNode(true);

                fragment.querySelectorAll('[data-name]').forEach(function (field) {
                    field.name = field.getAttribute('data-name').replace('__INDEX__', nextIndex);
                    field.removeAttribute('data-name');
                });

                container.appendChild(fragment);
                refreshRemoveButtons(container);
            }

            document.getElementById('addSubServiceRow')?.addEventListener('click', function () {
                addRepeaterRow(subServicesRepeater, subServiceTemplate, 'sub_services');
            });

            document.getElementById('addBenefitRow')?.addEventListener('click', function () {
                addRepeaterRow(benefitsRepeater, benefitTemplate, 'benefits');
            });

            document.addEventListener('click', function (event) {
                const removeButton = event.target.closest('.admin-repeater-remove');

                if (!removeButton || removeButton.disabled) {
                    return;
                }

                const item = removeButton.closest('[data-repeater-item]');
                const container = removeButton.closest('.admin-repeater-list');

                if (!item || !container) {
                    return;
                }

                item.remove();

                container.querySelectorAll('[data-repeater-item]').forEach(function (row, index) {
                    row.querySelectorAll('[name]').forEach(function (field) {
                        field.name = field.name.replace(/\[\d+\]/, '[' + index + ']');
                    });
                });

                refreshRemoveButtons(container);
            });

            refreshRemoveButtons(subServicesRepeater);
            refreshRemoveButtons(benefitsRepeater);
        });
    </script>
@endpush
