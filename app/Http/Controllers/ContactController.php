<?php

namespace App\Http\Controllers;

use App\Mail\ContactReceivedMail;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

/**
 * Handles the public contact page.
 */
class ContactController extends Controller
{
    /**
     * Setting keys used on the contact page.
     *
     * @var list<string>
     */
    private const CONTACT_SETTING_KEYS = [
        'website_name',
        'email_1',
        'email_2',
        'phone_1',
        'phone_2',
        'whatsapp_number',
        'address',
        'opening_hours',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'google_map_embed',
        'contact_locations_title',
        'contact_locations_description',
        'contact_form_title',
        'contact_form_description',
    ];

    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $settings = Setting::getMany(self::CONTACT_SETTING_KEYS);

        return view('contact.index', compact('settings'));
    }

    /**
     * Store a contact form submission and optionally notify by email.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $contact = Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        $this->sendNotificationEmail($contact);

        return response()->json([
            'message' => 'Thank you for reaching out. Our team will get in touch with you shortly.',
        ]);
    }

    /**
     * Send a notification email when SMTP is configured.
     */
    private function sendNotificationEmail(Contact $contact): void
    {
        if (! $this->isSmtpConfigured()) {
            return;
        }

        $recipients = array_values(array_filter([
            Setting::getValue('email_1'),
            Setting::getValue('email_2'),
        ]));

        if ($recipients === []) {
            return;
        }

        try {
            Mail::to($recipients)->send(new ContactReceivedMail($contact));
        } catch (\Throwable $exception) {
            Log::warning('Contact form email could not be sent.', [
                'contact_id' => $contact->id,
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Determine whether SMTP mail delivery is configured.
     */
    private function isSmtpConfigured(): bool
    {
        if (config('mail.default') !== 'smtp') {
            return false;
        }

        $host = config('mail.mailers.smtp.host');
        $username = config('mail.mailers.smtp.username');
        $fromAddress = config('mail.from.address');

        return filled($host)
            && filled($username)
            && filled($fromAddress)
            && $fromAddress !== 'hello@example.com';
    }
}
