@extends('admin.layouts.app')

@section('title', 'Add Hero Banner')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Hero Banner</h4>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.hero-banners.store') }}" method="POST">
        @csrf
        @include('admin.hero-banners._form')

        <div class="mt-3 admin-form-actions">
            <button type="submit" class="btn btn-primary">Save Banner</button>
            <a href="{{ route('admin.hero-banners.index') }}" class="btn btn-light ms-1">Cancel</a>
        </div>
    </form>
@endsection
