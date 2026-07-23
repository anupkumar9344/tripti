@extends('admin.layouts.app')

@section('title', 'Create Promo Code')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.promo-codes.index') }}" class="btn btn-light">Back</a>
                </div>
                <h4 class="page-title">Create Promo Code</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.promo-codes.store') }}" method="POST">
                        @csrf
                        @include('admin.promo-codes._form')
                        <button type="submit" class="btn btn-primary">Create Promo Code</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
