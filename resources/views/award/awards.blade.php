@extends('layout.front-index')
@section('title','About Us')

@section('custom-js')

@section('content')

<div class="our_product product_detail">
	<section class="back">
	  <div class="container">
	    <div class="back_sec">
	      <span>home &nbsp; :
          @if(getReffrel())
            <p class="breadcrumb-item"><a href="{{getReffrel()['url']}}">{{getReffrel()['name']}}</a></p>&nbsp&nbsp&nbsp:
          @endif
          <p class="breadcrumb-item"><a href="{{ url('awards') }}">AWARDS</a></p>
        </span>
	      <a href="#" onclick="goback()" class="read_all"><p>back</p></a>
	    </div>
	  </div>
	</section>

	<section class="case_explore">
	  <div class="container">
      <div class="big_text big_flex">
        <a href="#" class="orange-title">AWARDS</a>
        <span>  {{ isset($pageData->page_title)?$pageData->page_title:'' }}
          <div class="product_title"  @if(session('LoggedUser'))
                                      data-link="{{route('admin.awards-page.editor')}}"
                                  @endif></div>
       </span>
      </div>
	    <div class="inner_tab_blk">
	      <div class="inner_tab_blk_right">
          <div class="image_gallery">
            <div class="product_cat_name">
              <img src="{{ url('') }}/images/person.png" alt="person" />
              <p>Our Awards</p>
              @if(session('LoggedUser'))
                <a href="#" class="header_crud" @if(session('LoggedUser'))
                data-link="{{route('award.index')}}"
                data-create="{{route('award.index')}}"
                data-delete-link="{{route('award.index')}}"
                @endif></a>
              @endif
            </div>
            <div class="clients_logo">
              <?php 
                $awardArrs = array_chunk(json_decode(json_encode($awards), true), 2);
                $clientArrs = array_chunk(json_decode(json_encode($clients), true), 2);
              ?>
              @foreach($awardArrs as $i => $clientArr)
                @foreach($clientArr as $clientList)
                  <a class="clients_item">
                    @if(session('LoggedUser'))
                    <div href="#" style="position: absolute;padding-bottom: 10%;" class="crud" @if(session('LoggedUser'))
                    data-create="{{route('award.index')}}"
                    data-link="{{route('award.edit',$clientList['id'])}}"
                    data-delete-link="{{route('admin.index')}}/award/delete/{{ $clientList['id']}}"
                    @endif></div>
                    @endif
                    <img src="{{url('/')}}/images/{{$clientList['image']}}" alt="{{$clientList['name']}}" data-fancybox="gallery" href="{{url('web')}}/images/{{$clientList['image']}}"/>
                  </a>
                @endforeach
              @endforeach
            </div>
          </div>
          <div class="description_wrap">
            <div class="menu_crud" @if(session('LoggedUser'))
                  data-link="{{route('admin.awards-page.editor')}}"
                  @endif></div>
            <div class="description_blk">
              <div class="description_blk_item">
                <p>{!! $pageData->description !!}</p>
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

	<!-- section slider -->
  <section class="client_slider client_page">
    <div class="container">
      <div class="client_wrap">
        <div class="big_text mid_text">
          <a href="{{ url('client') }}">Clients</a>
          <div class="clients_crud" @if(session('LoggedUser'))
                data-link="{{route('client.index')}}"
                data-create="{{route('client.index')}}"
                data-delete-link="{{route('client.index')}}"
                @endif>
          </div>
        </div>
        <div class="client_blk_page">
          @foreach($clientArrs as $i => $clientArr)
            @foreach($clientArr as $clientList)
              <div class="client_item">
                @if(session('LoggedUser'))
                  <div href="#" class="crud" @if(session('LoggedUser'))
                  data-create="{{route('client.index')}}"
                  data-link="{{route('client.edit',$clientList['id'])}}"
                  data-delete-link="{{route('admin.index')}}/client/delete/{{ $clientList['id']}}"
                  @endif></div>
                @endif
                <a data-fancybox="gallery" href="{{url('/')}}/images/{{$clientList['image']}}" >
                  <img src="{{url('/')}}/images/{{$clientList['image']}}" class="@if(session('LoggedUser')) pt-1 @endif"/>
                </a>
              </div>
            @endforeach
          @endforeach
        </div>
        <a href="{{ url('client') }}" class="read_all explore_all"><p>exeplore ALL</p></a>
      </div>
    </div>
  </section>

  <section class="gray">
    <div class="container">
      @include('widget.experts')
    </div>
  </section>
  <!-- room -->
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