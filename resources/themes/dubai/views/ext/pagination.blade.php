@if ($paginator->hasPages())

<!-- Pagination -->

  <ul>

    @if ($paginator->onFirstPage())

        <li class="prev">

          <a aria-label="Previous">

            «

          </a>

        </li>

    @else

        <li class="prev">

          <a href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">

            «

          </a>

        </li>

    @endif





  

    @foreach ($elements as $element)

       

        @if (is_string($element))

          <li ><a href="{{ $url }}">{{ $element }}</a></li>

        @endif

       

        @if (is_array($element))

            @foreach ($element as $page => $url)

                @if ($page == $paginator->currentPage())

                    <li class="active"><a class="active" href="{{ $url }}">{{ $page }}</a></li>

                @else

                    <li class="active"><a href="{{ $url }}">{{ $page }}</a></li>

                @endif

            @endforeach

        @endif

    @endforeach





    

    @if ($paginator->hasMorePages())

        <li class="next">

          <a href="{{ $paginator->nextPageUrl() }}" aria-label="Next">

            »

          </a>

        </li>

    @else

        <li class="next">

          <a href="{{ $paginator->nextPageUrl() }}" aria-label="Next">

            »

          </a>

        </li>

    @endif

  </ul>

<!-- End Pagination -->

@else

<ul>
                      <li class="prev"><a >‹</a></li>
                      <li><span>Page</span></li>
                      <li class="active"><span>1</span></li>
                      <li class="next"><a >›</a></li>
                    </ul>

@endif 