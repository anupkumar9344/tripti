@extends('admin.layouts.app')

@section('title', 'General Settings')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">General Settings</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.settings._form')

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
@endsection
