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
    
    {{-- Try to load 'header-sports-vertical' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.header-sports-vertical', 'ext.header-sports-vertical'])

    {{-- Main content of the page --}}
    <!-- @yield('content') -->
    <main class="position-relative">
          <div class="slideshow">
          @foreach ($sliders as $key => $slider)
            <div class="slide">
              <div class="slide__wrap banner-slider-item" onclick="window.location.href = 'products.html';">
                <div class="slide__img" style="background-image: url({{ url('/') }}/images/{{ $slider->image }});"></div>
                <div class="slide__title-wrap header-top-space">
                  <div class="banner-slider-content text-center">
                    <div class="theme-heading">
                      <h2 class="banner-slider-heading custom-fadedowm">{{ $slider->title }} <span>Inflatables</span></h2>
                      <div class="banner-slider-desc custom-fadedowm">
                        <p>{{$slider->description}}</p>
                      </div>
                    </div>
                    <div class="banner-slider-btn custom-fadedowm">
                      <a href="{{ url('products') }}" class="btn btn-animation--infinity mb-4 btn-animation"><strong></strong><strong></strong><strong></strong><strong></strong>EXPLORE NOW</a>
                    </div>
                    @if(session('LoggedUser'))
                        <!-- <a class="onscreen-banner-slider" href="{{ url('/powerup/slider?onscreenCms=true') }}" onclick="window.open('{{ url("/powerup/slider?onscreenCms=true") }}', 'toolbar=no, location=no','left=`+left+`,width=`+popupWinWidth+`,height=860'); return false;" ><i class='fa fa-edit'></i></a> -->
                        <div class="content_banners" 
                            data-create-link="{{ route('slider.create') }}" 
                            data-edit-link="{{ route('slider.edit', $slider->id) }}" 

                            data-index-link="{{ route('slider.index') }}"
                            data-delete-link="{{ route('slider.delete',$slider->id) }}">
                        </div>

                    @endif
                    <div class="d-md-flex d-none justify-content-center">
                      <a href="#jumpto" class="banner-down-btn custom-fadedowm">
                        <img src="{{asset('/')}}/dubai/images/arrow-down-circle.svg" alt="arrow-down-circle">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            
          </div><!-- /slideshow -->
          <nav class="boxnav">
            <button class="boxnav__item boxnav__item--prev">
              <svg class="icon icon--caret">
                <use xlink:href="#icon-caret"></use>
              </svg>
            </button>
            <div class="boxnav__item boxnav__item--label">
              <span class="boxnav__label boxnav__label--current">1</span>
              <span class="boxnav__label boxnav__label--total"></span>
            </div>
            <button class="boxnav__item boxnav__item--next">
              <svg class="icon icon--caret-rot">
                <use xlink:href="#icon-caret"></use>
              </svg>
            </button>
          </nav>
          <button class="action action--details" style="display: none;">+ details</button>
          <!-- details -->
          <div class="details-wrap">
            <div class="details">
              <div class="details__item details__item--close" data-direction="ttb">
                <div class="details__inner">
                  <button class="action action--close">Close</button>
                </div>
              </div>
            </div><!-- /details -->
            <div class="details">
              <div class="details__item details__item--close" data-direction="ttb">
                <div class="details__inner">
                  <button class="action action--close">Close</button>
                </div>
              </div>
            </div><!-- /details -->
            <div class="details">
              <div class="details__item details__item--close" data-direction="ttb">
                <div class="details__inner">
                  <button class="action action--close">Close</button>
                </div>
              </div>
            </div><!-- /details -->
            <div class="details">
              <div class="details__item details__item--close" data-direction="ttb">
                <div class="details__inner">
                  <button class="action action--close">Close</button>
                </div>
              </div>
            </div><!-- /details -->
          </div>
        </main>


          <!-- content area part -->
          <div class="main-content" id="jumpto">
            <section class="products-section">
              <div class="container">
                <div class="theme-stroke-heading text-center text-uppercase">
                  <strong class="letters">Our Products</strong>
                  <h1 class="h3 letters" onclick="window.location.href = 'products.html';">Our <span>Products</span></h1>
                  <div class="product_title_1"  @if(session('LoggedUser'))
                  data-link="{{route('admin.product-page.editor')}}?onscreenCms=true"
              @endif></div>
                </div>
              </div>
              <div class="products-wrap position-relative">
                <div class="bg-img-wrap">
                  <img class="bg-img-top" src="{{asset('/')}}/dubai/images/red-effect-top.webp" alt="red-effect-top">
                  <img class="bg-img-bottom" src="{{asset('/')}}/dubai/images/red-effect-bottom.webp" alt="red-effect-bottom">
                </div>
                <div class="container">
                  <div class="row g-5 pb-2 pt-xl-3">
                    @if(count(customMainCat()) > 0)
                    @foreach(customMainCat() as $key => $topInflatableLp)
                    <?php 
                        $getSubCategories = getSubCategories($topInflatableLp->id); 
                        if (!empty($getSubCategories)) {
                        
                    ?>

                    <div class="col-md-4 col-sm-6">
                      <a href="{{url('')}}/{{$topInflatableLp->slug}}" class="products-box text-center wow zoomIn" data-wow-offset="200">
                        <div class="animated-border-box-glow">
                          <div class="products-box-img">
                            <?php if(!empty($topInflatableLp->image))
                            {
                              ?>                  <img src="{{url('')}}/images/{{$topInflatableLp->image}}" style="height: 540px !important;" />
                              <?php }else{?>
                          @foreach(getSubCategoryImages($getSubCategories[0]->id, 10, 'DESC') as $key => $productImage)
                            <img src="{{url('')}}/images/{{$productImage->image}}" style="height: 540px !important;" />
                            @endforeach
                            <?php }?>
                            
                          </div>
                          <div class="product_internal_title" @if(session('LoggedUser'))
                          data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-delete-link="{{route('admin.category.delete',$topInflatableLp->id)}}"
                          data-index-link="{{route('admin.category.list')}}"
                        @endif></div>
                          <div class="products-box-heading text-uppercase theme-heading">
                            <h5>{{ $topInflatableLp->name }}</h5>
                          </div>
                        </div>
                      </a>
                    </div>
                    <?php } else { ?>

                    <div class="col-md-4 col-sm-6">
                      <a href="{{url('')}}/{{$topInflatableLp->slug}}" class="products-box text-center wow zoomIn" data-wow-offset="200">
                        <div class="animated-border-box-glow">
                          <div class="products-box-img">
                            <?php if(!empty($topInflatableLp->image))
                            {
                              ?>
                              <img src="{{url('')}}/images/{{$topInflatableLp->image}}" style="height: 540px !important;" />
                              <?php }else{?>
          
                        <img src="{{url('')}}/img/no-item.jpeg" />
                        <?php }?>
                          </div>
                          <div class="product_internal_title" @if(session('LoggedUser'))
                          data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatableLp->id}}"
                          data-index-link="{{route('admin.category.list')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                        @endif></div>
                          <div class="products-box-heading text-uppercase theme-heading">
                            <h5>{{ $topInflatableLp->name }}</h5>
                          </div>
                        </div>
                      </a>
                    </div>
                    <?php } ?>
                    @endforeach
                  @else
                    <div class="col-md-4 col-sm-6">
                      <a href="{{url('')}}/{{$topInflatableLp->slug}}" class="products-box text-center wow zoomIn" data-wow-offset="200">
                        <div class="animated-border-box-glow">
                          <div class="products-box-img">
                            <img src="{{url('')}}/img/no-item.jpeg" />
                          </div>
                          <div class="product_internal_title" @if(session('LoggedUser'))
                          data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true"
                          data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatableLp->id}}"
                          data-index-link="{{route('admin.category.list')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                        @endif></div
                          <div class="products-box-heading text-uppercase theme-heading">
                            <h5>{{ $topInflatableLp->name }}s</h5>
                          </div>
                        </div>
                      </a>
                    </div>
                    @endif
                  
                  
                   
                  </div>
                  <div class="position-relative text-center product-all-btn">
                    <a href="{{ url('products') }}" class="btn text-uppercase btn-animation--infinity">VIEW ALL PRODUCTS</a>
                  </div>
                </div>
              </div>
            </section>
            <section class="about-us-section">
              <div class="container">
                <div class="theme-stroke-heading text-center text-uppercase mb-lg-5 mb-4">
                    @php
                    $aboutLink = App\Models\admin\UrlList::find(97);
                    @endphp
                  <strong class="letters">About Us</strong>
                  <h3 class="h3 letters" onclick="window.location.href = '{{ $aboutLink->url }}';">About <span>Us</span></h3>
                  <div class="product_title"  @if(session('LoggedUser'))
                  data-link="{{route('admin.about-page.editor')}}"
              @endif></div>
                </div>
                <div class="row">
                  <div class="col-lg-3 about-left-logo d-flex align-items-center mb-lg-5 mb-4 wow fadeInLeft" data-wow-offset="200">
                    <img src="{{asset('/')}}/dubai/images/logo.svg" alt="logo">
                  </div>
                  <div class="col-xl-6 col-lg-5 col-md-7 about-middle-contect wow fadeIn" data-wow-offset="200" data-wow-delay="0.5s">
                    <div class="about-middle-contect-inner">
                        {!! $pageData->description !!}
                    </div>
                    <div class="text-md-start text-center mt-md-3 mb-md-0 mb-4"><a href="{{ $aboutLink->url }}" class="btn share-about-btn text-uppercase btn-animation--infinity">VIEW MORE</a></div>
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
            <section class="updates-contact-section position-relative overflow-hidden">
              <div class="bg-img-wrap">
                <img class="bg-img-bottom opacity-25" src="{{asset('/')}}/dubai/images/desert-transparent.webp" alt="desert-bg">
              </div>
              <div class="updates-section">
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
@includeFirst(['theme::ext.script', 'ext.script'])
@includeFirst(['theme::ext.footer', 'ext.footer'])
</div>


    {{-- Try to load 'script' and 'footer' from the active theme; fallback to default --}}


    {{-- Additional custom JavaScript --}}
    @yield('custom-js')
</body>
</html>
