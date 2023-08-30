@if ($paginator->hasPages())
    <ul class="pager clearfix">
        @if ($paginator->onFirstPage())
            <li class="prev"><a href="javascript:void()">Précédant</a></li>
        @else
            <li class="prev"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">Précédant</a></li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><a href="javascript:void()">{{ $element }}</a></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a href="javascript:void()">{{ $page }}</a></li>
                    @else
                        <li class="li"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li class="next"><a href="{{ $paginator->nextPageUrl() }}">Suivant</a></li>
        @else
            <li class="next"><a href="javascript:void()">Suivant</a></li>
        @endif
    </ul>
@endif 