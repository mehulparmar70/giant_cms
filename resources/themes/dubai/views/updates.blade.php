@extends('layout.front-index')
@section('title','About Us')

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

$(".updates_menu").addClass( "active");
$(".updates_menu_active").addClass( "menu_active");
  
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
          <p class="breadcrumb-item"><a href="{{ url('updates') }}">updates</a></p>
        </span>
	      <a href="{{ url()->previous() }}" class="read_all"><p>back</p></a>
	    </div>
	  </div>
	</section>
  <section class="case_explore">
    <div class="container">
      <div class="inner_tab_blk">
        <div class="inner_tab_blk_right">
          <div class="image_gallery">
            <div class="product_cat_name">
              <img src="{{ url('') }}/images/person.png" alt="person" />
              <p >updates</p>
              <div class="product_title"  @if(session('LoggedUser'))
                                            data-link="{{route('admin.blog-page.editor')}}"
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
        <a href="#" class="orange-title">Latest updates</a>
        <span>  {{ isset($pageData->page_title)?$pageData->page_title:'' }}
              <div class="product_title"  @if(session('LoggedUser'))
                                            data-link="{{route('admin.blog-page.editor')}}"
                                        @endif></div>
                                        <div class="description_blk_item">
                    <p>{!! $pageData->description !!}</p>
                  </div>  
             </span>
      </div>
      <div class="video_product update_blk_item">
        <div class="client_line">
          @foreach($updates as $update)
          <div class="update_item">
            <h2 class="onscreen_page_blog_block" @if(session('LoggedUser'))
                {{-- data-link="{{route('blog.edit', $update->id)}}" --}}
                data-delete-link="{{route('admin.index')}}/blog/delete/{{ $update->id}}"
              @endif>{{ $update->title }}</h2>
            <a class="update_inner match" href="{{ url('updates') }}/{{$update->slug}}">
              <img src="{{url('')}}/images/{{$update->image}}" />
              <p>
                {!! html_entity_decode($update->short_description) !!}
                <span
                  ><img src="{{ url('') }}/images/osearch.png" /> &nbsp; click to
                  view</span
                >
              </p>
            </a>
          </div>
          @endforeach
        </div>
      </div>
      {{ $updates->links("widget.pagination") }}
    </div>
  </section>

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