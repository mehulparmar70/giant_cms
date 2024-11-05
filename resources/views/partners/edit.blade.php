<script>

  $(document).ready(function () {
    $(".del-modal").click(function () {
      var delete_id = $(this).attr('data-id');
      var data_title = $(this).attr('data-title');
      var data_image = $(this).attr('data-image');

      $('.delete-form').attr('action', '/admin/Blog/' + delete_id);
      $('.delete-title').html(data_title);
      $('.delete-data-image').attr('src', data_image);
    });
  });

  $(".partners").addClass("menu-is-opening menu-open");
  $(".partners a").addClass("active-menu");

</script>



<form id="partnereditajax" enctype="multipart/form-data" method="post" class="form-horizontal" onsubmit="return false;">
  <div class="cmsModal-formGroup">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-sm-4">
      <label class="cmsModal-formLabel" for="title">Edit Partners Title</label>
      <input type="text" class="cmsModal-formControl" name="title" placeholder="Partners Title"
        value="@if(old('title')){{old('title')}}@else{{$blog->title}}@endif" required>
      <span class="text-danger">@error('title') {{$message}} @enderror</span>
    </div>
    <div class="col-sm-4">
      <label class="cmsModal-formLabel" for="title">Edit Partners Short Description</label>
      <input type="text" class="cmsModal-formControl" name="short_description" placeholder="Partners Short Description"
        value="@if(old('short_description')){{old('short_description')}}@else{{$blog->short_description}}@endif"
        required>
      <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
    </div>
    <div class="col-sm-4">
      <label class="cmsModal-formLabel" for="title">Edit Partners Page Url</label>
      <input type="text" class="cmsModal-formControl" name="slug" placeholder="Url"
        value="@if(old('short_description')){{old('short_description')}}@else{{$blog->short_description}}@endif"
        required>
      <span class="text-danger">@error('slug') {{$message}} @enderror</span>
    </div>
    <div class="col-sm-12 mt-3">
      <label for="full_description">Edit Partners Description</label>
      <input class="cmsModal-formLabel" type="hidden" id="full_description"
        value="@if(old('full_description')){{old('full_description')}}@else{{ $blog->full_description }}@endif">
      <textarea id="editor" name="full_description"
        placeholder="Partners Descriptions">{{old('full_description')}}</textarea>
      <span class="text-danger">@error('full_description') {{$message}} @enderror</span>
    </div>
  </div>
  <div class="form-group row mt-3">
    <div class="col-sm-6 col-md-6">
      <div class="col-sm-12">
        <label class="cmsModal-formLabel" for="image_alt">Edit Partners Image</label><br>
        <input type="hidden" id="page_type" value="singleUpload">
        <input type="file" name="image" class="file_input " id="image" accept="image/png,image/jpeg,image/webp" />
        <input type="hidden" name="old_image" value="{{$blog->image}}">
        @if($blog->image)
        <!-- <img class="elevation-2 perview-img"  height="120"src="{{asset('/')}}images/{{$blog->image}}">  -->
        <div class="image-area mt-3">
          <img class="elevation-2 perview-img" height="120" src="{{asset('/')}}images/{{$blog->image}}">
           <a class="remove-image" href="#"  onclick="removeimage('{{ $blog->id }}','partners','image','{{url('api')}}/media/image-delete/{{$blog->id}}')" data-id="{{ $blog->id }}" data-table="partners" data-field="image"
            data-url="{{url('api')}}/media/image-delete/{{$blog->id}}"
            style="display: inline; position: absolute;display: inline;; border-radius: 10em; padding: 2px 6px 3px; text-decoration: none; font: 700 21px/20px sans-serif;left: 105px;"><i
              class="fa fa-trash-o" aria-hidden="true"></i></a> 
        </div>
        @else
        <img class="elevation-2 perview-img mt-3" height="120" src="{{asset('/')}}img/no-item.jpeg">
        @endif
        <br>
        <span class="text-danger">@error('image') {{$message}} @enderror</span>
      </div>
      <div class="col-sm-12 row">
        <div class="col-sm-6">
          <label class="cmsModal-formLabel" for="image_alt">Image Alt</label>
          <input type="text" class="cmsModal-formControl" name="image_alt" placeholder="Partners Image Alter Text (SEO)"
            value="@if(old('image_alt')){{old('image_alt')}}@else{{$blog->image_alt}}@endif">
          <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>
        </div>
        <div class="col-sm-6">
          <label class="cmsModal-formLabel" for="image_title">Image Title</label>
          <input type="text" class="cmsModal-formControl" name="image_title" placeholder="Partners Image Title (SEO)"
            value="@if(old('image_title')){{old('image_title')}}@else{{$blog->image_title}}@endif">
          <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6">
      <div class="col-sm-12 mb-2  p-0">
        <label class="cmsModal-formLabel"  for="search_index">Edit SEO CONTENTS</label>
        <input type="text" class="cmsModal-formControl" name="meta_title" placeholder="Seo Title"
          value="@if(old('meta_title')){{old('meta_title')}}@else{{$blog->meta_title}}@endif">
        <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
      </div>
      <div class="col-sm-12 mb-2  p-0">
        <input class="cmsModal-formLabel" type="text"  name="meta_keyword" placeholder="Seo Keywords with ,"
          value="@if(old('meta_keyword')){{old('meta_keyword')}}@else{{$blog->meta_keyword}}@endif">
        <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
      </div>
      <div class="col-sm-12 mb-2  p-0">
        <textarea type="text" class="cmsModal-formControl" name="meta_description"
          placeholder="Seo Description">@if(old('meta_description')){{old('meta_description')}}@else{{$blog->meta_description}}@endif</textarea>
        <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
      </div>
      <div class="row col-sm-12">
        <div class="col-sm-6">
          <label class="cmsModal-formLabel"   for="search_index">Allow search engines?</label>
          <select class="cmsModal-formControl col-sm-5" name="search_index">
            <option value="1" @if($blog->search_index == 1)
              selected
              @endif
              >Yes</option>
            <option value="0" @if($blog->search_index == 0)
              selected
              @endif
              >No</option>
          </select>
        </div>

        <div class="col-sm-6">
          <label class="cmsModal-formLabel"   for="search_follow">Follow links?</label>
          <select class="cmsModal-formControl col-sm-5" name="search_follow">
            <option value="1" @if($blog->search_follow == 1)
              selected
              @endif
              >Yes</option>
            <option value="0" @if($blog->search_follow == 0)
              selected
              @endif
              >No</option>
          </select>
        </div>
      </div>
      <div class="col-sm-12 mt-3">
        <label class="cmsModal-formLabel" for="canonical_url">Canonical URL</label>
        <input type="text" class="cmsModal-formControl" name="canonical_url" placeholder="Canonical URL"
          value="@if(old('canonical_url')){{old('canonical_url')}}@else{{$blog->canonical_url}}@endif">
        <span class="text-danger"></span>
      </div>
      <div class="col-sm-12">
        <div class="form-check mt-4">
          <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1"
            onClick="updateStatus({{$blog->id}})" @if($blog->status == 1)checked
          @endif
          @if(old('status'))checked
          @endif
          />

          @if($blog->status == 0)
          <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span
              class="badge badge-success">Active</span></h5>@endif
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer text-center">
    <button type="button" onclick="editpartnersubmit({{$blog->id}})" class="cmsBtn blue"><i class="fa fa-floppy-o"
        aria-hidden="true"></i>
      Update </button>
  </div>
  </div>
</form>