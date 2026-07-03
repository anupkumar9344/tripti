<div class="form-group mb-3">
    <label class="form-label" for="reviewer_name">Reviewer Name <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('reviewer_name') is-invalid @enderror" id="reviewer_name" name="reviewer_name" value="{{ old('reviewer_name', $patientReview->reviewer_name ?? '') }}" required placeholder="Kiran Mehta">
    @error('reviewer_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    @include('admin.media.partials.url-field', [
        'name' => 'photo',
        'currentValue' => old('photo', isset($patientReview) ? ($patientReview->photo ?? '') : ''),
        'label' => 'Reviewer Photo',
    ])
    <span class="form-text text-muted font-12">Optional. Shown in the home page testimonials slider. Leave empty to use an initial avatar.</span>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="initial">Avatar Initial</label>
            <input type="text" maxlength="1" class="form-control @error('initial') is-invalid @enderror" id="initial" name="initial" value="{{ old('initial', $patientReview->initial ?? '') }}" placeholder="K">
            @error('initial')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="avatar_tone">Avatar Color <span class="text-danger">*</span></label>
            @php
                $avatarTone = old('avatar_tone', $patientReview->avatar_tone ?? 'accent');
            @endphp
            <select class="form-select @error('avatar_tone') is-invalid @enderror" id="avatar_tone" name="avatar_tone" required>
                <option value="accent" @selected($avatarTone === 'accent')>Accent</option>
                <option value="primary" @selected($avatarTone === 'primary')>Primary</option>
                <option value="warm" @selected($avatarTone === 'warm')>Warm</option>
            </select>
            @error('avatar_tone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="review_time">Review Time</label>
            <input type="text" class="form-control @error('review_time') is-invalid @enderror" id="review_time" name="review_time" value="{{ old('review_time', $patientReview->review_time ?? '') }}" placeholder="6 months ago">
            @error('review_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="review_text">Review Text <span class="text-danger">*</span></label>
    <textarea class="form-control @error('review_text') is-invalid @enderror" id="review_text" name="review_text" rows="5" required placeholder="Feedback shown in the slider card.">{{ old('review_text', $patientReview->review_text ?? '') }}</textarea>
    @error('review_text')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label class="form-label" for="rating">Star Rating <span class="text-danger">*</span></label>
            @php
                $ratingValue = (string) old('rating', $patientReview->rating ?? 5);
            @endphp
            <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                @for ($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}" @selected($ratingValue === (string) $i)>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                @endfor
            </select>
            @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group mb-3">
            <label class="form-label" for="is_verified">Verified Badge <span class="text-danger">*</span></label>
            @php
                $verifiedValue = (string) old('is_verified', isset($patientReview) ? (int) $patientReview->is_verified : 1);
            @endphp
            <select class="form-select @error('is_verified') is-invalid @enderror" id="is_verified" name="is_verified" required>
                <option value="1" @selected($verifiedValue === '1')>Show</option>
                <option value="0" @selected($verifiedValue === '0')>Hide</option>
            </select>
            @error('is_verified')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group mb-3">
            <label class="form-label" for="sort_order">Display Order</label>
            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $patientReview->sort_order ?? 0) }}">
            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group mb-0">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            @php
                $statusValue = (string) old('status', isset($patientReview) ? (int) $patientReview->status : 1);
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
