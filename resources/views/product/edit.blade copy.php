@extends('layout.admin-index')
@section('title','Edit:- Product')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')


<script>

$(".editProductImage").on('click', function() {
    alert('editmode');
});

// $(".editProductImage").click(){
//   alert('editmode');

// }


  $('.category_parent_id').on('change', function() {
          var parent = $(this).find(':selected').val();
      // alert(parent);
  
          $.get( `{{url('api')}}/get/getPetaKacheri/`+parent, { category_parent_id: parent })
          .done(function( data ) {
            // alert(JSON.stringify(data));
  
          if(JSON.stringify(data.length) == 0){
              $('.sub_category_parent_id').html('<option>Sub Category</option>');
          }
          else{
                  $('.sub_category_parent_id').empty();     
              $('.sub_category_parent_id').html('<option value="">Sub Category</option>');
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
              $('.subcategory2_id').html('<option>Select Sub Category2</option>');
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
  
      
      
  $(".product").addClass( "menu-is-opening menu-open");
  $(".product a").addClass( "active-menu");
  
  </script>
  
  
@endsection
@section('content')



<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit: Product </h1>
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Edit Product</li>


              <a href="{{route('product.create')}}" class="btn btn-success btn-sm ml-2"><i class="fa fa-plus" aria-hidden="true"></i>
                &nbsp;&nbsp; </a>

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
            
            <div class="col-md-12">
                 
              <form enctype="multipart/form-data" method="post" class="form-horizontal"  
                action="{{route('product.update', $product->id)}}">
                @csrf
                @method('PUT')
                  <div class="form-group row">
                    <div class="col-sm-4">
                    <label for="client_id">Main Category</label>
                      {{-- <input type="text" disabled value="{{}}"> --}}
                      
                      {{-- @if(getParentCategory($product->category_id)['subcategory2'])
                        <span class='bg-warning p-1'>{{getParentCategory($product->category_id)['subcategory2']->name}}</span>
                      @endif
                                 --}}

                      <select name="category_parent_id" class="form-control category_parent_id">
                        <option value="">Select Category</option>
                          @foreach($parent_categories as $parent_category)
                              <option value="{{$parent_category->id}}"

                                @if(isset(getParentCategory($product->category_id)['category']))
                                  @if($parent_category->id == getParentCategory($product->category_id)['category']->id)
                                    selected
                                  @endif
                                @endif

                                >{{$parent_category->name}}</option>
                          @endforeach
                      </select>

                      <span class="text-danger">@error('category_id') {{$message}} @enderror</span>
                    </div>
                    
                    <div class="col-sm-4">
                    <label for="client_id">Sub Category</label>
                      <select name="sub_category_parent_id"  class="form-control sub_category_parent_id">
                        <option value="">Select Sub Category</option>
                        
                        @if(getParentCategory($product->category_id)['subcategory'])
                          <option selected value="{{getParentCategory($product->category_id)['subcategory']->id}}">{{getParentCategory($product->category_id)['subcategory']->name}}</option>
                        @endif

                      </select>
                      <span class="text-danger">@error('sub_category_parent_id') {{$message}} @enderror</span>
                    </div>
    
                    
                    <div class="col-sm-4">
                     <label for="client_id">Product Range</label>
                      
                     <select name="subcategory2_id"  class="form-control subcategory2_id">
                        <option value="">Select Sub Category2</option>

                        @if(getParentCategory($product->category_id)['subcategory2'])
                          <option selected value="{{getParentCategory($product->category_id)['subcategory2']->id}}">{{getParentCategory($product->category_id)['subcategory2']->name}}</option>
                        @endif

                      </select>

                      <span class="text-danger">@error('subcategory2_id') {{$message}} @enderror</span>

                      <input type="hidden" name="category_id" class="category_id" value="{{$product->category_id}}">
                      

                      <input type="hidden" name="admin_id" value="{{session('LoggedUser')->id}}">
                    </div>                 
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name" 
                         placeholder="Product Name" 
                         value="@if(old('name')){{old('name')}}@else{{$product->name}}@endif">
                         
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label for="short_description">Short Desctiption</label>
                      <input type="text" class="form-control" name="short_description" 
                         placeholder="Product Short Desctiption" 
                         value="@if(old('short_description')){{old('short_description')}}@else{{$product->short_description}}@endif">
                         
                    <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label for="full_description">Full Desctiption</label>
                        <textarea id="editor" name="full_description" placeholder="Product Descriptions">@if(old('full_description')){{old('full_description')}}@else{{$product->full_description}}@endif</textarea>
                                  
                    <span class="text-danger">@error('full_description') {{$message}} @enderror</span>
                    </div>
                    </div>
                    
                    <div class="form-group row">
                      <label  for="slug"><span class="text-danger">*</span>Enter URL label</label>
                      <input type="text" class="form-control" name="slug" 
                        placeholder="Seo Friendly Url" value="@if(old('slug')){{old('slug')}}@else{{$product->slug}}@endif">
                      <span class="text-danger">@error('slug') {{$message}} @enderror</span>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-3">
                        <label for="image_alt">Featured Image</label><br>
                        <input type="file" name="image" class="image " id="image"
                         accept="image/png,image/jpeg,image/webp" />
                      </div>

                      <div class="col-sm-7">
                        <img class="mt-2" width="200" src="{{asset('web')}}/media/xs/{{$product->image}}">
                      </div>

                    </div>
                    
                 <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="image_alt">Image Alt</label>
                        <input type="text" class="form-control" name="image_alt" 
                          placeholder="Image Alter Text (SEO)" 
                          value="@if(old('image_alt')){{old('image_alt')}}@else{{$product->image_alt}}@endif">
                          
                        <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>
                      </div>
                      
                      <div class="col-sm-6">
                        <label for="image_title">Image Title</label>
                        <input type="text" class="form-control" name="image_title" 
                          placeholder="Product Image Title (SEO)" 
                          value="@if(old('image_title')){{old('image_title')}}@else{{$product->image_title}}@endif">
                          
                        <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
                      </div>
                    </div>

                  <div class="form-group row">
                    <h5 class="bg-dark pl-4 pr-4">SEO CONTENTS</h5>
                    <div class="col-sm-12">
                      <label  class="text-danger" class="text-danger" for="meta_title">SEO Title</label>
                      <input type="text" class="form-control" name="meta_title" 
                        placeholder="Seo Friendly Title" 
                        value="@if(old('meta_title')){{old('meta_title')}}@else{{$product->meta_title}}@endif">

                      <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-12">
                      <label  class="text-danger" for="meta_keyword">Keyword</label>
                      <input type="text" class="form-control" name="meta_keyword" 
                        placeholder="Seo Keywords with ," 
                        value="@if(old('meta_keyword')){{old('meta_keyword')}}@else{{$product->meta_keyword}}@endif">

                      <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-12">
                      <label  class="text-danger" for="meta_description">Description</label>
                      <textarea type="text" class="form-control" name="meta_description" 
                        placeholder="Seo Friendly Title">@if(old('meta_description')){{old('meta_description')}}@else{{$product->meta_description}}@endif</textarea>
                      <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
                    </div>
                  </div>

                  
                  <div class="col-sm-12 row mt-4">
                      <div class="col-sm-6">
                        <label  class="text-danger" class="text-danger" for="search_index">Allow search engines to show this Page in search results?</label>
                        <select class="form-control" name="search_index">
                            <option value="1"
                              @if($product->search_index == 1)
                                  selected
                              @endif
                            >Yes</option>
                            <option value="0"
                            
                              @if($product->search_index == 0)
                                  selected
                              @endif
                            >No</option>
                        </select>
                      </div>
                      `
                      <div class="col-sm-6">
                        <label  class="text-danger" class="text-danger" for="search_follow">Follow links on this Page?</label>
                        <select class="form-control" name="search_follow">
                            <option value="1"

                              @if($product->search_follow == 1)
                                    selected
                                @endif
                            >Yes</option>
                            <option value="0"
                            
                              @if($product->search_follow == 0)
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
                        value="@if(old('canonical_url')){{old('canonical_url')}}@else{{$product->canonical_url}}@endif">
                      <span class="text-danger"></span>
                    </div>

                  <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input  pull-right" name="status" 
                        id="exampleCheck1"
                        
                          onClick="updateStatus({{$product->id}})"
                          @if($product->status == 1)checked
                          @endif 
                          @if(old('status'))checked
                          @endif
                          />
                          
                        @if($product->status == 0)
                        <h5> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span class="badge badge-success">Active</span></h5>@endif</td>
                    </div>	


                    <input type="hidden" name="old_image" value="{{$product->image}}">
                  <input type="hidden" class="media_id" value="{{$product->id}}">
                  
                  <input type="hidden" class="image_type" value="product">

                <div class="card-footer">
                  <button type="submit" class="float-right btn btn-dark"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                    Save Product</button>
                </div>

              </div>
              </form>

              </div>


              <div id="product_mul_images">
                    
              </div>


          </div>
        </div>


      </div>
    </section>
  </div>

  @endsection
