@extends('admin.layouts.app')

@section('title', 'Shorts Video')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.video-feedbacks.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Video
                    </a>
                </div>
                <h4 class="page-title">Shorts Video</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Short Video Reels</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_video_feedbacks">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Preview</th>
                                    <th>Title</th>
                                    <th>Video URL</th>
                                    <th>Visibility</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($videoFeedbacks as $videoFeedback)
                                    <tr>
                                        <td>{{ $videoFeedback->sort_order }}</td>
                                        <td>
                                            @include('partials.video-feedback-thumbnail', [
                                                'video' => $videoFeedback,
                                                'class' => 'rounded video-feedback-admin-thumb',
                                                'attrs' => 'height="72" style="width: 40px; object-fit: cover;"',
                                            ])
                                        </td>
                                        <td class="fw-semibold">{{ $videoFeedback->displayTitle() }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($videoFeedback->video_url, 50) }}</td>
                                        <td>
                                            @if ($videoFeedback->display_on_home)
                                                <span class="badge badge-soft-primary me-1">Home</span>
                                            @endif
                                            @if (! $videoFeedback->display_on_home)
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            @if ($videoFeedback->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'viewUrl' => $videoFeedback->embedUrl(),
                                                'viewTitle' => 'Preview',
                                                'viewTarget' => '_blank',
                                                'editUrl' => route('admin.video-feedbacks.edit', $videoFeedback),
                                                'deleteUrl' => route('admin.video-feedbacks.destroy', $videoFeedback),
                                                'deleteTitle' => 'Delete video?',
                                                'deleteText' => 'This video will be removed from all pages.',
                                            ])
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/datatables/simple-datatables.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.querySelector('#datatable_video_feedbacks');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search videos...',
                        noRows: 'No videos found. Add your first short video feedback.',
                        noResults: 'No matching videos found.',
                    },
                });
            }
        });
    </script>
@endpush
