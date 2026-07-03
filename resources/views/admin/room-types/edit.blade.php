@extends('admin.layouts.app')

@section('title', 'Edit Room Type')

@section('content')
    <div class="row"><div class="col-sm-12"><div class="page-title-box"><h4 class="page-title">Edit Room Type</h4></div></div></div>
    <div class="row"><div class="col-12"><div class="card"><div class="card-body">
        <form action="{{ route('admin.room-types.update', $roomType) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.room-types._form')
            <div class="mt-3 admin-form-actions">
                <button type="submit" class="btn btn-primary">Update Room Type</button>
                <a href="{{ route('admin.room-types.index') }}" class="btn btn-light ms-1">Cancel</a>
            </div>
        </form>
    </div></div></div></div>
@endsection
