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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Item Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.trust-strip-items.update', $trustStripItem) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.trust-strip-items._form', ['trustStripItem' => $trustStripItem])

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update Item</button>
                            <a href="{{ route('admin.trust-strip-items.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
