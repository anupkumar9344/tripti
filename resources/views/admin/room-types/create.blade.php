@extends('admin.layouts.app')

@section('title', 'Add Room Type')

@section('content')
    <div class="row"><div class="col-sm-12"><div class="page-title-box"><h4 class="page-title">Add Room Type</h4></div></div></div>
    <div class="row"><div class="col-12"><div class="card"><div class="card-body">
        <form action="{{ route('admin.room-types.store') }}" method="POST">
            @csrf
            @include('admin.room-types._form')
            <div class="mt-3 admin-form-actions">
                <button type="submit" class="btn btn-primary">Save Room Type</button>
                <a href="{{ route('admin.room-types.index') }}" class="btn btn-light ms-1">Cancel</a>
            </div>
        </form>
    </div></div></div></div>
@endsection
