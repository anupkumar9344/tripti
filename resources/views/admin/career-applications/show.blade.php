@extends('admin.layouts.app')

@section('title', 'Career Application')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.career-applications.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left me-1"></i> Back to Applications
                    </a>
                </div>
                <h4 class="page-title">Career Application</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">{{ $careerApplication->opening?->title ?? $careerApplication->position }}</h4>
                    <span class="badge {{ $careerApplication->statusBadgeClass() }}">{{ $careerApplication->statusLabel() }}</span>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3 font-13">
                        Applied on {{ $careerApplication->created_at?->format('d M Y, h:i A') }}
                    </p>

                    @if ($careerApplication->message)
                        <div class="border rounded p-3 bg-light">
                            <p class="mb-0" style="white-space: pre-line;">{{ $careerApplication->message }}</p>
                        </div>
                    @else
                        <p class="text-muted mb-0">No message provided.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Applicant Details</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="text-muted mb-1 font-12">Opening</p>
                        <p class="mb-0 fw-semibold">{{ $careerApplication->opening?->title ?? $careerApplication->position }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted mb-1 font-12">Name</p>
                        <p class="mb-0 fw-semibold">{{ $careerApplication->name }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted mb-1 font-12">Email</p>
                        <p class="mb-0"><a href="mailto:{{ $careerApplication->email }}">{{ $careerApplication->email }}</a></p>
                    </div>
                    <div class="mb-0">
                        <p class="text-muted mb-1 font-12">Phone</p>
                        <p class="mb-0"><a href="tel:{{ $careerApplication->phone }}">{{ $careerApplication->phone }}</a></p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Update Status</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.career-applications.update-status', $careerApplication) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-group mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                @foreach (\App\Models\CareerApplication::statuses() as $statusOption)
                                    <option value="{{ $statusOption }}" @selected(old('status', $careerApplication->status) === $statusOption)>{{ ucfirst($statusOption) }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="admin_notes">Admin Notes</label>
                            <textarea class="form-control @error('admin_notes') is-invalid @enderror" id="admin_notes" name="admin_notes" rows="4" placeholder="Internal notes for HR team">{{ old('admin_notes', $careerApplication->admin_notes) }}</textarea>
                            @error('admin_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.career-applications.destroy', $careerApplication) }}" method="POST" class="js-confirm-delete" data-title="Delete application?" data-text="This career application will be permanently removed.">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="ti ti-trash me-1"></i> Delete Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
