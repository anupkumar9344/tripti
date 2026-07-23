@extends('admin.layouts.app')

@section('title', 'Add Event Booking')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Banquet / Meeting Booking</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.event-bookings.store') }}" method="POST">
                        @csrf
                        @include('admin.event-bookings._form')
                        <button type="submit" class="btn btn-primary">Create Booking</button>
                        <a href="{{ route('admin.event-bookings.index') }}" class="btn btn-light ms-1">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
