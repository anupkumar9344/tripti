@extends('admin.layouts.app')

@section('title', 'Edit Health Program')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Health Program</h4>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.health-programs.update', $healthProgram) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.health-programs._form', ['healthProgram' => $healthProgram])

        <div class="mt-3 admin-form-actions">
            <button type="submit" class="btn btn-primary">Update Program</button>
            <a href="{{ route('admin.health-programs.index') }}" class="btn btn-light ms-1">Cancel</a>
        </div>
    </form>
@endsection
