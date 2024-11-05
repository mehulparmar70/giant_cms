@extends('layout.front-index')
@section('title','Videos')
<style>
.modal-header {
    border: 0px !important;
    padding-bottom: 0px !important;
}
.modal-body {
    padding-top: 0px !important;
}


</style>

@section('custom-js')
<script>
	$(".video").addClass( "active");
	$(".video-modal");



$(document).ready(function () {
  $( ".lazyload" ).css('overflow', 'auto');
  $( ".loader" ).hide();
});
	
function goBack() {
  window.history.back();
}

	$(".video-modal").click(function(){
    var data_image = $(this).attr('data-iframe');
    var data_title = $(this).attr('data-title');
    var data_short_description = $(this).attr('data-short_description');
    

	$('body').css({'padding': '0px'});

		$('.video-body').html(data_image);
		$('.card-title').html(data_title);
		$('.short-description').html(data_short_description);
		
	});  

</script>


@endsection
@section('content')
<div class="our_product product_detail">
	<section class="back">
      <div class="container">
        <div class="back_sec">
          <span>home &nbsp; :
            @if(getReffrel())
                <p class="breadcrumb-item"><a href="{{getReffrel()['url']}}">{{getReffrel()['name']}}</a></p>&nbsp&nbsp&nbsp:
            @endif
            <p class="breadcrumb-item"><a href="{{ url('videos') }}">product videos</a></p>
          </span>
          <a href="{{ url()->previous() }}" class="read_all"><p>back</p></a>
        </div>
      </div>
  </section>
	<section class="product_video video_product_name">
	  <div class="container">
	    <div class="big_text big_flex">
	      <a href="#" class="orange-title">product videos</a>
	      <span>  {{ isset($pageData->page_title)?$pageData->page_title:'' }}
        	<div class="product_title"  @if(session('LoggedUser'))
                                      data-link="{{route('admin.video-page.editor')}}"
                                  @endif></div>
								  <div class="description_wrap">
                <div ></div>
                <div class="description_blk">
                  <div class="description_blk_item">
                    <p>{!! $pageData->description !!}</p>
                  </div>  
                </div>
            </div>
       </span>
	    </div>
	    <div class="video_product">
	    	@foreach($videos as $video)
	    	<?php 
          preg_match('/src="([^"]+)"/', $video->youtube_embed, $match);
          $url = array_slice(explode('/', $match[1]), -1)[0];
          $tumbnail = 'https://img.youtube.com/vi/'.$url.'/hqdefault.jpg';
          ?>
	      <div class="product_item">
	        <h4 style="@if(session('LoggedUser')) display: flex;
							@endif">{{$video->title}}<div class="onscreen_video_popup_block" @if(session('LoggedUser'))
								data-link="{{route('video.edit', $video->id)}}"
								data-delete-link="{{route('admin.index')}}/video/delete/{{ $video->id}}"
							@endif></div></h4>
	        <div class="video_text">
	          <div
	            class="video"
	            style="background-image: url('{{$tumbnail}}')"
	          >
	            <a data-fancybox="" href="{{ $match[1] }}">
	              <img src="{{url('sardar')}}/images/wvideo.png" />
	            </a>
	          </div>
	          <p>
	          	{!! html_entity_decode($video->short_description) !!}
	          </p>
	        </div>
	      </div>
	      @endforeach
	    </div>
	    {{ $videos->links("widget.pagination") }}
	  </div>
	</section>

	<section class="banner_slider banner_margin">
	  <div class="container">
	    @include('widget.industries-serve-with-title')
	  </div>
	</section>

	<section class="update_slider update_left">
    <div class="container">
      <div class="client_line">
        @include('widget.newsleters-slider')
        @include('widget.casestudy-slider')
      </div>
    </div>
  </section>
</div>
@endsection