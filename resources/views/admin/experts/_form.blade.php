@php
    $isEdit = isset($expert);
@endphp

<div class="card mb-3">
    <div class="card-header">
        <h4 class="card-title mb-0">Basic Information</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group mb-3">
                    <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $expert->name ?? '') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label class="form-label" for="slug">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $expert->slug ?? '') }}" placeholder="Auto-generated if empty">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Used for the profile page URL.</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                    @php
                        $statusValue = (string) old('status', $isEdit ? (int) $expert->status : 1);
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

            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label" for="display_on_home">Display on Home <span class="text-danger">*</span></label>
                    @php
                        $homeValue = (string) old('display_on_home', $isEdit ? (int) $expert->display_on_home : 0);
                    @endphp
                    <select class="form-select @error('display_on_home') is-invalid @enderror" id="display_on_home" name="display_on_home" required>
                        <option value="1" @selected($homeValue === '1')>Yes</option>
                        <option value="0" @selected($homeValue === '0')>No</option>
                    </select>
                    @error('display_on_home')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Show in the home page experts section.</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label" for="show_faq_section">Show FAQ Section <span class="text-danger">*</span></label>
                    @php
                        $faqValue = (string) old('show_faq_section', $isEdit ? (int) $expert->show_faq_section : 0);
                    @endphp
                    <select class="form-select @error('show_faq_section') is-invalid @enderror" id="show_faq_section" name="show_faq_section" required>
                        <option value="1" @selected($faqValue === '1')>Yes</option>
                        <option value="0" @selected($faqValue === '0')>No</option>
                    </select>
                    @error('show_faq_section')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label" for="sort_order">Display Order</label>
                    <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $expert->sort_order ?? 0) }}">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group mb-0">
                    @include('admin.media.partials.url-field', [
                        'name' => 'photo',
                        'currentValue' => $isEdit ? $expert->photo : '',
                        'label' => 'Photo URL',
                        'required' => ! $isEdit,
                    ])
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h4 class="card-title mb-0">Listing Card</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label" for="designation">Designation</label>
                    <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $expert->designation ?? '') }}" placeholder="Founder & Chairman">
                    @error('designation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label" for="specialty">Specialty</label>
                    <input type="text" class="form-control @error('specialty') is-invalid @enderror" id="specialty" name="specialty" value="{{ old('specialty', $expert->specialty ?? '') }}" placeholder="Ayurveda & Panchakarma Specialist">
                    @error('specialty')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label" for="experience_label">Experience Label</label>
                    <input type="text" class="form-control @error('experience_label') is-invalid @enderror" id="experience_label" name="experience_label" value="{{ old('experience_label', $expert->experience_label ?? '') }}" placeholder="25+ Years Experience">
                    @error('experience_label')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Shown on cards and the profile badge.</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label" for="qualifications">Qualifications</label>
                    <input type="text" class="form-control @error('qualifications') is-invalid @enderror" id="qualifications" name="qualifications" value="{{ old('qualifications', $expert->qualifications ?? '') }}" placeholder="MPT Orthopedics | Neuro Rehab Expert">
                    @error('qualifications')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Combined with experience on listing cards.</span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group mb-0">
                    <label class="form-label" for="short_description">Short Description</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3">{{ old('short_description', $expert->short_description ?? '') }}</textarea>
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Brief summary shown on expert cards.</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h4 class="card-title mb-0">Profile Page</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label" for="specialty_location">Specialty & Location</label>
                    <input type="text" class="form-control @error('specialty_location') is-invalid @enderror" id="specialty_location" name="specialty_location" value="{{ old('specialty_location', $expert->specialty_location ?? '') }}" placeholder="Ayurveda Specialist – Indore">
                    @error('specialty_location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Appended to the name on the profile page heading.</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label" for="patients_treated">Patients Treated</label>
                    <input type="text" class="form-control @error('patients_treated') is-invalid @enderror" id="patients_treated" name="patients_treated" value="{{ old('patients_treated', $expert->patients_treated ?? '') }}" placeholder="10,000+ Patients Treated">
                    @error('patients_treated')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label" for="highlight_quote">Highlight Quote</label>
                    <textarea class="form-control @error('highlight_quote') is-invalid @enderror" id="highlight_quote" name="highlight_quote" rows="2">{{ old('highlight_quote', $expert->highlight_quote ?? '') }}</textarea>
                    @error('highlight_quote')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group mb-0">
                    <label class="form-label" for="long_description">Full Biography</label>
                    <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description" name="long_description" rows="8">{{ old('long_description', $expert->long_description ?? '') }}</textarea>
                    @error('long_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
