@extends('admin.layouts.app')

@section('title', 'Privacy & Terms')

@php
    $activeTab = 'privacy';

    if ($errors->hasAny(['terms_conditions_title', 'terms_conditions_content'])) {
        $activeTab = 'terms';
    }
@endphp

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('privacy-policy') }}" class="btn btn-light me-1" target="_blank">
                        <i class="ti ti-world me-1"></i> Privacy Policy
                    </a>
                    <a href="{{ route('terms-and-conditions') }}" class="btn btn-light" target="_blank">
                        <i class="ti ti-world me-1"></i> Terms &amp; Conditions
                    </a>
                </div>
                <h4 class="page-title">Privacy &amp; Terms</h4>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.legal-pages.update') }}" method="POST" id="legalPagesForm">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $activeTab === 'privacy' ? 'active' : '' }}" id="legal-privacy-tab" data-bs-toggle="tab" data-bs-target="#legal-privacy" type="button" role="tab" aria-controls="legal-privacy" aria-selected="{{ $activeTab === 'privacy' ? 'true' : 'false' }}">Privacy Policy</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $activeTab === 'terms' ? 'active' : '' }}" id="legal-terms-tab" data-bs-toggle="tab" data-bs-target="#legal-terms" type="button" role="tab" aria-controls="legal-terms" aria-selected="{{ $activeTab === 'terms' ? 'true' : 'false' }}">Terms &amp; Conditions</button>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade {{ $activeTab === 'privacy' ? 'show active' : '' }}" id="legal-privacy" role="tabpanel" aria-labelledby="legal-privacy-tab">
                        <div class="form-group mb-3">
                            <label class="form-label" for="privacy_policy_title">Page Title</label>
                            <input type="text" class="form-control @error('privacy_policy_title') is-invalid @enderror" id="privacy_policy_title" name="privacy_policy_title" value="{{ old('privacy_policy_title', $settings['privacy_policy_title']) }}" placeholder="Privacy Policy">
                            @error('privacy_policy_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label class="form-label" for="privacy_policy_content">Content</label>
                            <textarea class="form-control legal-page-editor @error('privacy_policy_content') is-invalid @enderror" id="privacy_policy_content" name="privacy_policy_content" rows="12">{{ old('privacy_policy_content', $settings['privacy_policy_content']) }}</textarea>
                            @error('privacy_policy_content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="tab-pane fade {{ $activeTab === 'terms' ? 'active' : '' }}" id="legal-terms" role="tabpanel" aria-labelledby="legal-terms-tab">
                        <div class="form-group mb-3">
                            <label class="form-label" for="terms_conditions_title">Page Title</label>
                            <input type="text" class="form-control @error('terms_conditions_title') is-invalid @enderror" id="terms_conditions_title" name="terms_conditions_title" value="{{ old('terms_conditions_title', $settings['terms_conditions_title']) }}" placeholder="Terms & Conditions">
                            @error('terms_conditions_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label class="form-label" for="terms_conditions_content">Content</label>
                            <textarea class="form-control legal-page-editor @error('terms_conditions_content') is-invalid @enderror" id="terms_conditions_content" name="terms_conditions_content" rows="12">{{ old('terms_conditions_content', $settings['terms_conditions_content']) }}</textarea>
                            @error('terms_conditions_content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Save Content</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editorConfig = {
                height: 420,
                plugins: 'advlist autolink lists link charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime table help',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link blockquote | removeformat | help',
                menubar: 'edit view insert format tools table help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            };

            tinymce.init({
                ...editorConfig,
                selector: '#privacy_policy_content',
            });

            tinymce.init({
                ...editorConfig,
                selector: '#terms_conditions_content',
            });

            document.getElementById('legalPagesForm').addEventListener('submit', function () {
                tinymce.triggerSave();
            });
        });
    </script>
@endpush
