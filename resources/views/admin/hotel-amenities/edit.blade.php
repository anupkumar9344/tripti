@extends('admin.layouts.app')

@section('title', 'Edit Amenity')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box"><h4 class="page-title">Edit Amenity</h4></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.hotel-amenities.update', $amenity) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.hotel-amenities._form')
                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary">Update Amenity</button>
                            <a href="{{ route('admin.hotel-amenities.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
