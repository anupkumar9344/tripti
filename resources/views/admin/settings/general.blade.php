@extends('admin.layouts.app')

@section('title', 'General Settings')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">General Settings</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="website_name">Website Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('website_name') is-invalid @enderror" id="website_name" name="website_name" value="{{ old('website_name', $settings['website_name']) }}" placeholder="Enter website name" required>
                                    @error('website_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="website_logo">Website Logo</label>
                                    <input type="file" class="form-control @error('website_logo') is-invalid @enderror" id="website_logo" name="website_logo" accept="image/*">
                                    @error('website_logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if (! empty($settings['website_logo']))
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $settings['website_logo']) }}" alt="Website logo" class="img-thumbnail" style="max-height: 80px;">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="email_1">Email 1</label>
                                    <input type="email" class="form-control @error('email_1') is-invalid @enderror" id="email_1" name="email_1" value="{{ old('email_1', $settings['email_1']) }}" placeholder="Enter primary email">
                                    @error('email_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="email_2">Email 2</label>
                                    <input type="email" class="form-control @error('email_2') is-invalid @enderror" id="email_2" name="email_2" value="{{ old('email_2', $settings['email_2']) }}" placeholder="Enter secondary email">
                                    @error('email_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="phone_1">Phone Number 1</label>
                                    <input type="text" class="form-control @error('phone_1') is-invalid @enderror" id="phone_1" name="phone_1" value="{{ old('phone_1', $settings['phone_1']) }}" placeholder="Enter primary phone number">
                                    @error('phone_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="phone_2">Phone Number 2</label>
                                    <input type="text" class="form-control @error('phone_2') is-invalid @enderror" id="phone_2" name="phone_2" value="{{ old('phone_2', $settings['phone_2']) }}" placeholder="Enter secondary phone number">
                                    @error('phone_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="whatsapp_number">WhatsApp Number</label>
                                    <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="Enter WhatsApp number">
                                    @error('whatsapp_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="address">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Enter business address">{{ old('address', $settings['address']) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
