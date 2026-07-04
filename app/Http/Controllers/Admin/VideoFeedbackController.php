<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoFeedback;
use App\Support\MediaPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for short video feedback reels.
 */
class VideoFeedbackController extends Controller
{
    /**
     * Display the list of video feedbacks.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $videoFeedbacks = VideoFeedback::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.video-feedbacks.index', compact('videoFeedbacks'));
    }

    /**
     * Show the form to create a new video feedback.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.video-feedbacks.create');
    }

    /**
     * Store a newly created video feedback.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateVideoFeedback($request);

        VideoFeedback::create($this->videoFeedbackAttributes($validated));

        return redirect()
            ->route('admin.video-feedbacks.index')
            ->with('success', 'Video feedback created successfully.');
    }

    /**
     * Show the form to edit a video feedback.
     *
     * @return \Illuminate\View\View
     */
    public function edit(VideoFeedback $videoFeedback): View
    {
        return view('admin.video-feedbacks.edit', compact('videoFeedback'));
    }

    /**
     * Update an existing video feedback.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, VideoFeedback $videoFeedback): RedirectResponse
    {
        $validated = $this->validateVideoFeedback($request);

        $videoFeedback->fill($this->videoFeedbackAttributes($validated));
        $videoFeedback->save();

        return redirect()
            ->route('admin.video-feedbacks.index')
            ->with('success', 'Video feedback updated successfully.');
    }

    /**
     * Delete a video feedback.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(VideoFeedback $videoFeedback): RedirectResponse
    {
        $videoFeedback->delete();

        return redirect()
            ->route('admin.video-feedbacks.index')
            ->with('success', 'Video feedback deleted successfully.');
    }

    /**
     * Validate video feedback form input.
     *
     * @return array<string, mixed>
     */
    private function validateVideoFeedback(Request $request): array
    {
        return $request->validate([
            'title' => ['nullable', 'string', 'max:120'],
            'video_url' => ['required', 'string', 'max:500'],
            'thumbnail' => ['nullable', 'string', 'max:500'],
            'display_on_home' => ['required', 'boolean'],
            'display_on_services' => ['required', 'boolean'],
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
    private function videoFeedbackAttributes(array $validated): array
    {
        return [
            'title' => $validated['title'] ?? null,
            'video_url' => MediaPath::normalize($validated['video_url']) ?? trim($validated['video_url']),
            'thumbnail' => MediaPath::normalize($validated['thumbnail'] ?? null),
            'display_on_home' => (bool) $validated['display_on_home'],
            'display_on_services' => (bool) $validated['display_on_services'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
        ];
    }
}
