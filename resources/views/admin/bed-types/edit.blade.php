@extends('admin.layouts.app')

@section('title', 'Edit Bed Type')

@section('content')
    <div class="row"><div class="col-sm-12"><div class="page-title-box"><h4 class="page-title">Edit Bed Type</h4></div></div></div>
    <div class="row"><div class="col-lg-8"><div class="card"><div class="card-body">
        <form action="{{ route('admin.bed-types.update', $bedType) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.bed-types._form')
            <div class="mt-3 admin-form-actions">
                <button type="submit" class="btn btn-primary">Update Bed Type</button>
                <a href="{{ route('admin.bed-types.index') }}" class="btn btn-light ms-1">Cancel</a>
            </div>
        </form>
    </div></div></div></div>
@endsection
