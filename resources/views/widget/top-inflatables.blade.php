<dl class="responsive-tabs top-inflatable" style="position: relative">
  @foreach(customMainCat() as $key => $topInflatable)
    @if(customMainCat() > 0)
      <dt data-id="{{ $topInflatable->id }}" data-isproducttab="1" class="product_title_main @if(session('homePageCatId') == $topInflatable->id) active @endif" @if(session('LoggedUser'))
                                    data-create-link="{{route('admin.category.create')}}?type=main_category"
                                    data-index-link="{{route('admin.category.list')}}?type=main_category"
                                    data-edit-link="{{route('admin.category.edit',$topInflatable->id)}}?type=main_category"
                                    data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatable->id}}"
                                @endif>
        <a style="color: #999;" href="{{$topInflatable->slug}}">{{$topInflatable->name}}</a>
        
      </dt>
      <dd class="">
        <!-- <div class="tab_item home_page_top categorieImage" >
        </div> -->
        <div class="tab_item home_page_top categorieImage" >
          @if(count(customMainCat()) > 0)
            @foreach(customMainCat() as $key => $topInflatableLp)
            <?php 
                $getSubCategories = getSubCategories($topInflatableLp->id); 
                if (!empty($getSubCategories)) {
                
            ?>
              <div class="item_img showProductDetails" data-link="{{url('')}}/{{$topInflatableLp->slug}}">
                <div class="tab_top subCategoryImage subCategoryImage-{{ $topInflatableLp->id }}">
                  <?php if(!empty($topInflatableLp->image))
                  {
                    ?>                  <img src="{{url('')}}/images/{{$topInflatableLp->image}}" style="height: 540px !important;" />
                    <?php }else{?>
                @foreach(getSubCategoryImages($getSubCategories[0]->id, 10, 'DESC') as $key => $productImage)
                  <img src="{{url('')}}/images/{{$productImage->image}}" style="height: 540px !important;" />
                  @endforeach
                  <?php }?>
                </div>
                <div class="product_internal_title" @if(session('LoggedUser'))
                      data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatable->id}}"
                      data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true&id={{$topInflatable->id}}"
                      data-delete-link="{{route('admin.category.delete',$topInflatableLp->id)}}"
                      data-index-link="{{route('admin.category.list')}}"
                    @endif></div>
                <div class="big_text small_text">
                  <a href="{{url('')}}/{{$topInflatableLp->slug}}">{{ $topInflatableLp->name }}</a>
                </div>
              </div>
            <?php } else { ?>
            <div class="item_img showProductDetails" data-link="{{url('')}}/{{$topInflatableLp->slug}}">
              <div class="tab_top">
              <?php if(!empty($topInflatableLp->image))
                  {
                    ?>
                    <img src="{{url('')}}/images/{{$topInflatableLp->image}}" style="height: 540px !important;" />
                    <?php }else{?>

              <img src="{{url('')}}/img/no-item.jpeg" />
              <?php }?>
                <!-- <img src="{{url('/')}}/images/{{$topInflatableLp->image}}"  /> -->
                <div class="product_internal_title" @if(session('LoggedUser'))
                      data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatable->id}}"
                      data-edit-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true&id={{$topInflatable->id}}"
                      data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatableLp->id}}"
                      data-index-link="{{route('admin.category.list')}}?type=main_category&onscreenCms=true&id={{$topInflatable->id}}"
                    @endif></div>
                <div class="big_text small_text">
                  <a href="{{url('')}}/{{$topInflatableLp->slug}}" class="noImageFontClr">{{ $topInflatableLp->name }}</a>
                </div>
                
              </div>
            </div>
            <?php } ?>
            @endforeach
          @else
            <div class="item_img showProductDetails" data-link="{{url('')}}/{{$topInflatable->slug}}">
              <div class="tab_top">
                <img src="{{url('')}}/img/no-item.jpeg" />
                <div class="product_internal_title" @if(session('LoggedUser'))
                      data-create-link="{{route('admin.category.create')}}?type=main_category&onscreenCms=true&id={{$topInflatable->id}}"
                      data-edit-link="{{route('admin.category.edit', $topInflatable->id)}}?type=main_category&onscreenCms=true"
                      data-delete-link="{{route('admin.index')}}/category/delete/{{ $topInflatable->id}}"
                      data-index-link="{{route('admin.category.list')}}?type=main_category&onscreenCms=true&id={{$topInflatable->id}}"
                    @endif></div>
                <div class="big_text small_text">
                  <a href="{{url('')}}/{{$topInflatable->slug}}" class="noImageFontClr">{{ $topInflatable->name }}</a>
                </div>
                
              </div>
            </div>
          @endif
        </div>
      </dd>
    @endif
  @endforeach
  
  <?php $route = Route::current ()->getName (); ?> 
  @if($route=="index")
  <div class="discuss"><a href="{{ url('products') }}" class="ft-clr-white">view more</a></div>
  @endif 
</dl>