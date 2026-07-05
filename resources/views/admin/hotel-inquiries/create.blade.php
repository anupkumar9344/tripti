@extends('admin.layouts.app')

@section('title', 'Add Inquiry')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Inquiry</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.hotel-inquiries.store') }}" method="POST">
                        @csrf
                        @include('admin.hotel-inquiries._form')
                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary">Save Inquiry</button>
                            <a href="{{ route('admin.hotel-inquiries.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
