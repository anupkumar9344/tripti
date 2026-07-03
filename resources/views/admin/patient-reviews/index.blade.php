@extends('admin.layouts.app')

@section('title', 'Feedback')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.patient-reviews.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Review
                    </a>
                </div>
                <h4 class="page-title">Feedback</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Section Header</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.patient-reviews.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="form-label" for="patient_feedback_rating_label">Rating Label <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('patient_feedback_rating_label') is-invalid @enderror" id="patient_feedback_rating_label" name="patient_feedback_rating_label" value="{{ old('patient_feedback_rating_label', $sectionSettings['patient_feedback_rating_label'] ?? 'Excellent') }}" required>
                            @error('patient_feedback_rating_label')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="patient_feedback_total_reviews">Total Reviews Text <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('patient_feedback_total_reviews') is-invalid @enderror" id="patient_feedback_total_reviews" name="patient_feedback_total_reviews" value="{{ old('patient_feedback_total_reviews', $sectionSettings['patient_feedback_total_reviews'] ?? '346') }}" required placeholder="346">
                            @error('patient_feedback_total_reviews')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="patient_feedback_read_more_url">Read More Reviews URL</label>
                            <input type="text" class="form-control @error('patient_feedback_read_more_url') is-invalid @enderror" id="patient_feedback_read_more_url" name="patient_feedback_read_more_url" value="{{ old('patient_feedback_read_more_url', $sectionSettings['patient_feedback_read_more_url'] ?? '') }}" placeholder="https://g.page/r/...">
                            @error('patient_feedback_read_more_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="admin-form-actions mt-3">
                            <button type="submit" class="btn btn-primary">Save Section Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Review Cards</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_patient_reviews">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Name</th>
                                    <th>Time</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->sort_order }}</td>
                                        <td>{{ $review->reviewer_name }}</td>
                                        <td>{{ $review->review_time ?: '—' }}</td>
                                        <td>{{ $review->rating }}/5</td>
                                        <td>
                                            @if ($review->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'editUrl' => route('admin.patient-reviews.edit', $review),
                                                'deleteUrl' => route('admin.patient-reviews.destroy', $review),
                                                'deleteTitle' => 'Delete review?',
                                                'deleteText' => 'This review will be removed from the home page slider.',
                                            ])
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/datatables/simple-datatables.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.querySelector('#datatable_patient_reviews');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search reviews...',
                        noRows: 'No reviews found. Add your first review.',
                        noResults: 'No matching reviews found.',
                    },
                });
            }
        });
    </script>
@endpush
