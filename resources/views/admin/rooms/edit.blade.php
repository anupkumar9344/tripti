@extends('admin.layouts.app')

@section('title', 'Edit Room')

@section('content')
    <div class="row"><div class="col-sm-12"><div class="page-title-box"><h4 class="page-title">Edit Room — {{ $roomType->name }}</h4></div></div></div>
    <div class="row"><div class="col-lg-8"><div class="card"><div class="card-body">
        <form action="{{ route('admin.room-types.rooms.update', [$roomType, $room]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.rooms._form')
            <div class="mt-3 admin-form-actions">
                <button type="submit" class="btn btn-primary">Update Room</button>
                <a href="{{ route('admin.room-types.rooms.index', $roomType) }}" class="btn btn-light ms-1">Cancel</a>
            </div>
        </form>
    </div></div></div></div>
@endsection
