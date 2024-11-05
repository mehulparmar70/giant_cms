
@includeFirst(['theme::front-index', 'front-index'])

@section('custom-js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<style>
.loader img{
    width:0px;
}
.onscreen-banner-slider {
    background: white;
    font-size: 24px;
    padding: 10px;
}
.onscreen-banner-slider .fa{
  padding-top:20px;
}
</style>
    <script>
        $(".home").addClass("active");
        $(".home_menu_active").addClass("menu_active");

        /*$.fn.responsiveTabs = function() {

        return this.each(function() {
          var el = $(this),
              tabs = el.find('.product_title_main'),
              content = el.find('dd'),
              placeholder = $('<div class="responsive-tabs-placeholder"></div>').insertAfter(el);
              
          placeholder.html(tabs.next().html());
          tabs.on('click', function() {
            var tab = $(this);
            // undefined
            if ($(tab).data('tab') != undefined) {
              console.log('Hello');
              $('.main-img-slider').slick('unslick');
              $('.thumb-nav').slick('unslick');
            }
            tabs.not(tab).removeClass('active');
            tab.addClass('active');

            placeholder.html( tab.next().next().html() );
          });

          // tabs.filter(':first').trigger('click');
        });

      }


      $('.responsive-tabs').responsiveTabs();*/
    </script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<section class="banner">
  <div class="banner_slick_123">
    <div class="banner_123">
  
      @foreach ($sliders as $key => $slider)
     
      <div class="banner_slick_item slick-slide">
        <img src="{{ url('/') }}/images/{{ $slider->image }}" alt="{{$slider->description}}" />
        <div class="container">
          <h1>
            {{ $slider->title }}
          </h1>
          <a href="{{ $slider->url }}" class="discuss"> view more </a>
          @if(session('LoggedUser'))
            <!-- <a class="onscreen-banner-slider" href="{{ url('/powerup/slider?onscreenCms=true') }}" onclick="window.open('{{ url("/powerup/slider?onscreenCms=true") }}', 'toolbar=no, location=no','left=`+left+`,width=`+popupWinWidth+`,height=860'); return false;" ><i class='fa fa-edit'></i></a> -->
            <div class="content_banners" 
                data-create-link="{{ route('slider.create') }}" 
                data-edit-link="{{ route('slider.edit', $slider->id) }}" 

                data-index-link="{{ route('slider.index') }}"
                data-delete-link="{{ route('slider.delete',$slider->id) }}">
            </div>

          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

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
