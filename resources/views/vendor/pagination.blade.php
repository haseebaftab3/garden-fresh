@if ($paginator->hasPages())
    <nav class="pagination__wrap mt-50">
        <ul class="list-wrap">
            <!-- Previous Page Link -->
            @if ($paginator->onFirstPage())
                <li class="link-arrow disabled">
                    <a href="#"><img src="assets/img/icon/pagination_icon01.svg" alt="Previous"></a>
                </li>
            @else
                <li class="link-arrow">
                    <a href="{{ $paginator->previousPageUrl() }}"><img src="assets/img/icon/pagination_icon01.svg"
                            alt="Previous"></a>
                </li>
            @endif

            <!-- Pagination Elements -->
            @foreach ($elements as $element)
                <!-- "Three Dots" Separator -->
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                <!-- Array of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="#">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <li class="link-arrow">
                    <a href="{{ $paginator->nextPageUrl() }}"><img src="assets/img/icon/pagination_icon02.svg"
                            alt="Next"></a>
                </li>
            @else
                <li class="link-arrow disabled">
                    <a href="#"><img src="assets/img/icon/pagination_icon02.svg" alt="Next"></a>
                </li>
            @endif
        </ul>
    </nav>
@endif
