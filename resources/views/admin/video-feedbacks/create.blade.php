@extends('admin.layouts.app')

@section('title', 'Add Shorts Video')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Shorts Video</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Video Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.video-feedbacks.store') }}" method="POST">
                        @csrf
                        @include('admin.video-feedbacks._form')

                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary">Save Video</button>
                            <a href="{{ route('admin.video-feedbacks.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
