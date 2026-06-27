@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@push('styles')
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-yajra-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Contact Messages</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">All Contact Submissions</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-yajra-datatable">
                        <table class="table table-striped table-bordered mb-0 w-100" id="contacts-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Contact</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#contacts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.contacts.data') }}',
                order: [[3, 'desc']],
                pageLength: 10,
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                columns: [
                    { data: 'contact', name: 'name', orderable: true, searchable: true },
                    { data: 'subject', name: 'subject', orderable: true, searchable: true },
                    { data: 'status', name: 'status', orderable: true, searchable: false },
                    { data: 'created_at', name: 'created_at', orderable: true, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                language: {
                    search: 'Search messages:',
                    emptyTable: 'No contact messages yet.',
                    zeroRecords: 'No matching contact messages found.',
                    processing: 'Loading messages...',
                },
            });
        });
    </script>
@endpush
