@extends('layout.front-index')
@section('title','About Us')

@section('custom-js')

<script>
function goBack() {
  window.history.back();
}
</script>
@endsection
@section('content')

<div class="our_product product_detail">
	<section class="back">
	  <div class="container">
	    <div class="back_sec">
	      <span>home &nbsp; :
	        <!-- <p>partners</p> -->
          @if(getReffrel())
            <p class="breadcrumb-item"><a href="{{getReffrel()['url']}}">{{getReffrel()['name']}}</a></p>&nbsp&nbsp&nbsp:
          @endif
          <p class="breadcrumb-item"><a href="{{ url('partners') }}">partners</a></p>
        </span>
	      <a href="{{ url()->previous() }}" class="read_all"><p>back</p></a>
	    </div>
	  </div>
	</section>
  
  <section class="product_video case_studies">
    <div class="container">
      <div class="big_text big_flex">
        
        <a href="#" class="orange-title">Partners</a>
        <span>  {{ isset($pageData->page_title)?$pageData->page_title:'' }}
              <div class="product_title"  @if(session('LoggedUser'))
                                          data-link="{{route('admin.partners-page.editor')}}"
                                      @endif></div>
                                      <div class="description_blk_item">
                    <p>{!! $pageData->description !!}</p>
                  </div>  
            </span>
      </div>
      <div class="video_product update_blk_item">
        <div class="client_line">
          @foreach($partenrs as $partenr)
          <div class="update_item">
            <h2 style="@if(session('LoggedUser')) display: flex;
              @endif">{{addEllipsis($partenr->title, 60, '...')}}<div class="onscreen_video_popup_block" @if(session('LoggedUser'))
                data-link="{{route('partners.edit', $partenr->id)}}"
                data-delete-link="{{route('admin.index')}}/partners/delete/{{ $partenr->id}}"
              @endif></div></h2>
            <a class="update_inner match" href="{{url('partners')}}/{{$partenr->slug}}">
              <img src="{{url('')}}/images/{{$partenr->image}}" />
              <p>
                {{$partenr->short_description}}
                <span
                  ><img src="{{ url('') }}/images/osearch.png" /> &nbsp; click to
                  view</span
                >
              </p>
            </a>
          </div>
          @endforeach
        </div>
      </div>
      {{ $partenrs->links("widget.pagination") }}
    </div>
  </section>

  <section class="banner_slider banner_margin">
    <div class="container">
      @include('widget.industries-serve-with-title')
    </div>
  </section>
  <!-- gray part -->
  <section class="gray">
    <div class="container">
      @include('widget.experts')
    </div>
  </section>

  <section class="update_slider update_left" style="margin-top: 50px">
    <div class="container">
      <div class="client_line">
          @include('widget.newsleters-slider')
          @include('widget.casestudy-slider')
      </div>
    </div>
  </section>
</div>
@endsection