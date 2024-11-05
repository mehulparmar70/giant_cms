
@extends('layout.front-index')
@section('title',' Internal')

@section('custom-js')
<script>
	$(".product").addClass( "active");

function goBack() {
  window.history.back();
}


$(document).ready(function () {
  $( ".lazyload" ).css('overflow', 'auto');
  $( ".loader" ).hide();
});

$(".product").addClass( "active");
$(".our_product_menu").addClass( "active");
$(".product_menu_active").addClass( "menu_active");

</script>
<style>
.sub_categories_padding {
    margin-top: 130px;
}
.deleteImageSlider {
      cursor: pointer;
    }
</style>
@endsection
@section('content')

@if(isset(getParentCategory($current_cat->id)['category']))
	<?php $finalSlug = getParentCategory($current_cat->id)['category']->slug.'/';
		$mainCategorySlug = $finalSlug;
		$searchCriteria = getParentCategory($current_cat->id)['category']->id;
	?>
	@endif

		@if(isset(getParentCategory($current_cat->id)['subcategory']))
			<?php
				$subCategorySlug = getParentCategory($current_cat->id)['subcategory']->slug.'/';
				$searchCriteria = $searchCriteria.','.getParentCategory($current_cat->id)['subcategory']->id;
			?>
		@endif

		@if(isset(getParentCategory($current_cat->id)['subcategory2']))
			<?php $finalSlug = $finalSlug.getParentCategory($current_cat->id)['subcategory2']->slug.'/';
				$subCategory2Slug = getParentCategory($current_cat->id)['subcategory2']->slug.'/';
				$searchCriteria = $searchCriteria.','.getParentCategory($current_cat->id)['subcategory2']->id;
			?>
		@endif

		
<?php 
	$main_category_data = getParentCategory($current_cat->id)['category'];
	$current_products = DB::table('products')->where(['category_id' => $current_cat->id, 'status' => 1])->get();
	
// dd($main_category_data);
$arr = explode(',',$searchCriteria);
// dd($arr);

$intArray = array_map(
    function($value) { return (int)$value; },
    $arr
);
// dd($intArray);

$intArray = array_map(
    function($value) { return (int)$value; },
    $arr
);
$current_criteria = DB::table('criteria_metas')->whereIn('categories', $intArray)->get();

?>

<?php 
	$finalSlug = '';
	$mainCategorySlug = '';
	$subCategorySlug = '';
	$subCategory2Slug = '';
?>
<div class="our_product">
<section class="back">
  <div class="container">
    <div class="back_sec">
      <span >home &nbsp; :
        <p class="breadcrumb-item"><a href="{{ route('products') }}">{{getSocialMedia()->product_title}}</a></p>
        @if(getParentCategory($current_cat->id)['category'])
          &nbsp&nbsp&nbsp: <p class="breadcrumb-item"><a href="{{url('')}}/{{getParentCategory($current_cat->id)['category']->slug}}">{{getParentCategory($current_cat->id)['category']->name}}</a></p>
                    @endif

        @if(getParentCategory($current_cat->id)['subcategory'])
        &nbsp&nbsp&nbsp: <p class="breadcrumb-item"><a href="{{url('')}}/{{getParentCategory($current_cat->id)['subcategory']->slug}}">{{getParentCategory($current_cat->id)['subcategory']->name}}</a></p>
                    @endif

        @if(getParentCategory($current_cat->id)['subcategory2'])
        &nbsp&nbsp&nbsp: <p class="breadcrumb-item"><a href="{{url('')}}/{{getParentCategory($current_cat->id)['subcategory2']->slug}}">{{getParentCategory($current_cat->id)['subcategory2']->name}}</a></p>
                    @endif
      </span>
      <a href="{{ route('products') }}" class="read_all"><p>back</p></a>
    </div>
  </div>
