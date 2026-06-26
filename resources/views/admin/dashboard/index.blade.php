@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Welcome, {{ auth()->user()->name }}!</h4>
                    <p class="card-text text-muted mb-0">You are logged in to the Sahaj admin panel.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
