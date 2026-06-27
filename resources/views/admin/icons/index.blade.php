@extends('admin.layouts.app')

@section('title', 'Icon Reference')

@push('styles')
    <link href="{{ asset('admin/assets/css/admin-icons.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4 class="page-title mb-1">Icon Reference</h4>
                    <p class="text-muted mb-0 font-13">Click an icon to copy its name. Paste it into icon fields on Services, Treatments, Gallery, and other forms.</p>
                </div>
                <span class="badge bg-soft-primary text-primary">{{ number_format($iconCount) }} icons</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card admin-icons-card">
                <div class="card-body">
                    <div class="admin-icons-toolbar">
                        <div class="row g-2 align-items-center">
                            <div class="col-lg-6 col-md-8">
                                <input type="search" class="form-control" id="iconSearchInput" placeholder="Search icons, e.g. heart, leaf, hospital..." autofocus>
                            </div>
                            <div class="col-lg-3 col-md-4 col-6">
                                <select class="form-select" id="iconStyleFilter" disabled>
                                    <option value="solid" selected>Solid (website icons)</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-12 col-6 text-lg-end">
                                <span class="text-muted font-13" id="iconResultCount">{{ number_format($iconCount) }} icons</span>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-light border mt-3 mb-3 font-13" role="note">
                        Copy the icon name only, such as <code>fa-leaf</code>. Do not include <code>fa-solid</code>.
                    </div>

                    <div class="admin-icons-grid" id="iconGrid"></div>
                    <div class="admin-icons-empty d-none" id="iconEmptyState">
                        <i class="ti ti-search-off"></i>
                        <p class="mb-0">No icons match your search.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.SahajIconsConfig = {
            iconsUrl: @json(route('admin.icons.data')),
        };
    </script>
    <script src="{{ asset('admin/assets/js/admin-icons.js') }}"></script>
@endpush
