<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerOpening;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Handles admin CRUD for career job openings.
 */
class CareerOpeningController extends Controller
{
    /**
     * Display all job openings.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $openings = CareerOpening::query()
            ->withCount('applications')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.career-openings.index', compact('openings'));
    }

    /**
     * Show the form to create a job opening.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.career-openings.create');
    }

    /**
     * Store a new job opening.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        CareerOpening::create($this->validatedData($request));

        return redirect()
            ->route('admin.career-openings.index')
            ->with('success', 'Job opening created successfully.');
    }

    /**
     * Show the form to edit a job opening.
     *
     * @return \Illuminate\View\View
     */
    public function edit(CareerOpening $careerOpening): View
    {
        return view('admin.career-openings.edit', compact('careerOpening'));
    }

    /**
     * Update a job opening.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, CareerOpening $careerOpening): RedirectResponse
    {
        $careerOpening->update($this->validatedData($request));

        return redirect()
            ->route('admin.career-openings.index')
            ->with('success', 'Job opening updated successfully.');
    }

    /**
     * Delete a job opening.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CareerOpening $careerOpening): RedirectResponse
    {
        $careerOpening->delete();

        return redirect()
            ->route('admin.career-openings.index')
            ->with('success', 'Job opening deleted successfully.');
    }

    /**
     * Validate job opening form input.
     *
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:100'],
            'job_type' => ['required', Rule::in(CareerOpening::jobTypes())],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        return [
            'title' => $validated['title'],
            'department' => $validated['department'] ?? null,
            'job_type' => $validated['job_type'],
            'location' => $validated['location'] ?? null,
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
        ];
    }
}
