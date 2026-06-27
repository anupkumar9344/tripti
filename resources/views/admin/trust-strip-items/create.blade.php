@extends('admin.layouts.app')

@section('title', 'Add Trust Strip Item')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Trust Strip Item</h4>
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
                    <form action="{{ route('admin.trust-strip-items.store') }}" method="POST">
                        @csrf
                        @include('admin.trust-strip-items._form')

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Save Item</button>
                            <a href="{{ route('admin.trust-strip-items.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
