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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Program Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.health-programs.update', $healthProgram) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.health-programs._form', ['healthProgram' => $healthProgram])

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update Program</button>
                            <a href="{{ route('admin.health-programs.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
