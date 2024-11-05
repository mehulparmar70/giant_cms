

      <div class="cmsModal-formGroup">
      <label class="cmsModal-formLabel"  for="image">Featured Image</label>
      <input type="file" class="cmsModal-formControl" name="image" accept="image/png,image/jpeg,image/webp">
      <input type="hidden" id="page_type" value="singleUpload">

      <input type="hidden" name="old_image" value="{{$pageData->featured_image}}">

      <span class="cmsModal-formLabel"></span>

      <p class="cmsModal-formLabel">
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
      @if(!file_exists($imageFile))
      <img class="elevation-2 perview-img" width="120" src="{{asset('/')}}/img/no-item.jpeg">
      @elseif($pageData->featured_image)
      <div class="image-area">
        <img class="object-fit perview-img" width="300" src="{{asset('web')}}/media/lg/{{$pageData->featured_image}}">
        <a class="cmsModal-formLabel" href="#" data-id="{{ $pageData->id }}" data-table="pages" data-field="featured_image"
          data-url="{{url('api')}}/media/image-delete/{{$pageData->id}}"
          style="display: inline; position: absolute; top: -10px; border-radius: 10em; padding: 2px 6px 3px; text-decoration: none; font: 700 21px/20px sans-serif;"><i
            class="fa fa-trash-o" aria-hidden="true"></i></a>
      </div>
    
      @else
      <img class="elevation-2 perview-img" width="120" src="{{asset('/')}}/img/no-item.jpeg">
      @endif
    

 



   
    <label for="image_alt" class="cmsModal-formLabel">Image Alt</label>
    <input type="text" class="cmsModal-formControl" name="image_alt" placeholder="Image Alter Text (SEO)"
      value="@if(old('image_alt')){{old('image_alt')}}@else{{$pageData->image_alt}}@endif">


    <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>


 
    <label for="image_title" class="cmsModal-formLabel">Image Title</label>
    <input type="text" class="cmsModal-formControl" name="image_title" placeholder="Image Title (SEO)"
      value="@if(old('image_title')){{old('image_title')}}@else{{$pageData->image_title}}@endif">


    <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
 
  
  </div>