@extends('layouts.app')

@section('title', 'Privacy Policy | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Privacy Policy'])
    <section class="padding-t-50 padding-b-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="rx-inner-details">
                        <h4>Privacy Policy</h4>
                        <p>This is a static privacy policy page for Tripti Hotel. Content will be updated when the CMS is connected.</p>
                        <p>We respect your privacy and are committed to protecting your own personal data. This policy explains how we collect, use, and safeguard your information when you visit our website or stay at our property.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
