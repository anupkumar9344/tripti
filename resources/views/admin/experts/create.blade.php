@extends('admin.layouts.app')

@section('title', 'Add Team Member')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Team Member</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.experts.store') }}" method="POST">
                @csrf
                @include('admin.experts._form')

                <div class="mb-3 admin-form-actions">
                    <button type="submit" class="btn btn-primary">Save Team Member</button>
                    <a href="{{ route('admin.experts.index') }}" class="btn btn-light ms-1">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: '#long_description',
                height: 320,
                plugins: 'advlist autolink lists link charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime table help',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | removeformat | help',
                menubar: 'edit view insert format tools table help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });

            document.querySelector('form').addEventListener('submit', function () {
                tinymce.triggerSave();
            });
        });
    </script>
@endpush
