<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Handles admin CRUD for booking promo codes.
 */
class PromoCodeController extends Controller
{
    /**
     * Display the list of promo codes.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $promoCodes = PromoCode::query()->latest()->get();

        return view('admin.promo-codes.index', compact('promoCodes'));
    }

    /**
     * Show the form to create a new promo code.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.promo-codes.create');
    }

    /**
     * Store a newly created promo code.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->validationRules($request));

        PromoCode::create($this->payloadFromValidated($validated, $request));

        return redirect()
            ->route('admin.promo-codes.index')
            ->with('success', 'Promo code created successfully.');
    }

    /**
     * Show the form to edit a promo code.
     *
     * @return \Illuminate\View\View
     */
    public function edit(PromoCode $promoCode): View
    {
        return view('admin.promo-codes.edit', compact('promoCode'));
    }

    /**
     * Update the given promo code.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PromoCode $promoCode): RedirectResponse
    {
        $validated = $request->validate($this->validationRules($request, $promoCode));

        $promoCode->update($this->payloadFromValidated($validated, $request));

        return redirect()
            ->route('admin.promo-codes.index')
            ->with('success', 'Promo code updated successfully.');
    }

    /**
     * Remove the given promo code.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PromoCode $promoCode): RedirectResponse
    {
        $promoCode->delete();

        return redirect()
            ->route('admin.promo-codes.index')
            ->with('success', 'Promo code deleted successfully.');
    }

    /**
     * Build validation rules for create and update requests.
     *
     * @return array<string, mixed>
     */
    private function validationRules(Request $request, ?PromoCode $promoCode = null): array
    {
        return [
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('promo_codes', 'code')->ignore($promoCode?->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'discount_type' => ['required', 'in:flat,percent'],
            'discount_value' => [
                'required',
                'numeric',
                'min:0',
                Rule::when($request->input('discount_type') === 'percent', ['max:100']),
            ],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
        ];
    }

    /**
     * Build the persisted payload from validated input.
     *
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function payloadFromValidated(array $validated, Request $request): array
    {
        return [
            'code' => $validated['code'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'discount_type' => $validated['discount_type'],
            'discount_value' => $validated['discount_value'],
            'starts_at' => $validated['starts_at'] ?? null,
            'ends_at' => $validated['ends_at'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'is_default' => $request->boolean('is_default'),
            'usage_limit' => $validated['usage_limit'] ?? null,
        ];
    }
}
