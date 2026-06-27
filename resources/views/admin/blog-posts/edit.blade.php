@extends('admin.layouts.app')

@section('title', 'Edit Blog Post')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Blog Post</h4>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.blog-posts.update', $blogPost) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.blog-posts._form', ['blogPost' => $blogPost])

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Update Post</button>
            <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-light ms-1">Cancel</a>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#content',
            height: 420,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image blockquote | removeformat | help',
            menubar: 'edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

        document.querySelector('form').addEventListener('submit', function () {
            tinymce.triggerSave();
        });
    </script>
@endpush
