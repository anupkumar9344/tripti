@extends('admin.layouts.app')

@section('title', 'Add Amenity')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box"><h4 class="page-title">Add Amenity</h4></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.hotel-amenities.store') }}" method="POST">
                        @csrf
                        @include('admin.hotel-amenities._form')
                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary">Save Amenity</button>
                            <a href="{{ route('admin.hotel-amenities.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
