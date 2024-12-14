<!DOCTYPE HTML>
<html>
  <head>
  {{-- Try to load 'head' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.head', 'ext.head'])

    {{-- Additional theme-specific CSS --}}
    @yield('addon-css')
  </head>
  <body>
  <?php $current_page = '';     $productLink = App\Models\admin\UrlList::find(96);  // Our Products link
  $homeLink = App\Models\admin\UrlList::find(95);  // Home link
  $contactLink = App\Models\admin\UrlList::find(101);  // Contact Us link
  ?>
    
    {{-- Try to load 'header-sports-vertical' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.header-sports-vertical', 'ext.header-sports-vertical'])

        <!-- banner area part -->
        <section class="products-banner-section common-inner-banner header-top-space position-relative">
          <div class="bg-img-wrap">
            <img class="bg-img-top opacity-50" src="{{asset('/')}}/dubai/images/about-banner.webp" alt="products-banner">
            <img class="bg-img-bottom" src="{{asset('/')}}/dubai/images/red-effect-bottom.webp" alt="red-effect-bottom">
          </div>
          <div class="container position-relative">
            <div class="breadcrumb">
              <div class="breadcrumb-left">
                <a href="{{ $homeLink->url }}" class="header-top-home d-flex align-items-center text-uppercase">
                  <img class="me-2" src="{{asset('/')}}/dubai/images/home-icon.png" alt="home-icon">Home
                </a>
                <span class="text-uppercase">Search</span>
              </div>
              <a href="{{ $homeLink->url }}" class="breadcrumb-back text-uppercase">Back<img src="{{asset('/')}}/dubai/images/right-arrow-circle.svg" alt="right-arrow-circle"></a>
            </div>
            <div class="theme-stroke-heading text-center text-uppercase mb-4">
              <strong class="letters">Search</strong>
              <h3 class="h3 letters">Se<span>arch</span></h3>
              <div  class="product_title_1"  @if(session('LoggedUser'))
              data-link="{{route('admin.blog-page.editor')}}?onscreenCms=true"
          @endif></div>
            </div>
            <div class="updates-section -update-page">
              <div class="updates-wrap position-relative">
                <div class="container">
                  <div class="row updates-blocks-list">
                    
                    @foreach($searchData as $search)
                    

                    <div class="col-md-4 col-sm-6 updates-blocks-col">
                      <div class="updates-slider-item">
                        <a href="{{ url('/') }}/{{$search['Slug']}}" class="updates-box wow bounce" data-wow-offset="150">
                          <div class="updates-box-img">
                            <img src="{{$search['Image']}}" />
                          </div>
                          <div class="updates-box-content">
                
                            <h6>{{ $search['Title'] }}</h6>
                            <p>{!! html_entity_decode($search['Description']) !!}</p>
                            <span class="btn">View More</span>
                          </div>
                        </a>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  <div class="pagination text-center mb-xxl-3 mb-1">

          
                  </div>
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
                            @foreach(getSubCategoryImages($getSubCategories[0]->id, 10, 'DESC') as $key => $productImage)
                            <img src="{{url('/')}}/images/{{$productImage->image}}"  />
                            @endforeach
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
                      <a class="contact-social-link" target="_blank"><img src="{{asset('/')}}/dubai/images/facebook.png" alt="facebook-icon"></a>
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
    <!-- Modal -->

  

    @includeFirst(['theme::ext.script', 'ext.script'])
  </body>
</html>
