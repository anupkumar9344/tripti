<x-mail::message>
# New Contact Message

You have received a new message from the website contact form.

**Name:** {{ $contact->name }}

**Email:** {{ $contact->email }}

**Phone:** {{ $contact->phone }}

@if ($contact->subject)
**Subject:** {{ $contact->subject }}
@endif

**Message:**

{{ $contact->message }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
