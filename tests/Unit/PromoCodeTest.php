<?php

use App\Models\PromoCode;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('applies flat and percent discounts from active promo codes', function () {
    $flat = PromoCode::create([
        'code' => 'FLAT50',
        'name' => 'Flat 50',
        'discount_type' => 'flat',
        'discount_value' => 50,
        'is_active' => true,
        'is_default' => false,
    ]);

    $percent = PromoCode::create([
        'code' => 'SAVE10',
        'name' => 'Save 10%',
        'discount_type' => 'percent',
        'discount_value' => 10,
        'is_active' => true,
        'is_default' => false,
    ]);

    expect($flat->applyToAmount(1000))->toBeFloat()
        ->and($flat->applyToAmount(1000))->toEqual(950.0)
        ->and($percent->applyToAmount(1000))->toEqual(900.0);
});

it('keeps only one promo code as default at a time', function () {
    $first = PromoCode::create([
        'code' => 'FIRST',
        'name' => 'First default',
        'discount_type' => 'flat',
        'discount_value' => 100,
        'is_active' => true,
        'is_default' => true,
    ]);

    $second = PromoCode::create([
        'code' => 'SECOND',
        'name' => 'Second default',
        'discount_type' => 'percent',
        'discount_value' => 5,
        'is_active' => true,
        'is_default' => true,
    ]);

    $first->refresh();
    $second->refresh();

    expect($first->is_default)->toBeFalse()
        ->and($second->is_default)->toBeTrue();
});

it('caps flat discounts at the booking amount', function () {
    $promoCode = PromoCode::create([
        'code' => 'BIGFLAT',
        'name' => 'Big flat',
        'discount_type' => 'flat',
        'discount_value' => 500,
        'is_active' => true,
        'is_default' => false,
    ]);

    expect($promoCode->calculateDiscount(300))->toEqual(300.0)
        ->and($promoCode->applyToAmount(300))->toEqual(0.0);
});

it('reports promo code status labels', function () {
    $active = PromoCode::create([
        'code' => 'ACTIVE',
        'name' => 'Active',
        'discount_type' => 'flat',
        'discount_value' => 10,
        'is_active' => true,
    ]);

    $inactive = PromoCode::create([
        'code' => 'INACTIVE',
        'name' => 'Inactive',
        'discount_type' => 'flat',
        'discount_value' => 10,
        'is_active' => false,
    ]);

    expect($active->statusLabel())->toBe('Active')
        ->and($inactive->statusLabel())->toBe('Inactive');
});

it('returns the default applicable promo code', function () {
    PromoCode::create([
        'code' => 'DEFAULT',
        'name' => 'Default',
        'discount_type' => 'percent',
        'discount_value' => 10,
        'is_active' => true,
        'is_default' => true,
    ]);

    expect(PromoCode::defaultApplicable()?->code)->toBe('DEFAULT')
        ->and(PromoCode::defaultApplicable()?->discountLabel())->toBe('10% off');
});
