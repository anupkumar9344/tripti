@extends('admin.layouts.app')

@section('title', 'Edit Feedback')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Feedback</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Review Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.patient-reviews.update', $patientReview) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.patient-reviews._form', ['patientReview' => $patientReview])

                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary">Update Review</button>
                            <a href="{{ route('admin.patient-reviews.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
