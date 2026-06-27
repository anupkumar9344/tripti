@extends('admin.layouts.app')

@section('title', 'Edit Treatment')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Treatment</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Treatment Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.treatments.update', $treatment) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.treatments._form', ['treatment' => $treatment])

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update Treatment</button>
                            @if ($treatment->status)
                                <a href="{{ route('treatment.show', $treatment->slug) }}" class="btn btn-outline-primary ms-1" target="_blank">View Page</a>
                            @endif
                            <a href="{{ route('admin.treatments.index') }}" class="btn btn-light ms-1">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#long_description',
            height: 350,
            plugins: 'advlist autolink lists link charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime table help',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | removeformat | help',
            menubar: 'edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

        document.querySelector('form').addEventListener('submit', function () {
            tinymce.triggerSave();
        });
    </script>
@endpush
