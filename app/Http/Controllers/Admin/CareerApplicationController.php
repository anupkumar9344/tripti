<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Handles admin listing and review of career applications.
 */
class CareerApplicationController extends Controller
{
    /**
     * Display career applications with optional status filter.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $status = (string) $request->query('status', '');

        $applications = CareerApplication::query()
            ->with('opening')
            ->when($status !== '', fn ($query) => $query->status($status))
            ->latest()
            ->get();

        $counts = [
            'all' => CareerApplication::query()->count(),
            CareerApplication::STATUS_NEW => CareerApplication::query()->status(CareerApplication::STATUS_NEW)->count(),
            CareerApplication::STATUS_REVIEWED => CareerApplication::query()->status(CareerApplication::STATUS_REVIEWED)->count(),
            CareerApplication::STATUS_SHORTLISTED => CareerApplication::query()->status(CareerApplication::STATUS_SHORTLISTED)->count(),
            CareerApplication::STATUS_REJECTED => CareerApplication::query()->status(CareerApplication::STATUS_REJECTED)->count(),
        ];

        return view('admin.career-applications.index', compact('applications', 'status', 'counts'));
    }

    /**
     * Display a single career application.
     *
     * @return \Illuminate\View\View
     */
    public function show(CareerApplication $careerApplication): View
    {
        return view('admin.career-applications.show', [
            'careerApplication' => $careerApplication->load('opening'),
        ]);
    }

    /**
     * Update application status and admin notes.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, CareerApplication $careerApplication): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(CareerApplication::statuses())],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $careerApplication->update($validated);

        return redirect()
            ->route('admin.career-applications.show', $careerApplication)
            ->with('success', 'Application updated successfully.');
    }

    /**
     * Delete a career application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CareerApplication $careerApplication): RedirectResponse
    {
        $careerApplication->delete();

        return redirect()
            ->route('admin.career-applications.index')
            ->with('success', 'Application deleted successfully.');
    }
}
