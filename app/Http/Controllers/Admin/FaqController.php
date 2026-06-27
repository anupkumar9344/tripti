<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Models\Faq;
use App\Models\Service;
use App\Models\Setting;
use App\Support\MediaPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Handles admin CRUD for website FAQ items.
 */
class FaqController extends Controller
{
    /**
     * Setting keys for the home FAQ section.
     *
     * @var list<string>
     */
    private const HOME_SECTION_SETTING_KEYS = [
        'faq_home_eyebrow',
        'faq_home_title',
        'faq_home_description',
        'faq_home_image',
        'faq_home_contact_label',
    ];

    /**
     * Media setting keys for the home FAQ section.
     *
     * @var list<string>
     */
    private const HOME_SECTION_MEDIA_KEYS = [
        'faq_home_image',
    ];

    /**
     * Display FAQs and home section settings.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $faqs = Faq::query()
            ->with(['service:id,title', 'expert:id,name'])
            ->orderBy('sort_order')
            ->orderBy('question')
            ->get();

        $homeSectionSettings = Setting::getMany(self::HOME_SECTION_SETTING_KEYS);

        return view('admin.faqs.index', compact('faqs', 'homeSectionSettings'));
    }

    /**
     * Update the home FAQ section settings.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'faq_home_eyebrow' => ['nullable', 'string', 'max:100'],
            'faq_home_title' => ['nullable', 'string', 'max:255'],
            'faq_home_description' => ['nullable', 'string', 'max:1000'],
            'faq_home_image' => ['nullable', 'string', 'max:500'],
            'faq_home_contact_label' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($validated as $key => $value) {
            if (in_array($key, self::HOME_SECTION_MEDIA_KEYS, true)) {
                Setting::setValue($key, MediaPath::normalize($value));

                continue;
            }

            Setting::setValue($key, $value);
        }

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'Home FAQ section settings updated successfully.');
    }

    /**
     * Show the form to create a new FAQ.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.faqs.create', $this->formOptions());
    }

    /**
     * Store a newly created FAQ.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateFaq($request);

        Faq::create($this->faqAttributes($validated));

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    /**
     * Show the form to edit an FAQ.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', array_merge(['faq' => $faq], $this->formOptions()));
    }

    /**
     * Update the given FAQ.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $this->validateFaq($request);

        $faq->fill($this->faqAttributes($validated));
        $faq->save();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    /**
     * Delete an FAQ.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }

    /**
     * Shared form dropdown data.
     *
     * @return array<string, mixed>
     */
    private function formOptions(): array
    {
        return [
            'services' => Service::query()->orderBy('title')->get(['id', 'title']),
            'experts' => Expert::query()->orderBy('name')->get(['id', 'name']),
        ];
    }

    /**
     * Validate FAQ form input.
     *
     * @return array<string, mixed>
     */
    private function validateFaq(Request $request): array
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:500'],
            'answer' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
            'display_on_home' => ['required', 'boolean'],
            'display_on_service_detail' => ['required', 'boolean'],
            'display_on_expert_detail' => ['required', 'boolean'],
            'service_id' => ['nullable', 'integer', 'exists:services,id'],
            'expert_id' => ['nullable', 'integer', 'exists:experts,id'],
        ]);

        if (! empty($validated['service_id']) && ! empty($validated['expert_id'])) {
            throw ValidationException::withMessages([
                'service_id' => 'Choose either a service or an expert, not both.',
            ]);
        }

        return $validated;
    }

    /**
     * Map validated input to model attributes.
     *
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function faqAttributes(array $validated): array
    {
        $serviceId = $validated['service_id'] ?? null;
        $expertId = $validated['expert_id'] ?? null;

        return [
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
            'display_on_home' => (bool) $validated['display_on_home'],
            'display_on_service_detail' => $serviceId ? false : (bool) $validated['display_on_service_detail'],
            'display_on_expert_detail' => $expertId ? false : (bool) $validated['display_on_expert_detail'],
            'service_id' => $serviceId,
            'expert_id' => $expertId,
        ];
    }
}
