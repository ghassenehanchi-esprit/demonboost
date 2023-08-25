
<style>
.custom-pagination {
  list-style: none;
  margin: 0;
  padding: 0;
}

.custom-pagination li {
  display: inline-block;
  margin-right: 5px;
}

.custom-pagination li a,
.custom-pagination li span {
  font-size: 14px;
  display: inline-block;
  padding: 5px 10px;
  text-decoration: none;
  color: #8a8a8a;
  border: 1px solid #f0e9ff;
  border-radius: 3px;
}

.custom-pagination li.active span {
  background-color: #fbf9ff;
  border-color: #f0e9ff;
  color: #888888;
}

.custom-pagination li.disabled span,
.custom-pagination li.disabled a {
  color: #8a8a8a;
  pointer-events: none;
  cursor: default;
}



    </style>

<ul class="custom-pagination">
    @if ($paginator->onFirstPage())
        <li class="disabled"><span>&laquo;</span></li>
    @else
        <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
    @endif

    {{-- Pagination elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
    @else
        <li class="disabled"><span>&raquo;</span></li>
    @endif
</ul>
