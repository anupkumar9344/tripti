@extends('admin.layouts.app')

@section('title', 'Contact Message')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left me-1"></i> Back to Messages
                    </a>
                </div>
                <h4 class="page-title">Contact Message</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">{{ $contact->subject ?: 'General Inquiry' }}</h4>
                    @if ($contact->status === 'new')
                        <span class="badge badge-soft-success">New</span>
                    @else
                        <span class="badge badge-soft-secondary">Read</span>
                    @endif
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3 font-13">
                        Received on {{ $contact->created_at?->format('d M Y, h:i A') }}
                        @if ($contact->read_at)
                            · Read on {{ $contact->read_at->format('d M Y, h:i A') }}
                        @endif
                    </p>
                    <div class="border rounded p-3 bg-light">
                        <p class="mb-0" style="white-space: pre-line;">{{ $contact->message }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Sender Details</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="text-muted mb-1 font-12">Name</p>
                        <p class="mb-0 fw-semibold">{{ $contact->name }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted mb-1 font-12">Email</p>
                        <p class="mb-0"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                    </div>
                    <div class="mb-0">
                        <p class="text-muted mb-1 font-12">Phone</p>
                        <p class="mb-0"><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="js-confirm-delete" data-title="Delete message?" data-text="This contact message will be permanently removed.">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="ti ti-trash me-1"></i> Delete Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
