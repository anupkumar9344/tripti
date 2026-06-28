@extends('admin.layouts.app')

@section('title', 'Edit Why Choose Item')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Why Choose Item</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Item Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.why-choose-items.update', $whyChooseItem) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.why-choose-items._form', ['whyChooseItem' => $whyChooseItem])

                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary">Update Item</button>
                            <a href="{{ route('admin.why-choose-items.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