</section>
<section class="tab_blk product_detail">
  <div class="container">
    <div class="big_text top_banner_left">
      <a href="#">{{getSocialMedia()->product_title}}</a>
      <span>
        {{ $productTitle->page_title }}
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
          <dt class="@if($mainCategory->id == $mainCategoryAll->id)
                      active ft-clr-white
                    @else ft-clr-grey @endif @if (0 === --$toEndMain) last_tab @endif"><a style="color: #999;" href="{{$mainCategoryAll->slug}}">{{$mainCategoryAll->name}}</a></dt>
                  </div>
        @endforeach
  	</dl>
    <div class="big_text" style=" margin-bottom: 0px">
      @if(session('LoggedUser'))
      <a href="#" class="onscreen_product_internal_title onscreen_product_internal_title3" @if(session('LoggedUser'))
        data-link="{{route('admin.category.edit', $current_cat->id)}}?type=main_category&onscreenCms=true&id={{$current_cat->id}}"
        data-create-subcategory="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$current_cat->id}}"
        data-delete-link="{{route('admin.index')}}/category/delete/{{ $current_cat->id}}"
        @endif></a>
        @endif
      <a href="#" class="orange-title">{{$mainCategory->name}}</a>
      <span>{{$mainCategory->short_description}}</span>
    </div>
    <dd style="margin-top: 30px;">
      <div class="tab_item">
        @if(count(getCustomSubCategories($mainCategory->id)) > 0)
          @foreach(getCustomSubCategories($mainCategory->id) as $key => $topInflatableLp)
          <?php if (count(getSubCategoryImages($topInflatableLp->id)) > 0) {?>
            <?php $imageName = getSubCategoryImages($topInflatableLp->id, 2, 'DESC')[0]['image']; ?>
            <div class="item_img showProductDetails other_cat_admin" data-link="{{url('')}}/{{$topInflatableLp->slug}}">
              <div align="right"  class="product_internal_title" @if(session('LoggedUser'))
                  data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=sub_category&onscreenCms=true&id={{$current_cat->id}}"
                  data-create-link="{{route('admin.category.create')}}?type=sub_category&onscreenCms=true&id={{$current_cat->id}}"
                  data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatableLp->id}}"
                @endif></div>
              <div class="tab_top subCategoryImage">
                @foreach(getImages($topInflatableLp->id) as $key => $productImage)
                <img src="{{url('')}}/images/{{$productImage->image}}" style="height: 543px !important;" />
                @endforeach
              </div>
              <div class="big_text small_text">
                <a href="{{url('')}}/{{$topInflatableLp->slug}}">{{ $topInflatableLp->name }}</a>
              </div>
            </div>
          <?php } else { ?>
            <div class="item_img showProductDetails other_cat_admin" data-link="{{url('')}}/{{$topInflatableLp->slug}}">
              <div align="right"  class="product_internal_title" @if(session('LoggedUser'))
                  data-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=sub_category&onscreenCms=true&id={{$current_cat->id}}"
                  data-create-link="{{route('admin.category.create')}}?type=sub_category&onscreenCms=true&id={{$current_cat->id}}"
                  data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatableLp->id}}"
                @endif></div>
              <div class="tab_top">
                <img src="{{url('')}}/images/noimage.png" />
                <div class="big_text small_text">
                  <a href="{{url('')}}/{{$topInflatableLp->slug}}" class="noImageFontClr">{{ $topInflatableLp->name }}</a>
                </div>
              </div>
            </div>
          <?php } ?>
          @endforeach
        @else
          <div class="item_img showProductDetails other_cat_admin" data-link="{{url('')}}/{{$mainCategory->slug}}">
            <div align="right"  class="product_internal_title" @if(session('LoggedUser'))
                data-link="{{route('admin.category.edit', $mainCategory->id)}}?type=main_category&onscreenCms=true"
                data-create-link="{{route('admin.category.create')}}?type=sub_category&onscreenCms=true&id={{$mainCategory->id}}"
              @endif></div>
            <div class="tab_top">
              <img src="{{url('')}}/images/noimage.png" />
              <div class="big_text small_text">
                <a href="{{url('')}}/{{$mainCategory->slug}}" class="noImageFontClr">{{ $mainCategory->name }}</a>
              </div>
            </div>
          </div>
        @endif
      </div>
    </dd>
  </div>
</section>

<section class="description">
  <div class="container">
    <div class="description_wrap">
      <div class="description_blk_item TopContent" @if(session('LoggedUser'))
                  data-link="{{route('admin.category.edit', $current_cat->id)}}?type=main_category&onscreenCms=true&id={{$current_cat->id}}"
              @endif>
        {!! html_entity_decode($current_cat->description) !!}
      </div>
      </div>
  </div>
</section>

<section class="banner_slider top_banner">
  <div class="container">
    <div class="big_text">
      <a href="#">Other Main Categories</a>
    </div>
    <div class="banner_slider_blk_top">
    	@foreach(getCustomSubCategories($mainCategory->id) as $key => $subCategories1)
    	<?php
      ?>
      <a href="{{url('')}}/{{$subCategories1->slug}}" class="banner_slider_item onscreen_product_internal_title onscreen_product_internal_title3 <?php if(session('LoggedUser')){ echo 'other_cat_admin'; } ?>" @if(session('LoggedUser'))
                        data-link="{{route('admin.category.edit', $current_cat->id)}}?type=sub_category&onscreenCms=true&id={{$subCategories1->id}}"
                        data-create-subcategory="{{route('admin.category.create')}}?type=sub_category&onscreenCms=true&id={{$subCategories1->id}}"
                        data-delete-link="{{route('admin.index')}}/category/delete/{{ $current_cat->id}}"
                        @endif>
        <?php if (count(getSubCategoryImages($subCategories1->id)) > 0) { $imageName = getImages($subCategories1->id)[0]['image']; ?>
          <img src="{{url('')}}/images/{{$imageName}}"  />
          <p>{{$subCategories1->name}} </p>
        <?php } else { ?>
          <img src="{{url('')}}/images/noimage.png" />
          <p class="noImageFontClr">{{$subCategories1->name}} </p>
        <?php } ?>
        
      </a>
      @endforeach
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
  	@include('widget.industries-serve')
  </div>
</section>
</div>
@endsection