@extends('adm.layout.admin-index')
@section('title','Edit:- Category')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')

<?php
$cat_type = '';
$cat_level = [];
  $parent_id = $data->parent_id;


if($parent_id == 0){
  $cat_type = 'category';
  $cat_level = ['category_name' => null, 'category' => null, 'subcategory' => null, 'subcategory2' => null, 'parent_id' =>0];
  // dd($cat_level);
  // dd('0 main category');
}
else{
  if($mainCategory = getParent($parent_id)->parent_id == 0){
    $cat_type = 'subcategory';
    $cat_level = ['category_name' => getParent($parent_id)->name, 'category' => getParent($parent_id)->id, 'subcategory' => null, 'subcategory2' => null, 'parent_id' =>getParent($parent_id)->id];

  }
  else{
      $cat_type = 'subcategory2';
      if($subCategory = (getParent(getParent($parent_id)->parent_id)->parent_id) == 0){
      $cat_level = ['category_name' => getParent(getParent($parent_id)->parent_id)->name, 'category' => getParent(getParent($parent_id)->parent_id)->id, 'subcategory' => getParent($parent_id)->id, 'subcategory_name' => getParent($parent_id)->name, 'subcategory2' => null, 'parent_id' => getParent($parent_id)->id];
  // dd($cat_level);
  // dd('2 sub category 2');
      }

  }
}



// dd($cat_level['parent_id']);

// checkParent($parent_id){
//   if(getParent($parent_id)->parent_id == 0){
//     dd('main category');
//   }
//   else{
  
//     dd(getParent($parent_id));
//   }
// }



  // if(getParent($parent_id)->parent_id == 0 || getParent($parent_id)->parent_id == null){

  //   dd('main category');
  // }
 
  
// if($data->parent_id == 0){
//   $mainCategory = 0;
//   $subCategory = null;
//   dd($mainCategory);

// }else{
//   $sel1 = DB::table('categories')->where('id', $parent_id)->first();

//   // dd($sel1);

//   if($sel1->parent_id == 0){
//     $mainCategory = $sel1;
//     $subCategory = null;
//     dd($mainCategory);
//   }else{

//     $sel2 = DB::table('categories')->where('id', $sel1->parent_id)->first();
//     dd($sel2);

//     if($sel2->parent_id == 0){
//       $mainCategory = $sel2;
//     }else{
//       $sel3 = DB::table('categories')->where('id', $sel2->parent_id)->first();
//       if($sel3->parent_id == 0){
//         $mainCategory = $sel2;
//       }
//     }
//     dd($mainCategory);
//   }
// }
//   $subCategory = DB::where('parent_id', '!=', 0)->where('id', $id)->first();
  
//   if($subCategory){
//     $subCategory = DB::where('parent_id', $subCategory->id )->first();
//   }else{
//     $subCategory = null;
//   }
  
//   if($subCategory){

//     $subCategory = DB::where('parent_id', $subCategory->id )->first();
//     if($subCategory2){
//       $subCategory = DB::where('parent_id', $subCategory->id )->first();
//     }else{
//       $subCategory = null;
//     }
// }

?>

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

</script>

<?php

  if($_GET['type'] == 'main_category'){
    $pageType = "Main Category";
  }elseif($_GET['type'] == 'sub_category'){

    $pageType = "Sub Category";
  }


