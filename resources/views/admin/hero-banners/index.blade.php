@extends('admin.layouts.app')

@section('title', 'Hero Banners')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.hero-banners.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Banner
                    </a>
                </div>
                <h4 class="page-title">Hero Banners</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Home Page Slider</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_hero_banners">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="width: 60px;">#</th>
                                    <th>Banner</th>
                                    <th>Primary Action</th>
                                    <th>Secondary Action</th>
                                    <th class="text-center" style="width: 90px;">Order</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($heroBanners as $banner)
                                    <tr>
                                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ $banner->imageUrl() }}" alt="{{ $banner->title }}" height="40" class="rounded me-2">
                                            <span class="d-inline-block align-middle">
                                                <span class="fw-semibold d-block">{{ $banner->title }}</span>
                                                @if ($banner->eyebrow)
                                                    <span class="text-muted font-12">{{ $banner->eyebrow }}</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            @if ($banner->primary_label)
                                                <span class="font-13">{{ $banner->primary_label }}</span>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            @if ($banner->hasSecondaryAction())
                                                <span class="font-13">{{ $banner->secondary_label }}</span>
                                                <span class="badge badge-soft-secondary ms-1">{{ $banner->secondary_type }}</span>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td class="text-center fw-semibold">{{ $banner->sort_order }}</td>
                                        <td>
                                            @if ($banner->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'viewUrl' => url('/'),
                                                'viewTitle' => 'View Home',
                                                'viewTarget' => '_blank',
                                                'editUrl' => route('admin.hero-banners.edit', $banner),
                                                'deleteUrl' => route('admin.hero-banners.destroy', $banner),
                                                'deleteTitle' => 'Delete banner?',
                                                'deleteText' => 'This banner will be removed from the home page slider.',
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
            const table = document.querySelector('#datatable_hero_banners');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search banners...',
                        noRows: 'No banners found. Add your first banner.',
                        noResults: 'No matching banners found.',
                    },
                });
            }
        });
    </script>
@endpush
