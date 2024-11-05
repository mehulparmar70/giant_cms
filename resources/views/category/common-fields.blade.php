<!-- 
                  <div class="col-sm-6">
                      <div class="col-sm-12">
                        <label for="image">Image</label><br>
                        <input type="file" name="image" class="image " id="image" required
                        accept="image/png,image/jpeg,image/webp" />
                        <br> 
                        <span class="text-danger">@error('image') {{$message}} @enderror</span>
                        </div>
                      </div> 

                    
                   <div class="form-group row">
                      <div class="col-sm-12">
                        <label for="image_alt">Image Alt</label>
                        <input type="text" class="form-control" name="image_alt" 
                          placeholder="Image Alter Text (SEO)" value="{{old('image_alt')}}">
                          
                        <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>
                      </div>
                      
                      <div class="col-sm-12">
                        <label for="image_title">Image Title</label>
                        <input type="text" class="form-control" name="image_title" 
                          placeholder="Category Image Title (SEO)" value="{{old('image_title')}}">
                          
                        <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
                      </div>
                    </div>
                     -->
                    
                  <div class="row pt-2">
                    <div class="col-sm-12 mb-4">
                    <h5 class="bg-dark pl-4 pr-4">SEO CONTENTS</h5>
                      <input type="text" class="form-control" name="meta_title" 
                        placeholder="Seo Title" value="{{old('meta_title')}}">
                      <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-12 mb-4">
                      <input type="text" class="form-control" name="meta_keyword" 
                        placeholder="Seo Keywords with ," value="{{old('meta_keyword')}}">
                      <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-12 mb-4">
                      <textarea type="text" class="form-control" name="meta_description" 
                        placeholder="Seo Description">{{old('meta_description')}}</textarea>
                      <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
                    </div>
                  </div>