?>
@endsection
@section('content')


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        
      <div class="row">
      
      <div class="col-sm-6"> 
        <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Edit {{$pageType}} </li>

              </ol>

          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            <li class="breadcrumb-item active">
                Edit Category
              </li>

              <a href="{{route('admin.category.create')}}" class="btn btn-success btn-sm ml-2"><i class="fa fa-plus" aria-hidden="true"></i>
                &nbsp;&nbsp;Add New {{$pageType}} </a>
                
              @if($pageType == 'main_category')
                <a href="{{route('admin.category.create')}}?type=sub_category" class="btn btn-success btn-sm ml-2"><i class="fa fa-plus" aria-hidden="true"></i>
                  &nbsp;&nbsp;Add Sub Category </a>

                @elseif($pageType == 'sub_category')
                  <a href="{{route('product.create')}}" class="btn btn-success btn-sm ml-2"><i class="fa fa-plus" aria-hidden="true"></i>
                    &nbsp;&nbsp;Upload Photos Category </a>
                @else

                <a href="{{route('admin.category.create')}}?type=sub_category" class="btn btn-success btn-sm ml-2"><i class="fa fa-plus" aria-hidden="true"></i>
                    &nbsp;&nbsp;Add Main Category </a>
                @endif
                <a class="btn btn-dark btn-sm ml-1" onclick="goBack()"> ❮ Back</a>
                

              </ol>
          </div>
          </div>

        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Edit {{$pageType}}: 
            

                @if(getParentCategory($data->id)['category']->parent_id == 0)
                  <span class='badge badge-primary p-1'>{{getParentCategory($data->id)['category']->name}}</span>
                  <?php $category = 0; ?>
                @else
                  <span class='badge badge-primary p-1'>{{getParentCategory($data->id)['category']->name}}</span>
                  <?php $category = getParentCategory($data->id)['category']->parent_id; ?>
                @endif

                
                @if(getParentCategory($data->id)['subcategory'])
                  <span class='badge badge-danger p-1'>{{getParentCategory($data->id)['subcategory']->name}}</span>
                @endif

                
                @if(getParentCategory($data->id)['subcategory2'])
                  <span class='badge badge-warning p-1'>{{getParentCategory($data->id)['subcategory2']->name}}</span>
                @endif

             </h1>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">
                Edit Category
              </li>

              <a href="{{route('admin.category.create')}}" class="btn btn-success btn-sm ml-2"><i class="fa fa-plus" aria-hidden="true"></i>
                &nbsp;&nbsp;Add New {{$pageType}} </a>
            
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
        
          <div class="card-body">
            <div class="form-horizontal row">
            
            <div class="col-md-12 card card-theme">
                 
              <div class="card card-theme">
              <div class="card-header">
                <h3 class="card-title">Category Details</h3>
              </div>
             
              <form method="post" enctype="multipart/form-data" class="form-horizontal" 
              action="{{route('admin.category.list.update', $data->id)}}">
                @csrf
                <div class="card-body p-2 pt-4">

                <div class="form-group row">
                    <div class="col-sm-6">
                      <label  for="slug"><span class=""></span>Category</label>
                      <select name="category_parent_id" class="form-control category_parent_id">
                      

                        <option value="0">Select Category</option>

                          @foreach($categories as $parent_category)
                              <option value="{{$parent_category->id}}"
                      
                                @if($cat_level['category'] == $parent_category->id )
                                  selected
                                @endif
                              

                              >{{$parent_category->name}}</option>
                          @endforeach

                      </select>
                      <span class="text-danger">@error('category_parent_id') {{$message}} @enderror</span>
                    </div>

                    <div class="col-sm-6">
                      <label  for="sub category"><span class=""></span>Sub Category</label>
                      <select name="subcategory_parent_id"  class="form-control subcategory_parent_id">

                        @if($cat_level['subcategory'])
                          <option value="{{$cat_level['subcategory']}}">{{$cat_level['subcategory_name']}}</option>
                        @else
                          <option value="0">Select Sub Category</option>
                        @endif
                        

                      </select>
                      <span class="text-danger">@error('subcategory_parent_id') {{$message}} @enderror</span>
                    </div>
                  </div>

                  <input type="hidden" name="parent_id" class="parent_id"value="{{$cat_level['parent_id']}}">
                 
                  
                <div class="form-group row category-block" 
                
                
                @if($cat_level['category'])

                  style="display:block"
                    @else
                      style="display:none"
                    @endif
                    

                >
                    <div class="col-sm-6 pull-left sub-category "  
                    @if($cat_level['category'])
                      style="display:block"
                    @else
                      style="display:none"
                    @endif
                    
                    >
                      <label  for="slug"><span class=""></span>Category</label>
                      <select name="category_parent_id" class="form-control category_parent_id">
                        <option value="">Select Main Category</option>
                          @foreach($parent_categories as $parent_category)
                              <option value="{{$parent_category->id}}"
                              
                          @if($cat_level['category'] == $parent_category->id )
                              selected
                            @endif

                              {{--@if(old('category_parent_id') == $parent_category->id) selected @endif --}}
                              >{{$parent_category->name}}</option>
                          @endforeach

                      </select>
                      <span class="text-danger">@error('category_parent_id') {{$message}} @enderror</span>
                    </div>
                
                    <div class="col-sm-6 pull-left product-range"  
                    @if($cat_level['subcategory'])
                      style="display:block"
                    @else
                      style="display:block"
                    @endif
                    >
                      <label  for="sub category"><span class=""></span>sub Category</label>
                      <select name="subcategory_parent_id"  class="form-control subcategory_parent_id">


                      @if($cat_level['subcategory'])
                          <option value="{{$cat_level['subcategory']}}">{{$cat_level['subcategory_name']}}</option>
                        @else
                          <option value="0">Select Sub Category</option>
                        @endif
                        
                      </select>
                      <span class="text-danger">@error('subcategory_parent_id') {{$message}} @enderror</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label  for="name"><span class="text-danger">*</span>Name</label>
                      <input type="hidden" name="type" value="name">
                      <input type="text" class="form-control" name="name" 
                         placeholder="Category Name" 
                          value="@if(old('name')){{old('name')}}@else{{$data->name}}@endif">
                         
                        <span class="text-danger">@error('category') {{$message}} @enderror</span>
                    </div>
                  </div>


                  <div class="form-group row">
                      <div class="col-sm-12">
                        <label for="description"><span class="text-danger">*</span>Desctiption</label>
                          <textarea id="editor" name="description" placeholder="Product Descriptions" 
                          >@if(old('description')){{old('description')}}@else{{$data->description}}@endif</textarea>
                                    
                      <span class="text-danger">@error('description') {{$message}} @enderror</span>
                      </div>
                    </div>
                    

                  <div class="form-group row">
                    <div class="col-sm-12">
                         
                      <label  for="slug"><span class="text-danger">*</span>Enter URL label</label>
                      <input class="form-control" name="slug" placeholder="Seo friendly url" value="@if(old('slug')){{old('slug')}}@else{{$data->slug}}@endif" required>


                    <span class="text-danger">@error('slug') {{$message}} @enderror</span>
                    </div>
                  </div>
                  

                  <div class="form-group row">
                        <div class="col-sm-12 row">
                          <div class="col-4">
                            <label for="image">Image</label><br>
                            <input type="file" name="image" class="image " id="image" require
                          accept="image/png,image/jpeg,image/webp" />
                          <br>
  
                            <span class="text-danger">@error('image') {{$message}} @enderror</span>
                            <p class="text-danger">
                              Image size for should be( 1351Px   X   700Px ).<br>
                              Supportable Format: JPG,JPEG,PNG,WEBP
                            </p>
                          </div>

                        <div class="col-8">
                          <input type="hidden" name="old_image" value="{{$data->image}}">
                          @if($data->image)
                            <img class="mt-2"  height="120"
                              src="{{asset('web')}}/media/xs/{{$data->image}}">
                              @else
                              <img class=""  height="120"
                            src="{{asset('/')}}/img/no-item.jpeg">
                          @endif
                        </div>
                    </div>
                    </div>

                    
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label for="image_alt">Image Alt</label>
                        <input type="text" class="form-control" name="image_alt" 
                          placeholder="Image Alter Text (SEO)" 
                          value="@if(old('image_alt')){{old('image_alt')}}@else{{$data->image_alt}}@endif">
                          
                        <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>
                      </div>
                      
                      <div class="col-sm-12">
                        <label for="image_title">Image Title</label>
                        <input type="text" class="form-control" name="image_title" 
                          placeholder="Category Image Title (SEO)" 
                          value="@if(old('image_title')){{old('image_title')}}@else{{$data->image_title}}@endif">
                          
                        <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
                      </div>
                    </div>
                    
                    
                  <div class="form-group row">
                    <h5 class="bg-dark pl-4 pr-4">SEO CONTENTS</h5>
                    <div class="col-sm-12">
                      <label  class="text-danger" class="text-danger" for="meta_title">SEO Title</label>
                      <input type="text" class="form-control" name="meta_title" 
                        placeholder="Seo Friendly Title" 
                          value="@if(old('meta_title')){{old('meta_title')}}@else{{$data->meta_title}}@endif">
                      <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-12">
                      <label  class="text-danger" for="meta_keyword">Keyword</label>
                      <input type="text" class="form-control" name="meta_keyword" 
                        placeholder="Seo Keywords with ," 
                          value="@if(old('meta_keyword')){{old('meta_keyword')}}@else{{$data->meta_keyword}}@endif">

                      <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-12">
                      <label  class="text-danger" for="meta_description">Description</label>
                      <textarea type="text" class="form-control" name="meta_description" 
                        placeholder="Seo Friendly Title">@if(old('meta_description')){{old('meta_description')}}@else{{$data->meta_description}}@endif</textarea>
                      <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
                    </div>
                  </div>
                  
                  <div class="col-sm-12 row mt-4">
                      <div class="col-sm-6">
                        <label  class="text-danger" class="text-danger" for="search_index">Allow search engines to show this Page in search results?</label>
                        <select class="form-control" name="search_index">
                            <option value="1"
                              @if($data->search_index == 1)
                                  selected
                              @endif
                            >Yes</option>
                            <option value="0"
                            
                              @if($data->search_index == 0)
                                  selected
                              @endif
                            >No</option>
                        </select>
                      </div>
                      
                      <div class="col-sm-6">
                        <label  class="text-danger" class="text-danger" for="search_follow">Follow links on this Page?</label>
                        <select class="form-control" name="search_follow">
                            <option value="1"

                              @if($data->search_follow == 1)
                                    selected
                                @endif
                            >Yes</option>
                            <option value="0"
                            
                              @if($data->search_follow == 0)
                                  selected
                              @endif                            
                            >No</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <label  class="text-danger" for="canonical_url">Canonical URL</label>
                      <input type="text" class="form-control" name="canonical_url" 
                        placeholder="Canonical URL" 
                        value="@if(old('canonical_url')){{old('canonical_url')}}@else{{$data->canonical_url}}@endif">
                      <span class="text-danger"></span>
                    </div>


                  
                             <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input  pull-right" name="status" 
                                id="exampleCheck1"
                                
                                  onClick="updateStatus({{$data->id}})"
                                  @if($data->status == 1)checked
                                  @endif 
                                  @if(old('status'))checked
                                  @endif
                                  />
                                  
                                @if($data->status == 0)
                                <h5> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span class="badge badge-success">Active</span></h5>@endif</td>
                            </div>	
                  
                  </div>
                </div>


                <div class="card-footer">
                  <button type="submit" class="float-right btn btn-dark"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                    Save Category</button>
                </div>
              </form>
            </div>

          </div>
        </div>


      </div>
    </section>
  </div>

  @endsection
