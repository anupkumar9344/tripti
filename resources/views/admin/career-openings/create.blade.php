@extends('admin.layouts.app')

@section('title', 'Add Job Opening')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box"><h4 class="page-title">Add Job Opening</h4></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.career-openings.store') }}" method="POST">
                        @csrf
                        @include('admin.career-openings._form')
                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary">Save Opening</button>
                            <a href="{{ route('admin.career-openings.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
