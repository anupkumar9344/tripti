<div class="form-group mb-3">
    <label class="form-label" for="question">Question <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question', $faq->question ?? '') }}" required placeholder="What treatments does Tripti Hotel offer?">
    @error('question')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label class="form-label" for="answer">Answer <span class="text-danger">*</span></label>
    <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" rows="5" required placeholder="Answer shown in the accordion.">{{ old('answer', $faq->answer ?? '') }}</textarea>
    @error('answer')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="display_on_home">Show on Home <span class="text-danger">*</span></label>
            @php
                $homeValue = (string) old('display_on_home', isset($faq) ? (int) $faq->display_on_home : 0);
            @endphp
            <select class="form-select @error('display_on_home') is-invalid @enderror" id="display_on_home" name="display_on_home" required>
                <option value="1" @selected($homeValue === '1')>Yes</option>
                <option value="0" @selected($homeValue === '0')>No</option>
            </select>
            @error('display_on_home')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="display_on_faq_page">Show on FAQ Page <span class="text-danger">*</span></label>
            @php
                $faqPageValue = (string) old('display_on_faq_page', isset($faq) ? (int) ($faq->display_on_faq_page ?? 1) : 1);
            @endphp
            <select class="form-select @error('display_on_faq_page') is-invalid @enderror" id="display_on_faq_page" name="display_on_faq_page" required>
                <option value="1" @selected($faqPageValue === '1')>Yes</option>
                <option value="0" @selected($faqPageValue === '0')>No</option>
            </select>
            @error('display_on_faq_page')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="sort_order">Display Order</label>
            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}">
            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-0">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            @php
                $statusValue = (string) old('status', isset($faq) ? (int) $faq->status : 1);
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
