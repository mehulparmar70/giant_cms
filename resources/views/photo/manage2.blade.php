
@extends('adm.layout.admin-index')
@section('title','Manage:- Product')

@section('toast')
  @include('adm.widget.toast')


@endsection

@section('custom-js')

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>


<script>

$( ".row_position" ).sortable({
      stop: function() {
			var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);

        }
  });

function updateOrder(data) {

  $.ajax({
      url:"{{url('api')}}/admin/item/update-item-priority",
      type:'post',
      data:{position:data, table: 'media'},
      success:function(result){
        console.log(result);
      }
  })
}
</script>

<script>
$('.delete_field').on('click', function() {
    $(this).parent('.image-block').remove();
  });
	

$('.category_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();
    // alert(parent);

        $.get( `{{url('api')}}/get/getSubCategories/`+parent, { category_parent_id: parent })

        .done(function( data ) {
          // alert(JSON.stringify(data));

        if(JSON.stringify(data.length) == 0){
            $('.sub_category_parent_id').html('<option value=>Select Sub Category</option>');
        }
        else{
                $('.sub_category_parent_id').empty();     
            $('.sub_category_parent_id').html('<option value="">Select Sub Category</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.sub_category_parent_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
    $('.category_id').val(parent);

    });


    $('.sub_category_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();

        $.get( `{{url('api')}}/get/getDepartment/`+parent, { sub_category_parent_id: parent })
        .done(function( data ) {
          // alert(JSON.stringify(data));

        if(JSON.stringify(data.length) == 0){
            $('.subcategory2_id').html('<option value=>Select Sub Category2</option>');
        }
        else{
                $('.subcategory2_id').empty();     
            $('.subcategory2_id').html('<option value="">Select Sub Category2</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.subcategory2_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
    
    $('.category_id').val(parent);
       
    });
    
    $('.subcategory2_id').on('change', function() {
        var parent = $(this).find(':selected').val();
        $('.category_id').val(parent);
       
    });

    
    
$(".listing").addClass( "menu-is-opening menu-open");
$(".listing a").addClass( "active-menu");

</script>

    <script>
       var dataCounter = 1;
        $('.add-more').click(function () { 
          // alert('text');

         var imageBlockCode = $('.image-container').html();

         dataCounter = Number(dataCounter) + 1;
          var data = ` 
          <div class="row col-sm-12 p-0 image-block mb-3">
              <div class="col-sm-4">
                  <input type="file" class="image" name="image[]"  required   accept="image/png,image/jpeg,image/webp">
              </div>

              <div class="col-sm-4">
                  <input type="text" class="form-control title" name="title[]" placeholder="Title">
              </div>

              <div class="col-sm-3 p-0">
                  <input type="text" class="form-control alt" name="alt[]" placeholder="Alt Text">
              </div>

              <div class="col-sm-1 p-0 delField" style="margin: auto;">
                <button class="btn btn-sm btn-danger ml-3 delField" type="button">X</button>
              </div>

          </div>

          `;

          $('.res').append(data);
          
        });


async function updateProductImage(e) {
  e.preventDefault();
  const formData = new FormData();
  formData.append('image_alt', e.target.image_alt.value);
  formData.append('image_title', e.target.image_title.value);

  axios.post(GLOBAL.API + 'media/update-product-image', formData)
  .then(res => {
    if(res.data == 'success'){
      // alert('1');
      toastr.success('Field Updated...')
        getMedias();
        console.log('done');  
    }
    else if(res.data == 'not-exists'){
      alert('0');

        console.log('file Already deleted');
    }
  })
}

$(".update-form").submit(function(e) {
    e.preventDefault(); // prevent actual form submit
    var form = $(this);
    var url = form.attr('action'); //get submit url [replace url here if desired]
    $.ajax({
         type: "POST",
         url: url,
         data: form.serialize(), // serializes form input
         success: function(data){
             console.log(data);
             
          toastr.success('Image Field Updated...');
         }
    });

});

$(".btnDelete").click(function(e) {
    var url = $(this).attr('data-url');
    var el = $(this);
    $.ajax({
        type: "GET",
        url: url,
        success: function(result) {
            
          toastr.error('Image Field Deleted...');
            el.closest('.update-form').remove().slideUp(1000);

        },
        error: function(result) {
            alert('error');
        }
    });
});

$('#summernote').summernote({
        placeholder: 'Photo Description Here...',
        tabsize: 2,
        height: 140
      });

    </script>

@endsection
<?php 
  $pageType = $_GET['page'];
  if($_GET['page'] == 'add'){
    $pageTitle = "Add Photos";
  }elseif($_GET['page'] == 'manage'){
    $pageTitle = "Manage Photos";

  }
  
?>

@section('content')

<?php
  $sub_category = $_REQUEST['sub_category'];

  $productDetail = DB::table('products')->where('category_id', $sub_category)->first();
  // dd($productDetail);
?>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
      <div class="row">
      
      <div class="col-sm-6">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              
              <li class="breadcrumb-item active">Manage Photos</li>
            
            </ol>
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('admin.photo.manage')}}?page=list" class="btn btn-success btn-sm ml-2">
              <i class="fa fa-th-list nav-icon" aria-hidden="true"></i>
                &nbsp;&nbsp;Manage Photos </a>
                <a class="btn btn-dark btn-sm ml-1" onclick="goBack()"> ❮ Back</a>
                
            </ol>
          </div>
      </div>
        <div class="row mb-2">
        
          <div class="col-sm-6">
            <h1>Manage Photos</h1>
          </div>
          
        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-body">
            <div class="form-horizontal row">
            
            <div class="col-md-12"  style="
                        background: whitesmoke;
                        padding: 10px !important;
                    ">
                <div class="form-group row">
                  <form action=""  class="col-sm-12 row">

                        <label class="text-danger col-sm-12">Upload Photo Details</label>

                      <div class="col-sm-4">
                      @if(isset($_REQUEST['main_category'])) 
                        <input type="text" class="form-control" name="main_category" 
                        value="{{getCategoryData($_REQUEST['main_category'])->name}}" readonly>

                        @else

                      <select name="main_category" class="form-control category_parent_id" required>
                          <option value="">Select Main Category</option>
                            @foreach($Maincategories as $Maincategory)
                                <option value="{{$Maincategory->id}}"

                                @if($_REQUEST['main_category'] == $Maincategory->id)
                                  selected
                                @endif

                                >{{$Maincategory->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('category_id') {{$message}} @enderror</span>
                        @endif

                      </div>
                  
                      <div class="col-sm-4">
                        
                        @if(isset($_REQUEST['sub_category']))
                          
                        <input type="text" class="form-control" name="main_category" 
                          value="{{getCategoryData($_REQUEST['sub_category'])->name}}" readonly>
                          @else
  
                        <input type="hidden" name="page" value="add"/>
                        <select   name="sub_category"
                        class="form-control  mr-3 search-font1 sub_category_parent_id" required>
                           <option value="{{$_REQUEST['sub_category']}}">{{getCategory($_REQUEST['sub_category'])->name}}</option>
                        </select>

                        
                        @endif
                        <span class="text-danger">@error('sub_category_parent_id') {{$message}} @enderror</span>
                      </div>
                      
                    @if(isset($_REQUEST['main_category']) && isset($_REQUEST['sub_category']))
                      <div class=" mt-3 col-sm-12"></div>
                      @else
                                <button type="submit" class="btn btn-sm btn-dark search_link"> 
                                    <i class="fa fa-search" aria-hidden="true"></i> Confirm Search</button>
                                </div>
                      @endif

                    </form>
{{--
                   <input type="hidden" name="old_image" value="{{$product->image}}">
                  <input type="hidden" class="media_id" value="{{$_REQUEST['sub_category']}}">
                  --}}
                  <input type="hidden" class="image_type" value="product">
                   @if(isset($_REQUEST['main_category']) && isset($_REQUEST['sub_category']) )
                
              @if($_REQUEST['page'] != 'manage')

                <form enctype="multipart/form-data" method="post" class="col-md-12"  
                  action="{{route('product.store')}}">
                  @csrf
                    <div class="form-group row ">
                      
                    <input type="hidden" name="main_category" value="{{$_REQUEST['main_category']}}"/>
                    <input type="hidden" name="sub_category" value="{{$_REQUEST['sub_category']}}"/>

                    <input type="hidden" name="category_id" class="category_id" > 
                    <div class="form-group col-sm-6 row">
                  
                  <div class="col-sm-12">
                          <textarea id="editor" name="full_description" placeholder="Product Descriptions" 
                          >@if($productDetail->full_description){{$productDetail->full_description}}@endif</textarea>
                                    
                        <span class="text-danger">@error('description') {{$message}} @enderror</span>
                  </div>

                  <div class="col-sm-12 mb-3">
                      <input type="text" class="form-control" name="slug" 
                        placeholder="URL label" 
                        value="@if($productDetail->name){{$productDetail->slug}}@endif" required>
                      <span class="text-danger">@error('slug') {{$message}} @enderror</span>
                  </div>
                  </div>

                    
                
                <div class="col-sm-6">
                    <div class="col-sm-12">
                  <h5 class="text-danger pr-4 col-sm-12">SEO CONTENTS</h5>
                      <div class="row col-sm-12">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <input type="text" class="form-control" name="meta_title" 
                            placeholder="Seo Title" value="@if($productDetail->meta_title){{$productDetail->meta_title}}@endif">
                          <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
                        </div>

                      <div class="form-group">
                        <input type="text" class="form-control" name="meta_keyword" 
                          placeholder="Seo Keywords with ," value="@if($productDetail->meta_keyword){{$productDetail->meta_keyword}}@endif">
                        <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
                      </div>
                      </div>
                      
                      <div class="col-sm-12">
                        <textarea type="text" class="form-control" name="meta_description" 
                          placeholder="Seo Description">@if($productDetail->meta_description){{$productDetail->meta_description}}@endif</textarea>
                        <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
                      </div>
                      
                    <div class="col-sm-6">
                      <label  class="text-dark" class="text-dark" for="search_index">Allow search engines?</label>
                      <select class="form-control col-sm-5" name="search_index">
                        
                      <option value="1"
                              @if($productDetail->search_index == 1)
                                  selected
                              @endif
                            >Yes</option>
                            <option value="0"
                            
                              @if($productDetail->search_index == 0)
                                  selected
                              @endif
                            >No</option>
                      </select>
                    </div>
                    
                    <div class="col-sm-6">
                      <label  class="text-dark" class="text-dark" for="search_follow">Follow links?</label>
                      <select class="form-control col-sm-5" name="search_follow">
                          
                      <option value="1"
                            
                            @if($productDetail->search_index == 1)
                                  selected
                              @endif
                            >Yes</option>
                            <option value="0"
                            
                            @if($productDetail->search_index == 0)
                                  selected
                              @endif
                            >No</option>
                            
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-12">
                        <label  class="text-dark" for="canonical_url">Canonical URL</label>
                        <input type="text" class="form-control" name="canonical_url" 
                          value="@if($productDetail->canonical_url){{$productDetail->canonical_url}}@endif"
                          placeholder="Canonical URL" >
                        <span class="text-dark"></span>
                      </div>
                    </div>
                    
          
                    </div>
                    <div class="card-footer col-sm-12">
                    <div class=" col-sm-12 text-center">
                  <button type="submit" class=" btn btn-dark"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                    Save & Upload Photos</button>
                </div>
                </div>
              </div>
            </div>
        </form>
        @endif
        @endif




        </div>
        </div>
        

  </div>
  
  @if(isset($_REQUEST['main_category']) && isset($_REQUEST['sub_category']) )

<div class="form-horizontal row  mt-4">
            
            <div class="col-md-12" >
                   
<form action={{route('upload.multiple-image')}} class="col-sm-12" method="post" enctype="multipart/form-data">

<div class="image-container col-sm-9 p-0">
  <div class="row image-block col-sm-12 mb-3 p-0" style="position: relative;
      align-items: center;
    ">
          <input type="hidden" name="media_id" value="{{$_REQUEST['sub_category']}}">
          <input type="hidden" name="image_type" value="sub_category">

      <div class="col-sm-4">
          <input type="file" class="image" name="image[]" required   accept="image/png,image/jpeg,image/webp">

      </div>

      <div class="col-sm-4">
          <input type="text" class="form-control title" name="title[]" placeholder="Title">
      </div>

      <div class="col-sm-3 p-0">
          <input type="text" class="form-control alt" name="alt[]" placeholder="Alt Text">
      </div>


      <!-- <button type="button" class="delete_field">Delete</button> -->
  
  </div>

    <div class="res">

    </div>
  </div>

  <p class="text-danger">
          Image size should be( 1200Px   X   1038Px ).<br>
          Supportable Format: JPG,JPEG,PNG,WEBP.<br>
        </p>
  </div>
  
      <div class="col-sm-9 pt-1" style="min-height:40px">

        <button class="btn btn-dark btn-sm pull-right mx-2 btn-upload" type="submit" 
        style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
        <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp; Start Upload</button>

        <button type="button" class="add-more btn btn-primary btn-sm pull-right" 
          style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
          <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;&nbsp;Add More
        </button>

          </div>

      <hr/>
      </div>


  
</form>
  


          <div class="form-horizontal row text-center mb-3 text-center" style="
                  background: #dedede;
                  position: relative;display: flex;align-items: center;">

              <div class="col-sm-3">
                <strong>Photo</strong>
              </div>

              <div class="col-sm-3">
               <strong>Title</strong>
              </div>

              <div class="col-sm-3">
               <strong>Alt Text</strong>
              </div>

              <div class="col-sm-3">
               <strong>Action</strong>
              </div>

            </div>
        <div class="row">

        @foreach(getSubCategoryImages($_REQUEST['sub_category'], 0 , 'DESC') as $image)
          <form class="col-sm-12 update-form" action="{{route('update.multiple-image-field', $image->id)}}"
           method="post" id="{{$image->id}}">

          @csrf
              <div class="row  col-sm-12 mb-3 text-center selected-images" style="">
                <div class="col-sm-3">
                  <img src="{{url('')}}/web/media/md/{{$image->image}}" width="200"/>
                </div>

                <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm title" name="title" value="{{$image->image_title}}" 
                    placeholder="Title" >
                </div>

                <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm alt" name="alt" placeholder="Alt Text"  value="{{$image->image_alt}}" 
                     >
                </div>

                  <div class="col-sm-3">
                  
                    <button type="save" class="btnUpload btn btn-success btn-sm mr-2" 
                      style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
                      <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Update Field
                    </button>
                  
                    <a class="btnDelete btn btn-danger btn-sm mr-2" data-url="{{url('api')}}/media/media-delete/{{$image->id}}"
                      style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
                      <i class="fa fa-trash"></i> &nbsp;&nbsp;Delete
                    </a>
                  </div>

                </div>

            </form>

            @endforeach


              </div>
              </div>
              </div>
        </div>
        @endif


      <div class="container">
          <h3 class="bg-warning pl-3">Arrange Photo Order</h3>
          <table  id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      
                    <th width="50">Order</th>
                      <th>Image</th>
                      <th width="300">Image Title</th>
                      <th width="300">Image Alt</th>
                    </tr>
                  </thead>
                  
                  <tbody class="row_position">
                  @foreach(getSubCategoryImages($_REQUEST['sub_category'], 0 , 'DESC') as $image)
                      <tr id="{{$image->id}}"> 
                        <td>{{$image->item_no}}</td>
                          <td>
                            <img src="{{url('')}}/images/{{$image->image}}" width="100"/>
                          </td>
                          <td>{{$image->image_title}}</td>
                          <td>{{$image->image_alt}}</td>
                        </tr>
                    @endforeach
                      </tbody>
                  </table>
        
        
                  </div>
                  </div>
          </div>


      </div>

        </div>
</div>


      </div>


      
    </section>
  </div>

  @endsection
