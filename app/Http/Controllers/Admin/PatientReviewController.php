<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientReview;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Handles admin CRUD for home page patient feedback reviews.
 */
class PatientReviewController extends Controller
{
    /**
     * Setting keys for the patient feedback section header.
     *
     * @var list<string>
     */
    private const SECTION_SETTING_KEYS = [
        'patient_feedback_rating_label',
        'patient_feedback_total_reviews',
        'patient_feedback_read_more_url',
    ];

    /**
     * Display patient feedback reviews and section settings.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $reviews = PatientReview::query()
            ->orderBy('sort_order')
            ->orderBy('reviewer_name')
            ->get();

        $sectionSettings = Setting::getMany(self::SECTION_SETTING_KEYS);

        return view('admin.patient-reviews.index', compact('reviews', 'sectionSettings'));
    }

    /**
     * Update the patient feedback section header settings.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_feedback_rating_label' => ['required', 'string', 'max:50'],
            'patient_feedback_total_reviews' => ['required', 'string', 'max:50'],
            'patient_feedback_read_more_url' => ['nullable', 'string', 'max:500'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::setValue($key, $value);
        }

        return redirect()
            ->route('admin.patient-reviews.index')
            ->with('success', 'Patient feedback section settings updated successfully.');
    }

    /**
     * Show the form to create a new patient review.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.patient-reviews.create');
    }

    /**
     * Store a newly created patient review.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateReview($request);

        PatientReview::create($this->reviewAttributes($validated));

        return redirect()
            ->route('admin.patient-reviews.index')
            ->with('success', 'Patient review created successfully.');
    }

    /**
     * Show the form to edit a patient review.
     *
     * @return \Illuminate\View\View
     */
    public function edit(PatientReview $patientReview): View
    {
        return view('admin.patient-reviews.edit', compact('patientReview'));
    }

    /**
     * Update the given patient review.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PatientReview $patientReview): RedirectResponse
    {
        $validated = $this->validateReview($request);

        $patientReview->fill($this->reviewAttributes($validated));
        $patientReview->save();

        return redirect()
            ->route('admin.patient-reviews.index')
            ->with('success', 'Patient review updated successfully.');
    }

    /**
     * Delete a patient review.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PatientReview $patientReview): RedirectResponse
    {
        $patientReview->delete();

        return redirect()
            ->route('admin.patient-reviews.index')
            ->with('success', 'Patient review deleted successfully.');
    }

    /**
     * Validate patient review form input.
     *
     * @return array<string, mixed>
     */
    private function validateReview(Request $request): array
    {
        return $request->validate([
            'reviewer_name' => ['required', 'string', 'max:255'],
            'initial' => ['nullable', 'string', 'max:1'],
            'avatar_tone' => ['required', 'string', 'in:accent,primary,warm'],
            'review_time' => ['nullable', 'string', 'max:100'],
            'review_text' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'is_verified' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);
    }

    /**
     * Map validated input to model attributes.
     *
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function reviewAttributes(array $validated): array
    {
        $initial = trim((string) ($validated['initial'] ?? ''));

        if ($initial === '') {
            $initial = Str::upper(Str::substr($validated['reviewer_name'], 0, 1));
        }

        return [
            'reviewer_name' => $validated['reviewer_name'],
            'initial' => $initial,
            'avatar_tone' => $validated['avatar_tone'],
            'review_time' => $validated['review_time'] ?? null,
            'review_text' => $validated['review_text'],
            'rating' => (int) $validated['rating'],
            'is_verified' => (bool) $validated['is_verified'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
        ];
    }
}
