@extends('admin.layouts.app')

@section('title', 'Edit Inquiry')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Inquiry</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.hotel-inquiries.update', $hotelInquiry) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.hotel-inquiries._form', ['inquiry' => $hotelInquiry])
                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary">Update Inquiry</button>
                            <a href="{{ route('admin.hotel-inquiries.show', $hotelInquiry) }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
