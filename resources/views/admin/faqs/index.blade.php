@extends('admin.layouts.app')

@section('title', 'FAQs')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add FAQ
                    </a>
                </div>
                <h4 class="page-title">FAQs</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Home Section</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.faqs.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="form-label" for="faq_home_eyebrow">Eyebrow Text</label>
                            <input type="text" class="form-control @error('faq_home_eyebrow') is-invalid @enderror" id="faq_home_eyebrow" name="faq_home_eyebrow" value="{{ old('faq_home_eyebrow', $homeSectionSettings['faq_home_eyebrow'] ?? 'FAQs') }}">
                            @error('faq_home_eyebrow')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="faq_home_title">Section Title</label>
                            <input type="text" class="form-control @error('faq_home_title') is-invalid @enderror" id="faq_home_title" name="faq_home_title" value="{{ old('faq_home_title', $homeSectionSettings['faq_home_title'] ?? 'Frequently Asked Questions') }}">
                            @error('faq_home_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="faq_home_description">Section Description</label>
                            <textarea class="form-control @error('faq_home_description') is-invalid @enderror" id="faq_home_description" name="faq_home_description" rows="3">{{ old('faq_home_description', $homeSectionSettings['faq_home_description'] ?? '') }}</textarea>
                            @error('faq_home_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            @include('admin.media.partials.url-field', [
                                'name' => 'faq_home_image',
                                'currentValue' => $homeSectionSettings['faq_home_image'] ?? '',
                                'label' => 'Side Image URL',
                            ])
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="faq_home_contact_label">Contact Box Label</label>
                            <input type="text" class="form-control @error('faq_home_contact_label') is-invalid @enderror" id="faq_home_contact_label" name="faq_home_contact_label" value="{{ old('faq_home_contact_label', $homeSectionSettings['faq_home_contact_label'] ?? 'Still Have Questions?') }}">
                            @error('faq_home_contact_label')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Home Section</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">FAQ Items</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_faqs">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Question</th>
                                    <th>Visibility</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->sort_order }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($faq->question, 60) }}</td>
                                        <td>
                                            @if ($faq->display_on_home)
                                                <span class="badge badge-soft-primary me-1">Home</span>
                                            @endif
                                            @if ($faq->display_on_service_detail)
                                                <span class="badge badge-soft-info me-1">Services</span>
                                            @endif
                                            @if ($faq->display_on_expert_detail)
                                                <span class="badge badge-soft-warning me-1">Team</span>
                                            @endif
                                            @if ($faq->service)
                                                <span class="badge badge-soft-secondary me-1">{{ $faq->service->title }}</span>
                                            @endif
                                            @if ($faq->expert)
                                                <span class="badge badge-soft-secondary me-1">{{ $faq->expert->name }}</span>
                                            @endif
                                            @if (! $faq->display_on_home && ! $faq->display_on_service_detail && ! $faq->display_on_expert_detail && ! $faq->service && ! $faq->expert)
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            @if ($faq->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="me-2" title="Edit">
                                                <i class="las la-pen text-secondary font-16"></i>
                                            </a>
                                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline js-confirm-delete" data-title="Delete FAQ?" data-text="This question will be removed from all pages.">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 border-0" title="Delete">
                                                    <i class="las la-trash-alt text-secondary font-16"></i>
                                                </button>
                                            </form>
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
            const table = document.querySelector('#datatable_faqs');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search FAQs...',
                        noRows: 'No FAQs found. Add your first question.',
                        noResults: 'No matching FAQs found.',
                    },
                });
            }
        });
    </script>
@endpush
