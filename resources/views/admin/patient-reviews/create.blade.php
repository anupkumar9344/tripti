@extends('admin.layouts.app')

@section('title', 'Add Patient Review')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Patient Review</h4>
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
                    <form action="{{ route('admin.patient-reviews.store') }}" method="POST">
                        @csrf
                        @include('admin.patient-reviews._form')

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Save Review</button>
                            <a href="{{ route('admin.patient-reviews.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
