
@section('toast')
 
@endsection

@if(session('LoggedUser'))
<style type="text/css">
  .product-video-div .onscreen-popup-title-link{
    background: white;
  }
  .product-video-div .active a{
    color: black !important;
  }
  .product_internal_title,.footer-partners-div .crud {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    padding: 4px 10px
    border: none;
    cursor: pointer;
    text-align: center;
    z-index: 99999999;
    background: white;
  }
</style>
@endif

	

	<section class="kiis">
		<div class="container">
			<div class="wrap_kiis">
			<div class="kiss_wrap">
				<div class="big_text mid_text">
				<a href="{{url('/videos')}}" >PRODUCT VIDEOS </a>
				</div>
				<div class="kiis_blk">
  				
				@foreach($videos as $video)
				<?php 
				preg_match('/src="([^"]+)"/', $video->youtube_embed, $match);
				
				$url = array_slice(explode('/', $match[1]), -1)[0];
				$tumbnail = 'https://img.youtube.com/vi/'.$url.'/hqdefault.jpg';
				?>
				<div href="#" class="kiis_item product-video-div">
					<section
					class="video"
					style="background-image: url('{{$tumbnail}}')"
					>
					<a data-fancybox href="{{ $match[1] }}">
						<img src="{{url('/')}}/images/video2.png" />
						<div class="onscreen_video_popup_block" 
							@if(session('LoggedUser'))
								data-create-link="{{ route('video.create') }}"
								data-edit-link="{{ route('video.edit', $video->id) }}" 
								data-delete-link="{{ route('video.delete', $video->id) }}"
								data-index-link="{{ route('video.index') }}"
							@endif>
						</div>

					</a>
					</section>
				</div>
				@endforeach
				</div>
				<a href="{{url('/videos')}}" class="read_all explore_all"><p>VIEW ALL</p></a>
			</div>
			<div class="kiss_wrap">
				<div class="big_text mid_text">
				<a href="{{ url('partners') }}">OUR PARTNERS</a>
				</div>
				<div class="kiis_blk footer-partners-div">
				@foreach($footerOurPartners as $partenr)
				<a href="{{url('partners')}}/{{$partenr->slug}}" class="kiis_item">
					<img src="{{url('/')}}/images/{{$partenr->image}}" />
					<!-- <div class="crud"></div> -->
					<div class="product_internal_title" @if(session('LoggedUser'))
                      data-create-link="{{route('partners.create')}}"
                      data-edit-link="{{route('partners.edit', $partenr->id)}}"
                      data-delete-link="{{route('admin.index')}}/partners/delete/{{ $partenr->id}}"
                      data-index-link="{{route('partners.index')}}"
                    @endif></div>
				</a>
				@endforeach
				</div>
				<a href="{{ url('partners') }}" class="read_all explore_all"><p>VIEW ALL</p></a>
			</div>
			<div class="kiss_wrap">
				<div class="big_text mid_text">
				<a href="{{ url('products') }}">LATEST PROJECT</a>
				</div>
				<div class="kiis_blk">
				@foreach(getMainCategories() as $key => $mainCategoryAll)
				@foreach(getSubCategories($mainCategoryAll->id) as $key => $topInflatableLp)
				<?php $imageName = getSubCategoryImages($topInflatableLp->id, 2, 'DESC')[0]['image']; ?>
				<a href="{{$topInflatableLp->slug}}" class="kiis_item">
					<img src="{{url('/')}}/images/{{$imageName}}" />
					<!-- <div class="product_internal_title"></div> -->
					<div class="product_internal_title" @if(session('LoggedUser'))
                      data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                      data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                      data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatableLp->id}}"
                      data-index-link="{{route('admin.category.list')}}"
                    @endif></div>
				</a>
				@endforeach
				@endforeach
				</div>
				<a href="{{ url('products') }}" class="read_all explore_all"><p>VIEW ALL</p></a>
			</div>
			</div>
		</div>
	</section>

