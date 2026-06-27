<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HealthProgram;
use App\Support\MediaPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for health programs.
 */
class HealthProgramController extends Controller
{
    /**
     * Display the list of health programs.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $healthPrograms = HealthProgram::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.health-programs.index', compact('healthPrograms'));
    }

    /**
     * Show the form to create a new health program.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.health-programs.create');
    }

    /**
     * Store a newly created health program.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', 'string', 'max:500'],
            'video_url' => ['nullable', 'string', 'max:500'],
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'section_title' => ['nullable', 'string', 'max:255'],
            'section_lead' => ['nullable', 'string'],
            'date_time' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'chief_consultant' => ['nullable', 'string', 'max:255'],
            'key_benefits' => ['nullable', 'string'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
            'active_on_home' => ['required', 'boolean'],
        ]);

        $imagePath = MediaPath::normalize($validated['image'] ?? null);

        if (! $imagePath) {
            return back()
                ->withErrors(['image' => 'Please paste an image URL from the media library.'])
                ->withInput();
        }

        $program = HealthProgram::create($this->payloadFromValidated($validated, $imagePath));

        if ($program->active_on_home && $program->status) {
            HealthProgram::syncActiveOnHome($program->id);
        }

        return redirect()
            ->route('admin.health-programs.index')
            ->with('success', 'Health program created successfully.');
    }

    /**
     * Show the form to edit a health program.
     *
     * @return \Illuminate\View\View
     */
    public function edit(HealthProgram $healthProgram): View
    {
        return view('admin.health-programs.edit', compact('healthProgram'));
    }

    /**
     * Update the given health program.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, HealthProgram $healthProgram): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:500'],
            'video_url' => ['nullable', 'string', 'max:500'],
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'section_title' => ['nullable', 'string', 'max:255'],
            'section_lead' => ['nullable', 'string'],
            'date_time' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'chief_consultant' => ['nullable', 'string', 'max:255'],
            'key_benefits' => ['nullable', 'string'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
            'active_on_home' => ['required', 'boolean'],
        ]);

        $imagePath = MediaPath::normalize($validated['image'] ?? null) ?: $healthProgram->image;

        if (! $imagePath) {
            return back()
                ->withErrors(['image' => 'Please paste an image URL from the media library.'])
                ->withInput();
        }

        $healthProgram->update($this->payloadFromValidated($validated, $imagePath));

        if ($healthProgram->active_on_home && $healthProgram->status) {
            HealthProgram::syncActiveOnHome($healthProgram->id);
        }

        return redirect()
            ->route('admin.health-programs.index')
            ->with('success', 'Health program updated successfully.');
    }

    /**
     * Remove the given health program.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(HealthProgram $healthProgram): RedirectResponse
    {
        $healthProgram->delete();

        return redirect()
            ->route('admin.health-programs.index')
            ->with('success', 'Health program deleted successfully.');
    }

    /**
     * Build the persisted payload from validated input.
     *
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function payloadFromValidated(array $validated, string $imagePath): array
    {
        return [
            'title' => $validated['title'],
            'image' => $imagePath,
            'video_url' => $validated['video_url'] ?? null,
            'eyebrow' => $validated['eyebrow'] ?? null,
            'section_title' => $validated['section_title'] ?? null,
            'section_lead' => $validated['section_lead'] ?? null,
            'date_time' => $validated['date_time'] ?? null,
            'location' => $validated['location'] ?? null,
            'chief_consultant' => $validated['chief_consultant'] ?? null,
            'key_benefits' => $validated['key_benefits'] ?? null,
            'button_text' => $validated['button_text'] ?? null,
            'button_url' => $validated['button_url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
            'active_on_home' => (bool) $validated['status'] && (bool) $validated['active_on_home'],
        ];
    }
}
