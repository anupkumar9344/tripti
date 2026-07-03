@extends('admin.layouts.app')

@section('title', 'Bed Types')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.bed-types.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add New
                    </a>
                </div>
                <h4 class="page-title">Bed List</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_bed_types">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 80px;">S.N.</th>
                                    <th>Bed Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bedTypes as $bedType)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bedType->name }}</td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'editUrl' => route('admin.bed-types.edit', $bedType),
                                                'deleteUrl' => route('admin.bed-types.destroy', $bedType),
                                                'deleteTitle' => 'Delete bed type?',
                                                'deleteText' => 'This bed type will be permanently removed.',
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
            const table = document.querySelector('#datatable_bed_types');
            if (table) {
                new simpleDatatables.DataTable(table, { searchable: true, fixedHeight: false, perPage: 10 });
            }
        });
    </script>
@endpush
