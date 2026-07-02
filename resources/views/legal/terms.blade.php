@extends('layouts.app')

@section('title', 'Terms & Conditions | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Terms & Conditions'])
    <section class="padding-t-50 padding-b-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="rx-inner-details">
                        <h4>Terms & Conditions</h4>
                        <p>This is a static terms and conditions page for Tripti Hotel. Content will be updated when the CMS is connected.</p>
                        <p>By using our website and booking our services, you agree to these terms. Please read them carefully before making a reservation.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
