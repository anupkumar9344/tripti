@extends('admin.layouts.app')

@section('title', 'About Us Settings')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ url('/') }}" class="btn btn-light me-1" target="_blank">
                        <i class="ti ti-world me-1"></i> Home
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-light" target="_blank">
                        <i class="ti ti-world me-1"></i> About Page
                    </a>
                </div>
                <h4 class="page-title">About Us Settings</h4>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.about.update') }}" method="POST" id="aboutSettingsForm">
        @csrf
        @method('PUT')
        @include('admin.about._form')

        <div class="mt-3 admin-form-actions">
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#about_page_description',
            height: 280,
            plugins: 'advlist autolink lists link charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime table help',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | removeformat | help',
            menubar: 'edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

        document.getElementById('aboutSettingsForm').addEventListener('submit', function () {
            tinymce.triggerSave();
        });
    </script>
@endpush
