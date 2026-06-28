@extends('admin.layouts.app')

@section('title', 'Edit Trust Strip Item')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Trust Strip Item</h4>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.trust-strip-items.update', $trustStripItem) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.trust-strip-items._form', ['trustStripItem' => $trustStripItem])

        <div class="mt-3 admin-form-actions">
            <button type="submit" class="btn btn-primary">Update Item</button>
            <a href="{{ route('admin.trust-strip-items.index') }}" class="btn btn-light ms-1">Cancel</a>
        </div>
    </form>
@endsection
