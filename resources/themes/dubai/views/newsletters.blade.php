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

</script>

@endsection

@section('content')
<div class="our_product product_detail"> 
    <section class="back">
        <div class="container">
          <div class="back_sec">
            <span>home &nbsp; :
              @if(getReffrel())
                  <p class="breadcrumb-item"><a href="{{getReffrel()['url']}}">{{getReffrel()['name']}}</a></p>&nbsp&nbsp&nbsp:
              @endif
              <p class="breadcrumb-item"><a href="{{ url('news-letters') }}">NewsLetters</a></p>
            </span>
            <a href="{{ url()->previous() }}" class="read_all"><p>back</p></a>
          </div>
        </div>
    </section>
    <section class="product_video case_studies news_letters">
        <div class="container">
          <div class="big_text big_flex">
            <a href="#" class="orange-title">newsletters</a>
            <span>  {{ isset($pageData->page_title)?$pageData->page_title:'' }}
              <div class="product_title"  @if(session('LoggedUser'))
                                          data-link="{{route('admin.newsletter-page.editor')}}"
                                      @endif></div>
                                      <div class="description_blk_item">
                    <p>{!! $pageData->description !!}</p>
                  </div>  
            </span>
          </div>
          <div class="video_product">
            @foreach($newsletter as $newsletterList)
            <div class="product_item">
              <h4 class="newsletter_card">{{ $newsletterList->title }}<div class="crud" @if(session('LoggedUser'))
                data-create="{{route('newsletter.create')}}"
                data-link="{{route('newsletter.edit', $newsletterList->id)}}"
                data-delete-link="{{route('admin.index')}}/newsletter/delete/{{ $newsletterList->id}}"
              @endif></div></h4>
              <!-- <h5>title here</h5> -->
              <a href="{{ url('news-letters') }}/{{$newsletterList->slug}}" class="video_text">
                <img src="{{url('/')}}/images/{{$newsletterList->image}}" />
              </a>
            </div>
            @endforeach
          </div>
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