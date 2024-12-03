{{-- @extends('layout.front-index')
@section('title','Contact Us')

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
	      	@if(getReffrel())
            <p class="breadcrumb-item"><a href="{{getReffrel()['url']}}">{{getReffrel()['name']}}</a></p>&nbsp&nbsp&nbsp:
          @endif
	        <p class="breadcrumb-item"><a href="{{url('contact-us')}}">Contact us</a></p>
	      </span>
	      <a href="{{ url()->previous() }}" class="read_all"><p>back</p></a>
	    </div>
	  </div>
	</section>
	<section class="product_video">
	  <div class="container">
	    <div class="big_text big_flex" style="margin-bottom: 10px">
	      <a href="#" class="orange-title">Contact Us</a>
	      <span>  {{ isset($pageData->page_title)?$pageData->page_title:'' }}
              <div class="product_title"  @if(session('LoggedUser'))
                                            data-link="{{route('admin.contact-page.editor')}}"
                                        @endif></div>
             </span>
	    </div>
	  </div>
	</section>
	<section class="map_sec">
	  <div class="container">
	    <div class="map_blk">
	      <div class="map_item">
	        <div class="full_map">
	          <!-- <iframe width="1920"height="472"frameborder="0"scrolling="no"marginheight="0"marginwidth="0"src="https://www.google.com/maps/place/Giant+Inflatables+Asia/@22.2862297,73.128362,20.38z/data=!4m5!3m4!1s0x0:0x911551eaf654eefb!8m2!3d22.2861971!4d73.1283451"></iframe> --> 
	          <a href="https://www.google.com/maps/place/27+Woodlands+Dr,+Braeside+VIC+3195,+Australia/@-37.989998,145.117691,13z/data=!4m5!3m4!1s0x6ad66cddb5a512c1:0xaf6e978c76351aff!8m2!3d-37.989998!4d145.117691" target="_blank">
						<img src="{{asset('sardar')}}/img/gii-map.jpg" >
					</a>
	        </div>
	      </div>
	      <div class="map_item">
	        <img src="{{url('sardar')}}/images/logo.png" alt="call" class="img1300" />
	        <p>
	          <i class="fa fa-phone"></i
	          ><a href="tel:{{getSocialMedia()->phone}}" class="call">{{getSocialMedia()->phone}}</a>
	        </p>
	        <p>
	          <i class="fa fa-envelope-o"></i
	          ><a href="mailto: {{getSocialMedia()->email}}" class="mail"
	            >{{getSocialMedia()->email}}</a
	          >
	        </p>
	        <p>
	          <i class="fa fa-map-marker"></i><a href="#">{{getSocialMedia()->address}}</a>
	        </p>
	        <div class="social_icon">
	        	@if(isset(getSocialMedia()->facebook))
	          <a href="{{getSocialMedia()->facebook}}"> <img src="{{url('sardar')}}/images/bluefb.png" alt="facebook" /></a>
	          @endif
	          @if(isset(getSocialMedia()->twitter))
	          <a href="{{getSocialMedia()->twitter}}"><img src="{{url('sardar')}}/images/bluetwiter.png" alt="twitter" /></a>
	          @endif
	          @if(isset(getSocialMedia()->youtube))
	          <a href="{{getSocialMedia()->youtube}}"><img src="{{url('sardar')}}/images/blueyoutube.png" alt="youtube" /></a>
	          @endif
	          @if(isset(getSocialMedia()->linkedin))
	          <a href="{{getSocialMedia()->linkedin}}"> <img src="{{url('sardar')}}/images/bluein.png" alt="linkedin" /></a>
	          @endif
	        </div>
	        <span class="map_span">
	          <a href="{{route('sitemap')}}">Sitemap</a> &nbsp;|&nbsp;
	          <a href="#">Privacy Policy</a>
	        </span>
	      </div>
	      <div class="map_item">
	        @include('widget.contact-form1')
	      </div>
	    </div>
	  </div>
	</section>
	<section class="description">
  <div class="container">
    <div class="description_wrap">
      <div class="description_blk_item">
        {!! html_entity_decode($pageData->description) !!}
      </div>
      </div>
  </div>
</section>
	<section class="banner_slider banner_margin">
	  <div class="container">
	    @include('widget.industries-serve-with-title')
	  </div>
	</section>
</div>
@endsection --}}

<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    {{-- Try to load 'head' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.head', 'ext.head'])

    {{-- Additional theme-specific CSS --}}
    @yield('addon-css')
</head>

<body class="lazyload pr-0">
	<?php $current_page = '';
	$homeLink = App\Models\admin\UrlList::find(95);  // Home link ?>

	@includeFirst(['theme::ext.header-sports-vertical', 'ext.header-sports-vertical'])

	<section class="contact-banner-section common-inner-banner header-top-space position-relative">
		<div class="bg-img-wrap">
		  <img class="bg-img-top opacity-50" src="{{asset('/')}}/dubai/images/about-banner.webp" alt="about-banner">
		</div>
		<div class="container position-relative">
		  <div class="breadcrumb">
			<div class="breadcrumb-left">
			  <a href="{{ $homeLink->url }}" class="header-top-home d-flex align-items-center text-uppercase">
				<img class="me-2" src="{{asset('/')}}/dubai/images/home-icon.png" alt="home-icon">Home
			  </a>
			  <span class="text-uppercase">Contact</span>
			</div>
			<a href="{{ url()->previous() }}" class="breadcrumb-back text-uppercase">Back<img src="{{asset('/')}}/dubai/images/right-arrow-circle.svg" alt="right-arrow-circle"></a>
		  </div>
		  <div class="contact-section">
			<div class="container">
			  <div class="theme-stroke-heading text-center text-uppercase">
				<strong class="letters">Get In Touch</strong>
				<h3 class="h3 letters">Get In <span>Touch</span></h3>
			  </div>
			</div>
			<div class="container position-relative pt-4">
			  <div class="d-flex flex-sm-nowrap flex-wrap justify-content-center gap-md-4 gap-3">
				<div class="share-concept-form-box wow flipInY" data-wow-offset="200">
				  <img class="w-full" src="{{asset('/')}}/dubai/images/share-concept.png" alt="share-concept">

				  @include('widget.contact-form1')
				</div>
				<div class="contact-links-box text-center wow flipInY" data-wow-offset="200">
					<p>Award Winning Inflatable Designer & Manufacturer</p>
					<img src="{{asset('/')}}/dubai/images/logo.svg" alt="logo">
					<div class="mt-sm-4 mt-2 mb-2">
					  <a class="contact-link" href="tel:+919429613531"><img src="{{asset('/')}}/dubai/images/phone-icon.svg" alt="phone-icon"> +91 87587 13931</a>
					</div>
					<div class="mb-sm-4 mb-2">
					  <a class="contact-link" href="mailto:sales@giantinflatables.ae"><img src="{{asset('/')}}/dubai/images/mail-icon.svg" alt="mail-icon"> sales@giantinflatables.ae</a>
					</div>
					<div class="mb-2">
					  <a class="contact-social-link" href="#" target="_blank"><img src="{{asset('/')}}/dubai/images/facebook.png" alt="facebook-icon"></a>
					</div>
				  </div>
			  </div>
			</div>
		  </div>
		</div>
	  </section>

@includeFirst(['theme::ext.script', 'ext.script'])
@includeFirst(['theme::ext.footer', 'ext.footer'])
</div>
    @yield('custom-js')
</body>
</html>