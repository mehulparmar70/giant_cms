<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    {{-- Try to load 'head' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.head', 'ext.head'])

    {{-- Additional theme-specific CSS --}}
    @yield('addon-css')
</head>

<body class="lazyload pr-0">
    <?php $current_page = ''; ?>
    <?php 
// dd($mainCategory);
$industriesPageData = getPageData('industrie_page');
$subCategory = $current_cat;
// dd($subCategory);



// $current_products = DB::table('products')->where(['category_id' => $subCategory->id, 'status' => 1])->get();


	$finalSlug = '';
	$mainCategorySlug = '';
	$subCategorySlug = '';
	$subCategory2Slug = '';

	// dd($current_products);


?>
	@if(isset(getParentCategory($subCategory->id)['category']))
	<?php $finalSlug = getParentCategory($subCategory->id)['category']->slug.'/';
		$mainCategorySlug = $finalSlug;
	?>
	@endif

		@if(isset(getParentCategory($subCategory->id)['subcategory']))
			<?php $finalSlug = getParentCategory($subCategory->id)['subcategory']->slug ;
				$subCategorySlug = $finalSlug;
				// dd($subCategorySlug);

			?>
		@endif

		@if(isset(getParentCategory($subCategory->id)['subcategory2']))
			<?php $finalSlug = getParentCategory($subCategory->id)['subcategory2']->slug;
				$subCategory2Slug = $finalSlug;
				// dd($subCategory2Slug);
			?>
		@endif
		
<?php

	if($type == 'maincategory_product'){
		// dd($type);

		$finalSlug = $finalSlug;
	}
	elseif($type == 'maincategory_sub_sub2_product'){
		// dd($type);
		$finalSlug = $subCategorySlug;
	}
	elseif($type == 'maincategory_subcategory_product'){
		// dd($type);

		$finalSlug = $mainCategorySlug;
	}
	
	if(isset(getParentCategory($subCategory->id)['category']))
	{
		$searchCriteria = getParentCategory($subCategory->id)['category']->id;
	}
	if(isset(getParentCategory($subCategory->id)['subcategory']))
	{
		$searchCriteria = $searchCriteria.','.getParentCategory($subCategory->id)['subcategory']->id;
	}
	if(isset(getParentCategory($subCategory->id)['subcategory2']))
	{
		$searchCriteria = $searchCriteria.','.getParentCategory($subCategory->id)['subcategory2']->id;
	}

$arr = explode(',',$searchCriteria);
// dd($arr);

$intArray = array_map(
    function($value) { return (int)$value; },
    $arr
);

$current_criteria = DB::table('criteria_metas')->whereIn('categories', $intArray)->get();
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
                <a href="{{url('')}}" class="header-top-home d-flex align-items-center text-uppercase">
                  <img class="me-2" src="{{asset('/')}}/dubai/images/home-icon.png" alt="home-icon">Home
                </a>
                <a href="{{ url('products') }}" class="header-top-home d-flex align-items-center text-uppercase py-1 me-3">Our Products</a>
                @if(getParentCategory($subCategory->id)['category'])
						<span class="text-uppercase">{{getParentCategory($subCategory->id)['category']->name}}</span>
                        @endif

						@if(getParentCategory($subCategory->id)['subcategory'])
						 <span class="text-uppercase">{{getParentCategory($subCategory->id)['subcategory']->name}}</span>
                        @endif

						@if(getParentCategory($subCategory->id)['subcategory2'])
						 <span class="text-uppercase">{{getParentCategory($subCategory->id)['subcategory2']->name}}</span>
                        @endif 
              </div>
              <a href="{{ url('products') }}" class="breadcrumb-back text-uppercase">Back<img src="{{asset('/')}}/dubai/images/right-arrow-circle.svg" alt="right-arrow-circle"></a>
            </div>
       
        <div class="row g-xxl-5 g-lg-4 g-3">
          <div class="col-xl-9 col-md-8">
            <div class="about-banner-blocks-wrap wow fadeInLeft" data-wow-offset="200">
              <div class="row g-xxl-5 g-lg-4 g-3">
                <div class="col-sm-6">
                  <div class="about-banner-block">
                    <div class="about-block-icon">
                      <img src="{{asset('/')}}/dubai/images/professional-team-icon.png" alt="professional-team-icon">
                    </div>
                    <h6>Professional Team</h6>
                    <p>Sed ut perspiciatis miani tes ipsum, dolor sit amet kedi consectetur adipisicing elit</p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="about-banner-block">
                    <div class="about-block-icon">
                      <img src="{{asset('/')}}/dubai/images/smart-services-icon.png" alt="smart-services-icon">
                    </div>
                    <h6>Smart Services</h6>
                    <p>Sed ut perspiciatis miani tes ipsum, dolor sit amet kedi consectetur adipisicing elit</p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="about-banner-block">
                    <div class="about-block-icon">
                      <img src="{{asset('/')}}/dubai/images/smart-work-icon.png" alt="smart-work-icon">
                    </div>
                    <h6>Smart Work</h6>
                    <p>Sed ut perspiciatis miani tes ipsum, dolor sit amet kedi consectetur adipisicing elit</p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="about-banner-block">
                    <div class="about-block-icon">
                      <img src="{{asset('/')}}/dubai/images/great-support-icon.png" alt="great-support-icon">
                    </div>
                    <h6>Great Support</h6>
                    <p>Sed ut perspiciatis miani tes ipsum, dolor sit amet kedi consectetur adipisicing elit</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="about-banner-desc wow zoomIn" data-wow-offset="200">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias perspiciatis expedita omnis vitae vel ab id cumque illo, tempore quaerat provident earum porro molestiae quidem nemo pariatur adipisci sunt, accusamus non, a dolores.</p>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit:- <br>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam accusamus, optio possimus facere, maxime reiciendis recusandae iure quasi totam sint iusto Animi non ipsam atque aliquid cupiditate, recusandae molestiae natus! Reiciendis tempore sequi suscipit blanditiis fugiat officia, inventore praesentium quas accusantium incidunt iste maxime dolores dicta laborum fugit facere quis aliquid quasi natus aut nam ullam, maiores ipsam. Libero facere non sapiente necessitatibus hic. Numquam fugit cumque quaerat error consequuntur. <br>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius accusamus provident error! Eaque beatae minus debitis tenetur quidem facere, qui blanditiis, deleniti atque, nostrum explicabo voluptate magni impedit nemo ipsum <br>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae ipsam neque rem commodi facilis ab debitis deserunt inventore quidem corrupti, ullam quae fugiat quas quia officia, modi fugit harum odit repellendus. Repudiandae, dolorem eligendi laboriosam asperiores ut consequatur, accusantium doloremque perferendis earum ipsum officia vel facilis dicta eaque. Itaque adipisci praesentium aliquam. Vero commodi totam officiis, quo quos culpa eum!
              </p>
            </div>
          </div>
                  <div class="col-xl-3 col-lg-4 col-md-5 wow fadeInRight" data-wow-offset="200">
                    <div class="share-concept-form-box share-about-box mx-md-0 mx-auto">
                      <img class="w-full" src="{{asset('/')}}/dubai/images/share-concept.png" alt="share-concept">
                      <form action="" class="share-concept-form ms-2">
                        <div class="share-concept-field d-flex align-items-start">
                          <div class="share-concept-icon d-flex align-items-center justify-content-center"><img src="{{asset('/')}}/dubai/images/user-icon.svg" alt="user icon"></div>
                          <input class="share-concept-form-input" type="text" placeholder="Name">
                        </div>
                        <div class="share-concept-field d-flex align-items-start">
                          <div class="share-concept-icon d-flex align-items-center justify-content-center"><img src="{{asset('/')}}/dubai/images/phone-icon.svg" alt="phone icon"></div>
                          <input class="share-concept-form-input" type="tel" placeholder="Phone Number">
                        </div>
                        <div class="share-concept-field d-flex align-items-start">
                          <div class="share-concept-icon d-flex align-items-center justify-content-center"><img src="{{asset('/')}}/dubai/images/mail-icon.svg" alt="mail icon"></div>
                          <input class="share-concept-form-input" type="email" placeholder="Email">
                        </div>
                        <div class="share-concept-field d-flex align-items-start">
                          <div class="share-concept-icon d-flex align-items-center justify-content-center"><img src="{{asset('/')}}/dubai/images/country-glob-icon.svg" alt="country icon"></div>
                          <select class="share-concept-form-input" name="" id="">
                            <option value="">Select Country</option>
                            <option value="">Dubai</option>
                            <option value="">America</option>
                          </select>
                        </div>
                        <div class="share-concept-field d-flex align-items-start">
                          <div class="share-concept-icon d-flex align-items-center justify-content-center"><img src="{{asset('/')}}/dubai/images/message-icon.svg" alt="message icon"></div>
                          <textarea class="share-concept-form-input" type="text" placeholder="Share Your Inflatables Requirement"></textarea>
                        </div>
                        <div class="share-concept-field d-flex justify-content-center mb-0">
                          <img src="{{asset('/')}}/dubai/images/captcha-image.jpg" alt="captcha-image">
                        </div>
                        <div class="share-concept-field text-center share-concept-info mb-4">
                          <strong>We do not sell or rent your information.</strong>
                        </div>
                        <div class="text-center">
                          <button class="btn btn-animation--infinity" type="submit">SUBMIT</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <div class="main-content">
             <section class="updates-contact-section position-relative overflow-hidden">
              <div class="bg-img-wrap">
                <img class="bg-img-bottom opacity-25" src="{{asset('/')}}/dubai/images/desert-transparent.webp" alt="desert-bg">
              </div>
              {{-- <div class="updates-section">
                <div class="container">
                  <div class="theme-stroke-heading text-center text-uppercase">
                    <strong class="letters">Updates</strong>
                    <h3 class="h3 letters" onclick="window.location.href = 'updates.html';">Up<span>dates</span></h3>
                  </div>
                </div>
                <div class="updates-wrap position-relative">
                  <div class="bg-img-wrap">
                    <img class="bg-img-top" src="{{asset('/')}}/dubai/images/red-effect-top.webp" alt="red-effect-top">
                  </div>
                  <div class="container pt-4">
                    <div class="position-relative wow zoomInDown" data-wow-offset="200">
                      <div class="updates-slider px-xl-5 px-3">
                        <div class="updates-slider-item">
                          <a href="updates-detail.html" class="updates-box">
                            <div class="updates-box-img">
                              <img src="{{asset('/')}}/dubai/images/home-banner.webp" alt="updates-img">
                            </div>
                            <div class="updates-box-content">
                              <h6>Lorem ipsum, dolor sit amet conse ctetur sicing sicing elit</h6>
                              <p>Soluta ex autem obcaecati aperiam adipisci porro odio quam fugit debitis numquam hic consequuntur ratione, eligendi quos cumque non magni harum eum</p>
                              <span class="btn">View More</span>
                            </div>
                          </a>
                        </div>
                        <div class="updates-slider-item">
                          <a href="updates-detail.html" class="updates-box">
                            <div class="updates-box-img">
                              <img src="{{asset('/')}}/dubai/images/desert.webp" alt="updates-img">
                            </div>
                            <div class="updates-box-content">
                              <h6>Lorem ipsum, dolor sit amet conse ctetur sicing sicing elit</h6>
                              <p>Soluta ex autem obcaecati aperiam adipisci porro odio quam fugit debitis numquam hic consequuntur ratione, eligendi quos cumque non magni harum eum</p>
                              <span class="btn">View More</span>
                            </div>
                          </a>
                        </div>
                        <div class="updates-slider-item">
                          <a href="updates-detail.html" class="updates-box">
                            <div class="updates-box-img">
                              <img src="{{asset('/')}}/dubai/images/home-banner.webp" alt="updates-img">
                            </div>
                            <div class="updates-box-content">
                              <h6>Lorem ipsum, dolor sit amet conse ctetur sicing sicing elit</h6>
                              <p>Soluta ex autem obcaecati aperiam adipisci porro odio quam fugit debitis numquam hic consequuntur ratione, eligendi quos cumque non magni harum eum</p>
                              <span class="btn">View More</span>
                            </div>
                          </a>
                        </div>
                        <div class="updates-slider-item">
                          <a href="updates-detail.html" class="updates-box">
                            <div class="updates-box-img">
                              <img src="{{asset('/')}}/dubai/images/home-banner.webp" alt="updates-img">
                            </div>
                            <div class="updates-box-content">
                              <h6>Lorem ipsum, dolor sit amet conse ctetur sicing sicing elit</h6>
                              <p>Soluta ex autem obcaecati aperiam adipisci porro odio quam fugit debitis numquam hic consequuntur ratione, eligendi quos cumque non magni harum eum</p>
                              <span class="btn">View More</span>
                            </div>
                          </a>
                        </div>
                        <div class="updates-slider-item">
                          <a href="updates-detail.html" class="updates-box">
                            <div class="updates-box-img">
                              <img src="{{asset('/')}}/dubai/images/desert.webp" alt="updates-img">
                            </div>
                            <div class="updates-box-content">
                              <h6>Lorem ipsum, dolor sit amet conse ctetur sicing sicing elit</h6>
                              <p>Soluta ex autem obcaecati aperiam adipisci porro odio quam fugit debitis numquam hic consequuntur ratione, eligendi quos cumque non magni harum eum</p>
                              <span class="btn">View More</span>
                            </div>
                          </a>
                        </div>
                        <div class="updates-slider-item">
                          <a href="updates-detail.html" class="updates-box">
                            <div class="updates-box-img">
                              <img src="{{asset('/')}}/dubai/images/home-banner.webp" alt="updates-img">
                            </div>
                            <div class="updates-box-content">
                              <h6>Lorem ipsum, dolor sit amet conse ctetur sicing sicing elit</h6>
                              <p>Soluta ex autem obcaecati aperiam adipisci porro odio quam fugit debitis numquam hic consequuntur ratione, eligendi quos cumque non magni harum eum</p>
                              <span class="btn">View More</span>
                            </div>
                          </a>
                        </div>
                      </div>
                      <div class="updates-custom-nav slider-reverse-arrows owl-nav position-relative text-center mt-3">
                        <a href="updates.html" class="btn text-uppercase btn-animation--infinity">VIEW ALL UPDATES</a>
                      </div>
                      <div class="updates-mobile-nav owl-nav d-md-none d-block">
                        <button class="owl-prev updates-second-prev"><span aria-label="Previous">‹</span></button>
                        <button class="owl-next updates-second-next"><span aria-label="Next">›</span></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div> --}}
              <div class="updates-section products-slider-section">
                <div class="container">
                  <div class="theme-stroke-heading text-center text-uppercase">
                    <strong class="letters">Our Products</strong>
                    <h1 class="h3 letters" onclick="window.location.href = 'products.html';">Our <span>Products</span></h1>
                  </div>
                </div>
                <div class="updates-wrap position-relative">
                  <div class="bg-img-wrap">
                    <img class="bg-img-top" src="{{asset('/')}}/dubai/images/red-effect-top.webp" alt="red-effect-top">
                  </div>
                  <div class="container position-relative pt-lg-4">
                    <div class="updates-slider">
                      <div class="updates-slider-item wow zoomIn" data-wow-offset="200">
                        <a href="products.html" class="products-box text-center wow zoomIn" data-wow-offset="200">
                          <div class="animated-border-box-glow">
                            <div class="products-box-img">
                              <img src="{{asset('/')}}/dubai/images/home-banner.webp" alt="products-img">
                            </div>
                            <div class="products-box-heading text-uppercase theme-heading">
                              <h5>MAIN-CATEGORY NAME-1</h5>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="updates-slider-item wow zoomIn" data-wow-offset="200">
                        <a href="products.html" class="products-box text-center wow zoomIn" data-wow-offset="200">
                          <div class="animated-border-box-glow">
                            <div class="products-box-img">
                              <img src="{{asset('/')}}/dubai/images/home-banner.webp" alt="products-img">
                            </div>
                            <div class="products-box-heading text-uppercase theme-heading">
                              <h5>MAIN-CATEGORY NAME-2</h5>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="updates-slider-item wow zoomIn" data-wow-offset="200">
                        <a href="products.html" class="products-box text-center wow zoomIn" data-wow-offset="200">
                          <div class="animated-border-box-glow">
                            <div class="products-box-img">
                              <img src="{{asset('/')}}/dubai/images/home-banner.webp" alt="products-img">
                            </div>
                            <div class="products-box-heading text-uppercase theme-heading">
                              <h5>MAIN-CATEGORY NAME-3</h5>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="updates-slider-item wow zoomIn" data-wow-offset="200">
                        <a href="products.html" class="products-box text-center wow zoomIn" data-wow-offset="200">
                          <div class="animated-border-box-glow">
                            <div class="products-box-img">
                              <img src="{{asset('/')}}/dubai/images/home-banner.webp" alt="products-img">
                            </div>
                            <div class="products-box-heading text-uppercase theme-heading">
                              <h5>MAIN-CATEGORY NAME-4</h5>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="updates-slider-item wow zoomIn" data-wow-offset="200">
                        <a href="products.html" class="products-box text-center wow zoomIn" data-wow-offset="200">
                          <div class="animated-border-box-glow">
                            <div class="products-box-img">
                              <img src="{{asset('/')}}/dubai/images/home-banner.webp" alt="products-img">
                            </div>
                            <div class="products-box-heading text-uppercase theme-heading">
                              <h5>MAIN-CATEGORY NAME-5</h5>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                    <div class="updates-custom-nav slider-reverse-arrows owl-nav position-relative text-center mt-4">
                      <a href="products.html" class="btn text-uppercase btn-animation--infinity">VIEW ALL PRODUCTS</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="contact-section">
                <div class="container">
                  <div class="theme-stroke-heading text-center text-uppercase">
                    <strong class="letters">Get In Touch</strong>
                    <h3 class="h3 letters" onclick="window.location.href = 'contact.html';">Get In <span>Touch</span></h3>
                  </div>
                </div>
                <div class="container position-relative pt-4">
                  <div class="d-flex flex-sm-nowrap flex-wrap justify-content-center gap-md-4 gap-3">
                    <div class="share-concept-form-box wow flipInY" data-wow-offset="200">
                      <img class="w-full" src="{{asset('/')}}/dubai/images/share-concept.png" alt="share-concept">
                      <form action="" class="share-concept-form ms-2">
                        <div class="share-concept-field d-flex align-items-start">
                          <div class="share-concept-icon d-flex align-items-center justify-content-center"><img src="{{asset('/')}}/dubai/images/user-icon.svg" alt="user icon"></div>
                          <input class="share-concept-form-input" type="text" placeholder="Name">
                        </div>
                        <div class="share-concept-field d-flex align-items-start">
                          <div class="share-concept-icon d-flex align-items-center justify-content-center"><img src="{{asset('/')}}/dubai/images/phone-icon.svg" alt="phone icon"></div>
                          <input class="share-concept-form-input" type="tel" placeholder="Phone Number">
                        </div>
                        <div class="share-concept-field d-flex align-items-start">
                          <div class="share-concept-icon d-flex align-items-center justify-content-center"><img src="{{asset('/')}}/dubai/images/mail-icon.svg" alt="mail icon"></div>
                          <input class="share-concept-form-input" type="email" placeholder="Email">
                        </div>
                        <div class="share-concept-field d-flex align-items-start">
                          <div class="share-concept-icon d-flex align-items-center justify-content-center"><img src="{{asset('/')}}/dubai/images/country-glob-icon.svg" alt="country icon"></div>
                          <select class="share-concept-form-input" name="" id="">
                            <option value="">Select Country</option>
                            <option value="">Dubai</option>
                            <option value="">America</option>
                          </select>
                        </div>
                        <div class="share-concept-field d-flex align-items-start">
                          <div class="share-concept-icon d-flex align-items-center justify-content-center"><img src="{{asset('/')}}/dubai/images/message-icon.svg" alt="message icon"></div>
                          <textarea class="share-concept-form-input" type="text" placeholder="Share Your Inflatables Requirement"></textarea>
                        </div>
                        <div class="share-concept-field d-flex justify-content-center mb-0">
                          <img src="{{asset('/')}}/dubai/images/captcha-image.jpg" alt="captcha-image">
                        </div>
                        <div class="share-concept-field text-center share-concept-info mb-4">
                          <strong>We do not sell or rent your information.</strong>
                        </div>
                        <div class="text-center">
                          <button class="btn btn-animation--infinity" type="submit">SUBMIT</button>
                        </div>
                      </form>
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
</div>

    {{-- Try to load 'script' and 'footer' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.script', 'ext.script'])
    @includeFirst(['theme::ext.footer', 'ext.footer'])

    {{-- Additional custom JavaScript --}}
    @yield('custom-js')
</body>
</html>

