@extends('admin.layouts.app')

@section('title', 'Promo Codes')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    @include('admin.partials.page-add-button', [
                        'permission' => 'promo-codes.create',
                        'url' => route('admin.promo-codes.create'),
                        'label' => 'Add New',
                    ])
                </div>
                <h4 class="page-title">Promo Codes</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_promo_codes">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 80px;">S.N.</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Usage</th>
                                    <th>Validity</th>
                                    <th>Status</th>
                                    <th>Default</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promoCodes as $promoCode)
                                    @php
                                        $statusLabel = $promoCode->statusLabel();
                                        $statusClass = match ($statusLabel) {
                                            'Active' => 'badge-soft-success',
                                            'Scheduled' => 'badge-soft-info',
                                            'Expired', 'Exhausted' => 'badge-soft-warning',
                                            default => 'badge-soft-danger',
                                        };
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $promoCode->code }}</strong></td>
                                        <td>{{ $promoCode->name }}</td>
                                        <td>{{ $promoCode->discount_type === 'percent' ? 'Percent' : 'Flat' }}</td>
                                        <td>{{ $promoCode->discount_type === 'percent' ? $promoCode->discount_value.'%' : '₹'.$promoCode->discount_value }}</td>
                                        <td>{{ $promoCode->usageSummary() }}</td>
                                        <td>
                                            @if ($promoCode->starts_at || $promoCode->ends_at)
                                                <div class="small">
                                                    @if ($promoCode->starts_at)
                                                        <div>From: {{ $promoCode->starts_at->format('d M Y, h:i A') }}</div>
                                                    @endif
                                                    @if ($promoCode->ends_at)
                                                        <div>To: {{ $promoCode->ends_at->format('d M Y, h:i A') }}</div>
                                                    @endif
                                                </div>
                                            @else
                                                Always
                                            @endif
                                        </td>
                                        <td><span class="badge {{ $statusClass }}">{{ $statusLabel }}</span></td>
                                        <td>{{ $promoCode->is_default ? 'Yes' : 'No' }}</td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'permissionPrefix' => 'promo-codes',
                                                'editUrl' => route('admin.promo-codes.edit', $promoCode),
                                                'deleteUrl' => route('admin.promo-codes.destroy', $promoCode),
                                                'deleteTitle' => 'Delete promo code?',
                                                'deleteText' => 'This promo code will be permanently removed.',
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
            const table = document.querySelector('#datatable_promo_codes');
            if (table) {
                new simpleDatatables.DataTable(table, { searchable: true, fixedHeight: false, perPage: 10 });
            }
        });
    </script>
@endpush
