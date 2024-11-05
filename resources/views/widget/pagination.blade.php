@if ($paginator->hasPages())
<!-- Pagination -->
  <ul id="pagination">
    @if ($paginator->onFirstPage())
        <li class="disabled">
          <a aria-label="Previous">
            «
          </a>
        </li>
    @else
        <li class="page-item ml-0">
          <a href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
            «
          </a>
        </li>
    @endif


  
    @foreach ($elements as $element)
       
        @if (is_string($element))
          <li class="page-item disabled"><a href="{{ $url }}">{{ $element }}</a></li>
        @endif
       
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item"><a class="active" href="{{ $url }}">{{ $page }}</a></li>
                @else
                    <li class="page-item"><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach


    
    @if ($paginator->hasMorePages())
        <li class="page-item">
          <a href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
            »
          </a>
        </li>
    @else
        <li class="page-item disabled">
          <a href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
            »
          </a>
        </li>
    @endif
  </ul>
<!-- End Pagination -->
@else
<ul id="pagination">
  <li><a class="" href="#">«</a></li>
  <li><a href="#" class="active">1</a></li>
  <li><a href="#">»</a></li>
</ul>
@endif 