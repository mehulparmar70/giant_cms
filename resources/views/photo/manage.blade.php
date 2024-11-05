

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>
<style>
  .imageuploadify{border:2px dashed #d2d2d2;position:relative;min-height:350px;min-width:250px;max-width:1000px;margin:auto;display:flex;padding:0;flex-direction:column;text-align:center;background-color:#fff;color:#3AA0FF}.imageuploadify .imageuploadify-overlay{z-index:10;width:100%;height:100%;position:absolute;flex-direction:column;top:0;left:0;display:none;font-size:7em;background-color:rgba(242,242,242,.7);text-align:center;pointer-events:none}.imageuploadify .imageuploadify-overlay i{z-index:10;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);pointer-events:none}.imageuploadify .imageuploadify-images-list{display:inline-block}.imageuploadify .imageuploadify-images-list i{display:block;font-size:7em;text-align:center;margin-top:.5em;padding-bottom:12px}.imageuploadify .imageuploadify-images-list span.imageuploadify-message{font-size:24px;border-top:1px solid #3AA0FF;border-bottom:1px solid #3AA0FF;padding:10px;display:inline-block}.imageuploadify .imageuploadify-images-list button.btn-default{display:block;color:#3AA0FF;border-color:#3AA0FF;border-radius:1em;margin:25px auto;width:100%;max-width:500px}.imageuploadify .imageuploadify-images-list .imageuploadify-container{width:100px;height:100px;position:relative;overflow:hidden;margin-bottom:1em;float:left;border-radius:12px;box-shadow:0 0 4px 0 #888}.imageuploadify .imageuploadify-images-list .imageuploadify-container button.btn-danger{position:absolute;top:3px;right:3px;width:20px;height:20px;border-radius:15px;font-size:10px;line-height:1.42;padding:2px 0;text-align:center;z-index:3}.imageuploadify .imageuploadify-images-list .imageuploadify-container img{height:100px;left:50%;position:absolute;top:50%;transform:translate(-50%,-50%);width:auto}.imageuploadify .imageuploadify-images-list .imageuploadify-container .imageuploadify-details{position:absolute;top:0;padding-top:20px;width:100%;height:100%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;background:rgba(255,255,255,.5);z-index:2;opacity:0}.imageuploadify .imageuploadify-images-list .imageuploadify-container .imageuploadify-details span{display:block}
</style>

<script>
  $('.delete_field').on('click', function () {
    $(this).parent('.image-block').remove();
  });

</script>
<script>
  var dataCounter = 1;


  async function updateProductImage(e) {
    e.preventDefault();
    const formData = new FormData();
    formData.append('image_alt', e.target.image_alt.value);
    formData.append('image_title', e.target.image_title.value);

    axios.post(GLOBAL.API + 'media/update-product-image', formData)
      .then(res => {
        if (res.data == 'success') {
          // alert('1');
          toastr.success('Field Updated...')
          getMedias();
          console.log('done');
        }
        else if (res.data == 'not-exists') {
          alert('0');
          console.log('file Already deleted');
        }
      })
  }



  $(".photoSubmit").submit(function (e) {
    e.preventDefault(); // prevent actual form submit
    var form = $(this);
    var url = form.attr('action'); //get submit url [replace url here if desired]

    // if($('.addImage img').length)
    if ($('.addImage img').length > 0) {
      $('.btn-upload').addClass('disabled');
      $('.btn-upload').html('<i class="fa fa-circle-notch fa-spin" aria-hidden="true"></i> Uploading Image');
      // $('.btn-upload').addClass('color_black_red');

      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes form input
        success: function (data) {
          // console.log(data);
          toastr.success('Image Field Updated...');
        },
        fail: function (data) {
          console.log('error');
        }
      });
    }
  });

  $(".update-form").submit(function (e) {
    e.preventDefault(); // prevent actual form submit
    var form = $(this);
    var url = form.attr('action'); //get submit url [replace url here if desired]

    if ($('.addImage img').length > 0) {
      $('.btn-upload').addClass('disabled');
      $('.btn-upload').html('<i class="fa fa-circle-notch fa-spin" aria-hidden="true"></i> Uploading Image');
      // $('.btn-upload').addClass('color_black_red');

      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes form input
        success: function (data) {
          console.log(data);
          toastr.success('Image Field Updated...');
        },
        fail: function (data) {
          console.log('error');
        }
      });
    }
  });

  $('.btn-upload').click(function () {
    /*$(this).children('i').addClass('bounce');
    $(this).addClass('color_black_red');*/

    $(this).addClass('disabled');
    $(this).html('<i class="fa fa-circle-notch fa-spin" aria-hidden="true"></i> Uploading Image');
    $(this).addClass('color_black_red');
  });

  $(".btnDelete").click(function (e) {
    var url = $(this).attr('data-url');
    var el = $(this);
    $.ajax({
      type: "GET",
      url: url,
      success: function (result) {
        toastr.error('Image Field Deleted...');
        el.closest('.update-form').remove().slideUp(1000);
        $('#tr-' + result.deleted_id).remove();
      },
      error: function (result) {
        alert('error');
      }
    });
  });

  // $('#summernote').summernote({
  //   placeholder: 'Photo Description Here...',
  //   tabsize: 2,
  //   height: 140
  // });
