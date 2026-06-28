@extends('admin.layouts.app')

@section('title', 'Edit Profile Category')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Profile Category</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Category Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.expert-profile-categories.update', $expertProfileCategory) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.expert-profile-categories._form')

                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                            <a href="{{ route('admin.expert-profile-categories.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
