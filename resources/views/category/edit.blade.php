

<script>
$('.category_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();
        
        $('.parent_id').val(parent);

        $.get( `{{url('api')}}/get/getPetaKacheri/`+parent, { category_parent_id: parent })
        .done(function( data ) {
        if(JSON.stringify(data.length) == 0){
            $('.subcategory_parent_id').html('<option>Select Sub Category</option>');
        }
        else{
                $('.subcategory_parent_id').empty();     
            $('.subcategory_parent_id').html('<option value="">Select Sub Category</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.subcategory_parent_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
  });

  $('.subcategory_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();
        if(parent == ''){
          var mainCat = $('.category_parent_id').find(':selected').val();
          
          $('.parent_id').val(mainCat);

        }else{
          $('.parent_id').val(parent);
        }

    });

    
$(".listing").addClass( "menu-is-opening menu-open");
$(".listing a").addClass( "active-menu");

$('.category_option').on('change', function() {
        var category_option = $(this).find(':selected').val();

        if(category_option == 'main_category'){
          // alert(category_option);
          
          $('.hidden-block').show();
          $('.name-lable').text('Main Category');
          $('.name-input').attr('placeholder', 'Main Category Name');
          
          $('.sub-category select').attr('required', false);
          $('.sub-category').hide();
          $('.product-range').hide();
          $('.category-block').hide();
          
        }
        else if(category_option == 'sub_category'){
          // alert(category_option);
          $('.hidden-block').show();
          $('.name-lable').text('Sub Category');
          $('.name-input').attr('placeholder', 'Sub Category Name');

          $('.category-block').show();
          $('.sub-category').show();
          $('.sub-category select').attr('required', true);
          $('.product-range').hide();
        }else{
          
          $('.hidden-block').hide();
        }

    });


</script>

<?php

 

$cat_type = '';
$cat_level = [];
  $parent_id = old('parent_id');


if($parent_id == 0){
  $cat_type = 'category';
  $cat_type = 'subcategory';
  $cat_level = ['category_name' => null, 'type' => 'main_category', 'category' => null, 'subcategory' => null, 'subcategory2' => null, 'parent_id' =>0];
 
}
else{
  if($mainCategory = getParent($parent_id)->parent_id == 0){
    $cat_type = 'subcategory'.'sub cat';
    $cat_level = ['category_name' => getParent($parent_id)->name, 'type' => 'sub_category', 'category' => getParent($parent_id)->id, 'subcategory' => null, 'subcategory2' => null, 'parent_id' =>getParent($parent_id)->id];

  }
  else{
      $cat_type = 'subcategory2';
      if($subCategory = (getParent(getParent($parent_id)->parent_id)->parent_id) == 0){
      $cat_level = ['category_name' => getParent(getParent($parent_id)->parent_id)->name, 'type' => 'product_range', 'category' => getParent(getParent($parent_id)->parent_id)->id, 'subcategory' => getParent($parent_id)->id, 'subcategory_name' => getParent($parent_id)->name, 'subcategory2' => null, 'parent_id' => getParent($parent_id)->id];
    
      }
  }

}


?>


                 
             <input type="hidden" id="page_type" value="singleUpload">
              <form id="editCategoryidajax" method="post" enctype="multipart/form-data"
              class="form-horizontal"  onsubmit="return false;">
              
                @csrf

                @if(isset($_REQUEST['onscreenCms']) && $_REQUEST['onscreenCms'] == 'true')
                        <input type="hidden" name="onscreenCms" value="true">
                    @endif
                

                    <div class="cmsModal-row">
                  @if($type == 'Sub_Category')
                 
                    <div class="cmsModal-column">
                      <div class="cmsModal-formGroup">
                        <input type="hidden" name="pageType" class="parent_id" 
                        value="sub_category"> 
                        <label  class="cmsModal-formLabel" for="search_index">Select Main Category</label>
                      <select name="category_parent_id" class="cmsModal-formControl category_parent_id" required>
                    
                        <option value="">Select Main Category</option>
                          @foreach($parent_categories as $parent_category)
                              <option value="{{$parent_category->id}}"
                              
                          @if($parentid == $parent_category->id )
                              selected
                            @endif

                              {{--@if(old('category_parent_id') == $parent_category->id) selected @endif --}}
                              >{{$parent_category->name}}</option>
                          @endforeach

                      </select>
                      <span class="text-danger">@error('category_parent_id') {{$message}} @enderror</span>
                      <input type="hidden" name="parent_id" class="parent_id" 
                    value="{{$parentid}}"/>
                    <input type="hidden" name="page_type" value="sub_category"/>
                    </div>
                    </div>
                    @else
                    <div class="cmsModal-column">
                      <div class="cmsModal-formGroup">

                  <input type="hidden" name="pageType" class="parent_id" 
                      value="main_category"> 

                      <input type="hidden" name="parent_id" class="parent_id" 
                      value="0"> 

                    </div>
                  </div>
                    @endif
                  
         
                  <div class="cmsModal-column">
                      <div class="cmsModal-formGroup">
                      <label  class="cmsModal-formLabel" for="search_index">Edit Name</label>
                      <input type="text" class="cmsModal-formControl name-input" name="name" 
                         placeholder=" Name" 
                          value="@if(old('name')){{old('name')}}@else{{$category->name}}@endif" required>
                         
                      <span class="text-danger">@error('name') {{$message}} @enderror</span>
                      <input type="hidden" name="type" value="name">
                    </div>
                  </div>
                  <div class="cmsModal-column">
                    <div class="cmsModal-formGroup">
                      <label for="" class="cmsModal-formLabel">Add Custom URL</label>
                      <input class="cmsModal-formControl" name="slug" placeholder="URL label" 
                        
                        value="@if(old('slug')){{old('slug')}}@else{{$category->slug}}@endif"
                         required>
                        <span class="text-danger">@error('slug') {{$message}} @enderror</span>
                    </div>
                  </div>

                  <div class="cmsModal-column">
                    <div class="cmsModal-formGroup">
                      <label  class="cmsModal-formLabel" for="search_index">Edit Page Short Description</label>
                        <textarea class="cmsModal-formControl" name="short_description">@if(old('short_description')){{old('short_description')}}@else{{$category->short_description}}@endif</textarea>
                        <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
                    </div>
                  </div>
                  </div>
                  <div class="cmsModal-row">
                    <div class="cmsModal-column">
                      <div class="cmsModal-formGroup">
                        <label  class="cmsModal-formLabel" for="search_index">Edit Description</label>
                        <textarea id="editor" name="description" placeholder="Category Descriptions" 
                        >@if(old('description')){{old('description')}}@else{{$category->description}}@endif</textarea>
                                  
                      <span class="text-danger">@error('description') {{$message}} @enderror</span>
                    </div>
                    </div>
                  </div>

                  <div class="cmsModal-row">
                    <div class="cmsModal-column">
                      <div class="cmsModal-formGroup">
                        <label  class="cmsModal-formLabel" for="search_index">Edit Image</label>
                        <input type="file" name="image" class="file_input " id="image" accept="image/png,image/jpeg,image/webp" />
                        <input type="hidden" name="old_image" value="{{$category->image}}">
                        @if($category->image)
                        <label  class="cmsModal-formLabel" for="search_index">Image Uploaded</label><br>
                        <img class="mt-2 elevation-2 perview-img" src="{{asset('/')}}images/{{$category->image}}">
                        <a class="remove-image" onclick="removeimage('{{ $category->id }}','categories','image','{{url('api')}}/media/image-delete/{{$category->id}}')" href="#"  data-id="{{ $category->id }}" data-table="categories" data-field="image" data-url="{{url('api')}}/media/image-delete/{{$category->id}}" style="display: inline; position: absolute; border-radius: 10em; padding: 2px 6px 3px; text-decoration: none; font: 700 21px/20px sans-serif;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      @else
                      <label  class="cmsModal-formLabel" for="search_index"></label>
                        <img class="elevation-2 perview-img" src="{{asset('/')}}img/no-item.jpeg" style="height: 120px;">
                      @endif
                      </div>  
                    </div>  
                      <div class="cmsModal-column">
                        <div class="cmsModal-formGroup">
                          <label class="cmsModal-formLabel" for="search_index">Edit SEO Details</label>
                          <input type="text" class="cmsModal-formControl" name="meta_title" 
                            placeholder="Seo Title" 
                          value="@if(old('meta_title')){{old('meta_title')}}@else{{$category->meta_title}}@endif">
                          <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
                          <input type="text" class="cmsModal-formControl" name="meta_keyword" 
                          placeholder="Seo Keywords with ," 
                          value="@if(old('meta_keyword')){{old('meta_keyword')}}@else{{$category->meta_keyword}}@endif">
                        <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
                        <textarea type="text" class="cmsModal-formControl" name="meta_description" 
                        placeholder="Seo Description">@if(old('meta_description')){{old('meta_description')}}@else{{$category->meta_description}}@endif</textarea>
                      <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
                      </div>
                      <div class="cmsModal-row">
                        <div class="cmsModal-column">
                            <div class="cmsModal-formGroup">
                                <label for="" class="cmsModal-formLabel">Allow Search Engine?</label>
                                <select class="cmsModal-formSelect mx-width-150" name="search_index">
                                  <option value="1"
                                  @if($category->search_index == 1)
                                      selected
                                  @endif
                                >Yes</option>
                                <option value="0"
                                
                                  @if($category->search_index == 0)
                                      selected
                                  @endif
                                >No</option>
                                </select>
                            </div>
                        </div>
                        <div class="cmsModal-column">
                            <div class="cmsModal-formGroup">
                                <label for="" class="cmsModal-formLabel">Follow Links?</label>
                                <select class="cmsModal-formSelect mx-width-150" name="search_follow">
                                  <option value="1"

                                  @if($category->search_follow == 1)
                                        selected
                                    @endif
                                  >Yes</option>
                                  <option value="0"
      
                                  @if($category->search_follow == 0)
                                      selected
                                  @endif                            
                                  >No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cmsModal-formGroup">
                      <label for="" class="cmsModal-formLabel">Canonical URL</label>
                      <input type="text" class="cmsModal-formControl" name="canonical_url" 
                              placeholder="Canonical URL" 
                            value="@if(old('canonical_url')){{old('canonical_url')}}@else{{$category->canonical_url}}@endif">
                          <span class="text-dark"></span>
                      <div class="mt-15px">
                        <input type="checkbox" class="form-check-input  " name="status" 
                        id="exampleCheck1"
                        
                          onClick="updateStatus({{$category->id}})"
                          @if($category->status == 1)checked
                          @endif 
                          @if(old('status'))checked
                          @endif
                          />
                        @if($category->status == 0)
                        <h5> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span class="badge badge-success">Active</span></h5>@endif
                      </div>
                  </div>
                    </div>
                    </div>
                  
                  
                  
                @if($type == 'Main_Category')
              
                      <div class="cmsModal-footer">
                      {{-- <button type="submit" class="cmsBtn blue" name="close" value="1">
                      Save Edits & Exit</button> --}}
                      <button type="button" onclick="editcategoriessubmit({{$category->id}})" class="cmsBtn blue">
                        Save Edits & Exit</button>
                    </div>
                

                   @elseif($type == 'Sub_Category')
                   <div class="cmsModal-footer">
                 
                  <button type="button" onclick="editcategoriessubmit({{$category->id}})" class="cmsBtn blue">
                  Save Edits & Exit</button>
                      <button type="submit" class="col-sm-4 cmsBtn blue mr-2">
                        Save & Add Photos</button>
                      <button type="submit" class="cmsBtn blue" name="close" value="2">
                        Save & Create Sub Category</button>
                   
                  
                    
                  </div> 
                @endif

             


              </form>
            
