@extends('layout.front-index')
@section('title','Product Details')


	@section('custom-head')

	<style>
		.magnify-modal {
			box-shadow: 0 0 6px 2px rgba(0, 0, 0, .3);
			}

			.magnify-header .magnify-toolbar {
			background-color: rgba(0, 0, 0, .5);
			}
			.magnify-stage {
			border-width: 0;

			text-align:center;
			}

			.magnify-footer {
			bottom: 10px;
			}

			.magnify-footer .magnify-toolbar {
			background-color: rgba(0, 0, 0, .5);
			border-radius: 5px;
			}

			.magnify-loader {
			background-color: transparent;
			}

			.magnify-header,
			.magnify-footer {
			pointer-events: none;
			}

			.magnify-button {
			pointer-events: auto;
			}

		.Biginflatables .img_thumbnail img {
			border-radius: 5px;
			width: 100%;
			height: auto;
			object-fit: contain;
			background: black;
		}
		.my_slider_block{
			margin:0 auto;
		}
		.my_slider_block .Biginflatables .slick-slide {
			height: 400px;
		}
		.deleteImageSlider {
		  cursor: pointer;
		}
		.my_slider_block .Biginflatables .img_thumbnail img{
			object-fit: contain;
			height: 400px;
			background: black;
		}
			.slick-prev.slick-arrow {
				left: 3% !important;
				z-index: 0 !important;
			}

			.slick-next.slick-arrow {
				right: 3% !important;
				z-index: 0 !important;
			}
			
			.image_gallery .product_cat_name {
		    background-color: #8460a6;
		    display: flex;
		    align-items: center;
		    padding: 9px 15px;
		}
	</style>

	@endsection

@section('custom-js')

<script>
$(document).ready(function () {
  $( ".lazyload" ).css('overflow', 'auto');
  $( ".loader" ).hide();
});

$(".product").addClass( "active");
$(".our_product_menu").addClass( "active");
$(".product_menu_active").addClass( "menu_active");
	
function goBack() {
  window.history.back();
}


</script>
@endsection
@section('content')

<?php 
// dd($mainCategory);
$industriesPageData = getPageData('industrie_page');
$subCategory = $current_cat;
// dd($subCategory);



// $current_products = DB::table('products')->where(['category_id' => $subCategory->id, 'status' => 1])->get();


	$finalSlug = '';
	$mainCategorySlug = '';
	$subCategorySlug = '';
	$subCategory2Slug = '';

	// dd($current_products);


?>
	@if(isset(getParentCategory($subCategory->id)['category']))
	<?php $finalSlug = getParentCategory($subCategory->id)['category']->slug.'/';
		$mainCategorySlug = $finalSlug;
	?>
	@endif

		@if(isset(getParentCategory($subCategory->id)['subcategory']))
			<?php $finalSlug = getParentCategory($subCategory->id)['subcategory']->slug ;
				$subCategorySlug = $finalSlug;
				// dd($subCategorySlug);

			?>
		@endif

		@if(isset(getParentCategory($subCategory->id)['subcategory2']))
			<?php $finalSlug = getParentCategory($subCategory->id)['subcategory2']->slug;
				$subCategory2Slug = $finalSlug;
				// dd($subCategory2Slug);
			?>
		@endif
		
<?php

	if($type == 'maincategory_product'){
		// dd($type);

		$finalSlug = $finalSlug;
	}
	elseif($type == 'maincategory_sub_sub2_product'){
		// dd($type);
		$finalSlug = $subCategorySlug;
	}
	elseif($type == 'maincategory_subcategory_product'){
		// dd($type);

		$finalSlug = $mainCategorySlug;
	}
	
	if(isset(getParentCategory($subCategory->id)['category']))
	{
		$searchCriteria = getParentCategory($subCategory->id)['category']->id;
	}
	if(isset(getParentCategory($subCategory->id)['subcategory']))
	{
		$searchCriteria = $searchCriteria.','.getParentCategory($subCategory->id)['subcategory']->id;
	}
	if(isset(getParentCategory($subCategory->id)['subcategory2']))
	{
		$searchCriteria = $searchCriteria.','.getParentCategory($subCategory->id)['subcategory2']->id;
	}

$arr = explode(',',$searchCriteria);
// dd($arr);

$intArray = array_map(
    function($value) { return (int)$value; },
    $arr
);

$current_criteria = DB::table('criteria_metas')->whereIn('categories', $intArray)->get();
?>
<style>
	.deleteImageSlider {
		  cursor: pointer;
		}
