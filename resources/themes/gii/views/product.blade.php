@extends('layout.front-index')
@section('title','Product Page')

@section('custom-js')
<script>


  
function goBack() {
  window.history.back();
}


$(document).ready(function () {
  $( ".lazyload" ).css('overflow', 'auto');
  $( ".loader" ).hide();
});

//         $( document ).ready(function() {
//   $(".open-modal").click(function(){
//     //   alert('test');
//     var data_image = $(this).attr('data-image');
//     var data_type = $(this).attr('data-type');
//     var data_title = $(this).attr('data-title');
//     var data_clientName = $(this).attr('data-clientName');
//     var data_short_description = $(this).attr('data-short_description');
//     var data_full_description = $(this).attr('data-full_description');
    
// 		$('.card-img').attr('src',data_image);
// 		$('.card-image-link').val(data_image);
        
// 		$('.card-title').val(data_title);
// 		$('.card-client').html(data_clientName);
// 		$('.short-description').html(data_short_description);
// 		$('.full-description').html(data_full_description);


		
// 	}); 
// });

	$(".product").addClass( "active");
  $(".our_product_menu").addClass( "active");
  $(".our_product_menu i").addClass( "menu_active");
</script>
<style>
  /*@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
    .showProductDetails .subCategoryImage img{
      height: 543px !important; object-fit: cover; min-height: initial;
    }
  } 

  @media only screen and (min-width: 1030px) and (max-width: 1366px){
    .showProductDetails .subCategoryImage img{
      height: 543px !important; object-fit: cover; min-height: initial;
    }
  }

  @media only screen and (min-width: 1370px) {
    .showProductDetails .subCategoryImage img{
      height: 372px !important; object-fit: cover; min-height: initial;
    }
  }*/
  @media only screen and (min-width: 1920px) {
    .showProductDetails .subCategoryImage img{
      height: 543px !important; object-fit: cover; min-height: initial;
    }
  }
  @media (min-width: 1200px) and (max-width: 1599px) {
    .showProductDetails .subCategoryImage img{
      height: 372px !important; object-fit: cover; min-height: initial;
    }
  }
  @media (min-width: 1600px) and (max-width: 1919px) {
    .showProductDetails .subCategoryImage img{
      height: 543px !important; object-fit: cover; min-height: initial;
    }
  }
  @media (min-width: 1200px) and (max-width: 1548px) {
    .showProductDetails .subCategoryImage img{
      height: 543px !important; object-fit: cover; min-height: initial;
    }
  }
  @media (min-width: 1040px) and (max-width: 1199px) {
    .showProductDetails .subCategoryImage img{
      height: 302px !important; object-fit: cover; min-height: initial;
    }
  }
  @media (max-width: 1039px) {
    .showProductDetails .subCategoryImage img{
      height: 543px !important; object-fit: cover; min-height: initial;
    }
  }
  /*@media only screen and (min-width: 600px) {
    .showProductDetails .subCategoryImage img{
      height: 543px !important; object-fit: cover; min-height: initial;
    }
  }*/
</style>
@endsection
@section('content')
<?php 
$industriesPageData = getPageData('industrie_page');
?>
<div class="our_product">
<!-- back -->
  <section class="back">
    <div class="container">
      <div class="back_sec">
        <span >home &nbsp; :
          @if(getReffrel())
              <p class="breadcrumb-item"><a href="{{getReffrel()['url']}}">{{getReffrel()['name']}}</a></p>&nbsp&nbsp&nbsp:
          @endif
          <p class="breadcrumb-item"><a href="">{{getSocialMedia()->product_title}}</a></p>
        </span>
        <a href="{{ url()->previous() }}" class="read_all"><p>back</p></a>
      </div>
    </div>
  </section>

  <?php 
    /*echo "<pre>";
    print_r(getMainCategories());*/
  ?>
  <!-- tab -->
  <section class="tab_blk">
    <div class="container">
      <div class="big_text">
        <a href="#" class="orange-title">{{getSocialMedia()->product_title}}</a>
        <span>  {{ $pageData->page_title }}
        
      <div class="product_title"  @if(session('LoggedUser'))
                                    data-link="{{route('admin.product-page.editor')}}"
                                @endif></div>
      </span>
      </div>
      <dl class="responsive-tabs">
        <?php $toEndMain  = count(customMainCat(0, 16)); ?>
          @foreach(customMainCat(0, 16) as $key => $mainCategoryAll)
          <div class="onscreen_product_main_category_title2" @if(session('LoggedUser'))
                data-link="{{route('admin.category.edit', $mainCategoryAll->id)}}?type=main_category&onscreenCms=true"
                data-delete-link="{{route('admin.index')}}/category/delete/{{ $mainCategoryAll->id}}"
            @endif>
            <dt class="@if($key == 0)
                        ft-clr-white
                       @endif"><a style="color: #999;" href="{{$mainCategoryAll->slug}}">{{$mainCategoryAll->name}}</a></dt>
                    </div>
          @endforeach
      </dl>
      <dd>
        <div class="tab_item">
          @foreach(customMainCat() as $key => $topInflatableLp)
          <?php 
          $getSubCategories = getSubCategories($topInflatableLp->id);
              if (!empty($getSubCategories)) {
                $imageName = getSubCategoryImages($getSubCategories[0]->id, 10, 'DESC')[0]['image']; 
                /*foreach(getSubCategoryImages($getSubCategories[0]->id,10, 'DESC') as $key => $productImage){
                  print_r($productImage);
                }*/
          ?>
          <div class="item_img showProductDetails other_cat_admin" data-link="{{url('')}}/{{$topInflatableLp->slug}}">
            <div align="right"  class="product_internal_title" @if(session('LoggedUser'))
                data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatableLp->id}}"
                data-index-link="{{ route('admin.category.list') }}"
              @endif></div>
            <div class="tab_top subCategoryImage">
          @foreach(getSubCategoryImages($getSubCategories[0]->id, 10, 'DESC') as $key => $productImage)
          <img src="{{url('/')}}/images/{{$productImage->image}}" style="" />
          @endforeach
        </div>
        <div class="big_text small_text">
          <a href="{{url('')}}/{{$topInflatableLp->slug}}">{{ $topInflatableLp->name }}</a>
        </div>
            <!-- <div class="tab_hover">
            <h3>product name</h3>
          </div> -->
          </div>
        <?php } else { ?>
          <div class="item_img showProductDetails other_cat_admin" data-link="{{url('')}}/{{$topInflatableLp->slug}}">
            <div align="right"  class="product_internal_title" @if(session('LoggedUser'))
                data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatableLp->id}}"
                data-index-link="{{ route('admin.category.list') }}"
              @endif></div>
            <div class="tab_top subCategoryImage">
            <img src="{{url('/')}}/images/{{$topInflatableLp->image}}"  />

            </div>
        <div class="big_text small_text">
          <a href="{{url('')}}/{{$topInflatableLp->slug}}" class="noImageFontClr">{{ $topInflatableLp->name }}</a>
        </div>
            <!-- <div class="tab_hover">
            <h3>product name</h3>
          </div> -->
          </div>
        <?php } ?>
          @endforeach
        </div>
      </dd>
    </div>
  </section>

  <!-- description -->
  <section class="description">
    <div class="container">
      <div class="description_wrap">
        <div class="description_blk TopContent" @if(session('LoggedUser'))
					data-link="{{route('admin.product-page.editor')}}"
				@endif>
          {!! html_entity_decode($pageData->description) !!}
      	</div>
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
</div>
@endsection

<style type="text/css">
  .description .description_blk img{
        width: auto !important;
  }
</style>