@if ($paginator->hasPages())
    <div class="ep-pages">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li>
                <a href="javascript:;" style="cursor:not-allowed;" title="第一页">第一页</a>
            </li>
            <li>
                <a href="javascript:;" style="cursor:not-allowed;" title="上一页">上一页</a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->url(1) }}" title="第一页">第一页</a>
            </li>
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" title="上一页">上一页</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li>
                    <a href="javascript:;" style="cursor:not-allowed;" title="{{ $element }}">{{ $element }}</a>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                            <a class="current" href="javascript:;">{{ $page }}</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" title="下一页">下一页</a>
            </li>
        @else
            <li>
                <a href="javascript:;" style="cursor:not-allowed;" title="下一页">下一页</a>
            </li>
        @endif

        <div class="page-msg">共{{ $paginator->total() }}条数据,每页{{ $paginator->perPage() }}条,共{{ $paginator->lastPage() }}页</div>
    </div>
@endif
