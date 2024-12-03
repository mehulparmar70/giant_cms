<script>

  $(document).ready(function () {
    $(".del-modal").click(function () {
      var delete_id = $(this).attr('data-id');
      var data_title = $(this).attr('data-title');
      var data_image = $(this).attr('data-image');

      $('.delete-form').attr('action', '/admin/blog/' + delete_id);
      $('.delete-title').html(data_title);
      $('.delete-data-image').attr('src', data_image);
    });
  });

  $(".blog").addClass("menu-is-opening menu-open");
  $(".blog a").addClass("active-menu");

</script>


<form id="editblogajax" enctype="multipart/form-data" method="post" class="form-horizontal" onsubmit="return false;">

  @csrf
  @method('PUT')
  <div class="cmsModal-row">
    <div class="cmsModal-column">
      <div class="cmsModal-formGroup">
      <label class="cmsModal-formLabel" for="title">Edit Title</label>
      <input type="text" class="cmsModal-formControl" name="title" placeholder="Blog Title"
        value="@if(old('title')){{old('title')}}@else{{$blog->title}}@endif" required>
      <span class="text-danger">@error('title') {{$message}} @enderror</span>
    </div>
    </div>
    <div class="cmsModal-column">
      <div class="cmsModal-formGroup">
      <label class="cmsModal-formLabel" for="title">Edit Short Description</label>
      <input type="text" class="cmsModal-formControl" name="short_description" placeholder="Blog Short Description"
        value="@if(old('short_description')){{old('short_description')}}@else{{$blog->short_description}}@endif"
        required>
      <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
    </div>
    </div>
    <div class="cmsModal-column">
      <div class="cmsModal-formGroup">
      <label class="cmsModal-formLabel" for="title">Edit Page Url</label>
      <input type="text" class="cmsModal-formControl" name="slug" placeholder="Url"
        value="@if(old('slug')){{old('slug')}}@else{{$blog->slug}}@endif"
        required>
      <span class="text-danger">@error('slug') {{$message}} @enderror</span>
    </div>
    </div>
    </div>
    <div class="cmsModal-row">
      <div class="cmsModal-column">
          <div class="cmsModal-formGroup">
      <label class="cmsModal-formLabel" for="full_description">Edit Description</label>
      <input  type="hidden" id="full_description"
        value="@if(old('full_description')){{old('full_description')}}@else{{ $blog->full_description }}@endif">
      <textarea id="editor" name="full_description" placeholder="Blog Descriptions"
        maxlength="1">@if(old('full_description')){{old('full_description')}}@endif</textarea>
      <span class="text-danger">@error('full_description') {{$message}} @enderror</span>
    </div>
    </div>
  </div>
  <div class="cmsModal-row">
    <div class="cmsModal-column">
        <div class="cmsModal-formGroup">
        <label class="cmsModal-formLabel" for="image_alt">Edit Image</label><br>
        <input type="hidden" id="page_type" value="singleUpload">
        <input type="file" name="image" class="file_input " id="image" accept="image/png,image/jpeg,image/webp" />
        <br>
          <input type="hidden" name="old_image" value="{{$blog->image}}">
          <?php $fileName = public_path().'/images/'.$blog->image; ?>
          @if(!file_exists($fileName))
          <img class="elevation-2 perview-img" height="120" src="{{asset('/')}}img/no-item.jpeg">
          @elseif($blog->image)
          <!-- <img class="mt-2 elevation-2 perview-img"  height="120"src="{{asset('web')}}/media/xs/{{$blog->image}}"> -->
          <div class="image-area">
            <img class="elevation-2 perview-img" height="120" src="{{asset('/')}}images/{{$blog->image}}">

          </div>
          @else
          <img class="elevation-2 perview-img" height="120" src="{{asset('/')}}img/no-item.jpeg">
          @endif
        <span class="text-danger">@error('image') {{$message}} @enderror</span>

        <label class="cmsModal-formLabel" for="image_alt">Image Alt</label>
        <input type="text" class="cmsModal-formControl" name="image_alt" placeholder="Blog Image Alter Text (SEO)"
          value="@if(old('image_alt')){{old('image_alt')}}@else{{$blog->image_alt}}@endif">
        <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>
    
        <label class="cmsModal-formLabel" for="image_title">Image Title</label>
        <input type="text" class="cmsModal-formControl" name="image_title" placeholder="Blog Image Title (SEO)"
          value="@if(old('image_title')){{old('image_title')}}@else{{$blog->image_title}}@endif">
        <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
      </div>
      </div>
      <div class="cmsModal-column">
        <div class="cmsModal-formGroup">
          <label class="cmsModal-formLabel" class="text-dark" for="search_index">Add SEO CONTENTS</label>
          <input type="text" class="cmsModal-formControl" name="meta_title" placeholder="Seo Title"
            value="@if(old('meta_title')){{old('meta_title')}}@else{{$blog->meta_title}}@endif">
          <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>

          <input type="text" class="cmsModal-formControl" name="meta_keyword" placeholder="Seo Keywords with ,"
          value="@if(old('meta_keyword')){{old('meta_keyword')}}@else{{$blog->meta_keyword}}@endif">
        <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>

        <textarea type="text" class="cmsModal-formControl" name="meta_description"
        placeholder="Seo Description">@if(old('meta_description')){{old('meta_description')}}@else{{$blog->meta_description}}@endif</textarea>
      <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
        </div>
        <div class="cmsModal-row">
          <div class="cmsModal-column">
              <div class="cmsModal-formGroup">
                  <label for="" class="cmsModal-formLabel">Allow Search Engine?</label>
                  <select class="cmsModal-formSelect mx-width-150" name="search_index">
                    <option value="1" @if($blog->search_index == 1) selected @endif>Yes</option>
                    <option value="0" @if($blog->search_index == 0) selected @endif>No</option>
                  </select>
              </div>
          </div>
          <div class="cmsModal-column">
              <div class="cmsModal-formGroup">
                  <label for="" class="cmsModal-formLabel">Follow Links?</label>
                  <select class="cmsModal-formSelect mx-width-150" name="search_follow">
                    <option value="1" @if($blog->search_follow == 1) selected @endif>Yes</option>
                    <option value="0" @if($blog->search_follow == 0) selected @endif>No</option>
                  </select>
              </div>
          </div>
      </div>
      <div class="cmsModal-formGroup">
        <label class="cmsModal-formLabel"  for="canonical_url">Canonical URL</label>
        <input type="text" class="cmsModal-formControl" name="canonical_url" placeholder="Canonical URL"
          value="@if(old('canonical_url')){{old('canonical_url')}}@else{{$blog->canonical_url}}@endif">
        <span class="text-danger"></span>
        <div class="mt-15px">
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

 
  <div class="cmsModal-footer">
    <button type="button" onclick="editblogsubmit({{$blog->id}})" class="cmsBtn blue">
      Update Blog</button>
  </div>

</form>