<!-- map section -->
<section class="map_sec">
  <div class="container">
    <div class="map_blk">
      <div class="map_item">
        <div class="full_map">
		{!! html_entity_decode(getSocialMedia()->map_embed) !!}
        </div>
      </div>
      <div class="map_item">
        <img src="{{url('/')}}/images/logo.png" alt="call" class="img1300" />
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
          <a href="{{getSocialMedia()->facebook}}"> <img src="{{url('/')}}/images/bluefb.png" alt="facebook" /></a>
          @endif
          @if(isset(getSocialMedia()->twitter))
          <a href="{{getSocialMedia()->twitter}}"><img src="{{url('/')}}/images/bluetwiter.png" alt="twitter" /></a>
          @endif
          @if(isset(getSocialMedia()->youtube))
          <a href="{{getSocialMedia()->youtube}}"><img src="{{url('/')}}/images/blueyoutube.png" alt="youtube" /></a>
          @endif
          @if(isset(getSocialMedia()->linkedin))
          <a href="{{getSocialMedia()->linkedin}}"> <img src="{{url('/')}}/images/bluein.png" alt="linkedin" /></a>
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

	<section class="nav_1300">
		<div class="header_nav">
			<div class="container">
			<div class="navbar main_div">
				<ul class="ulclass">
				<li class="menu_crud" @if(session('LoggedUser'))
					data-link="{{route('admin.home.editor')}}"
					@endif><a href="{{url('')}}" class="home nav-item">HOME</a>
				</li>
				<li class="menu_crud" @if(session('LoggedUser'))
					data-link="{{route('admin.product-page.editor')}}?onscreenCms=true"
					@endif>
					<a href="{{url('products')}}" class="our_product_menu nav-item">OUR PRODUCTS </a>
				</li>
				<li class="menu_crud" @if(session('LoggedUser'))
					data-link="{{route('admin.about-page.editor')}}"
					@endif>
					<a class="item nav-item" href="{{url('about')}}">ABOUT</a>
				</li>
				<li class="menu_crud" @if(session('LoggedUser'))
					data-link="{{route('admin.casestudies-page.editor')}}"
					@endif><a href="{{url('case-studies')}}" class="nav-item case_studies_menu">CASE STUDIES</a></li>
				<li class="menu_crud nav-item" @if(session('LoggedUser'))
						data-link="{{route('admin.testimonial-page.editor')}}"
					@endif>
					<a href="{{url('testimonials')}}" class="item nav-item testimonials_menu"
					>TESTIMONIALS</a>
				</li>
				<li class="menu_crud" @if(session('LoggedUser'))
					data-link="{{route('admin.home.editor')}}"
					@endif><a class="nav-item" href="{{url('updates')}}">Updates</a></li>
				<li class="menu_crud " @if(session('LoggedUser'))
						data-link="{{route('admin.contact-page.editor')}}"
					@endif>
					<a href="{{url('contact-us')}}" class="item nav-item">CONTACT US</a></li>
				</ul>
			</div>
			</div>
		</div>
	</section>

	<footer class="footer" style="background-color: #eeeeee;">
		<div class="container">
			<div class="footer_blk">
			<div class="footer_item footer_width">
				<h2 class="social_footer" @if(session('LoggedUser'))
						data-link="{{route('setting.social-media')}}"
						@endif>Contact Us</h2>
				<img src="{{url('/')}}/img/{{getWebsiteOptions()['website_logo']->option_value}}" alt="Logo" class="img1300" />

				<p class="width_p">
				At Giant Inflatables Industrial we aim to replace the conventional
				with the extraordinary. Taking what industries have used for years
				and revolutionizing it into a product of efficiency, portability
				and productivity.
				</p>
				<p>
				<i class="fa fa-phone"></i
				><a href="tel:{{getSocialMedia()->phone}}" class="call">{{getSocialMedia()->phone}}</a>
				</p>
				<p>
				<i class="fa fa-envelope-o"></i
				><a
					href="mailto:{{getSocialMedia()->email}}"
					class="mail"
					>{{getSocialMedia()->email}}</a
				>
				</p>
				<p>
				<i class="fa fa-map-marker"></i
				><a href="#">{{getSocialMedia()->address}}</a>
				</p>
			</div>
			<div class="footer_item">
				<h2 class="footer_page_link_information" data-link="{{ route('admin.pageLink.create') }}">Company Links </h2>
				<ul class="footerLinks" >
				@foreach(getFooterLinks()['pageLinks'] as $pageLink)
						<li>
							<div class="triangle triangle-1"></div>
							<a href="{{$pageLink->url}}"
							
						>
							@if($pageLink->name)
							{{$pageLink->name}}
							@endif</a></li>
						@endforeach
				</ul>
			</div>
			<div class="footer_item">
				<h2>Products</h2>
				<ul class="footerLinks">
				@if(count(getFooterLinks()['categoryLinks']) == 0)
					@foreach(getMainCategories(0, 8) as $footerCategory)
						<li>
						<div class="triangle triangle-1"></div>
						<a href="{{url('')}}/{{$footerCategory->slug}}">{{$footerCategory->name}}</a>
						</li>
					@endforeach

					@else
					@foreach(getFooterLinks()['categoryLinks'] as $categoryLink)
						@if(isset($categoryLink->slug))
						<li>
						<div class="triangle triangle-1"></div>
						<a href="{{url('')}}/{{$categoryLink->slug}}">
							@if(isset($categoryLink->display_name))
								{{$categoryLink->display_name}}
							@else
							{{$categoryLink->name}}
							@endif</a>
						</li>
						@endif
					@endforeach
					@endif
				</ul>
			</div>
			<div class="footer_item">
				<h2>Updates</h2>
				<ul class="footerLinks">
				@foreach(getFooterLinks()['blogLinks'] as $blogLink)
						
						@if(isset($blogLink->slug))
						<li>
							<div class="triangle triangle-1"></div>
						<a href="{{url('updates')}}/{{$blogLink->slug}}">
						
							@if(isset($blogLink->display_name))
								{{$blogLink->display_name}}
							@else
							{{$blogLink->title}}
							@endif</a>
							</li>
							@endif
						@endforeach
				</ul>
			</div>
			<div class="footer_item">
				<h2>Case Study</h2>
				<ul class="footerLinks">
				@foreach($footerCaseStudies as $caseStudiesLink)
						
				@if(isset($caseStudiesLink))
					<li>
					<div class="triangle triangle-1"></div>
					<a href="{{url('case-studies')}}/{{$caseStudiesLink->slug}}">
					{{$caseStudiesLink->title}}</a>
					</li>
					@endif
				
				@endforeach
				</ul>
			</div>
			</div>
		</div>
	</footer>


	<footer class="footer_bottom">
		<div class="container">
			<div class="footer_bottom_item">
			<p>web & technology partner</p>
			<p>brand & marketing partner</p>
			</div>
			<div class="footer_bottom_item">
			<p><img src="{{url('/')}}/images/studio5-logo2.png" style="height: 115px;margin-top: 25px;" alt="The Studio5 Australia" class="img-fluid"></p>
			<p>copyright © Giant Industrial Inflatables. All rights reserved.</p>
			<p><img src="{{url('/')}}/images/SMB_LOGO_FINAL_WHITE.png" alt="Search Media Broker" class="img-fluid" style="height:180px;"></p>
			</div>
			<div class="footer_bottom_item"></div>
		</div>
	</footer>


	<img src="{{url('/')}}/img/border/100X40.png" style="display:none;" />
	<img src="{{url('/')}}/img/border/160X40.png" style="display:none;" />
	<img src="{{url('/')}}/img/border/140X40.png" style="display:none;" />


	<img src="{{url('/')}}/img/border/product_title_border/339X55_wh.jpg" style="display:none;" />
	<img src="{{url('/')}}/img/border/product_title_border/339X55_bk.jpg" style="display:none;" />

	<img src="{{url('/')}}/img/border/product_image_main/369X321.png" style="display:none;" />
	<img src="{{url('/')}}/img/border/product_title_border/262X55_wh.jpg" style="display:none;" />

	<img src="{{url('/')}}/img/border/product_title_border/262X55_bk.jpg" style="display:none;" />
	<img src="{{url('/')}}/img/border/product_title_border/320X55_bk.jpg" style="display:none;" />
	<img src="{{url('/')}}/img/border/product_title_border/426X55_bk.jpg" style="display:none;" />

	<img src="{{url('/')}}/img/border/product_image_main/369X321.png" style="display:none;" />
	<img src="{{url('/')}}/img/border/product_title_border/611X55_bk.jpg" style="display:none;" />
	<img src="{{url('/')}}/img/border/112X35_bk.png" style="display:none;" />


       

	<!-- <footer class="bg-white">
		<div class="container-fluid">	
			<div class="site-footer mt-4">	
				<ul style="
					text-align: center;
					padding: 0px 20%;
				">

		<li><p class="text-dark">This website is Designed & Developed by</p> 
					<a href="https://thestudio5.com.au/">
					<img src="{{url('/')}}/images/studio5_logo.jpg"    width="220"
						class="img-fluid mt-4"></a></li>	
					<li>
						<p class="text-center">This Website is protected <img src="{{url('/')}}/images/dmca.png" width="100" 
						class="img-fluid ml-3"></p>				
						<p class="text-center"><a href="#;" class="text-center">@ Giant Inflatables. All rights reserved. </a></p>
					</li>
					
					<li><a href="https://searchmediabroker.com/">
					<p class="text-dark">SEO-SEM-SMM-PPC By:</p>
						<img src="{{url('/')}}/images/smb-logo.png" width="200" class="img-fluid"></a>
					</li>		
					
				</ul>
				
			</div>	
			
		</div>	
	</footer>
	 -->