@extends('admin.layouts.app')

@section('title', 'Add Premium Service')

@section('content')
    <div class="row"><div class="col-sm-12"><div class="page-title-box"><h4 class="page-title">Add Premium Service</h4></div></div></div>
    <div class="row"><div class="col-lg-8"><div class="card"><div class="card-body">
        <form action="{{ route('admin.premium-services.store') }}" method="POST">
            @csrf
            @include('admin.premium-services._form')
            <div class="mt-3 admin-form-actions">
                <button type="submit" class="btn btn-primary">Save Service</button>
                <a href="{{ route('admin.premium-services.index') }}" class="btn btn-light ms-1">Cancel</a>
            </div>
        </form>
    </div></div></div></div>
@endsection
