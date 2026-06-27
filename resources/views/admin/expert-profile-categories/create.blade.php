@extends('admin.layouts.app')

@section('title', 'Add Profile Category')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Profile Category</h4>
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
                    <form action="{{ route('admin.expert-profile-categories.store') }}" method="POST">
                        @csrf
                        @include('admin.expert-profile-categories._form')

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Save Category</button>
                            <a href="{{ route('admin.expert-profile-categories.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
