@extends('admin.layouts.app')

@section('title', 'Rooms - '.$roomType->name)

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.room-types.rooms.create', $roomType) }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Room
                    </a>
                </div>
                <h4 class="page-title">Rooms — {{ $roomType->name }}</h4>
                <p class="text-muted mb-0 font-13">
                    <a href="{{ route('admin.room-types.index') }}">Room Types</a> / {{ $roomType->name }}
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_rooms">
                            <thead class="thead-light">
                                <tr>
                                    <th>Room No.</th>
                                    <th>Floor</th>
                                    <th>Bed Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rooms as $room)
                                    <tr>
                                        <td class="fw-semibold">{{ $room->room_number }}</td>
                                        <td>{{ $room->floor ?: '—' }}</td>
                                        <td>{{ $room->bedType?->name ?: '—' }}</td>
                                        <td>
                                            @if ($room->status)
                                                <span class="badge badge-soft-success">Enabled</span>
                                            @else
                                                <span class="badge badge-soft-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="admin-table-actions">
                                                <a href="{{ route('admin.room-types.rooms.edit', [$roomType, $room]) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                    <i class="las la-pen"></i>
                                                </a>
                                                <form
                                                    action="{{ route('admin.room-types.rooms.toggle-status', [$roomType, $room]) }}"
                                                    method="POST"
                                                    class="js-confirm-toggle d-inline"
                                                    data-title="{{ $room->status ? 'Disable room?' : 'Enable room?' }}"
                                                    data-text="{{ $room->status ? 'This room will be disabled and unavailable for booking.' : 'This room will be enabled again.' }}"
                                                    data-confirm-text="{{ $room->status ? 'Yes, disable' : 'Yes, enable' }}"
                                                    data-confirm-variant="{{ $room->status ? 'danger' : 'success' }}"
                                                >
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $room->status ? 'danger' : 'success' }}">
                                                        <i class="las la-{{ $room->status ? 'ban' : 'check' }}"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.room-types.rooms.destroy', [$roomType, $room]) }}" method="POST" class="js-confirm-delete d-inline" data-title="Delete room?" data-text="This room will be permanently removed.">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                        <i class="las la-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No rooms added yet for this room type.</td>
                                    </tr>
                                @endforelse
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
            const table = document.querySelector('#datatable_rooms');
            if (table && table.querySelector('tbody tr td[colspan]') === null) {
                new simpleDatatables.DataTable(table, { searchable: true, fixedHeight: false, perPage: 10 });
            }
        });
    </script>
@endpush
