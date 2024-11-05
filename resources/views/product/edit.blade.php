@extends('layout.admin-index')
@section('title','Edit:- Product')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')


<script>
$('.category_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();
    // alert(parent);

        $.get( `{{url('api')}}/get/getPetaKacheri/`+parent, { category_parent_id: parent })
        .done(function( data ) {
          // alert(JSON.stringify(data));

        if(JSON.stringify(data.length) == 0){
            $('.sub_category_parent_id').html('<option value="">Select Sub Category</option>');
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

    
    
$(".listing").addClass( "menu-is-opening menu-open");
$(".listing a").addClass( "active-menu");

</script>

@endsection
@section('content')



<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Product </h1>
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
              <a href="{{route('product.create')}}" class="btn btn-success btn-sm ml-2"><i class="fa fa-plus" aria-hidden="true"></i>
                &nbsp;&nbsp;Manage Product </a>
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
                  <div class="form-group row">
                    <div class="col-sm-4">
               
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
                    <select name="sub_category_parent_id"  class="form-control sub_category_parent_id">
                        <option value="">Select Sub Category</option>
                        
                        @if(getParentCategory($product->category_id)['subcategory'])
                          <option selected value="{{getParentCategory($product->category_id)['subcategory']->id}}">{{getParentCategory($product->category_id)['subcategory']->name}}</option>
                        @endif

                      </select>
                      <span class="text-danger">@error('sub_category_parent_id') {{$message}} @enderror</span>
                    </div>
                  </div>
                  
                  <input type="hidden" name="category_id" class="category_id" 
                    value="@if(old('category_id')) {{old('category_id')}} @else 0 @endif"> 

                  <div class="form-group row">
                    <div class="col-sm-4">
                    <input type="text" class="form-control" name="name" 
                         placeholder="Product Name" 
                         value="@if(old('name')){{old('name')}}@else{{$product->name}}@endif">
                                                
                      <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    </div>
                    
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="slug" 
                          placeholder="URL label"  value="@if(old('slug')){{old('slug')}}@else{{$product->slug}}@endif"  required>
                        <span class="text-danger">@error('slug') {{$message}} @enderror</span>
                      </div>
                    
                      <h5 class="text-danger pr-4 col-sm-6 mt-3">SEO CONTENTS</h5>
                        <div class="row col-sm-12">
                      
                        <div class="col-sm-4">
                          <div class="form-group">
                            <input type="text" class="form-control" name="meta_title" 
                              placeholder="Seo Title"  value="@if(old('meta_title')){{old('meta_title')}}@else{{$product->meta_title}}@endif">


                            <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
                          </div>

                        <div class="form-group">
                          <input type="text" class="form-control" name="meta_keyword" 
                            placeholder="Seo Keywords with ,"  value="@if(old('meta_keyword')){{old('meta_keyword')}}@else{{$product->meta_keyword}}@endif">

                          <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
                        </div>
                        </div>
                        
                        <div class="col-sm-4">
                          <textarea type="text" class="form-control" name="meta_description" 
                            placeholder="Seo Description">@if(old('meta_description')){{old('meta_description')}}@else{{$product->meta_description}}@endif</textarea>
                          <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
                        </div>
                      </div>

                    
                    
                  <div class="col-sm-12 row">
                      <div class="col-sm-3">
                        <label  class="text-dark" class="text-dark" for="search_index">Allow search engines?</label>
                        <select class="form-control col-sm-5"
                        
                        
                        name="search_index">
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
                      
                      <div class="col-sm-3">
                        <label  class="text-dark" class="text-dark" for="search_follow">Follow links?</label>
                        <select class="form-control col-sm-5" name="search_follow">
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
                      <div class="col-sm-6 pl-0">
                        <label  class="text-dark" for="canonical_url">Canonical URL</label>
                        <input type="text" class="form-control" name="canonical_url" 
                        value="@if(old('canonical_url')){{old('canonical_url')}}@else{{$product->canonical_url}}@endif">
                      
                          placeholder="Canonical URL" >
                        <span class="text-dark"></span>
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
                      
                    <h5> <span class="badge badge-success">Active</span></h5></td>
                </div>	
          
                    </div>


          </div>
                <div class="card-footer col-sm-8">
                  <button type="submit" class="float-right btn btn-dark"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                    Save Product</button>
                </div>

              </div>
              </form>
              </div>
        </div>


      </div>
    </section>
  </div>

  @endsection


  