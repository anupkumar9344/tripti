<section class="section-breadcrumb">
    <div class="rx-breadcrumb-image">
        <div class="rx-breadcrumb-overlay"></div>
        <div class="inner-breadcrumb-contact">
            <div class="main-breadcrumb-contact">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="rx-banner-contact">
                                <h2>{{ $breadcrumbTitle ?? 'Page' }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rx-banner-breadcrumb">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-contact">
                                <div class="main-heading">
                                    <h4>{{ $breadcrumbTitle ?? 'Page' }}</h4>
                                </div>
                                <div class="last-contact">
                                    <ul>
                                        <li><a href="{{ url('/') }}">Home</a></li>
                                        @if(!empty($breadcrumbParent))
                                            <li><a href="{{ $breadcrumbParentUrl ?? '#' }}">{{ $breadcrumbParent }}</a></li>
                                        @endif
                                        <li>{{ $breadcrumbTitle ?? 'Page' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
