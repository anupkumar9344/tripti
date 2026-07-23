@php
    $promoInputId = $promoInputId ?? 'promo_code';
    $promoInputName = $promoInputName ?? 'promo_code';
    $promoInputClass = $promoInputClass ?? 'booking-input';
    $promoInputValue = $promoInputValue ?? ($defaultPromoCode->code ?? '');
    $promoFieldWrapperClass = $promoFieldWrapperClass ?? '';
@endphp

<div class="promo-code-field {{ $promoFieldWrapperClass }}">
    @if (! empty($promoLabel) || ($defaultPromoCode ?? null))
        <div class="promo-code-field-label-row">
            @if (! empty($promoLabel))
                <label class="{{ $promoLabelClass ?? 'booking-label' }}" for="{{ $promoInputId }}">{{ $promoLabel }}</label>
            @endif

            @if ($defaultPromoCode ?? null)
                <div class="promo-default-offer promo-default-offer--inline">
                    <button
                        type="button"
                        class="promo-default-offer-btn"
                        data-promo-target="{{ $promoInputId }}"
                        data-promo-code="{{ $defaultPromoCode->code }}"
                        title="Apply default promo code"
                    >
                        <span class="promo-default-offer-label">Default:</span>
                        <strong>{{ $defaultPromoCode->code }}</strong>
                        <span>({{ $defaultPromoCode->discountLabel() }})</span>
                    </button>
                </div>
            @endif
        </div>
    @endif

    <div class="promo-code-field-control {{ $promoControlWrapperClass ?? '' }}">
        <input
            type="text"
            id="{{ $promoInputId }}"
            name="{{ $promoInputName }}"
            class="{{ $promoInputClass }}"
            value="{{ $promoInputValue }}"
            placeholder="Enter promo code"
            maxlength="50"
        >
        @if (! empty($promoControlIcon))
            <i class="{{ $promoControlIcon }}" aria-hidden="true"></i>
        @endif
    </div>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.promo-default-offer-btn').forEach(function (button) {
                    button.addEventListener('click', function () {
                        const targetId = button.getAttribute('data-promo-target');
                        const input = targetId ? document.getElementById(targetId) : null;

                        if (!input) {
                            return;
                        }

                        input.value = button.getAttribute('data-promo-code') || '';
                        input.dispatchEvent(new Event('input', { bubbles: true }));
                        input.focus();
                    });
                });
            });
        </script>
    @endpush
@endonce
