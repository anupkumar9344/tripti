@extends('admin.layouts.app')

@section('title', 'Add Facility')

@section('content')
    <div class="row"><div class="col-sm-12"><div class="page-title-box"><h4 class="page-title">Add Facility</h4></div></div></div>
    <div class="row"><div class="col-12"><div class="card"><div class="card-body">
        <form action="{{ route('admin.hotel-facilities.store') }}" method="POST">
            @csrf
            @include('admin.hotel-facilities._form')
            <div class="mt-3 admin-form-actions">
                <button type="submit" class="btn btn-primary">Save Facility</button>
                <a href="{{ route('admin.hotel-facilities.index') }}" class="btn btn-light ms-1">Cancel</a>
            </div>
        </form>
    </div></div></div></div>
@endsection