</style>
<!-- back -->
<div class="our_product product_detail product_detail_now">
	<section class="back">
	  <div class="container">
	    <div class="back_sec">
	      <span>home &nbsp; :
	        <p class="breadcrumb-item"><a href="{{$mainCategorySlug}}">{{getSocialMedia()->product_title}}</a></p>
	        
					@if(getParentCategory($subCategory->id)['category'])
						&nbsp&nbsp&nbsp: <p class="breadcrumb-item"><a href="{{url('')}}/{{getParentCategory($subCategory->id)['category']->slug}}">{{getParentCategory($subCategory->id)['category']->name}}</a></p>
                        @endif

						@if(getParentCategory($subCategory->id)['subcategory'])
						&nbsp&nbsp&nbsp: <p class="breadcrumb-item"><a href="{{url('')}}/{{$subCategorySlug}}">{{getParentCategory($subCategory->id)['subcategory']->name}}</a></p>
                        @endif

						@if(getParentCategory($subCategory->id)['subcategory2'])
						&nbsp&nbsp&nbsp: <p class="breadcrumb-item"><a href="{{url('')}}/{{$subCategory2Slug}}">{{getParentCategory($subCategory->id)['subcategory2']->name}}</a></p>
                        @endif
	      </span>
	      <a href="{{$mainCategorySlug}}" class="read_all"><p>back</p></a>
	    </div>
	  </div>
	</section>

	<!-- tab -->
	<section class="tab_blk">
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
										@else ft-clr-grey @endif @if (0 === --$toEndMain) last_tab @endif"><a href="{{$mainCategoryAll->slug}}">{{$mainCategoryAll->name}}</a></dt>
	      </div>
		    @endforeach
	    </dl>
	    <?php $toEnd  = count(getCustomSubCategories($current_cat->parent_id)); ?>
	    <div class="inner_tab">
	    	<div class="container">
	    		<div class="big_text" style="margin-top: 30px; margin-bottom: 0px">
	          @if(session('LoggedUser'))
	          <a href="#" class="onscreen_product_internal_title onscreen_product_internal_title3" @if(session('LoggedUser'))
							data-link="{{route('admin.category.edit', $mainCategory->id)}}?type=main_category&onscreenCms=true&id={{$mainCategory->id}}"
							data-create-subcategory="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$mainCategory->id}}"
							data-delete-link="{{route('admin.index')}}/category/delete/{{ $mainCategory->id}}"
							@endif></a>
							@endif
	          <a href="#" class="orange-title">{{$mainCategory->name}}</a>
	          <span>{{$mainCategory->short_description}}</span>
	        </div>
	    		<!-- <div class="big_text" style="margin-top: 30px; margin-bottom: 0px">
	          @if(session('LoggedUser'))
	          <a href="#" class="onscreen_product_internal_title onscreen_product_internal_title3" @if(session('LoggedUser'))
							data-link="{{route('admin.category.edit', $current_cat->id)}}?type=sub_category&onscreenCms=true&id={{$current_cat->parent_id}}"
							data-create-subcategory="{{route('admin.category.create')}}?type=sub_category&onscreenCms=true&id={{$current_cat->parent_id}}"
							data-delete-link="{{route('admin.index')}}/category/delete/{{ $current_cat->id}}"
							@endif></a>
							@endif
	          <a href="#">{{$subCategory->name}}</a>
	          <span>{{$subCategory->short_description}}</span>
	        </div> -->
	        
	        <dl class="responsive-tabs responsive_tabs" id="responsive-tabs">
	        	
	        	@foreach(getCustomSubCategories($current_cat->parent_id) as $key => $subCategories1)
	        	<div>
		        	@if(session('LoggedUser'))
			          	<a style="text-align: center;" href="#" class="onscreen_product_internal_title onscreen_product_internal_title3" @if(session('LoggedUser'))
								data-link="{{route('admin.category.edit', $subCategories1->id)}}?type=sub_category&onscreenCms=true&id={{$current_cat->parent_id}}"
								data-create-subcategory="{{route('admin.category.create')}}?type=sub_category&onscreenCms=true&id={{$current_cat->parent_id}}"
								data-delete-link="{{route('admin.index')}}/category/delete/{{ $subCategories1->id}}"
								@endif>
										
									</a>
								@endif
	        		<dt data-isproduct="1" data-tab="<?= $key ?>" class="@if($current_cat->id == $subCategories1->id)
											active ft-clr-white
										@else ft-clr-grey @endif @if (0 === --$toEnd) last_tab @endif"><a href="{{url('')}}/{{$subCategories1->slug}}"><?php echo strtolower($subCategories1->name); ?></a>
							</dt>
							<dd>
								<div class="inner_tab_blk">
									<div class="inner_tab_blk_right">
										<div class="image_gallery">
											<div class="product_cat_name">
	                      <img src="{{url('')}}/images/person.png" alt="person" />
	                      <p>{{$subCategory->name}}</p>
                      	@if(session('LoggedUser'))
							          	<a href="#" class="onscreen_product_internal_title onscreen_product_internal_title3" @if(session('LoggedUser'))
													data-link="{{route('admin.category.edit', $current_cat->id)}}?type=sub_category&onscreenCms=true&id={{getParentCategory($current_cat->id)['category']->id}}"
													data-create-subcategory="{{route('admin.category.create')}}?type=sub_category&onscreenCms=true&id={{getParentCategory($current_cat->id)['category']->id}}"
													data-delete-link="{{route('admin.index')}}/category/delete/{{ $current_cat->id}}"
													@endif></a>
												@endif
	                    </div>
	                    <div class="product-images demo-gallery">
	                      <!-- Begin product thumb nav -->
	                      <ul class="thumb-nav " id="thumb-nav-<?= $key ?>">
	                      	<?php if (count($productImages) > 0) {?>
	                      	@foreach($productImages as $productImage)
	                      	<div class="my_slider_thumb" style=""
															@if(session('LoggedUser'))
																data-link="{{route('admin.photo.manage')}}?page=manage&main_category={{$mainCategory->id}}&sub_category={{$subCategory->id}}"
																data-delete-link="{{url('api')}}/media/media-delete/{{$productImage->id}}"
																data-id="{{$productImage->id}}"
															@endif
														>
		                        <li>
		                          <img src="{{url('')}}/images/{{$productImage->image}}" alt="banner" />
		                        </li>
	                      	</div>
	                        @endforeach
	                      <?php } else { ?>
	                      	<div class="" style="">
		                        <li>
		                          <img src="{{url('')}}/images/noimage.png" alt="banner" />
		                        </li>
	                      	</div>
	                      <?php } ?>
	                      </ul>
	                      <!-- End product thumb nav -->
	                      <div class="main-img-slider" id="main-img-slider-<?= $key ?>">
	                      	<?php if (count($productImages) > 0) {?>
	                      	@foreach($productImages as $productImage)
	                      	<div class="BigInnerinflatableSub_slider mb-3 image-set"
													@if(session('LoggedUser'))
														data-link="{{route('admin.photo.manage')}}?page=manage&pagefrom=productpage&type=sub_category&onscreenCms=true&main_category={{$current_cat->id}}&sub_category={{$subCategory->id}}"
														data-delete-link="{{url('api')}}/media/media-delete/{{$current_cat->id}}"
														data-id="{{url('api')}}/media/media-delete/{{$current_cat->id}}"
													@endif
												>
	                          <a data-fancybox="gallery" href="{{url('')}}/images/{{$productImage->image}}" > 
	                          	<img src="{{url('')}}/images/{{$productImage->image}}" alt="banner" />
	                          </a>
	                        </div>
	                        @endforeach
	                        <?php } else { ?>
	                      	<div class="BigInnerinflatableSub_slider mb-3 image-set"
														@if(session('LoggedUser'))
															data-link="{{route('admin.photo.manage')}}?page=manage&onscreenCms=true&main_category={{$current_cat->id}}&sub_category={{$subCategory->id}}"
															data-delete-link="{{url('api')}}/media/media-delete/{{$current_cat->id}}"
															data-id="{{url('api')}}/media/media-delete/{{$current_cat->id}}"
														@endif
													>
		                          <a data-fancybox="gallery" href="{{url('')}}/images/noimage.png" > 
		                          	<img src="{{url('')}}/images/noimage.png" alt="banner" />
		                          </a>
		                        </div>
	                      <?php } ?>
	                      </div>
	                      <!-- End Product Images Slider -->
	                    </div>
										</div>
										@if($productDetail->description)
	                  <div class="description">
	                    <div class="container">
	                      <div class="description_wrap">
	                      		<div class="onscreen_product_internal_title onscreen_product_internal_title3" @if(session('LoggedUser'))
																	data-link="{{route('admin.category.edit', $current_cat->id)}}?type=sub_category&onscreenCms=true&id={{$mainCategory->id}}"
																	data-create-subcategory="{{route('admin.category.create')}}?type=sub_category&onscreenCms=true&id={{$mainCategory->id}}"
																	data-delete-link="{{route('admin.index')}}/category/delete/{{ $current_cat->id}}"
																	@endif></div>
														<div class="description_blk">
															<div class="description_blk_item">
																<p>{!! $productDetail->description !!}</p>
															</div>
														</div>
	                      </div>
	                    </div>
	                  </div>
	                  @endif
									</div>
									<div class="inner_tab_blk_left">
	                	@include('widget.contact-form1')    
	                </div>
								</div>
							</dd>
						</div>
	        	@endforeach
	        </dl>
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
      	@foreach(getSubCategories($current_cat->parent_id) as $key => $subCategories1)
      	<?php $imageName = getSubCategoryImages($subCategories1->id, 2, 'DESC')[0]['image']; ?>
        <a href="{{url('')}}/{{$subCategories1->slug}}" class="banner_slider_item onscreen_product_internal_title onscreen_product_internal_title3 <?php if(session('LoggedUser')){ echo 'other_cat_admin'; } ?>" @if(session('LoggedUser'))
													data-link="{{route('admin.category.edit', $current_cat->id)}}?type=sub_category&onscreenCms=true&id={{$subCategories1->id}}"
													data-create-subcategory="{{route('admin.category.create')}}?type=sub_category&onscreenCms=true&id={{$subCategories1->id}}"
													data-delete-link="{{route('admin.index')}}/category/delete/{{ $current_cat->id}}"
													@endif>
          <img src="{{url('')}}/images/{{$imageName}}" />
          <p>{{$subCategories1->name}} </p>
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
    	@include('widget.industries-serve-with-title')
    </div>
  </section>
</div>
@endsection