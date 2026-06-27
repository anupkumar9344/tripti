<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

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
        return view('admin.contacts.index');
    }

    /**
     * Return contact messages for Yajra DataTables.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(): JsonResponse
    {
        $query = Contact::query()->select('contacts.*');

        return DataTables::of($query)
            ->addColumn('contact', function (Contact $contact) {
                return view('admin.contacts.partials.contact-cell', compact('contact'))->render();
            })
            ->filterColumn('contact', function ($query, $keyword) {
                $query->where(function ($builder) use ($keyword) {
                    $builder->where('name', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%")
                        ->orWhere('phone', 'like', "%{$keyword}%");
                });
            })
            ->editColumn('subject', function (Contact $contact) {
                return $contact->subject ?: '—';
            })
            ->editColumn('status', function (Contact $contact) {
                if ($contact->status === 'new') {
                    return '<span class="badge badge-soft-success">New</span>';
                }

                return '<span class="badge badge-soft-secondary">Read</span>';
            })
            ->editColumn('created_at', function (Contact $contact) {
                return $contact->created_at?->format('d M Y, h:i A') ?? '—';
            })
            ->addColumn('action', function (Contact $contact) {
                return view('admin.contacts.partials.actions', compact('contact'))->render();
            })
            ->orderColumn('contact', 'name $1')
            ->orderColumn('created_at', 'created_at $1')
            ->rawColumns(['contact', 'status', 'action'])
            ->make(true);
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
