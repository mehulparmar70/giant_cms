<script>

  $(document).ready(function () {
    $(".del-modal").click(function () {
      var delete_id = $(this).attr('data-id');
      var data_title = $(this).attr('data-title');
      var data_image = $(this).attr('data-image');

      $('.delete-form').attr('action', '/admin/newsletter/' + delete_id);
      $('.delete-title').html(data_title);
      $('.delete-data-image').attr('src', data_image);
    });
  });

  $(".newsletter").addClass("menu-is-opening menu-open");
  $(".newsletter a").addClass("active-menu");

</script>



<form id="editnewsletter" onsubmit="return false;" enctype="multipart/form-data" method="post" class="form-horizontal">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-sm-4">
      <div class="cmsModal-formGroup">
        <label for="title" class="cmsModal-formLabel">Edit Newsletter Title</label>
        <input type="text" class="cmsModal-formControl" name="title" placeholder="Blog Title"
          value="@if(old('title')){{old('title')}}@else{{$testimonial->title}}@endif" required>
        <span class="text-danger">@error('title') {{$message}} @enderror</span>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="cmsModal-formGroup">
        <label for="title" class="cmsModal-formLabel">Edit Newsletter Short Description</label>
        <input type="text" class="cmsModal-formControl" name="short_description" placeholder="Blog Short Description"
          value="@if(old('short_description')){{old('short_description')}}@else{{$testimonial->short_description}}@endif"
          required>
        <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="cmsModal-formGroup">
        <label for="title" class="cmsModal-formLabel">Edit Newsletter Page Url</label>
        <input type="text" class="cmsModal-formControl" name="slug" placeholder="Url"
          value="@if(old('short_description')){{old('short_description')}}@else{{$testimonial->short_description}}@endif"
          required>
        <span class="text-danger">@error('slug') {{$message}} @enderror</span>
      </div>
    </div>
    <div class="col-sm-12 mt-3">
      <div class="cmsModal-formGroup">
        <label class="cmsModal-formLabel" for="full_description">Edit Newsletter Description</label>
        <input type="hidden" id="full_description"
          value="@if(old('full_description')){{old('full_description')}}@else{{ $testimonial->full_description }}@endif">
        <textarea id="editor" name="full_description" placeholder="Blog Descriptions"
          maxlength="1">@if(old('full_description')){{old('full_description')}}@else{{ $testimonial->full_description }}@endif</textarea>
        <span class="text-danger">@error('full_description') {{$message}} @enderror</span>
      </div>
    </div>
  </div>
  <div class="form-group row mt-3">
    <div class="col-sm-6 col-md-6">
      <div class="col-sm-12">
        <div class="cmsModal-formGroup">
          <label class="cmsModal-formLabel" for="image_alt">Edit Newsletter Image</label><br>
          <input type="hidden" id="page_type" value="singleUpload">
          <input type="file" name="image" class="file_input " id="image" accept="image/png,image/jpeg,image/webp" />
          <br>
          <div class="col-8">
            <input type="hidden" name="old_image" value="{{$testimonial->image}}">
            <?php $fileName = public_path().'/images/'.$testimonial->image; ?>
            @if(!file_exists($fileName))
            <img class="elevation-2 perview-img" height="120" src="{{asset('/')}}img/no-item.jpeg">
            @elseif($testimonial->image)
            <!-- <img class="mt-2"  height="120"src="{{asset('web')}}/media/xs/{{$testimonial->image}}"> -->
            <div class="image-area">
              <img class="elevation-2 perview-img" height="120" src="{{asset('/')}}images/{{$testimonial->image}}">
               <a class="remove-image" href="#"  onclick="removeimage('{{ $testimonial->id }}','newsletters','image','{{url('api')}}/media/image-delete/{{$testimonial->id}}')" data-id="{{ $testimonial->id }}" data-table="newsletters"
                data-field="image" data-url="{{url('api')}}/media/image-delete/{{$testimonial->id}}"
                style="display: inline; position: absolute; top: -10px; border-radius: 10em; padding: 2px 6px 3px; text-decoration: none; font: 700 21px/20px sans-serif;left: 105px;"><i
                  class="fa fa-trash" aria-hidden="true"></i></a>
            </div>
            @else
            <img class="elevation-2 perview-img" height="120" src="{{asset('/')}}img/no-item.jpeg">
            @endif
          </div>
          <span class="text-danger">@error('image') {{$message}} @enderror</span>

        </div>
      </div>
      <div class="col-sm-12 row">
        <div class="col-sm-6">
          <div class="cmsModal-formGroup">
            <label for="image_alt" class="cmsModal-formLabel">Image Alt</label>
            <input type="text" class="cmsModal-formControl" name="image_alt" placeholder="Blog Image Alter Text (SEO)"
              value="@if(old('image_alt')){{old('image_alt')}}@else{{$testimonial->image_alt}}@endif">
            <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="cmsModal-formGroup">
            <label for="image_title" class="cmsModal-formLabel">Image Title</label>
            <input type="text" class="cmsModal-formControl" name="image_title" placeholder="Blog Image Title (SEO)"
              value="@if(old('image_title')){{old('image_title')}}@else{{$testimonial->image_title}}@endif">
            <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6">
      <div class="col-sm-12 mb-2  p-0">
        <div class="cmsModal-formGroup">
          <label class="cmsModal-formLabel" for="search_index">Add SEO CONTENTS</label>
          <input type="text" class="cmsModal-formControl" name="meta_title" placeholder="Seo Title"
            value="@if(old('meta_title')){{old('meta_title')}}@else{{$testimonial->meta_title}}@endif">
          <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
        </div>
      </div>
      <div class="col-sm-12 mb-2  p-0">
        <div class="cmsModal-formGroup">
          <input type="text" class="cmsModal-formControl" name="meta_keyword" placeholder="Seo Keywords with ,"
            value="@if(old('meta_keyword')){{old('meta_keyword')}}@else{{$testimonial->meta_keyword}}@endif">
          <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
        </div>
      </div>
      <div class="col-sm-12 mb-2  p-0">
        <div class="cmsModal-formGroup">
          <textarea type="text" class="cmsModal-formControl" name="meta_description"
            placeholder="Seo Description">@if(old('meta_description')){{old('meta_description')}}@else{{$testimonial->meta_description}}@endif</textarea>
          <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
        </div>
      </div>
      <div class="row col-sm-12">
        <div class="col-sm-6">
          <div class="cmsModal-formGroup">
            <label class="cmsModal-formLabel" for="search_index">Allow search engines?</label>
            <select class="cmsModal-formControl col-sm-5" name="search_index">
              <option value="1" @if($testimonial->search_index == 1) selected @endif>Yes</option>
              <option value="0" @if($testimonial->search_index == 0) selected @endif>No</option>
            </select>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="cmsModal-formGroup">
            <label class="cmsModal-formLabel" for="search_follow">Follow links?</label>
            <select class="cmsModal-formControl col-sm-5" name="search_follow">
              <option value="1" @if($testimonial->search_follow == 1) selected @endif>Yes</option>
              <option value="0" @if($testimonial->search_follow == 0) selected @endif>No</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-sm-12 mt-3">
        <div class="cmsModal-formGroup">
          <label class="cmsModal-formLabel" for="canonical_url">Canonical URL</label>
          <input type="text" class="cmsModal-formControl" name="canonical_url" placeholder="Canonical URL"
            value="@if(old('canonical_url')){{old('canonical_url')}}@else{{$testimonial->canonical_url}}@endif">
          <span class="text-danger"></span>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-check mt-4">
          <div class="cmsModal-formGroup">
            <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1"
              onClick="updateStatus({{$testimonial->id}})" @if($testimonial->status == 1)checked
            @endif
            @if(old('status'))checked
            @endif
            />

            @if($testimonial->status == 0)
            <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span
                class="badge badge-success">Active</span></h5>@endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer text-center">
    <button onclick="editnewslettersubmit({{$testimonial->id}})" type="button" class="cmsBtn blue"
      style="font-size: 15px;padding: 1px 10px;vertical-align: middle;">
      <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Update
    </button>
  </div>
</form>