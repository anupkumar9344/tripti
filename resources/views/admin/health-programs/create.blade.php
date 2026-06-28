@extends('admin.layouts.app')

@section('title', 'Add Health Program')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Health Program</h4>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.health-programs.store') }}" method="POST">
        @csrf
        @include('admin.health-programs._form')

        <div class="mt-3 admin-form-actions">
            <button type="submit" class="btn btn-primary">Save Program</button>
            <a href="{{ route('admin.health-programs.index') }}" class="btn btn-light ms-1">Cancel</a>
        </div>
    </form>
@endsection
