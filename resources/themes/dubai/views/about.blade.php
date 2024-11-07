@includeFirst(['theme::front-index', 'front-index'])
@section('title','About Us')

@section('custom-js')
<script>
	

// 	$(document).ready(function () {
//   $( ".lazyload" ).css('overflow', 'auto');
//   $( ".loader" ).hide();
// });


  
function goBack() {
  window.history.back();
}


	$(".about").addClass( "active");
</script>

@endsection
@section('content')
<?php 
$industriesPageData = getPageData('industrie_page');
?>
<div class="our_product product_detail">
	<section class="back">
	  <div class="container">
	    <div class="back_sec">
	    	<span >home &nbsp; :
          @if(getReffrel())
              <p class="breadcrumb-item"><a href="{{getReffrel()['url']}}">{{getReffrel()['name']}}</a></p>&nbsp&nbsp&nbsp:
          @endif
          <p class="breadcrumb-item"><a href="{{ url('about') }}">About</a></p>
        </span>
        <a href="{{ url()->previous() }}" class="read_all"><p>back</p></a>
	      <!-- <span
	        >home &nbsp; :
	        <p>About</p></span
	      >
	      <a class="read_all" href="{{ url()->previous() }}"><p>back</p></a> -->
	    </div>
	  </div>
	</section>
	<section class="case_explore">
	  <div class="container">
	    <div class="big_text big_flex">
	      <a href="#" class="orange-title">about us</a>
	      <span>  {{ $pageData->page_title }}
		      <div class="product_title"  @if(session('LoggedUser'))
		                                    data-link="{{route('admin.about-page.editor')}}"
		                                @endif></div>
		     </span>
	    </div>
		

	    <div class="inner_tab_blk">
	      <div class="inner_tab_blk_right">
	        <div class="description">
	          <div class="description_wrap">
	            <div class="big_text gallert_text TopContent" style="margin-top: 30px; margin-bottom: 0px" @if(session('LoggedUser'))
								data-link="{{route('admin.about-page.editor')}}"
							@endif>
	              <a href="#">about us</a>
	            </div>
	            <div class="description_blk">
	              <div class="description_blk_item">
	                <p>
	                  {!! $pageData->description !!}
	                </p>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      <div class="inner_tab_blk_left">
	       @include('widget.contact-form1')
	      </div>
	    </div>
	  </div>
	</section>
	<section class="client_slider update_text" style="margin-top: 50px">
    <div class="container">
      <div class="client_line">
        @include('widget.client-slider2')
        @include('widget.awards-slider')
      </div>
    </div>
  </section>
  <section class="gray">
	  <div class="container">
	    @include('widget.experts')
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