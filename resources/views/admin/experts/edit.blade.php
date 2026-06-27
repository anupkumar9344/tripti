@extends('admin.layouts.app')

@section('title', 'Edit Team Member')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Team Member</h4>
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
                    <button type="submit" class="btn btn-primary">Update Team Member</button>
                    <a href="{{ route('experts.show', $expert->slug) }}" class="btn btn-outline-primary ms-1" target="_blank">View Profile</a>
                    <a href="{{ route('admin.experts.index') }}" class="btn btn-light ms-1">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        const profileEditorConfig = {
            height: 280,
            plugins: 'advlist autolink lists link charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime table help',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | removeformat | help',
            menubar: 'edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        };

        function initProfileEditor(textarea) {
            if (!textarea || tinymce.get(textarea.id)) {
                return;
            }

            tinymce.init({
                ...profileEditorConfig,
                target: textarea
            });
        }

        function removeProfileEditor(textarea) {
            if (!textarea) {
                return;
            }

            const editor = tinymce.get(textarea.id);

            if (editor) {
                editor.remove();
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                ...profileEditorConfig,
                selector: '#long_description',
                height: 320
            });

            document.querySelectorAll('.profile-category-checkbox').forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const panel = document.getElementById(checkbox.dataset.target);
                    const textarea = panel ? panel.querySelector('.expert-profile-editor') : null;

                    if (!panel) {
                        return;
                    }

                    if (checkbox.checked) {
                        panel.classList.remove('d-none');
                        initProfileEditor(textarea);
                    } else {
                        panel.classList.add('d-none');
                        removeProfileEditor(textarea);
                    }
                });
            });

            document.querySelectorAll('.profile-section-editor:not(.d-none) .expert-profile-editor').forEach(function (textarea) {
                initProfileEditor(textarea);
            });

            document.querySelector('form').addEventListener('submit', function () {
                tinymce.triggerSave();
            });
        });
    </script>
@endpush
