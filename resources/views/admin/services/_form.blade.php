@php
    $isEdit = isset($service);
@endphp

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Service Content</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $service->title ?? '') }}" placeholder="Enter service title" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="short_description">Short Description</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3" placeholder="Brief summary shown in listings">{{ old('short_description', $service->short_description ?? '') }}</textarea>
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="tags">Tags</label>
                    <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" value="{{ old('tags', $service->tags ?? '') }}" placeholder="Physiotherapy, Neuro Rehab">
                    @error('tags')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Comma-separated tags shown on service cards.</span>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="long_description">Long Description</label>
                    <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description" name="long_description" rows="10">{{ old('long_description', $service->long_description ?? '') }}</textarea>
                    @error('long_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Shown on the service detail page.</span>
                </div>

                <div class="form-group mb-0">
                    @include('admin.media.partials.gallery-url-field', [
                        'existingImages' => $isEdit ? $service->images : collect(),
                    ])
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Settings &amp; Media</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="slug">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $service->slug ?? '') }}" placeholder="Auto-generated if empty">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Used for the service page URL.</span>
                </div>

                <div class="form-group mb-3">
                    @include('admin.media.partials.url-field', [
                        'name' => 'thumbnail',
                        'currentValue' => $isEdit ? $service->thumbnail : '',
                        'label' => 'Thumbnail Image URL',
                        'required' => ! $isEdit,
                    ])
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="icon">Icon Class @include('admin.partials.icon-reference-link')</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $service->icon ?? '') }}" placeholder="fa-leaf">
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="display_on_home">Display on Home <span class="text-danger">*</span></label>
                    @php
                        $homeValue = (string) old('display_on_home', $isEdit ? (int) $service->display_on_home : 0);
                    @endphp
                    <select class="form-select @error('display_on_home') is-invalid @enderror" id="display_on_home" name="display_on_home" required>
                        <option value="1" @selected($homeValue === '1')>Yes</option>
                        <option value="0" @selected($homeValue === '0')>No</option>
                    </select>
                    @error('display_on_home')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Show in the home page &ldquo;Our Core Services&rdquo; section.</span>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="show_faq_section">Show FAQ Section <span class="text-danger">*</span></label>
                    @php
                        $faqValue = (string) old('show_faq_section', $isEdit ? (int) $service->show_faq_section : 0);
                    @endphp
                    <select class="form-select @error('show_faq_section') is-invalid @enderror" id="show_faq_section" name="show_faq_section" required>
                        <option value="1" @selected($faqValue === '1')>Yes</option>
                        <option value="0" @selected($faqValue === '0')>No</option>
                    </select>
                    @error('show_faq_section')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="sort_order">Order</label>
                            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" placeholder="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group mb-0">
                            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                            @php
                                $statusValue = (string) old('status', $isEdit ? (int) $service->status : 1);
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

@include('admin.services._sub-services-benefits')
