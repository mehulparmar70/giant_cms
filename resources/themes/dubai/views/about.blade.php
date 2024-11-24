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


    <section class="about-banner-section common-inner-banner header-top-space position-relative">
      <div class="bg-img-wrap">
        <img class="bg-img-top opacity-50" src="{{asset('/')}}/dubai/images/about-banner.webp" alt="about-banner">
        <img class="bg-img-bottom" src="{{asset('/')}}/dubai/images/red-effect-bottom.webp" alt="red-effect-bottom">
      </div>
      <div class="container position-relative">
        <div class="breadcrumb">
          <div class="breadcrumb-left">
            <a href="index.html" class="header-top-home d-flex align-items-center text-uppercase">
              <img class="me-2" src="{{asset('/')}}/dubai/images/home-icon.png" alt="home-icon">Home
            </a>
            <span class="text-uppercase">About</span>
          </div>
          <a href="index.html" class="breadcrumb-back text-uppercase">Back<img src="{{asset('/')}}/dubai/images/right-arrow-circle.svg" alt="right-arrow-circle"></a>
        </div>
        <div class="theme-stroke-heading text-center text-uppercase">
          <strong class="letters">About Us</strong>
          <h1 class="h3 letters">About <span>Us</span></h1>
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
              <div class="about-middle-contect-inner">
                <span><div  class="product_title"  @if(session('LoggedUser'))
                  data-link="{{route('admin.about-page.editor')}}"
              @endif></div>
                        {!! $pageData->description !!}</span>
            </div>
            </div>
          </div>
                  <div class="col-xl-3 col-lg-4 col-md-5 wow fadeInRight" data-wow-offset="200">
                    <div class="share-concept-form-box share-about-box mx-md-0 mx-auto">
                      <img class="w-full" src="{{asset('/')}}/dubai/images/share-concept.png" alt="share-concept">
                          @include('widget.contact-form1')
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
              <div class="updates-section products-slider-section">
                <div class="container">
                  <div class="theme-stroke-heading text-center text-uppercase">
                    <strong class="letters">Our Products</strong>
                    <h1 class="h3 letters" onclick="window.location.href = 'products.html';">Our <span>Products</span></h1>
                    <div  class="product_title_1"  @if(session('LoggedUser'))
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
                {{-- <div class="updates-wrap position-relative">
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
                      <a href="{{ url('products') }}" class="btn text-uppercase btn-animation--infinity">VIEW ALL PRODUCTS</a>
                    </div>
                  </div>
                </div> --}}
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