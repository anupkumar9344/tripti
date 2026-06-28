@extends('admin.layouts.app')

@section('title', 'Edit Gallery Item')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Gallery Item</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Item Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.gallery-items.update', $galleryItem) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.gallery-items._form', ['galleryItem' => $galleryItem])

                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary">Update Item</button>
                            <a href="{{ route('admin.gallery-items.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
