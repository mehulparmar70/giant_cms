<!DOCTYPE HTML>
<html>
  <head>
  {{-- Try to load 'head' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.head', 'ext.head'])

    {{-- Additional theme-specific CSS --}}
    @yield('addon-css')
  </head>
  <body>
  <?php $current_page = ''; 
  $updatesLink = App\Models\admin\UrlList::find(113);  // Updates link
    $productLink = App\Models\admin\UrlList::find(96);  // Our Products link
    $homeLink = App\Models\admin\UrlList::find(95);  // Home link
    $contactLink = App\Models\admin\UrlList::find(101);  // Contact Us link
    ?>
    
    {{-- Try to load 'header-sports-vertical' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.header-sports-vertical', 'ext.header-sports-vertical'], ['updateslug' => 'internalslug'])

    {{-- Main content of the page --}}
        <!-- banner area part -->
        <section class="product-detail-banner-section common-inner-banner header-top-space position-relative">
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
                <span class="text-uppercase">Updates</span>
              </div>
              <a href="{{ $updatesLink->url }}" class="breadcrumb-back text-uppercase">Back<img src="{{asset('/')}}/dubai/images/right-arrow-circle.svg" alt="right-arrow-circle"></a>
            </div>
            <div class="row g-lg-4 g-3 mt-lg-4 mt-2 pb-3">
              <div class="col-xl-9 col-md-8">
                <div class="product-detail-wrap wow fadeInLeft" data-wow-offset="200">
                  <div class="product-detail-title d-flex justify-content-md-start justify-content-center">
                    <h5 class="me-2 mt-1">{{$blogDetail->title}}</h5>
                    <div class="description_blk onscreen_blog_detail_page" @if(session('LoggedUser'))
                    data-link="{{route('blog.edit', $blogDetail->id)}}"
                  @endif></div>
                  </div>
                  <div class="mt-4 mb-lg-5 mb-4 mx-2">
                    <div class="product-detail-slider">
                      <a  class="product-detail-slider-item" data-fancybox="gallery">
                        <div class="product-detail-slider-img">
                          <img src="{{ url('/') }}/images/{{ $blogDetail->image }}" alt="product-banner">
                        </div>
                        <!-- <button type="button" class="product-enlarge-btn theme-heading d-flex align-items-center gap-2">
                          <img src="{{asset('/')}}/dubai/images/search-icon.svg" alt="search-icon">
                          Click To Enlarge
                        </button> -->
                      </a>
          
                    </div>
                    <!-- <div class="product-detail-custom-nav slider-reverse-arrows d-flex justify-content-between mt-4 px-3">
                      <div class="text-uppercase my-auto">LATEST Images - <span class="product-slider-counter"></span></div> 
                    </div> -->
                  </div>
                </div>
                <div class="about-banner-desc wow zoomIn" data-wow-offset="200">
                  <div class="description_blk onscreen_blog_detail_page" @if(session('LoggedUser'))
                  data-link="{{route('blog.edit', $blogDetail->id)}}"
                @endif></div>
                               {!! html_entity_decode($blogDetail->full_description) !!}
                </div>
              </div>
              <div class="col-xl-3 col-md-4 wow fadeInRight" data-wow-offset="200">
                <div class="share-concept-form-box -sticky mx-md-0 mx-auto">
                  <img class="w-full" src="{{asset('/')}}/dubai/images/share-concept.png" alt="share-concept">
                  @include('widget.contact-form1')
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- content area part -->
        <div class="main-content">
          <section class="updates-contact-section position-relative overflow-hidden">
            <div class="bg-img-wrap">
                <img class="bg-img-bottom opacity-25" src="{{asset('/')}}/dubai/images/desert-transparent.webp" alt="desert-bg">
            </div>
            <div class="updates-section">
              <div class="container">
                <div class="theme-stroke-heading text-center text-uppercase">
                  <strong class="letters">Other Updates</strong>
                  <h3 class="h3 letters" onclick="window.location.href = '{{ $updatesLink->url }}';">Other <span>Updates</span></h3>
                </div>
              </div>
              <div class="updates-wrap mt-3">
                <div class="container pt-2">
                  <div class="position-relative wow zoomInDown" data-wow-offset="200">
                    <div class="updates-slider px-3">
                      @foreach($latestUpdates as $updatesList)
                      <div class="updates-slider-item">
                        <a href="{{ url('updates') }}/{{$updatesList->slug}}" class="updates-box">
                          <div class="updates-box-img">
                            <img src="{{ url('/') }}/images/{{ $updatesList->image }}" />
                          </div>
                          <div class="updates-box-content">
                            <div align="right"  class="onscreen_blog_detail_page" @if(session('LoggedUser'))
                            data-create-link="{{route('blog.create')}}"
                            data-link="{{route('blog.edit', $updatesList->id)}}"
                            data-delete-link="{{route('blog.delete',$updatesList->id)}}"
                            data-index-link="{{ route('blog.index') }}"
                          @endif></div>
                            <h6>{{$updatesList->title}}</h6>
                            <p>                {!! html_entity_decode($updatesList->short_description) !!}</p>
                            <span class="btn">View More</span>
                          </div>
                        </a>
                      </div>
                      @endforeach
                    </div>
                    <div class="updates-custom-nav slider-reverse-arrows owl-nav position-relative text-center mt-4">
                      <a href="{{ $updatesLink->url }}" class="btn text-uppercase btn-animation--infinity">VIEW ALL UPDATES</a>
                    </div>
                    <div class="updates-mobile-nav owl-nav d-md-none d-block">
                      <button class="owl-prev updates-second-prev"><span aria-label="Previous">‹</span></button>
                      <button class="owl-next updates-second-next"><span aria-label="Next">›</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="updates-section products-slider-section">
              <div class="container">
                <div class="theme-stroke-heading text-center text-uppercase">
                  <strong class="letters">Our Products</strong>
                  <h3 class="h3 letters" onclick="window.location.href = '{{ $productLink->url }}';">Our <span>Products</span></h3>
                  <div  class="product_title_1"  @if(session('LoggedUser'))
                  data-link="{{route('admin.product-page.editor')}}?onscreenCms=true"
              @endif></div>
                </div>
              </div>
              <div class="updates-wrap position-relative">
                <div class="bg-img-wrap">
                  <img class="bg-img-top" src="{{asset('/')}}/dubai/images/red-effect-top.webp" alt="red-effect-top">
                </div>
                <div class="container position-relative pt-xxl-5">
                  <div class="products-slider pb-3">
                    @foreach(customMainCat() as $key => $topInflatableLp)
                    <?php 
                    $getSubCategories = getSubCategories($topInflatableLp->id);
                        if (!empty($getSubCategories)) {
                          $imageName = getSubCategoryImages($getSubCategories[0]->id, 10, 'DESC')[0]['image']; 
                          /*foreach(getSubCategoryImages($getSubCategories[0]->id,10, 'DESC') as $key => $productImage){
                            print_r($productImage);
                          }*/
                    ?>
                    <div class="updates-slider-item wow zoomIn" data-wow-offset="200">
                      <a href="{{url('')}}/{{$topInflatableLp->slug}}" class="products-box text-center">
                        <div class="animated-border-box-glow">
                          <div class="products-box-img">
                            <?php if(isset($topInflatableLp->image) && $topInflatableLp->image !== '') 
                            {
                              ?>                  <img src="{{url('')}}/images/{{$topInflatableLp->image}}"  />
                              <?php }else{?>
                          @foreach(getSubCategoryImages($getSubCategories[0]->id, 10, 'DESC') as $key => $productImage)
                            <img src="{{url('')}}/images/{{$productImage->image}}"  />
                            @endforeach
                            <?php }?>
                          </div>
                          <div align="right"  class="product_internal_title" @if(session('LoggedUser'))
                          data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatableLp->id}}"
                          data-index-link="{{ route('admin.category.list') }}"
                        @endif></div>
                          <div class="products-box-heading text-uppercase theme-heading">
                            <h5>{{ strip_tags($topInflatableLp->name) }}</h5>
                          </div>
                        </div>
                      </a>
                    </div>
                    <?php } else { ?>
                    <div class="updates-slider-item wow zoomIn" data-wow-offset="200">
                      <a href="{{url('')}}/{{$topInflatableLp->slug}}" class="products-box text-center">
                        <div class="animated-border-box-glow">
                          <div class="products-box-img">
                            <img src="{{url('/')}}/images/{{$topInflatableLp->image}}"  />
                          </div>
                          <div align="right"  class="product_internal_title" @if(session('LoggedUser'))
                          data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatableLp->id}}"
                          data-index-link="{{ route('admin.category.list') }}"
                        @endif></div>
                          <div class="products-box-heading text-uppercase theme-heading">
                            <h5>{{ $topInflatableLp->name }}</h5>
                          </div>
                        </div>
                      </a>
                    </div>
                    <?php } ?>
                    @endforeach
         
                  </div>
                  <div class="products-custom-nav slider-reverse-arrows owl-nav position-relative text-center mt-lg-4 mt-2">
                    <a href="{{ $productLink->url }}" class="btn text-uppercase btn-animation--infinity">VIEW ALL PRODUCTS</a>
                  </div>
                </div>
              </div>
            </div>
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
      @includeFirst(['theme::ext.footer', 'ext.footer'])
    </div>
    
   
    @includeFirst(['theme::ext.script', 'ext.script'])
  </body>
</html>