</script>


<?php 
  $pageType = $_GET['page'];
  if($_GET['page'] == 'add'){
    $pageTitle = "Add Photos";
  }elseif($_GET['page'] == 'manage'){
    $pageTitle = "Manage Photos";

  }
  
?>



<?php
  $sub_category = $_REQUEST['sub_category'];
  $productDetail = DB::table('products')->where('category_id', $sub_category)->first();
?>
<div id="loader"></div>
<div class="content-wrapper">



  <section class="content">
    <div class="container-fluid">
      <div class="">
        <div class="card-body">
          <div class="form-horizontal row">

            <div class="col-md-12">
              <div class="form-group row">
                <form action="" class="col-sm-12 row" style="display:none">
                  <input type="hidden" id="page_type" value="photoUpload">
                  <div class="col-sm-4">
                    <label for="">Main Category</label>
                    @if(isset($_REQUEST['main_category']))
                    <input type="text" class="form-control" name="main_category"
                      value="{{getCategoryData($_REQUEST['main_category'])->name}}" readonly>

                    @else

                    <select name="main_category" class="form-control category_parent_id" required>
                      <option value="">Select Main Category</option>
                      @foreach($Maincategories as $Maincategory)
                      <option value="{{$Maincategory->id}}" @if($_REQUEST['main_category']==$Maincategory->id)
                        selected
                        @endif

                        >{{$Maincategory->name}}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">@error('category_id') {{$message}} @enderror</span>
                    @endif

                  </div>

                  <div class="col-sm-4">

                    <label for="">Sub Category</label>
                    @if(isset($_REQUEST['sub_category']))
                    <input type="text" class="form-control" name="main_category"
                      value="{{getCategoryData($_REQUEST['sub_category'])->name}}" readonly>
                    @else

                    <input type="hidden" name="page" value="add" />
                    <select name="sub_category" class="form-control  mr-3 search-font1 sub_category_parent_id" required>
                      <option value="{{$_REQUEST['sub_category']}}">{{getCategory($_REQUEST['sub_category'])->name}}
                      </option>
                    </select>


                    @endif
                    <span class="text-danger">@error('sub_category_parent_id') {{$message}} @enderror</span>
                  </div>

                  @if(isset($_REQUEST['main_category']) && isset($_REQUEST['sub_category']))
                  <div class=" mt-3 col-sm-12"></div>
                  @else
                  <button type="submit" class="btn btn-sm btn-dark search_link">
                    <i class="fa fa-search" aria-hidden="true"></i> Confirm Search</button>

                  @endif

                </form>

                <input type="hidden" class="image_type" value="product">
                @if(isset($_REQUEST['main_category']) && isset($_REQUEST['sub_category']) )

                @if($_REQUEST['page'] != 'manage')

                <form enctype="multipart/form-data" method="post" class="col-md-12" id="photoSubmit"
                  action="{{route('product.store')}}">
                  @csrf
                  <div class="form-group row ">

                    <input type="hidden" name="main_category" value="{{$_REQUEST['main_category']}}" />
                    <input type="hidden" name="sub_category" value="{{$_REQUEST['sub_category']}}" />

                    <input type="hidden" name="category_id" class="category_id">
                    <div class="form-group col-sm-6 row">

                      <div class="col-sm-12">
                        <textarea id="editor" name="full_description"
                          placeholder="Product Descriptions">@if($productDetail->full_description){{$productDetail->full_description}}@endif</textarea>

                        <span class="text-danger">@error('description') {{$message}} @enderror</span>
                      </div>

                      <div class="col-sm-12 mb-3">
                        <input type="text" class="form-control" name="slug" placeholder="URL label"
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
                              <input type="text" class="form-control" name="meta_title" placeholder="Seo Title"
                                value="@if($productDetail->meta_title){{$productDetail->meta_title}}@endif">
                              <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
                            </div>

                            <div class="form-group">
                              <input type="text" class="form-control" name="meta_keyword"
                                placeholder="Seo Keywords with ,"
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
                        <button type="submit" class=" btn btn-dark"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                          Save & Upload Photos</button>
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

          <div class="col-md-12">

            <form id="photoupload" class="row" method="post" enctype="multipart/form-data"  onsubmit="return false;">

              <div class="image-container col-sm-12 p-0">
                <div class="row image-block col-sm-12 mb-3 p-0" style="position: relative;
      align-items: center;
    ">
                <h6>Add New Images</h6>
                  <input type="hidden" name="media_id" value="{{$_REQUEST['sub_category']}}">
                  <input type="hidden" name="image_type" value="sub_category">

                  <div class="col-sm-12">
                    <input type="file" class="file_input" name="image[]" accept="image/png,image/jpeg,image/webp"
                      multiple>
                  </div>

                  <!-- <div class="col-sm-3">
          <input type="text" class="form-control form-control-sm title" name="title[]" placeholder="Title">
      </div>

      <div class="col-sm-3 p-0">
          <input type="text" class="form-control form-control-sm alt" name="alt[]" placeholder="Alt Text">
      </div> -->


                </div>

                <!-- <div class="res">

    </div> -->
              </div>

              <div class="col-sm-4 pt-1" style="min-height:40px">
                @if(request()->get('onscreenCms') == 'true')
                <input type="hidden" class="onscreenCms" value="1">
                <!-- <button class="btn btn-dark btn-sm pull-right mx-2 btn-upload disabled" type="submit" 
        style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
        <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp; Start Upload & Close</button> -->
                @else
                <!-- <button class="btn btn-dark btn-sm pull-right mx-2 btn-upload disabled" type="submit" 
        style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
        <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp; Start Upload</button> -->
                @endif

              <button type="button" onclick="uploadiamges()" class="add-more btn btn-success btn-sm pull-right" 
