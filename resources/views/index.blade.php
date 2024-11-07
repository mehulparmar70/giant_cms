
@includeFirst(['theme::front-index', 'front-index'])

@section('custom-js')


@endsection
@section('content')



<!-- room -->
<section class="banner_slider">
  <div class="container">
    @include('widget.industries-serve')
  </div>
</section>

<!-- tab -->
<section class="tab_blk">
  <div class="container">
    <div class="big_text">
      <a href="{{url('/products')}}">{{getSocialMedia()->product_title}}</a>
      <span>  {{ $productTitle->page_title }}
        
      <div class="product_title_1"  @if(session('LoggedUser'))
                                    data-link="{{route('admin.product-page.editor')}}?onscreenCms=true"
                                @endif></div>
      </span>
      
    </div>
      @include('widget.top-inflatables')
      
      <div>
        <a href="{{url('/products')}}" class="all_product"><p>VIEW ALL PRODUCTS</p></a>
        <a style="margin-left: 41%;
    margin-top: -30px;
    position: absolute;" class="product"
            @if(session('LoggedUser'))
              data-link="{{route('admin.product-page.editor')}}"
            @endif></a>
      </div>
  </div>
</section>

<!-- company -->
<section class="company">
  <div class="container">
    <div class="big_text">
      <a href="{{url('/about')}}">our company</a>
      <span>  {{ isset($aboutPageData->page_title)?$aboutPageData->page_title:'' }}
              <div class="product_title"  @if(session('LoggedUser'))
                                            data-link="{{route('admin.about-page.editor')}}"
                                        @endif></div>
             </span>
    </div>
    <div class="company_blk">
      <div>
        <div class="company_left">
          <div class="left_item1">
            @include('widget.our-services')
          </div>
          <div class="left_item2">
            @include('widget.youtube')
          </div>
        </div>
        <a href="{{url('/about')}}" class="read_all"><p>READ ALL</p></a>
      </div>
      <div class="company_right">
        @include('widget.contact-form1')
      </div>
    </div>
  </div>
</section>

<!-- section slider -->
<section class="client_slider">
  <div class="container">
    <div class="client_line">
        @include('widget.client-slider2')
        @include('widget.awards-slider')
    </div>
  </div>
</section>

<!-- third slider -->
<section class="update_slider">
  <div class="container">
    <div class="client_line">
        @include('widget.updates-slider')
        @include('widget.casestudy-slider')
    </div>
  </div>
</section>

<section class="update_slider update_slider_2" style="margin-top: 50px">
  <div class="container">
    <div class="client_line">
        @include('widget.testimonials-slider')
        @include('widget.newsleters-slider')
    </div>
  </div>
</section>

<!-- gray part -->
<section class="gray">
  <div class="container">
    @include('widget.experts')
  </div>
</section>
@endsection
