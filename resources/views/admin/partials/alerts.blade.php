@if (session('success') || session('danger') || session('warning') || session('error'))
    <div class="admin-alerts mt-2">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('danger') || session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                {{ session('danger') ?? session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
@endif
