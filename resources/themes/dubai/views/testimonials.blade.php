@extends('layout.front-index')
@section('title','Testimonials')

@section('custom-js')
<script>
$(document).ready(function () {
  $( ".lazyload" ).css('overflow', 'auto');
  $( ".loader" ).hide();
});


$(".testimonials_menu").addClass( "active");
$(".testimonials_menu_active").addClass( "menu_active");
  
function goBack() {
  window.history.back();
}


</script>
@endsection
@section('content')

<?php 
  $industriesPageData = getPageData('industrie_page');
?>
<div class="our_product product_detail">
  <section class="back">
    <div class="container">
      <div class="back_sec">
        <span>home &nbsp; :
          @if(getReffrel())
              <p class="breadcrumb-item"><a href="{{getReffrel()['url']}}">{{getReffrel()['name']}}</a></p>&nbsp&nbsp&nbsp:
          @endif
          <p class="breadcrumb-item"><a href="{{ url('testimonials') }}">Testimonials</a></p>
          @if(app('request')->input('testimonial'))
          &nbsp&nbsp&nbsp: <p class="breadcrumb-item"><a href="{{url('testimonials')}}?testimonial={{$testimonialDetail->id}}">{{$testimonialDetail->client_name}}</a></p>
          @endif
        </span>
        <a href="{{ url()->previous() }}" class="read_all"><p>back</p></a>
      </div>
    </div>
  </section>
  @if(app('request')->input('testimonial'))
  <section class="case_explore">
    <div class="container">
      <div class="inner_tab_blk">
        <div class="inner_tab_blk_right">
          <div class="description">
            <div class="description_wrap">
              <div class="big_text gallert_text" style="margin-top: 30px; margin-bottom: 0px" >
                <a href="#" class="orange-title">{{$testimonialDetail->client_name}}</a>
              </div>
              <div class="description_blk onscreen_blog_detail_page" @if(session('LoggedUser'))
                  data-link="{{route('testimonials.edit', $testimonialDetail->id)}}"
                @endif>
                <div class="description_blk_item">
                  {!! htmlspecialchars_decode($testimonialDetail->full_description) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="inner_tab_blk_left">
          @include('widget.contact-form1')
        </div>
      </div>
    </div>
  </section>
  @else
  <section class="case_explore">
    <div class="container">
      <div class="inner_tab_blk">
        <div class="inner_tab_blk_right">
          <div class="image_gallery">
            <div class="product_cat_name">
              <img src="{{ url('') }}/images/person.png" alt="person" />
              <p>Testimonials</p>
              <div class="product_title"  @if(session('LoggedUser'))
                                            data-link="{{route('admin.testimonial-page.editor')}}"
                                        @endif></div>
            </div>
            <img src="{{ url('') }}/images/banner2.jpg" alt="banner" / class="case-img">
          </div>
        </div>
        <div class="inner_tab_blk_left">
          @include('widget.contact-form1')
        </div>
      </div>
    </div>
  </section>
  <section class="product_video case_studies">
    <div class="container">
      <div class="big_text big_flex">
        <a href="#" class="orange-title">Latest testimonials</a>
        <span>  {{ isset($pageData->page_title)?$pageData->page_title:'' }}
              <div class="product_title"  @if(session('LoggedUser'))
                                            data-link="{{route('admin.testimonial-page.editor')}}"
                                        @endif></div>
                                        <div class="description_blk_item">
                    <p>{!! $pageData->description !!}</p>
                  </div>  
             </span>
      </div>
      <div class="video_product update_blk_item">
        <div class="client_line">
          
          @foreach($testimonials as $testimonial)
          <div class="update_item testimonial_adm">
            <h2>{{$testimonial->client_name}}</h2>
            <div class="onscreen_popup_block" @if(session('LoggedUser'))
                  data-link="{{route('testimonials.edit', $testimonial->id)}}"
                  data-delete-link="{{route('admin.index')}}/testimonial/delete/{{ $testimonial->id}}"
                @endif></div>
            <a class="update_inner match " href="{{url('testimonials')}}?testimonial={{$testimonial->id}}">
              <img src="{{url('web')}}/media/lg/{{$testimonial->image}}" />
              <p>
                {!! $testimonial->short_description !!}
                <span><img src="{{ url('') }}/images/osearch.png" /> &nbsp; click to view</span>
              </p>
            </a>
          </div>
          @endforeach
        </div>
      </div>
      {{ $testimonials->links("widget.pagination") }}
    </div>
  </section>
  @endif
  <!-- section slider -->
  <section class="client_slider update_text">
    <div class="container">
      <div class="client_line">
        @include('widget.client-slider2')
        @include('widget.awards-slider')
      </div>
    </div>
  </section>

  <!-- gray part -->
  <section class="gray">
    <div class="container">
      @include('widget.experts')
    </div>
  </section>

  <section class="banner_slider banner_margin">
    <div class="container">
      @include('widget.industries-serve-with-title')
    </div>
  </section>

  <section class="update_slider update_left" style="margin-top: 50px">
    <div class="container">
      <div class="client_line">
          @include('widget.newsleters-slider')
          @include('widget.casestudy-slider')
      </div>
    </div>
  </section>
</div>
@endsection