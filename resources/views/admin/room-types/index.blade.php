@extends('admin.layouts.app')

@section('title', 'Room Types')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.room-types.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add New
                    </a>
                </div>
                <h4 class="page-title">All Room Types</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_room_types">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Fare</th>
                                    <th>Adult</th>
                                    <th>Child</th>
                                    <th>Featured</th>
                                    <th>Room / Suite</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roomTypes as $roomType)
                                    <tr>
                                        <td>
                                            <img src="{{ $roomType->imageUrl() }}" alt="{{ $roomType->name }}" height="40" width="56" class="rounded me-2 object-fit-cover">
                                            <span class="align-middle fw-semibold">{{ $roomType->name }}</span>
                                        </td>
                                        <td>₹{{ number_format($roomType->fare, 2) }}</td>
                                        <td>{{ $roomType->max_adults }}</td>
                                        <td>{{ $roomType->max_children }}</td>
                                        <td>
                                            @if ($roomType->is_featured)
                                                <span class="badge badge-soft-primary">Featured</span>
                                            @else
                                                <span class="badge badge-soft-secondary">Unfeatured</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-{{ $roomType->category === 'suite' ? 'info' : 'warning' }}">{{ ucfirst($roomType->category) }}</span>
                                        </td>
                                        <td>
                                            @if ($roomType->status)
                                                <span class="badge badge-soft-success">Enabled</span>
                                            @else
                                                <span class="badge badge-soft-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="admin-table-actions">
                                                <a href="{{ route('admin.room-types.rooms.index', $roomType) }}" class="btn btn-sm btn-outline-primary btn-with-label" title="Manage Rooms">
                                                    <i class="ti ti-home-2 me-1"></i>Rooms ({{ $roomType->rooms_count }})
                                                </a>
                                                <a href="{{ route('admin.room-types.edit', $roomType) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                    <i class="las la-pen"></i>
                                                </a>
                                                <form
                                                    action="{{ route('admin.room-types.toggle-status', $roomType) }}"
                                                    method="POST"
                                                    class="js-confirm-toggle d-inline"
                                                    data-title="{{ $roomType->status ? 'Disable room type?' : 'Enable room type?' }}"
                                                    data-text="{{ $roomType->status ? 'This room type will be disabled and hidden from booking.' : 'This room type will be enabled again.' }}"
                                                    data-confirm-text="{{ $roomType->status ? 'Yes, disable' : 'Yes, enable' }}"
                                                    data-confirm-variant="{{ $roomType->status ? 'danger' : 'success' }}"
                                                >
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $roomType->status ? 'danger' : 'success' }}">
                                                        <i class="las la-{{ $roomType->status ? 'ban' : 'check' }}"></i>
                                                    </button>
                                                </form>
                                            </div>
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
            const table = document.querySelector('#datatable_room_types');
            if (table) {
                new simpleDatatables.DataTable(table, { searchable: true, fixedHeight: false, perPage: 10 });
            }
        });
    </script>
@endpush
