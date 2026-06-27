@extends('admin.layouts.app')

@section('title', 'Edit Hero Banner')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Hero Banner</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Banner Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.hero-banners.update', $heroBanner) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.hero-banners._form', ['heroBanner' => $heroBanner])

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update Banner</button>
                            <a href="{{ route('admin.hero-banners.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
