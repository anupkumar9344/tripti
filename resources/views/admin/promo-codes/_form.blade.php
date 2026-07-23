<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="code">Promo Code <span class="text-danger">*</span></label>
        <input type="text" class="form-control text-uppercase @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $promoCode->code ?? '') }}" maxlength="50" required>
        <small class="text-muted">Letters and numbers only. Saved in uppercase.</small>
        @error('code')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $promoCode->name ?? '') }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $promoCode->description ?? '') }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="discount_type">Discount Type <span class="text-danger">*</span></label>
        <select class="form-select @error('discount_type') is-invalid @enderror" id="discount_type" name="discount_type">
            <option value="flat" @selected(old('discount_type', $promoCode->discount_type ?? 'flat') === 'flat')>Flat (₹)</option>
            <option value="percent" @selected(old('discount_type', $promoCode->discount_type ?? 'flat') === 'percent')>Percent (%)</option>
        </select>
        @error('discount_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="discount_value">Discount Value <span class="text-danger">*</span></label>
        <input type="number" step="0.01" min="0" class="form-control @error('discount_value') is-invalid @enderror" id="discount_value" name="discount_value" value="{{ old('discount_value', $promoCode->discount_value ?? 0) }}" required>
        <small class="text-muted" id="discount_value_help">Enter the flat amount in rupees.</small>
        @error('discount_value')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="usage_limit">Usage Limit</label>
        <input type="number" min="1" class="form-control @error('usage_limit') is-invalid @enderror" id="usage_limit" name="usage_limit" value="{{ old('usage_limit', $promoCode->usage_limit ?? '') }}" placeholder="Unlimited">
        <small class="text-muted">Leave blank for unlimited uses.</small>
        @error('usage_limit')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="starts_at">Starts At</label>
        <input type="datetime-local" class="form-control @error('starts_at') is-invalid @enderror" id="starts_at" name="starts_at" value="{{ old('starts_at', optional($promoCode->starts_at ?? null)->format('Y-m-d\TH:i')) }}">
        @error('starts_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="ends_at">Ends At</label>
        <input type="datetime-local" class="form-control @error('ends_at') is-invalid @enderror" id="ends_at" name="ends_at" value="{{ old('ends_at', optional($promoCode->ends_at ?? null)->format('Y-m-d\TH:i')) }}">
        @error('ends_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Options</label>
        <div class="form-check mt-2">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" @checked(old('is_active', $promoCode->is_active ?? true))>
            <label class="form-check-label" for="is_active">Active</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_default" name="is_default" value="1" @checked(old('is_default', $promoCode->is_default ?? false))>
            <label class="form-check-label" for="is_default">Default promo code</label>
        </div>
        <small class="text-muted d-block mt-1">Shown on the booking form so guests can apply it with one click.</small>
    </div>
    @isset($promoCode)
        <div class="col-12">
            <div class="alert alert-light border mb-0">
                <strong>Usage:</strong> {{ $promoCode->usageSummary() }}
            </div>
        </div>
    @endisset
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const discountType = document.getElementById('discount_type');
            const discountValue = document.getElementById('discount_value');
            const discountHelp = document.getElementById('discount_value_help');

            if (!discountType || !discountValue || !discountHelp) {
                return;
            }

            const syncDiscountField = () => {
                const isPercent = discountType.value === 'percent';
                discountValue.max = isPercent ? '100' : '';
                discountHelp.textContent = isPercent
                    ? 'Enter a percentage between 0 and 100.'
                    : 'Enter the flat amount in rupees.';
            };

            discountType.addEventListener('change', syncDiscountField);
            syncDiscountField();
        });
    </script>
@endpush
