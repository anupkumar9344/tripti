<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Handles admin contact message management.
 */
class ContactController extends Controller
{
    /**
     * Display the contact messages listing page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $contacts = Contact::query()->latest()->get();

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Display a single contact message and mark it as read.
     *
     * @return \Illuminate\View\View
     */
    public function show(Contact $contact): View
    {
        $contact->markAsRead();

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Delete a contact message.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Contact message deleted successfully.');
    }
}
