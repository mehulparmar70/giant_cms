<script>
  $('.category_parent_id').on('change', function () {
    var parent = $(this).find(':selected').val();

    $('.parent_id').val(parent);

    $.get(`{{url('api')}}/get/getPetaKacheri/` + parent, { category_parent_id: parent })
      .done(function (data) {
        if (JSON.stringify(data.length) == 0) {
          $('.subcategory_parent_id').html('<option>Select Sub Category</option>');
        }
        else {
          $('.subcategory_parent_id').empty();
          $('.subcategory_parent_id').html('<option value="">Select Sub Category</option>');
          for (var i = 0; i < JSON.stringify(data.length); i++) {
            $('.subcategory_parent_id').append('<option value=' + JSON.stringify(data[i].id) + '>' + data[i].name + '</option>')
          }
        }
      });
  });

  $('.subcategory_parent_id').on('change', function () {
    var parent = $(this).find(':selected').val();
    if (parent == '') {
      var mainCat = $('.category_parent_id').find(':selected').val();

      $('.parent_id').val(mainCat);

    } else {
      $('.parent_id').val(parent);
    }

  });


  $(".listing").addClass("menu-is-opening menu-open");
  $(".listing a").addClass("active-menu");

  $('.category_option').on('change', function () {
    var category_option = $(this).find(':selected').val();

    if (category_option == 'main_category') {
      // alert(category_option);

      $('.hidden-block').show();
      $('.name-lable').text('Main Category');
      $('.name-input').attr('placeholder', 'Main Category Name');

      $('.sub-category select').attr('required', false);
      $('.sub-category').hide();
      $('.product-range').hide();
      $('.category-block').hide();

    }
    else if (category_option == 'sub_category') {
      // alert(category_option);
      $('.hidden-block').show();
      $('.name-lable').text('Sub Category');
      $('.name-input').attr('placeholder', 'Sub Category Name');

      $('.category-block').show();
      $('.sub-category').show();
      $('.sub-category select').attr('required', true);
      $('.product-range').hide();
    } else {

      $('.hidden-block').hide();
    }



  });


</script>


<?php
  $pageType = $_GET['type'];
  if($_GET['type'] == 'main_category'){
    
    $pageTitle = "Main Category";
  }elseif($_GET['type'] == 'sub_category'){
    $pageTitle = "Sub Category";
  }

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


