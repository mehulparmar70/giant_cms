<!DOCTYPE HTML>
<html>
  <head>
  {{-- Try to load 'head' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.head', 'ext.head'])

    {{-- Additional theme-specific CSS --}}
    @yield('addon-css')
  </head>
  <body>
  <?php $current_page = ''; ?>
    
    {{-- Try to load 'header-sports-vertical' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.header-sports-vertical', 'ext.header-sports-vertical'])

    {{-- Main content of the page --}}

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
$productLink = App\Models\admin\UrlList::find(96);  // Our Products link
$homeLink = App\Models\admin\UrlList::find(95);  // Home link
?>

        <!-- banner area part -->
        <section class="product-detail-banner-section common-inner-banner header-top-space position-relative">
          <div class="bg-img-wrap">
            <img class="bg-img-top opacity-50" src="{{asset('/')}}/dubai/images/about-banner.webp" alt="about-banner">
            <img class="bg-img-bottom" src="{{asset('/')}}/dubai/images/red-effect-bottom.webp" alt="red-effect-bottom">
          </div>
          <div class="container position-relative">
            <div class="breadcrumb">
              <div class="breadcrumb-left">
				
                <a href="{{ $homeLink->url }}" class="header-top-home d-flex align-items-center text-uppercase">
                  <img class="me-2" src="{{asset('/')}}/dubai/images/home-icon.png" alt="home-icon">Home
                </a>
                <a href="{{$mainCategorySlug}}" class="header-top-home d-flex align-items-center text-uppercase py-1 me-3">{{getParentCategory($subCategory->id)['category']->name}}</a>


						@if(getParentCategory($subCategory->id)['subcategory'])
						<span class="text-uppercase">{{getParentCategory($subCategory->id)['subcategory']->name}}</span>
                        @endif

						@if(getParentCategory($subCategory->id)['subcategory2'])
						<span class="text-uppercase">{{getParentCategory($subCategory->id)['subcategory2']->name}}</span>
                        @endif
            
              </div>
              <a href="{{ $productLink->url }}" class="breadcrumb-back text-uppercase">Back<img src="{{asset('/')}}/dubai/images/right-arrow-circle.svg" alt="right-arrow-circle"></a>
            </div>
            <div class="row g-4 mt-4">
              <div class="col-xl-9 col-md-8">
                <div class="product-detail-wrap wow fadeInLeft" data-wow-offset="200">
                  <div class="product-detail-title d-flex gap-1 flex-md-row flex-column justify-content-md-between justify-content-center align-items-center">
				  @if(getParentCategory($subCategory->id)['subcategory'])
						<h5 class="me-2 mt-1">{{getParentCategory($subCategory->id)['subcategory']->name}}</h5>
                        @endif

						@if(getParentCategory($subCategory->id)['subcategory2'])
						<h5 class="me-2 mt-1">{{getParentCategory($subCategory->id)['subcategory2']->name}}</h5>
                        @endif
						<div class="product_title"  @if(session('LoggedUser'))
						data-link="{{route('admin.product-page.editor')}}"
					@endif></div>
                    <div class="dropdown">
                      <button class="btn btn-animation dropdown-toggle py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Other SUB CATEGORY
                        <img src="{{asset('/')}}/dubai/images/right-arrow-circle.svg" alt="arrow-circle">
                      </button>
                      <ul class="dropdown-menu">
					  @foreach(getCustomSubCategories($current_cat->parent_id) as $key => $subCategories1)
                        <li><a class="dropdown-item" href="sub-categories.html"><span class="hover-underline-animation left">{{$subCategory->name}}</span></a></li>
						@endforeach

                      </ul>
                    </div>
                  </div>
                  <div class="mt-4 mb-5 me-2">
                    <div class="product-detail-slider">
						<?php if (count($productImages) > 0) {?>
							@foreach($productImages as $productImage)
							<div class="my_slider_thumb" style=""
							@if(session('LoggedUser'))
								data-link="{{route('admin.photo.manage')}}?page=manage&main_category={{$mainCategory->id}}&sub_category={{$subCategory->id}}"
								data-delete-link="{{url('api')}}/media/media-delete/{{$productImage->id}}"
								data-id="{{$productImage->id}}"
							@endif
						>
                      <a href="{{url('')}}/images/{{$productImage->image}}" class="product-detail-slider-item" data-fancybox="gallery">
                        <div class="product-detail-slider-img">
                          <img src="{{url('')}}/images/{{$productImage->image}}" alt="product-banner">
                        </div>
                        <button type="button" class="product-enlarge-btn theme-heading d-flex align-items-center gap-2">
                          <img src="{{asset('/')}}/dubai/images/search-icon.svg" alt="search-icon">
                          Click To Enlarge
                        </button>
					</div>
                      </a>
					  @endforeach
					  <?php } else { ?>
                      <a href="{{url('')}}/images/noimage.png" class="product-detail-slider-item" data-fancybox="gallery">
                        <div class="product-detail-slider-img">
                          <img src="{{url('')}}/images/noimage.png" alt="product-banner">
                        </div>
                        <button type="button" class="product-enlarge-btn theme-heading d-flex align-items-center gap-2">
                          <img src="{{asset('/')}}/dubai/images/search-icon.svg" alt="search-icon">
                          Click To Enlarge
                        </button>
                      </a>
					  <?php } ?>
               
                    </div>
                    <div class="product-detail-custom-nav slider-reverse-arrows d-flex justify-content-between mt-4 px-3">
                      <div class="text-uppercase my-auto">Products - <span class="product-slider-counter"></span></div> 
                    </div>
                  </div>
                </div>
                <div class="about-banner-desc wow zoomIn" data-wow-offset="200">
					<div class="menu_crud" @if(session('LoggedUser'))
					data-link="{{route('admin.about-page.editor')}}" @endif>
					<a href="{{ $productLink->url }}" @if(session('LoggedUser'))
						data-link="{{route('admin.about-page.editor')}}"
					@endif></a>
					</div>
				
					<p>{!! $productDetail->description !!}</p>
                </div>
              </div>
              <div class="col-xl-3 col-md-4 wow fadeInRight" data-wow-offset="200">
                <div class="share-concept-form-box -sticky mx-auto">
                  <img class="w-full" src="{{asset('/')}}/dubai/images/share-concept.png" alt="share-concept">
                        @include('widget.contact-form1')
                </div>
              </div>
            </div>
            <div class="position-relative text-center mt-md-2 mt-4 pb-4">
              <a href="{{ $productLink->url }}" class="btn btn-back text-uppercase">
                <img src="{{asset('/')}}/dubai/images/right-arrow-circle.svg" alt="right-arrow-circle">
                BACK PREVIOUS PAGE
              </a>
            </div>
          </div>
        </section>
        <!-- content area part -->
        <div class="main-content">
          <section class="updates-contact-section position-relative overflow-hidden">
            <div class="bg-img-wrap">
                <img class="bg-img-bottom opacity-25" src="{{asset('/')}}/dubai/images/desert-transparent.webp" alt="desert-bg">
            </div>
            <div class="updates-section products-slider-section">
              <div class="container">
                <div class="theme-stroke-heading text-center text-uppercase">
                  <strong class="letters">Our Products</strong>
                  <h1 class="h3 letters" onclick="window.location.href = '{{ $productLink->url }}';">Our <span>Products</span></h1>
				  <span>    <div style="background-color:white" class="product_title_1"  @if(session('LoggedUser'))
					data-link="{{route('admin.product-page.editor')}}?onscreenCms=true"
				@endif></div></span>
                </div>
              </div>
              <div class="updates-wrap position-relative">
                <div class="bg-img-wrap">
                  <img class="bg-img-top" src="{{asset('/')}}/dubai/images/red-effect-top.webp" alt="red-effect-top">
                </div>
                <div class="container position-relative pt-md-4">
                  <div class="updates-slider">
					@if(count(customMainCat()) > 0)
                    @foreach(customMainCat() as $key => $topInflatableLp)
                    <?php 
                        $getSubCategories = getSubCategories($topInflatableLp->id); 
                        if (!empty($getSubCategories)) {
                        
                    ?>
                    <div class="updates-slider-item wow zoomIn" data-wow-offset="200">
                      <a href="{{url('')}}/{{$topInflatableLp->slug}}" class="products-box text-center">
                        <div class="animated-border-box-glow">
                          <div class="products-box-img">
							<?php if(!empty($topInflatableLp->image))
                            {
                              ?>                  <img src="{{url('')}}/images/{{$topInflatableLp->image}}"  />
                              <?php }else{?>
                          @foreach(getSubCategoryImages($getSubCategories[0]->id, 10, 'DESC') as $key => $productImage)
                            <img src="{{url('')}}/images/{{$productImage->image}}"  />
                            @endforeach
                            <?php }?>
                            
                          </div>
						  <div class="product_internal_title" @if(session('LoggedUser'))
                          data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-delete-link="{{route('admin.category.delete',$topInflatableLp->id)}}"
                          data-index-link="{{route('admin.category.list')}}"
                        @endif></div>
                          <div class="products-box-heading text-uppercase theme-heading">
                            <h5>{{ $topInflatableLp->name }}</h5>
                          </div>
                        </div>
                      </a>
                    </div>
					<?php } else { ?>
                    <div class="updates-slider-item wow zoomIn" data-wow-offset="200">
                      <a href="{{url('')}}/{{$topInflatableLp->slug}}" class="products-box text-center">
                        <div class="animated-border-box-glow">
                          <div class="products-box-img">
							<?php if(!empty($topInflatableLp->image))
                            {
                              ?>
                              <img src="{{url('')}}/images/{{$topInflatableLp->image}}"  />
                              <?php }else{?>
          
                        <img src="{{url('')}}/img/no-item.jpeg" />
                        <?php }?>
                          </div>
						  <div style="background:white" class="product_internal_title" @if(session('LoggedUser'))
                          data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatableLp->id}}"
                          data-index-link="{{route('admin.category.list')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                        @endif></div>
                          <div class="products-box-heading text-uppercase theme-heading">
                            <h5>{{ $topInflatableLp->name }}</h5>
                          </div>
                        </div>
                      </a>
                    </div>
					<?php } ?>
                    @endforeach
                  @else
                    <div class="updates-slider-item wow zoomIn" data-wow-offset="200">
                      <a href="{{url('')}}/{{$topInflatableLp->slug}}" class="products-box text-center">
                        <div class="animated-border-box-glow">
                          <div class="products-box-img">
                            <img src="{{url('')}}/img/no-item.jpeg" />
                          </div>
						  <div class="product_internal_title" @if(session('LoggedUser'))
                          data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                          data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true"
                          data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatableLp->id}}"
                          data-index-link="{{route('admin.category.list')}}?type=main_category&onscreenCms=true&id={{$topInflatableLp->id}}"
                        @endif></div>
                          <div class="products-box-heading text-uppercase theme-heading">
                            <h5>{{ $topInflatableLp->name }}</h5>
                          </div>
                        </div>
                      </a>
                    </div>
					@endif
       
                  </div>
                  <div class="updates-custom-nav slider-reverse-arrows owl-nav position-relative text-center mt-4">
                    <a href="{{ $productLink->url }}" class="btn text-uppercase btn-animation--infinity">VIEW ALL PRODUCTS</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="contact-section">
              <div class="container">
                <div class="theme-stroke-heading text-center text-uppercase">
                  <strong class="letters">Get In Touch</strong>
                  <h3 class="h3 letters" onclick="window.location.href = 'contact.html';">Get In <span>Touch</span></h3>
                </div>
              </div>
              <div class="container position-relative pt-4">
                <div class="d-flex flex-sm-nowrap flex-wrap justify-content-center gap-md-4 gap-3">
                  <div class="share-concept-form-box wow flipInY" data-wow-offset="200">
                    <img class="w-full" src="{{asset('/')}}/dubai/images/share-concept.png" alt="share-concept">
                          @include('widget.contact-form1')
                  </div>
                  <div class="contact-links-box text-center wow flipInY" data-wow-offset="200">
                    <p>Award Winning Inflatable Designer & Manufacturer</p>
                    <img src="{{asset('/')}}/dubai/images/logo.svg" alt="logo">
                    <div class="mt-sm-4 mt-2 mb-2">
                      <a class="contact-link" href="tel:+919429613531"><img src="{{asset('/')}}/dubai/images/phone-icon.svg" alt="phone-icon"> +91 87587 13931</a>
                    </div>
                    <div class="mb-sm-4 mb-2">
                      <a class="contact-link" href="mailto:sales@giantinflatables.ae"><img src="{{asset('/')}}/dubai/images/mail-icon.svg" alt="mail-icon"> sales@giantinflatables.ae</a>
                    </div>
                    <div class="mb-2">
                      <a class="contact-social-link" href="#" target="_blank"><img src="{{asset('/')}}/dubai/images/facebook.png" alt="facebook-icon"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
      <!-- footer part -->
     
      @includeFirst(['theme::ext.footer', 'ext.footer'])
    </div>
    <!-- Modal -->
   
    @includeFirst(['theme::ext.script', 'ext.script'])
  </body>
</html>
