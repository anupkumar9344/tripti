@extends('admin.layouts.app')

@section('title', 'Add Staff')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Staff Member</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.staff.store') }}" method="POST">
                        @csrf
                        @include('admin.staff._form')
                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary">Save Staff</button>
                            <a href="{{ route('admin.staff.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
