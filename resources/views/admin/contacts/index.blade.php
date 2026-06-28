@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
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
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_contacts">
                            <thead class="thead-light">
                                <tr>
                                    <th>Contact</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>
                                            @include('admin.contacts.partials.contact-cell', ['contact' => $contact])
                                        </td>
                                        <td>{{ $contact->subject ?: '—' }}</td>
                                        <td>
                                            @if ($contact->status === 'new')
                                                <span class="badge badge-soft-success">New</span>
                                            @else
                                                <span class="badge badge-soft-secondary">Read</span>
                                            @endif
                                        </td>
                                        <td class="text-nowrap font-13">{{ $contact->created_at?->format('d M Y, h:i A') ?? '—' }}</td>
                                        <td>
                                            @include('admin.contacts.partials.actions', ['contact' => $contact])
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
            const table = document.querySelector('#datatable_contacts');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search messages...',
                        noRows: 'No contact messages yet.',
                        noResults: 'No matching contact messages found.',
                    },
                });
            }
        });
    </script>
@endpush
