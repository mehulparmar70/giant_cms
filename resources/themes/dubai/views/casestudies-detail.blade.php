@extends('layout.front-index')
@section('title','Product Details')

@section('custom-js')

<script>
$(document).ready(function () {
  $( ".lazyload" ).css('overflow', 'auto');
  $( ".loader" ).hide();
});
function goBack() {
  window.history.back();
}
  
  $(document).ready(function () {
    $(".top-content-pages").hide();
  });

$(".case_studies_menu").addClass( "active");
$(".case_studies_menu_active").addClass( "menu_active");
  
</script>
<style type="text/css">
  .onscreen-media-testimonial-item-link {
    position: unset !important;
    margin-left: 0 !important;
  }
</style>
@endsection
@section('content')
<div class="our_product product_detail">
  <!-- back -->
  <section class="back">
    <div class="container">
      <div class="back_sec">
        <span>
          home &nbsp; :
          @if(getReffrel())
              <p class="breadcrumb-item"><a href="{{getReffrel()['url']}}">{{getReffrel()['name']}}</a></p>&nbsp&nbsp&nbsp:
          @endif
          <!-- <p class="breadcrumb-item"><a href="{{ url('case-studies') }}">Case Studies</a></p> -->
          <p class="breadcrumb-item"><a href="{{ url($blogDetail->slug) }}">{{$blogDetail->title}}</a></p>
        </span>
        <a href="{{ url('case-studies') }}" class="read_all"><p>back</p></a>
      </div>
    </div>
  </section>

  <section class="case_explore">
    <div class="container">
      <div class="inner_tab_blk">
        <div class="inner_tab_blk_right">
          <div class="description">
            <div class="description_wrap">
              <div class="big_text gallert_text" style="margin-top: 30px; margin-bottom: 0px" >
                <a href="#" class="orange-title">{{$blogDetail->title}}</a>
              </div>
              <div class="description_blk onscreen_blog_detail_page" @if(session('LoggedUser'))
                  data-link="{{route('casestudies.edit', $blogDetail->id)}}"
                @endif>
                <div class="description_blk_item">
                  <iframe src="https://docs.google.com/viewer?url={{ url('/') }}/casestudies/{{ $blogDetail->file_name }}&embedded=true" width="100%" height="1080" style="border: none;"></iframe>
                  <!-- <iframe src="{{ url('web') }}/casestudies/{{ $blogDetail->file_name }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="1080" style="border: none;"></iframe> -->
                  <!-- <embed src="{{ url('web') }}/casestudies/{{ $blogDetail->file_name }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="1080" /> -->
                </div>
       
              </div>
              <div class="description_wrap">
                <div class="onscreen_product_internal_title onscreen_casestudiesedit" @if(session('LoggedUser'))
                      data-link="{{route('casestudies.edit', $blogDetail->id)}}?onscreenCms=true&id={{$blogDetail->id}}"
                      @endif></div>
                <div class="description_blk">
                  <div class="description_blk_item">
                    <p>{!! $blogDetail->full_description !!}</p>
                  </div>  
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

  <!-- <section class="product_video case_studies details_updates">
    <div class="container">
      <div class="big_text">
        <a href="#">more Case Studies</a>
      </div>
      <div class="video_product update_blk_item">
        <div class="client_line">
          @foreach($caseStudiesSlider as $updatesList)
          <div class="update_item onscreen_media_testimonial_item" @if(session('LoggedUser'))
                data-link="{{route('casestudies.edit', $updatesList->id)}}"
                data-delete-link="{{route('admin.index')}}/casestudies/delete/{{ $updatesList->id}}"
              @endif>
            <h2>{{$updatesList->title}}</h2>
            <a class="update_inner match" href="{{ url('case-studies') }}/{{$updatesList->slug}}">
              <img src="{{ url('web') }}/media/md/{{ $updatesList->image }}" />
              <p>
                {!! html_entity_decode($updatesList->short_description) !!}
                <span><img src="{{ url('sardar') }}/images/osearch.png" /> &nbsp; click toview</span>
              </p>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section> -->
<section class="product_video case_studies details_updates news_letters update_details_slider">
  <div class="container">
    <div class="big_text">
      <a href="#">more Case Studies</a>
    </div>
    <div class="video_product update_blk_item">
      @foreach($caseStudiesSlider as $updatesList)
      <div class="update_item onscreen_media_testimonial_item" @if(session('LoggedUser'))
                data-link="{{route('casestudies.edit', $updatesList->id)}}"
                data-delete-link="{{route('admin.index')}}/casestudies/delete/{{ $updatesList->id}}"
              @endif>

        <h2>{{$updatesList->title}}</h2>
        <a class="update_inner" href="{{ url('case-studies') }}/{{$updatesList->slug}}">
          <img src="{{ url('') }}/images/{{ $updatesList->image }}" />
          <p>
           {!! strip_tags($updatesList->short_description) !!}
            <span
              ><img src="{{ url('') }}/images/osearch.png" /> &nbsp; click to view</span
            >
          </p>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>
  <!-- client section  -->
  <section class="client_slider">
    <div class="container">
      <div class="client_line">
          @include('widget.client-slider2')
          @include('widget.awards-slider')
      </div>
    </div>
  </section>

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

  <section class="update_slider update_left">
    <div class="container">
      <div class="client_line">
        @include('widget.newsleters-slider')
        @include('widget.casestudy-slider')
      </div>
    </div>
  </section>
</div>
@endsection