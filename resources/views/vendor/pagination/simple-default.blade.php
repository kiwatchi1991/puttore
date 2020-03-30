<div class="c-paging">
    @if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="disabled" aria-disabled="true">
            <span class="c-pagination__prev inactive"><i class="fas fa-angle-left c-pagination__prev--angle"></i></span>
        </li>

        @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <span class="c-pagination__prev"><i class="fas fa-angle-left c-pagination__prev--angle"></i></span>
            </a>
        </li>
        @endif

        <span class="c-pagination__count">{{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} /
            {{ $paginator->total() }}</span>


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                <span class="c-pagination__next"><i class="fas fa-angle-right c-pagination__next--angle"></i></span>
            </a>
        </li>
        @else
        <li class="disabled" aria-disabled="true">
            <span class="c-pagination__next inactive"><i
                    class="fas fa-angle-right c-pagination__next--angle"></i></span>
        </li>
        @endif
    </ul>
    @else
    全 <span> {{ $paginator->lastItem() }} 件 </span>
    @endif
</div>