>
          <i class="fa fa-plus" aria-hidden="true"></i> Upload
        </button> 
              </div>


              <p class="text-danger">
                Image size should be( 1200Px X 1038Px ).<br>
                Supportable Format: JPG,JPEG,PNG,WEBP.<br>
              </p>


              <hr />


            </form>
            <div>
              <h6>Edit Existing Images</h6>
            </div>
            <div class="form-horizontal row text-center mb-3 text-center" style="
                 
                  position: relative;display: flex;align-items: center;">


              <div class="col-sm-1">
                <strong>Select</strong>
              </div>

              <div class="col-sm-2">
                <strong>Photo</strong>
              </div>

              <div class="col-sm-3">
                <strong>Image Title</strong>
              </div>

              <div class="col-sm-3">
                <strong>Image Alt</strong>
              </div>

              <div class="col-sm-3">
                <strong>Action</strong>
              </div>

            </div>

            <div class="row row_position_photo res">
              @foreach(getSubCategoryImages($_REQUEST['sub_category'], 0 , 'DESC') as $key => $image)
              <input type="hidden" id="{{ $image->id }}">
              <form id="addimageproducts_{{ $image->id }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-12 update-form" 
                    onsubmit="return false;" style="position: relative; left: 0px; top: 0px; cursor: move;">
            
                @csrf
                <div class="row col-sm-12 mb-3 text-center selected-images">
                  <div class="col-sm-1">
                    <label for="">{{ ++$key }}</label>
                  </div>
                  <div class="col-sm-2">
                    <img src="{{ url('') }}/images/{{ $image->image }}" width="140" />
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm title" name="title" 
                           value="{{ $image->image_title }}" placeholder="Title">
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm alt" name="alt" 
                           placeholder="Alt Text" value="{{ $image->image_alt }}">
                  </div>
                  <div class="col-sm-3">
                    <button type="button" class="btnUpload btn btn-success btn-sm mr-2" onclick="updatephoto({{ $image->id }})" 
                            style="font-size: 15px; padding: 1px 10px; vertical-align: middle;">
                      <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Update
                    </button>
                    <button type="button" class="btnDelete btn btn-danger btn-sm mr-2" 
                    onclick="deletephoto({{ $image->id }})"
                    style="font-size: 15px; padding: 1px 10px; vertical-align: middle;">
              <i class="fa fa-trash"></i> &nbsp;&nbsp;Delete
            </button>
            
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

  </section>
</div>