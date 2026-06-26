@extends('admin.layouts.app')

@section('title', 'Edit Expert')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Expert</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.experts.update', $expert) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.experts._form')

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update Expert</button>
                    <a href="{{ route('admin.experts.index') }}" class="btn btn-light ms-1">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#long_description',
            height: 350,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | removeformat | help',
            menubar: 'edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

        document.querySelector('form').addEventListener('submit', function () {
            tinymce.triggerSave();
        });
    </script>
@endpush
