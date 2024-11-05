<?php 
  $pageType = $_GET['page'];

  if($_GET['page'] == 'add'){
    $pageTitle = "Add Photos";
  }elseif($_GET['page'] == 'manage'){
    $pageTitle = "Manage Photos";

  }
  
?>
<?php
  if(isset($_REQUEST['sub_category']))
    {
      $sub_category  = $_REQUEST['sub_category'];
      $productDetail = DB::table('products')->where('category_id', $sub_category)->first();
    }else{
      $productDetail = "";
    }

?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="">
        <div class="">
          <div class="form-horizontal row">

            <div class="col-md-12">
              <div class="form-group row mb-0">
                <form id="searchphoto" method="post" onsubmit="return false;" class="col-sm-12 row">
                  <div class="col-sm-4">

                    <select name="main_category" class="form-control category_parent_id" required>
                      <option value="">Select Main Category</option>
                      @foreach($Maincategories as $Maincategory)
                      <option value="{{$Maincategory->id}}" @if(isset($_REQUEST['main_category']) &&
                        $_REQUEST['main_category']==$Maincategory->id)
                        selected
                        @endif

                        >{{$Maincategory->name}}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">@error('category_id') {{$message}} @enderror</span>

                  </div>
                  <div class="col-sm-4">


                    <input type="hidden" name="page" value="manage" />

                    <select name="sub_category" class="form-control  mr-3 search-font1 sub_category_parent_id" required>
                      @if(isset($_REQUEST['sub_category']))
                      <option value="{{$_REQUEST['sub_category']}}">{{getCategory($_REQUEST['sub_category'])->name}}
                      </option>
                      @else
                      <option value="">Select Sub Category</option>
                      @endif
                    </select>


                    <span class="text-danger">@error('sub_category_parent_id') {{$message}} @enderror</span>
                  </div>

                  <div class="col-sm-3">
                    <button type="button" onclick="searchphoto()" class="btn btn-sm btn-info search_link">
                      <i class="fa fa-search" aria-hidden="true"></i> Confirm Search</button>
                  </div>
           
              </form>
              <input type="hidden" name="old_image" value="@if(isset($product))$product->image}}@endif">
              <input type="hidden" class="media_id" value="@if(isset($product)){{$product->id}}@endif">

              <input type="hidden" class="image_type" value="product">

              @if(isset($productPhotos))
              <div class="card-body table-responsive p-0 display-data">
                <form action="{{route('item.bulk-delete')}}" method="post">
                  <input type="hidden" name="type" value="product">
                  @if(isset($request->query))
                  <input type="hidden" class="media_id" value="{{$$request->query('image')}}">
                  @endif

                  <input type="hidden" class="image_type" value="product">


                  <table id="example2" class="table table-bordered table-striped" p-1>
                    <thead>
                      <tr>
                        <th>
                          <input type="checkbox" class="checkAll" name="status" id="checkAll" />
                        </th>
                        <th>Images</th>
                        <th width="200">Name</th>
                        <th width="200">Description</th>
                        <th width="">status</th>
                        <th width="150">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($productPhotos as $i => $product)

                      <tr>
                        <td>
                          <input type="checkbox" class="checkList" name="checkList[]" id="checkList"
                            value="{{$product->id}}" />
                        </td>
                        <td>
                          @if($product->count() > 0)
                          <img class="rounded" width="250" src="{{asset('web')}}/media/sm/{{$product->image}}">
                          @else
                          <img class="rounded" width="180" src="{{asset('adm')}}/img/no-item.jpeg">
                          @endif
                        </td>

                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>

                        <td>
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1"
                              onClick="updateStatus({{$product->id}})" @if($product->status == 1)checked
                            @endif
                            @if(old('status'))checked
                            @endif
                            />
                            @if($product->status == 0)
                            <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span
                                class="badge badge-success">Active</span></h5>@endif
                        </td>
            
            


              <td class="btn-block">

                @if(isset(getParentCategory($product->category_id)['category']))
                <?php $finalSlug = getParentCategory($product->category_id)['category']->slug.'/';
                            // echo $mainCategorySlug = $finalSlug;
                          ?>
                @endif

                @if(isset(getParentCategory($product->category_id)['subcategory']))
                <?php $finalSlug = $finalSlug.getParentCategory($product->category_id)['subcategory']->slug.'/' ;
                                $subCategorySlug = $finalSlug;
                                // echo($subCategorySlug);

                              ?>
                @endif

                @if(isset(getParentCategory($product->category_id)['subcategory2']))
                <?php $finalSlug = $finalSlug.getParentCategory($product->category_id)['subcategory2']->slug.'/';
                                $subCategory2Slug = $finalSlug;
                                // echo($subCategory2Slug);
                              ?>
                @endif

                <a target="_blank" href="{{url('')}}/{{$finalSlug}}{{$product->slug}}"
                  class="btn btn-xs btn-warning float-left mr-2" title="View Product Details">

                  <i class="fa fa-eye"></i></a>

                <a href="{{route('admin.index')}}/product?image={{$product->id}}"
                  class="btn btn-xs btn-info float-left mr-2" title="Manage Photos"><i class="far fa-edit"></i></a>


                <button type="button" class="btn btn-xs btn-danger del-modal float-left" title="Delete product"
                  data-id="{{route('admin.index')}}/product/{{$product->id}}" data-title="{{ $product->name}}"
                  data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
                </button>

              </td>
              </tr>
              @endforeach

              </tbody>
              <tfooter>
                <tr>

                  <td>
                    <input type="checkbox" class="checkAll" name="status" id="checkAll" />

                  <td colspan="7">

                    <!-- <button type="submit" name="action" value="active"
                            class="btn btn-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;
                            Active</button>

                          <button type="submit" name="action" value="deactive"
                            class="btn btn-info btn-sm"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Deactive</button> -->

                    <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm"><i
                        class="fas fa-trash-alt" aria-hidden="true"></i>&nbsp;&nbsp;Delete</button>

                  </td>
                </tr>

              </tfooter>
              </table>

              </form>
            </div>
            @endif

          </div>


        </div>
        <div class="col-md-12">
          <div id="resultssearch"></div>
        </div>

        @if(isset($_REQUEST['main_category']) && isset($_REQUEST['sub_category']) && isset($productDetail))


        <div class=" mt-3 col-sm-12"></div>
        <form enctype="multipart/form-data" method="post" class="col-md-12" action="{{route('product.store')}}">
          @csrf
          <div class="form-group row ">

            <input type="hidden" name="main_category" value="{{$_REQUEST['main_category']}}" />
            <input type="hidden" name="sub_category" value="{{$_REQUEST['sub_category']}}" />

            <div class="form-group col-sm-6 row">

              <!-- <div class="col-sm-12 mb-3">
                    <input type="text" class="form-control" name="name" 
                      placeholder="Product Title" 
                      value="@if($productDetail->name){{$productDetail->name}}@endif" required>
                      
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>

                  </div> -->


              <div class="col-sm-12">
                <textarea id="editor" name="full_description"
                  placeholder="Product Descriptions">@if($productDetail->full_description){{$productDetail->full_description}}@endif</textarea>

                <span class="text-danger">@error('description') {{$message}} @enderror</span>
              </div>

              <!-- <div class="col-sm-12 mb-3">
                      <input type="text" class="form-control" name="slug" 
                        placeholder="URL label" 
                        value="@if($productDetail->name){{$productDetail->slug}}@endif" required>
                      <span class="text-danger">@error('slug') {{$message}} @enderror</span>
                  </div>
                   -->
            </div>



            <div class="col-sm-6">
              <div class="col-sm-12">
                <h5 class="text-danger pr-4 col-sm-12">SEO CONTENTS</h5>
                <div class="row col-sm-12">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input type="text" class="form-control" name="meta_title" placeholder="Seo Title"
                        value="@if($productDetail->meta_title){{$productDetail->meta_title}}@endif">
                      <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" name="meta_keyword" placeholder="Seo Keywords with ,"
                        value="@if($productDetail->meta_keyword){{$productDetail->meta_keyword}}@endif">
                      <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <textarea type="text" class="form-control" name="meta_description"
                      placeholder="Seo Description">@if($productDetail->meta_description){{$productDetail->meta_description}}@endif</textarea>
                    <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
                  </div>

                  <div class="col-sm-6">
                    <label class="text-dark" class="text-dark" for="search_index">Allow search engines?</label>
                    <select class="form-control col-sm-5" name="search_index">

                      <option value="1" @if($productDetail->search_index == 1)
                        selected
                        @endif
                        >Yes</option>
                      <option value="0" @if($productDetail->search_index == 0)
                        selected
                        @endif
                        >No</option>
                    </select>
                  </div>

                  <div class="col-sm-6">
                    <label class="text-dark" class="text-dark" for="search_follow">Follow links?</label>
                    <select class="form-control col-sm-5" name="search_follow">

                      <option value="1" @if($productDetail->search_index == 1)
                        selected
                        @endif
                        >Yes</option>
                      <option value="0" @if($productDetail->search_index == 0)
                        selected
                        @endif
                        >No</option>

                    </select>
                  </div>
                </div>

                <div class="col-sm-12">
                  <label class="text-dark" for="canonical_url">Canonical URL</label>
                  <input type="text" class="form-control" name="canonical_url"
                    value="@if($productDetail->canonical_url){{$productDetail->canonical_url}}@endif"
                    placeholder="Canonical URL">
                  <span class="text-dark"></span>
                </div>
              </div>


            </div>
            <div class="card-footer col-sm-12">
              <div class=" col-sm-12 text-center">
                <button type="submit" class=" btn btn-info"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                  Save & Upload Photos</button>
              </div>
            </div>
          </div>
   
      </form>


      <div class="form-horizontal row  mt-4">

        <div class="col-md-12">

          <form action={{route('upload.multiple-image')}} class="col-sm-12" method="post" enctype="multipart/form-data">

            <div class="image-container col-sm-8 p-0">
              <h5 class="text-danger">Upload Photos</h5>
              <div class="row image-block col-sm-12 mb-3 p-0" style="position: relative;
      align-items: center;
    ">

                <input type="hidden" name="media_id" value="{{$productDetail->id}}">

                <input type="hidden" name="image_type" value="product">

                <div class="col-sm-4">
                  <input type="file" class="image" name="image[]" required accept="image/png,image/jpeg,image/webp">
                </div>

                <div class="col-sm-4">
                  <input type="text" class="form-control title" name="title[]" placeholder="Title">
                </div>

                <div class="col-sm-4 p-0">
                  <input type="text" class="form-control alt" name="alt[]" placeholder="Alt Text">
                </div>


              </div>

              <div class="res">

              </div>
            </div>
       
        <div class="col-sm-8 pt-1" style="min-height:40px">

          <button class="btn btn-dark btn-sm pull-right mx-2" type="submit"
            style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
            <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp; Start Upload</button>

          <button type="button" class="add-more btn btn-primary btn-sm pull-right"
            style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
            <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;&nbsp;Add More
          </button>

        </div>

        <hr />
     


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

        @foreach(getProductImages($productDetail->id, 0 , 'DESC') as $image)
        <form class="col-sm-12 update-form" action="{{route('update.multiple-image-field', $image->id)}}" method="post"
          id="{{$image->id}}">

          @csrf
          <div class="row  col-sm-12 mb-3 text-center selected-images" style="">
            <div class="col-sm-3">
              <img src="{{url('')}}/images/{{$image->image}}" width="200" />
            </div>

            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm title" name="title" value="{{$image->image_title}}"
                placeholder="Title" required>
            </div>

            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm alt" name="alt" placeholder="Alt Text"
                value="{{$image->image_alt}}" required>
            </div>

            <div class="col-sm-3">

              <button type="save" class="btnUpload btn btn-success btn-sm mr-2"
                style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
                <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Update Field
              </button>

              <a class="btnDelete btn btn-danger btn-sm mr-2"
                data-url="{{url('api')}}/media/media-delete/{{$image->id}}"
                style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
                <i class="fas fa-trash-alt"></i> &nbsp;&nbsp;Delete
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

</div>
</div>


</div>
</section>
</div>