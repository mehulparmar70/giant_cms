<form id="ajaxform" method="post"  enctype="multipart/form-data" class="form-horizontal" 
              action="{{route('admin.category.store')}}">
                @csrf
                  <input type="hidden" id="page_type" value="singleUpload">
              <div class="hidden-block form-group row">
                      <input type="hidden" name="parent_id" class="parent_id" 
                      value="0"> 
        <div class="card-body p-2">
            <div class="form-group row">
                    <div class="col-sm-4 col-md-3">
                      <label  class="text-dark" class="text-dark" for="search_index">Add Main Category Name</label>
                      <input type="hidden" name="type" value="name">
                      <input type="text" class="form-control name-input" name="name" 
                         placeholder="Main Category Name" value="{{old('name')}}" required>
                         
                      <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-4 col-md-3">
                      <label  class="text-dark" class="text-dark" for="search_index">Add Main Category Page Url</label>
                      <input class="form-control" name="slug" placeholder="URL label" 
                        value="{{old('slug')}}" required>
                      <span class="text-danger">@error('slug') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-4 col-md-6">
                      <label  class="text-dark" class="text-dark" for="search_index">Add Main Category Page Short Description</label>
                      <textarea class="form-control" name="short_description">{{old('short_description')}}</textarea>
                      <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
                    </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 pt-3 pb-3">
                    <label  class="text-dark" class="text-dark" for="search_index">Add Main Category Description</label>
                        <textarea id="editor" name="description" placeholder="Category Descriptions" 
                        >{{old('description')}}</textarea>
                                
                    <span class="text-danger">@error('description') {{$message}} @enderror</span>
                </div>
                <div class="col-sm-6">  
                    <div class="col-sm-12">
                        <label  class="text-dark mr-5"  for="search_index">Add Main Category Image</label><br>
                        <input type="file" name="image" class="file_input " id="image"
                        accept="image/png,image/jpeg,image/webp" />
                        <span class="text-danger">@error('image') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-12 mt-5">
                    <img class="elevation-2 perview-img"   width="120" src="{{asset('adm')}}/img/no-item.jpeg">
                    </div>
                </div>
                    @if(isset($_REQUEST['onscreenCms']) && $_REQUEST['onscreenCms'] == 'true')
                        <input type="hidden" name="onscreenCms" value="true">
                    @endif
                <div class="col-sm-6">
                    <div class="col-sm-12 mb-2  p-0">
                        <label class="text-dark" for="search_index">Add SEO CONTENTS</label>
                        <input type="text" class="form-control" name="meta_title" 
                        placeholder="Seo Title" value="{{old('meta_title')}}">
                        <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-12 mb-2  p-0">
                        <input type="text" class="form-control" name="meta_keyword" 
                            placeholder="Seo Keywords with ," value="{{old('meta_keyword')}}">
                        <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-12 mb-2  p-0">
                        <textarea type="text" class="form-control" name="meta_description" 
                            placeholder="Seo Description">{{old('meta_description')}}</textarea>
                        <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
                    </div>
                    <div class="row col-sm-12">
                        <div class="col-sm-6">
                            <label  class="text-dark" class="text-dark" for="search_index">Allow search engines?</label>
                            <select class="form-control col-sm-5" name="search_index">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label  class="text-dark" class="text-dark" for="search_follow">Follow links?</label>
                            <select class="form-control col-sm-5" name="search_follow">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                          <div class="col-sm-12 mt-2">
                            <label  class="text-dark" class="text-dark" for="search_follow">Canonical Url </label>
                            <input type="text" class="form-control" name="canonical_url" 
                              placeholder="Canonical URL" >
                            <span class="text-dark"></span>
                          </div>
                          <div class="col-sm-6 mt-2">
                            <div class="form-check">
                              <input type="checkbox" class="form-check-input  pull-right" name="status" 
                                  id="exampleCheck1"
                                checked
                                  />
                                <h5> <span class="badge badge-success">Active</span></h5>
                            </div>
                          </div>
                    </div>
                  <div class="col-sm-12 text-center mt-4 row">
                    @if(request()->get('onscreenCms') == 'true')
                    <div class="col-sm-6 mt-4 text-right">
                      
                      <button type="submit" class="cmsBtn blue" name="close" value="1"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                      Save & Close</button>
                    </div>
                    @endif
                    <div class="col-sm-6 @if(request()->get('onscreenCms') == 'true') text-left @else text-right @endif mt-4">
                    <button type="submit" class="cmsBtn blue"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                      Save & Create Sub Category</button>
                    </div>
                  </div>
                    </div>

              </form>