@extends('admin.layouts.app')

@section('title', 'Edit Event Booking')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Booking {{ $eventBooking->reference_number }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.event-bookings.update', $eventBooking) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.event-bookings._form', ['booking' => $eventBooking])
                        <button type="submit" class="btn btn-primary">Update Booking</button>
                        <a href="{{ route('admin.event-bookings.show', $eventBooking) }}" class="btn btn-light ms-1">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
