@php
    $isEdit = isset($healthProgram);
@endphp

<div class="row">
    <div class="col-md-8">
        <div class="form-group mb-3">
            <label class="form-label" for="title">Program Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $healthProgram->title ?? '') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="sort_order">Display Order</label>
            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $healthProgram->sort_order ?? 0) }}">
            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            @php
                $statusValue = (string) old('status', $isEdit ? (int) $healthProgram->status : 1);
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

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="active_on_home">Active on Home <span class="text-danger">*</span></label>
            @php
                $homeValue = (string) old('active_on_home', $isEdit ? (int) $healthProgram->active_on_home : 0);
            @endphp
            <select class="form-select @error('active_on_home') is-invalid @enderror" id="active_on_home" name="active_on_home" required>
                <option value="1" @selected($homeValue === '1')>Yes</option>
                <option value="0" @selected($homeValue === '0')>No</option>
            </select>
            @error('active_on_home')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-3">
            @include('admin.media.partials.url-field', [
                'name' => 'image',
                'currentValue' => $isEdit ? $healthProgram->image : '',
                'label' => 'Featured Image URL',
                'required' => ! $isEdit,
            ])
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-3">
            <label class="form-label" for="video_url">Video URL</label>
            <input type="text" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url', $healthProgram->video_url ?? '') }}" placeholder="https://www.youtube.com/watch?v=...">
            @error('video_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="eyebrow">Section Eyebrow</label>
            <input type="text" class="form-control @error('eyebrow') is-invalid @enderror" id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $healthProgram->eyebrow ?? 'Health Programs & Camps') }}">
            @error('eyebrow')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="section_title">Section Title</label>
            <input type="text" class="form-control @error('section_title') is-invalid @enderror" id="section_title" name="section_title" value="{{ old('section_title', $healthProgram->section_title ?? 'Group Healing. Lasting Wellness.') }}">
            @error('section_title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-3">
            <label class="form-label" for="section_lead">Section Description</label>
            <textarea class="form-control @error('section_lead') is-invalid @enderror" id="section_lead" name="section_lead" rows="3">{{ old('section_lead', $healthProgram->section_lead ?? 'Join our weekend wellness camps, weight-management programs, detox retreats and community healing sessions led by our multidisciplinary team.') }}</textarea>
            @error('section_lead')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="date_time">Date & Time</label>
            <input type="text" class="form-control @error('date_time') is-invalid @enderror" id="date_time" name="date_time" value="{{ old('date_time', $healthProgram->date_time ?? '') }}" placeholder="15 April 2026 · 10:00 AM – 2:00 PM">
            @error('date_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="location">Location</label>
            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $healthProgram->location ?? '') }}" placeholder="Agarwal Public School, Indore">
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-3">
            <label class="form-label" for="chief_consultant">Chief Consultant</label>
            <input type="text" class="form-control @error('chief_consultant') is-invalid @enderror" id="chief_consultant" name="chief_consultant" value="{{ old('chief_consultant', $healthProgram->chief_consultant ?? '') }}" placeholder="Dr Ravindra Verma">
            @error('chief_consultant')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-3">
            <label class="form-label" for="key_benefits">Key Benefits</label>
            <textarea class="form-control @error('key_benefits') is-invalid @enderror" id="key_benefits" name="key_benefits" rows="3" placeholder="Diabetes Management, Personalized Diet Plan, Stress Reduction Techniques">{{ old('key_benefits', $healthProgram->key_benefits ?? '') }}</textarea>
            @error('key_benefits')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="button_text">Home Button Text</label>
            <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" value="{{ old('button_text', $healthProgram->button_text ?? 'Explore Latest Programs') }}">
            @error('button_text')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-0">
            <label class="form-label" for="button_url">Home Button URL</label>
            <input type="text" class="form-control @error('button_url') is-invalid @enderror" id="button_url" name="button_url" value="{{ old('button_url', $healthProgram->button_url ?? '/contact-us') }}">
            @error('button_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
