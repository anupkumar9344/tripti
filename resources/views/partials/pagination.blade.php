@if ($paginator->hasPages())
    <div class="col-lg-12">
        <div class="page-pagination wow fadeInUp">
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li><span aria-hidden="true"><i class="fa-solid fa-arrow-left-long"></i></span></li>
                @else
                    <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page"><i class="fa-solid fa-arrow-left-long"></i></a></li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li><span>{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page"><i class="fa-solid fa-arrow-right-long"></i></a></li>
                @else
                    <li><span aria-hidden="true"><i class="fa-solid fa-arrow-right-long"></i></span></li>
                @endif
            </ul>
        </div>
    </div>
@endif
