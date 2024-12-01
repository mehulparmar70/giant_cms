

      <div class="cmsModal-formGroup">
      <label class="cmsModal-formLabel"  for="image">Featured Image</label>
      <input type="file" class="cmsModal-formControl" name="image" accept="image/png,image/jpeg,image/webp">
      <input type="hidden" id="page_type" value="singleUpload">

      <input type="hidden" name="old_image" value="{{$pageData->featured_image}}">

      <span class="cmsModal-formLabel"></span>

      <p >
        Image size should be( 400Px X 400Px ).<br>
        Supportable Format: JPG,JPEG,PNG,WEBP.<br>
        <!-- <span>* </span>This Image will Display in OG Tag -->
      </p>

      <?php 
                          // print_r($pageData);
                          // $imageFile = asset('web').'/media/xs/'.$pageData->featured_image; 
                          $imageFile = public_path().'/images/'.$pageData->featured_image; 
                          // print_r();
                          ?>
                        @if(!isset($pageData->featured_image) || !file_exists(public_path('web/media/lg/' . $pageData->featured_image)))
                            <img class="elevation-2 perview-img" width="120" src="{{ asset('img/no-item.jpeg') }}">
                        @else
                            <div class="image-area" style="position: relative;">
                                <img class="object-fit perview-img" width="300" src="{{ asset('web/media/lg/' . $pageData->featured_image) }}">
                                <a class="cmsModal-formLabel" href="#" 
                                  data-id="{{ $pageData->id }}" 
                                  data-table="pages" 
                                  data-field="featured_image"
                                  data-url="{{ url('api/media/image-delete/' . $pageData->id) }}"
                                  style="display: inline; position: absolute; top: -10px; right: -10px; border-radius: 50%; padding: 5px; background: rgba(255, 0, 0, 0.8); color: white; text-decoration: none; font: 700 18px/18px sans-serif;">
                                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </div>
                        @endif


 



   

    <input type="text" class="cmsModal-formControl" name="image_alt" placeholder="Image Alter Text (SEO)"
      value="@if(old('image_alt')){{old('image_alt')}}@else{{$pageData->image_alt}}@endif">


    <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>



    <input type="text" class="cmsModal-formControl" name="image_title" placeholder="Image Title (SEO)"
      value="@if(old('image_title')){{old('image_title')}}@else{{$pageData->image_title}}@endif">


    <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
 
  
  </div>