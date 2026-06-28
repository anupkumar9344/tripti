@extends('admin.layouts.app')

@section('title', 'Edit FAQ')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit FAQ</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">FAQ Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.faqs._form', ['faq' => $faq])

                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary">Update FAQ</button>
                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
