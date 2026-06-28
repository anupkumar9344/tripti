@extends('admin.layouts.app')

@section('title', 'General Settings')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ url('/') }}" class="btn btn-light" target="_blank">
                        <i class="ti ti-world me-1"></i> View Website
                    </a>
                </div>
                <h4 class="page-title">General Settings</h4>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.settings._form')

        <div class="mt-3 admin-form-actions">
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </div>
    </form>
@endsection
