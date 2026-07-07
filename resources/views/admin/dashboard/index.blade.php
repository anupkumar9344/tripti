@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
    <link href="{{ asset('admin/assets/css/admin-dashboard.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-1 admin-dashboard-hero">
        <div class="col-lg-8">
            <div class="card admin-dashboard-welcome overflow-hidden h-100">
                <div class="card-body p-4 d-flex align-items-center h-100">
                    <div class="row align-items-center w-100 g-3">
                        <div class="col-12 col-lg-7 min-w-0">
                            <span class="badge bg-light text-dark mb-2">Tripti Admin</span>
                            <h4 class="mb-2">Welcome back, {{ auth()->user()->name }}!</h4>
                            <p class="text-muted-light mb-0">
                                Live overview of hotel inventory, amenities, website content, contact messages, and recent activity.
                            </p>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="admin-dashboard-welcome-actions">
                                <a href="{{ url('/') }}" class="btn btn-light" target="_blank">
                                    <i class="ti ti-world me-1"></i> View Website
                                </a>
                                <a href="{{ route('admin.settings.general') }}" class="btn btn-outline-light">
                                    <i class="ti ti-settings me-1"></i> Settings
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card admin-dashboard-summary h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <p class="text-muted mb-0 fw-semibold">Total Managed Items</p>
                    <div class="summary-count">{{ number_format($totalContent) }}</div>
                    <p class="text-muted mb-1 font-13">Rooms, bookings, content, careers, and more.</p>
                    <p class="text-muted mb-0 font-13">
                        <span class="fw-semibold text-dark">{{ number_format($totalHotel) }}</span> hotel
                        <span class="mx-1">·</span>
                        <span class="fw-semibold text-dark">{{ number_format($totalWebsite) }}</span> website
                    </p>
                </div>
            </div>
        </div>
    </div>

    <p class="admin-dashboard-section-title mt-3 mb-0">Hotel Management</p>
    <div class="row admin-dashboard-stats g-3 mt-1 mb-0">
        @foreach ($hotelStats as $stat)
            <div class="col-xl-3 col-lg-6 col-md-6">
                <a href="{{ $stat['url'] }}" class="admin-dashboard-stat-link">
                    <div class="card admin-dashboard-stat mb-0">
                        <div class="card-body py-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="admin-dashboard-stat-icon tone-{{ $stat['tone'] }}">
                                    <i class="ti {{ $stat['icon'] }}"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="stat-label mb-0">{{ $stat['label'] }}</p>
                                    <div class="stat-count">{{ number_format($stat['count']) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <p class="admin-dashboard-section-title mt-4 mb-0">Website Content</p>
    <div class="row admin-dashboard-stats g-3 mt-1 mb-0">
        @foreach ($contentStats as $stat)
            <div class="col-xl-3 col-lg-6 col-md-6">
                <a href="{{ $stat['url'] }}" class="admin-dashboard-stat-link">
                    <div class="card admin-dashboard-stat mb-0">
                        <div class="card-body py-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="admin-dashboard-stat-icon tone-{{ $stat['tone'] }}">
                                    <i class="ti {{ $stat['icon'] }}"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="stat-label mb-0">{{ $stat['label'] }}</p>
                                    <div class="stat-count">{{ number_format($stat['count']) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="row g-4 mt-2">
        

        <div class="col-lg-6">
            <div class="card admin-dashboard-rooms mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">Room Types</h4>
                    <a href="{{ route('admin.room-types.index') }}" class="font-13">Manage <i class="ti ti-arrow-up-right"></i></a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse ($latestRoomTypes as $roomType)
                            <a href="{{ route('admin.room-types.edit', $roomType) }}" class="list-group-item list-group-item-action admin-dashboard-room-item">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $roomType->imageUrl() }}" alt="{{ $roomType->name }}" class="admin-dashboard-room-thumb rounded">
                                    <div class="flex-grow-1 min-w-0">
                                        <h6 class="mb-1 text-dark fw-semibold text-truncate">{{ $roomType->name }}</h6>
                                        <p class="mb-0 text-muted font-12">
                                            <i class="ti ti-bed me-1"></i>{{ $roomType->rooms_count }} room{{ $roomType->rooms_count === 1 ? '' : 's' }}
                                            <span class="mx-1">·</span>
                                            ₹{{ number_format((float) $roomType->fare) }}/night
                                        </p>
                                    </div>
                                    <span class="badge badge-soft-primary font-12">{{ $roomType->categoryLabel() }}</span>
                                </div>
                            </a>
                        @empty
                            <div class="list-group-item text-center text-muted py-4">No room types yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6">
            <div class="card admin-dashboard-blogs">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">Latest Blogs</h4>
                    <a href="{{ route('blog') }}" class="font-13" target="_blank">View All <i class="ti ti-arrow-up-right"></i></a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach ($latestBlogs as $blog)
                            <a href="{{ route('blog.show', $blog->slug) }}" class="list-group-item list-group-item-action admin-dashboard-blog-item" target="_blank">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $blog->featuredImageUrl() }}" alt="{{ $blog->title }}" class="admin-dashboard-blog-thumb rounded">
                                    <div class="flex-grow-1 min-w-0">
                                        <h6 class="mb-1 text-dark fw-semibold text-truncate">{{ $blog->title }}</h6>
                                        <p class="mb-0 text-muted font-12">
                                            <i class="ti ti-calendar me-1"></i>{{ $blog->formattedDate() }}
                                            <span class="mx-1">·</span>
                                            {{ $blog->author }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-0">
            <div class="card mt-0">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">Latest Contact</h4>
                    <a href="{{ route('admin.contacts.index') }}" class="badge badge-soft-primary text-decoration-none">{{ $newContactCount }} New</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle admin-dashboard-contacts">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latestContacts as $contact)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.contacts.show', $contact) }}" class="text-dark text-decoration-none">
                                                <span class="fw-semibold d-block">{{ $contact->name }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <span class="d-block font-13">{{ $contact->email }}</span>
                                            <span class="text-muted font-12">{{ $contact->phone }}</span>
                                        </td>
                                        <td>{{ $contact->subject ?: '—' }}</td>
                                        <td class="text-nowrap font-13">{{ $contact->created_at?->format('d M Y, h:i A') }}</td>
                                        <td>
                                            @if ($contact->status === 'new')
                                                <span class="badge badge-soft-success">New</span>
                                            @else
                                                <span class="badge badge-soft-secondary">Read</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No contact messages yet.</td>
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
