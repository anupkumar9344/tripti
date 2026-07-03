@extends('layouts.app')

@section('title', 'Our Expert Team | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Our Team'])

    <section class="team-page-section padding-t-50 padding-b-100">
        <div class="container">
            <div class="team-page-header text-center" data-aos="fade-up" data-aos-duration="1000">
                <span class="team-page-eyebrow">{{ $pageEyebrow }}</span>
                <h1 class="team-page-title">{{ $pageTitle }}</h1>
                <p class="team-page-intro">{{ $pageIntro }}</p>
            </div>

            @if ($experts->isNotEmpty())
                <div class="team-page-stats" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <div class="team-page-stat">
                        <strong>{{ $experts->count() }}</strong>
                        <span>Team Members</span>
                    </div>
                    @if ($specialties->isNotEmpty())
                        <div class="team-page-stat">
                            <strong>{{ $specialties->count() }}</strong>
                            <span>Departments</span>
                        </div>
                    @endif
                    <div class="team-page-stat">
                        <strong>24/7</strong>
                        <span>Guest Support</span>
                    </div>
                </div>

                @if ($specialties->count() > 1)
                    <div class="team-page-filters text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                        <button type="button" class="team-page-filter is-active" data-team-filter="all">All Team</button>
                        @foreach ($specialties as $specialty)
                            <button type="button" class="team-page-filter" data-team-filter="{{ \Illuminate\Support\Str::slug($specialty) }}">
                                {{ $specialty }}
                            </button>
                        @endforeach
                    </div>
                @endif

                <div class="row g-4" id="teamMembersGrid">
                    @foreach ($experts as $index => $expert)
                        <div class="col-lg-4 col-md-6 team-page-col"
                            data-team-specialty="{{ $expert->specialty ? \Illuminate\Support\Str::slug($expert->specialty) : 'general' }}"
                            data-aos="fade-up"
                            data-aos-duration="1000"
                            data-aos-delay="{{ ($index % 3) * 100 }}">
                            @include('partials.team-card', ['expert' => $expert])
                        </div>
                    @endforeach
                </div>

                <div class="team-page-cta text-center" data-aos="fade-up" data-aos-duration="1000">
                    <p>Need help planning your stay or a special event?</p>
                    <div class="team-page-cta-actions">
                        <a href="{{ route('contact') }}" class="team-page-cta-btn team-page-cta-btn--outline">Contact Us</a>
                        <a href="javascript:void(0)" class="team-page-cta-btn" data-bs-toggle="modal" data-bs-target="#rx_booking_from">Book Now</a>
                    </div>
                </div>
            @else
                <div class="team-page-empty text-center" data-aos="fade-up" data-aos-duration="1000">
                    <p>Team profiles will appear here once added from the admin panel.</p>
                    <a href="{{ route('contact') }}" class="team-page-cta-btn">Contact Us</a>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filters = document.querySelectorAll('[data-team-filter]');
            const columns = document.querySelectorAll('.team-page-col');

            if (!filters.length || !columns.length) {
                return;
            }

            filters.forEach(function (button) {
                button.addEventListener('click', function () {
                    const value = button.getAttribute('data-team-filter');

                    filters.forEach(function (item) {
                        item.classList.toggle('is-active', item === button);
                    });

                    columns.forEach(function (column) {
                        const specialty = column.getAttribute('data-team-specialty');
                        const show = value === 'all' || specialty === value;
                        column.classList.toggle('is-hidden', !show);
                    });
                });
            });
        });
    </script>
@endpush
