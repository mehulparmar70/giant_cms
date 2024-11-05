




<div class="content-wrapper">



    <section class="content">
      <div class="container-fluid">
        <div class="">
          <div class="">
            <div class="form-horizontal row">
            
            <div class="cmsModal-formGroup">
                 
                 
                <div class="form-group row">
                  <form  id="adproductsform"  enctype="multipart/form-data" method="post" class="row" onsubmit="return false;">
                    @csrf
                      <div class="col-sm-4">
                      <select name="main_category" class="cmsModal-formControl category_parent_id" required>
                      <option value="">Select Main Category</option>
                      @foreach($parent_categories as $Maincategory)
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
                      

                      <select name="sub_category" class="cmsModal-formControl  mr-3 search-font1 sub_category_parent_id" required>
                      @if(isset($_REQUEST['sub_category']))
                      <option value="{{$_REQUEST['sub_category']}}">{{getCategory($_REQUEST['sub_category'])->name}}
                      </option>
                      @else
                      <option value="">Select Sub Category</option>
                      @endif
                    </select>

                        <span class="text-danger">@error('sub_category_parent_id') {{$message}} @enderror</span>
                      </div>

                      <div class="col-sm-4 col-md-3">
                        <div class="form-group">

                          <input type="text" class="cmsModal-formControl" name="name" placeholder="Title" value="{{old('name')}}" required> 
                          <span class="text-danger">@error('name') {{$message}} @enderror</span>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <textarea id="editor" name="main_desc" placeholder="Product Descriptions" 
                        ></textarea>
                                  
                      <span class="text-danger">@error('description') {{$message}} @enderror</span>
                </div>
                      <div class="col-sm-12">
                        <div class="row">
                          <div class="col-sm-6 col-md-6">
                            <div class="col-sm-12">
                              <label class="cmsModal-formLabel" for="image_alt">Add Product Image</label><br>
                              <input type="hidden" id="page_type" value="singleUpload">
                              <input type="file" name="image" class="file_input" id="image" require accept="image/png,image/jpeg,image/webp"
                                required />
                              <br>
                              <img class="elevation-2 perview-img" width="120" src="{{asset('/')}}img/no-item.jpeg">
                              <span class="text-danger">@error('image') {{$message}} @enderror</span>
                            </div>
                            <div class="col-sm-12 row">
                              <div class="col-sm-6">
                                <label class="cmsModal-formLabel" for="image_alt">Image Alt</label>
                                <input type="text" class="cmsModal-formControl" name="image_alt" placeholder="Partners Image Alter Text (SEO)"
                                  value="{{old('image_alt')}}">
                                <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>
                              </div>
                              <div class="col-sm-6">
                                <label class="cmsModal-formLabel" for="image_title">Image Title</label>
                                <input type="text" class="cmsModal-formControl" name="image_title" placeholder="Partners Image Title (SEO)"
                                  value="{{old('image_title')}}">
                                <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-6">
                            <div class="col-sm-12 mb-2  p-0">
                              <label class="cmsModal-formLabel"  for="search_index">Add SEO CONTENTS</label>
                              <input type="text" class="cmsModal-formControl" name="meta_title" placeholder="Seo Title" value="{{old('meta_title')}}">
                              <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
                            </div>
                            <div class="col-sm-12 mb-2  p-0">
                              <input type="text" class="cmsModal-formControl" name="meta_keyword" placeholder="Seo Keywords with ,"
                                value="{{old('meta_keyword')}}">
                              <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
                            </div>
                            <div class="col-sm-12 mb-2  p-0">
                              <textarea type="text" class="cmsModal-formControl" name="meta_description"
                                placeholder="Seo Description">{{old('meta_description')}}</textarea>
                              <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
                            </div>
                            <div class="row col-sm-12">
                              <div class="col-sm-6">
                                <label class="cmsModal-formLabel"   for="search_index">Allow search engines?</label>
                                <select class="cmsModal-formControl col-sm-5" name="search_index">
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                </select>
                              </div>
                      
                              <div class="col-sm-6">
                                <label class="cmsModal-formLabel"   for="search_follow">Follow links?</label>
                                <select class="cmsModal-formControl col-sm-5" name="search_follow">
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-12 mt-3">
                              <label class="cmsModal-formLabel" class="" for="canonical_url">Canonical URL</label>
                              <input type="text" class="cmsModal-formControl" name="canonical_url" placeholder="Canonical URL">
                              <span class="text-danger"></span>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1" checked />
                                <h5> <span class="badge badge-success">Active</span></h5>
                              </div>
                            </div>
                          </div>
                        </div>
                </div>
                <div class="card-footer text-center">
                  <button type="button" onclick="addproductsubmit()" class="cmsBtn blue"><i class="fa fa-floppy-o"
                      aria-hidden="true"></i>
                    Save</button>
                </div>
                    </form>


                  <input type="hidden" class="image_type" value="product">
                     





        </div>

  </div>
  </div>
  </div>
  </div>
  </div>
  </section>
  </div>
 