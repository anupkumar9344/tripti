@extends('admin.layouts.app')

@section('title', 'Add Team Member')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Team Member</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.experts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.experts._form')

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save Team Member</button>
                    <a href="{{ route('admin.experts.index') }}" class="btn btn-light ms-1">Cancel</a>
                </div>
            </form>

            <p class="text-muted font-13">After saving, edit this member to add profile page details and category content.</p>
        </div>
    </div>
@endsection
