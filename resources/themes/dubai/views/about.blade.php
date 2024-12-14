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
    ?>
    
    {{-- Try to load 'header-sports-vertical' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.header-sports-vertical', 'ext.header-sports-vertical'])


    <section class="about-banner-section common-inner-banner header-top-space position-relative">
      <div class="bg-img-wrap">
        <img class="bg-img-top opacity-50" src="{{asset('/')}}/images/bg-image-about.png" alt="about-banner">
        <img class="bg-img-bottom" src="{{asset('/')}}/dubai/images/red-effect-bottom.webp" alt="red-effect-bottom">
      </div>
      <div class="container position-relative">
        <div class="breadcrumb">
          <div class="breadcrumb-left">
            <a href="{{ $homeLink->url }}" class="header-top-home d-flex align-items-center text-uppercase">
              <img class="me-2" src="{{asset('/')}}/dubai/images/home-icon.png" alt="home-icon">Home
            </a>
            <span class="text-uppercase">{{$Urllist->name}}</span>
          </div>
          <a href="{{ $homeLink->url }}" class="breadcrumb-back text-uppercase">Back<img src="{{asset('/')}}/dubai/images/right-arrow-circle.svg" alt="right-arrow-circle"></a>
        </div>
        <div class="theme-stroke-heading text-center text-uppercase">
          <strong class="letters">{{$Urllist->name}}</strong>
          <h1 class="h3 letters">{{$Urllist->name}} </h1>
          <div  class="product_title_1"  @if(session('LoggedUser'))
              data-link="{{route('admin.about-page.editor')}}?onscreenCms=true"
          @endif></div>
        </div>
        <div class="row g-xxl-5 g-lg-4 g-3">
          <div class="col-xl-9 col-md-8">
            <div class="about-banner-blocks-wrap wow fadeInLeft" data-wow-offset="150">
              <div class="row g-xxl-5 g-lg-4 g-3">
                @foreach($sections as $sec)
                <div class="col-sm-6">
                  <div class="about-banner-block">
                    <div  class="product_title_1"  @if(session('LoggedUser'))
                  data-link="{{route('admin.aboutsection1',$sec->id)}}?onscreenCms=true"
              @endif></div>
                    <div class="about-block-icon">
                      <img src="{{asset('/')}}images/{{$sec->icon}}" alt="professional-team-icon">
                    </div>
                    <h6>{{$sec->title}}</h6>
                    <p>{{$sec->description}}</p>
                  </div>
                </div>
                @endforeach

              </div>
            </div>
            <div class="about-banner-desc wow zoomIn" data-wow-offset="150">
              <div >
                <span>       <div class="menu_crud"  @if(session('LoggedUser'))
                  data-link="{{route('admin.about-page.editor')}}"
              @endif></div>
                        {!! $pageData->description !!}</span>
            </div>
            </div>
          </div>
                  <div class="col-xl-3 col-lg-4 col-md-5 wow fadeInRight" data-wow-offset="150">
                    <div class="share-concept-form-box share-about-box mx-md-0 mx-auto -sticky">
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
                    <h1 class="h3 letters" onclick="window.location.href = '{{ $productLink->url }}';">Our <span>Products</span></h1>
                    <div  class="product_title_1"  @if(session('LoggedUser'))
                    data-link="{{route('admin.product-page.editor')}}?onscreenCms=true"
                @endif></div>
                  </div>
                </div>
                <div class="updates-wrap position-relative">
                  <div class="bg-img-wrap">
                    <img class="bg-img-top" src="{{asset('/')}}/dubai/images/red-effect-top.webp" alt="red-effect-top">
                  </div>
                  <div class="container position-relative pt-xxl-4">
                    <div class="updates-slider pb-3">
                      @foreach(customMainCat() as $key => $topInflatableLp)
                      <?php 
                      $getSubCategories = getSubCategories($topInflatableLp->id);
                          if (!empty($getSubCategories)) {
                            $imageName = getSubCategoryImages($getSubCategories[0]->id, 10, 'DESC')[0]['image']; 
                            /*foreach(getSubCategoryImages($getSubCategories[0]->id,10, 'DESC') as $key => $productImage){
                              print_r($productImage);
                            }*/
                      ?>
                      <div class="updates-slider-item wow zoomIn" data-wow-offset="150">
                        <a href="{{url('')}}/{{$topInflatableLp->slug}}" class="products-box text-center">
                          <div class="animated-border-box-glow">
                            <div class="products-box-img">
                              <?php if(!empty($topInflatableLp->image))
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
                      <div class="updates-slider-item wow zoomIn" data-wow-offset="150">
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
                    <div class="updates-custom-nav slider-reverse-arrows owl-nav position-relative text-center mt-lg-4 mt-1">
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
                    <div class="share-concept-form-box wow flipInY" data-wow-offset="150">
                      <img class="w-full" src="{{asset('/')}}/dubai/images/share-concept.png" alt="share-concept">
                      @include('widget.contact-form1')
                    </div>
                    <div class="contact-links-box text-center wow flipInY" data-wow-offset="150">
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