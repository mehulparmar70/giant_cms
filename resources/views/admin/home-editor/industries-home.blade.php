<form  id="ajaxForm" method="post" enctype="multipart/form-data"  class="form-horizontal"
                action="{{route('industries-store')}}">
                  @csrf

        <div class="row">
        <div class="col-sm-4 col-md-3">
        <div class="form-group">
            <label for="client_name">Add QuickView Title</label>
            <input type="text" class="form-control" name="name" placeholder="Title" value="{{old('name')}}" required> 
            <span class="text-danger">@error('name') {{$message}} @enderror</span>
        </div>
        </div>
        <div class="col-sm-2 col-md-3">
        <div class="form-group">
            <label for="client_name">Add QuickView Icon</label><br>
            <input type="file" name="image" class="image" id="image" require accept="image/png,image/jpeg,image/webp" required/>
            <span class="text-danger">@error('image') {{$message}} @enderror <br>Icon size for should be( 65Px   X   60Px ).</span><br> <!-- <br> Supportable Format: JPG,JPEG,PNG -->
        </div>
        </div>
        <div class="col-sm-3">
        <div class="form-group">
            <label for="image_alt">Add Icon Alt</label>
            <input type="text" class="form-control" name="image_alt" placeholder="Icon Alter Text (SEO)" value="{{old('image_alt')}}">          
            <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>
        </div>
        </div>
        <div class="col-sm-3">
        <div class="form-group">
            <label for="image_alt">Add Icon Title</label>
            <input type="text" class="form-control" name="image_title" placeholder="Icon Title (SEO)" value="{{old('image_title')}}">
            <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
        </div>
        </div>
        <div class="col-sm-12">
        <label for="short_description">Add Short Description</label>
            <textarea type="text" class="form-control mb-3" required name="short_description" 
                style="min-height: 200px;"
                placeholder="Industries Short Description">{{old('short_description')}}</textarea>
                
        <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
        </div>
        <div class="col-sm-12 row">
        <div class="col-sm-4">
            <label for="link">Link</label>
            <input type="text" class="form-control" name="page_link" placeholder="Link" value="{{old('page_link')}}">    
            <span class="text-danger">@error('page_link') {{$message}} @enderror</span>
            <div class="form-check mt-4">
                <input type="checkbox" class="form-check-input  pull-right" name="status" 
                id="exampleCheck1"
                checked
                />
                
                <h5> <span class="badge badge-success">Active</span></h5>
            </div>
        </div>
        <div class="col-sm-8 text-center mb-5">
            <label for="link">Image</label>
            <input type="file" class="file_input" name="images[]" accept="image/png,image/jpeg,image/webp" multiple>
        </div>
        </div>
    </div>
    <div class="col-sm-12 res">
    </div>
    <div class="col-sm-12 text-center row">
        @if(request()->get('onscreenCms') == 'true')
        <input type="hidden" name="onscreenCms" value="true">
        <div class="col-sm-12 text-center">
        <button type="submit" class="cmsBtn blue" name="close" value="1"><i class="fa fa-floppy-o" aria-hidden="true"></i>
        Save & Exit</button>
        </div>
        @else
        <div class="col-sm-12 text-center">
        <button type="submit" class="cmsBtn blue"><i class="fa fa-floppy-o" aria-hidden="true"></i>
            Save </button>
        </div>
        @endif
    </div>
</form>