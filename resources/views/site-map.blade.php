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
    $productLink = App\Models\admin\UrlList::find(96);  // Our Products link
    $contactLink = App\Models\admin\UrlList::find(101);  // Contact Us link
    $homeLink = App\Models\admin\UrlList::find(95);  // Home link
	$updatesLink = App\Models\admin\UrlList::find(113);  // Updates link
    ?>
    
    {{-- Try to load 'header-sports-vertical' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.header-sports-vertical', 'ext.header-sports-vertical'])


    <section class="about-banner-section common-inner-banner header-top-space position-relative">
      <div class="bg-img-wrap">
        <img class="bg-img-top opacity-50" src="{{asset('/')}}/dubai/images/about-banner.webp" alt="about-banner">
        <img class="bg-img-bottom" src="{{asset('/')}}/dubai/images/red-effect-bottom.webp" alt="red-effect-bottom">
      </div>
      <div class="container position-relative">
        <div class="breadcrumb">
          <div class="breadcrumb-left">
            <a href="{{ $homeLink->url }}" class="header-top-home d-flex align-items-center text-uppercase">
              <img class="me-2" src="{{asset('/')}}/dubai/images/home-icon.png" alt="home-icon">Home
            </a>
            <span class="text-uppercase">Sitemap</span>
          </div>
          <a href="{{ $homeLink->url }}" class="breadcrumb-back text-uppercase">Back<img src="{{asset('/')}}/dubai/images/right-arrow-circle.svg" alt="right-arrow-circle"></a>
        </div>
        <div class="theme-stroke-heading text-center text-uppercase">
          <strong class="letters">Sitemap</strong>
          <h1 class="h3 letters">Site<span>map</span></h1>
        </div>
        <div class="row g-xxl-5 g-lg-4 g-3">
          <div class="col-xl-12 col-md-8">
            <div class="about-banner-blocks-wrap wow fadeInLeft" data-wow-offset="200">
              <div class="row g-xxl-5 g-lg-4 g-3">
             




				<section class="collection-slider">
					<div class="container-fluid">
						<div class="col-12">
			
						<section>
						<div class="row p-3 sitemap">
							<div class="col-sm-3">
							@foreach($urls as $url)
							<li><a href="{{url('')}}/{{$url->url}}">{{$url->name}}</a></li>
								@endforeach
							</div>
			
			
							<div class="col-sm-4">
								<h4 class="active_color"><a href="{{ $productLink->url }}">Products</a></h4>
									<ul>
										@foreach($mainCategories as $mainCategory)
											<li> <a href="{{url('')}}/{{$mainCategory->slug}}">{{$mainCategory->name}}</a></li>
			
											@if(count(getAllSubCategories($mainCategory->id)))
												<ul>
													@foreach(getAllSubCategories($mainCategory->id) as $subCategory)
														<li><a href="{{url('')}}/{{$subCategory->slug}}">{{$subCategory->name}}</a></li>
													@endforeach
												</ul>
											@endif
										@endforeach
									</ul>
							</div>
			
							<div class="col-sm-5">
								<h4 class="active_color"><a href="{{ $updatesLink->url }}">Updates</a></h4>
									<ul>
										@foreach($blogs as $blog)
											<li> <a href="{{$updatesLink->url}}/{{$blog->slug}}">{{$blog->title}}</a></li>
										@endforeach
									</ul>
							</div>
			
							<div class="clearfix"></div>
						</div>
						</section>
			
					</div>	
				</section>
			
              </div>
            </div>
           
          </div>
             
                </div>
              </div>
            </section>
            <div class="main-content">
             <section class="updates-contact-section position-relative overflow-hidden">
        
         
              <div class="contact-section">
                <div class="container">
                  <div class="theme-stroke-heading text-center text-uppercase">
                    <strong class="letters">Get In Touch</strong>                    
                    <h3 class="h3 letters" onclick="window.location.href = '{{ $contactLink->url }}';">Get In <span>Touch</span></h3>
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


            </section>
          </div>
</div>
</div>
@includeFirst(['theme::ext.script', 'ext.script'])
@includeFirst(['theme::ext.footer', 'ext.footer'])
</div>


    {{-- Try to load 'script' and 'footer' from the active theme; fallback to default --}}


    {{-- Additional custom JavaScript --}}
    @yield('custom-js')
</body>
</html>