<form method="post" id="addCategory" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false;">
  
    @csrf

    <input type="hidden" id="page_type" value="singleUpload">
    <div class="cmsModal-row">
      @if($pageType == 'sub_category')
      <div class="cmsModal-column">
        <div class="cmsModal-formGroup">
          <label class="cmsModal-formLabel" for="search_index">Main Category</label>
          <select name="category_parent_id" class="cmsModal-formSelect category_parent_id" required>
            <option value="">Select Main Category</option>
            @foreach($parent_categories as $parent_category)
            <option value="{{$parent_category->id}}" @if(isset($_REQUEST['id']) && $_REQUEST['id']==$parent_category->
              id)
              selected
              @endif

              @if(old('category_parent_id') == $parent_category->id) selected @endif
              >{{$parent_category->name}}</option>
            @endforeach

          </select>

          <span class="text-danger">@error('category_parent_id') {{$message}} @enderror</span>
        
        @if(isset($_REQUEST['id']))

        <input type="hidden" name="parent_id" class="parent_id" value="{{$_REQUEST['id']}}" />
        @else

        @endif

        @if(old('category_parent_id'))
        <input type="hidden" name="parent_id" class="parent_id" value="{{old('category_parent_id')}}" />
        @endif

        <input type="hidden" name="page_type" value="sub_category" />

      
      </div>
    </div>
      @else
      <input type="hidden" name="parent_id" class="parent_id" value="0">
      @endif
   

      <div class="@if($pageType == 'main_category') cmsModal-column @else cmsModal-column @endif">
        <div class="cmsModal-formGroup">
        <label class="cmsModal-formLabel" for="search_index">Add {{$pageTitle}}</label>
        <input type="hidden" name="type" value="name">
        <input type="text" class="cmsModal-formControl name-input" name="name" placeholder="Add {{$pageTitle}}"
          value="{{old('name')}}" required>

        <span class="text-danger">@error('name') {{$message}} @enderror</span>
      </div>
      </div>

      <div class="@if($pageType == 'main_category') cmsModal-column @else cmsModal-column @endif">
        <div class="cmsModal-formGroup">
        <label class="cmsModal-formLabel" for="search_index">Short
          Description</label>
        <input type="text" class="cmsModal-formControl" name="short_description"
          placeholder="Short Description">{{old('short_description')}}</input>
        <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
      </div>
      </div>
      </div>


      <div class="cmsModal-row">
        <div class="cmsModal-column">
          <div class="cmsModal-formGroup">
          <label class="cmsModal-formLabel" for="search_index">Add {{$pageTitle}}
            Description</label>
          <textarea id="editor" name="description" placeholder="Category Descriptions">{{old('description')}}</textarea>

          <span class="text-danger">@error('description') {{$message}} @enderror</span>
        </div>
      </div>
      </div>


        <div class="cmsModal-row">

          <div class="cmsModal-column">
            <div class="cmsModal-formGroup">
            <label class="cmsModal-formLabel" for="search_index">Add Feature Image</label><br>
            <input type="file" name="image" class="file_input " id="image" accept="image/png,image/jpeg,image/webp" />
            <span class="text-danger">@error('image') {{$message}} @enderror</span>
            <img class="elevation-2 perview-img" width="120" src="{{asset('/')}}img/no-item.jpeg">
          </div>
        </div>
          <div class="cmsModal-column">
          
        @if(isset($_REQUEST['onscreenCms']) && $_REQUEST['onscreenCms'] == 'true')
        <input type="hidden" name="onscreenCms" value="true">
        @endif
          <div class="@if($pageType == 'main_category') cmsModal-formGroup @else cmsModal-formGroup @endif">
          <label class="cmsModal-formLabel" for="search_index">Add SEO CONTENTS</label>
            <input class="cmsModal-formControl" name="slug" placeholder="URL label" value="{{old('slug')}}" required>
            <span class="text-danger">@error('slug') {{$message}} @enderror</span>

            <input type="text" class="cmsModal-formControl" name="meta_title" placeholder="Seo Title"
            value="{{old('meta_title')}}">
          <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>

          <input type="text" class="cmsModal-formControl" name="meta_keyword" placeholder="Seo Keywords with ,"
          value="{{old('meta_keyword')}}">
        <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>

        <textarea type="text" class="cmsModal-formControl" name="meta_description"
        placeholder="Seo Description">{{old('meta_description')}}</textarea>
      <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
          </div>

          <div class="cmsModal-row">
            <div class="cmsModal-column">
                <div class="cmsModal-formGroup">
                    <label for="" class="cmsModal-formLabel">Allow Search Engine?</label>
                    <select class="cmsModal-formSelect mx-width-150" name="search_index">
                        <option selected value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="cmsModal-column">
                <div class="cmsModal-formGroup">
                    <label for="" class="cmsModal-formLabel">Follow Links?</label>
                    <select class="cmsModal-formSelect mx-width-150" name="search_follow">
                        <option selected value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="cmsModal-formGroup">
          <label for="" class="cmsModal-formLabel">Canonical URL</label>
          <input type="text" name="" id="" class="cmsModal-formControl" name="canonical_url" placeholder="Canonical URL" />
          <div class="mt-15px">
              <input class="cmsModal-formCheckbox mr-15px" type="checkbox" id="exampleCheck1" name="status" checked />
              <a href="javascript:void(0)" type="button" class="cmsBtn green">Active</a>
          </div>
      </div>
    
        </div>
        </div>


        <div class="cmsModal-footer">
        @if($pageType == 'main_category')



      
            <button type="button" class="cmsBtn blue">
              Close</button>
            <button type="button" onclick="addCategorieSubmit()" class="cmsBtn blue">
              Save Category</button>
       
       

        @elseif($pageType == 'sub_category')

     
          <button type="button"  class="cmsBtn blue">
            Close</button>
          <button type="button" onclick="addCategorieSubmit()" class="cmsBtn blue">
            Save Category</button>


       
        @endif
      </div>


</form>