<script>

  $(document).ready(function () {
    $(".del-modal").click(function () {
      var delete_id = $(this).attr('data-id');
      var data_title = $(this).attr('data-title');
      var data_image = $(this).attr('data-image');

      $('.delete-form').attr('action', '/admin/testimonial/' + delete_id);
      $('.delete-title').html(data_title);
      $('.delete-data-image').attr('src', data_image);
    });
  });

  $(".testimonial").addClass("menu-is-opening menu-open");
  $(".testimonial a").addClass("active-menu");

</script>



<input type="hidden" id="page_type" value="singleUpload">
<form id="testimonaileditajax" enctype="multipart/form-data" method="post" class="form-horizontal"
  onsubmit="return false;">
  <div class="cmsModal-formGroup">
  @csrf

  @method('PUT')
  <div class="row mb-5">
    <div class="col-sm-4 col-md-4">
      <label class="cmsModal-formLabel" for="client_name">Edit Testimonial Title</label>
      <input type="text" class="cmsModal-formControl" name="client_name" placeholder="Testimonial Name"
        value="@if(old('client_name')){{old('client_name')}}@else{{$testimonial->client_name}}@endif" required>
      <span class="text-danger">@error('client_name') {{$message}} @enderror</span>
    </div>
    <div class="col-sm-12 col-md-12 mt-3">
      <label class="cmsModal-formLabel" for="short_description">Edit Testimonial Description</label>
      <textarea id="editor" name="full_description"
        placeholder="Testimonial Descriptions">@if(old('full_description')){{old('full_description')}}@else{{$testimonial->full_description}}@endif</textarea>
      <span class="text-danger">@error('full_description') {{$message}} @enderror</span>
    </div>
    <div class="col-md-12 col-sm-12 col-lg-12 mt-3 row">
      <div class="col-sm-6 col-md-6 col-lg-6">
        <label class="cmsModal-formLabel" for="short_description">Edit Image</label>
        <input type="file" name="image" class="file_input " id="image" accept="image/png,image/jpeg,image/webp" />
        <input type="hidden" name="old_image" value="{{$testimonial->image}}">
        @if($testimonial->image)
        <div class="col-sm-12 col-md-12 col-lg-12 row">
          <div class="image-area">
            <img class="mt-5 elevation-2 perview-img" height="120"
              src="{{asset('/')}}images/{{$testimonial->image}}">
             <a class="remove-image" href="#"  onclick="removeimage('{{ $testimonial->id }}','testimonials','image','{{url('api')}}/media/image-delete/{{$testimonial->id}}')" data-id="{{ $testimonial->id }}" data-table="testimonials"
              data-field="image" data-url="{{url('api')}}/media/image-delete/{{$testimonial->id}}"
              style="    display: inline; position: absolute; left: 92px; border-radius: 10em; padding: 2px 6px 3px; text-decoration: none; font: 700 21px/20px sans-serif; top: 48px;"><i
                class="fa fa-trash-o" aria-hidden="true"></i></a> 
          </div>
        </div>
        @else
        <img class="mt-5 elevation-2 perview-img" height="120" src="{{asset('/')}}img/no-item.jpeg">
        @endif
        <p class="text-danger"> <span class="text-danger">@error('image') {{$message}} @enderror</span><br> Image size
          for should be( 700Px X 700Px ).<br> Supportable Format: JPG,JPEG,PNG,WEBP </p>
        <div class="col-sm-12 col-md-12 col-lg-12 row">
          <div class="col-sm-6">
            <label class="cmsModal-formLabel" for="image_alt">Image Alt</label>
            <input type="text" class="cmsModal-formControl" name="image_alt" placeholder="Image Alter Text (SEO)"
              value="@if(old('image_alt')){{old('image_alt')}}@else{{$testimonial->image_alt}}@endif">
            <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>
          </div>
          <div class="col-sm-6">
            <label class="cmsModal-formLabel" for="image_title">Image Title</label>
            <input type="text" class="cmsModal-formControl" name="image_title" placeholder="Product Image Title (SEO)"
              value="@if(old('image_title')){{old('image_title')}}@else{{$testimonial->image_title}}@endif">
            <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6">
        <div class="col-sm-12 col-md-12">
          <label class="cmsModal-formLabel" for="short_description">Edit Testimonial Short Description</label>
          <textarea type="text" class="cmsModal-formControl mb-3" name="short_description" style="min-height: 200px;"
            placeholder="Testimonial Short Description"
            id="">@if(old('short_description')){{old('short_description')}}@else{{$testimonial->short_description}}@endif</textarea>
          <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
        </div>
        <div class="col-sm-6 col-md-6">
          <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1"
            @if($testimonial->status == 1)checked
          @endif
          @if(old('status'))checked
          @endif
          />

          @if($testimonial->status == 0)
          <h5> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span
              class="badge badge-success">Active</span></h5>@endif
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer text-center">
    <button type="button" onclick="edittestimonailsubmit({{$testimonial->id}})" class="cmsBtn blue"><i
        class="fa fa-floppy-o" aria-hidden="true"></i>
      Update </button>
  </div>
  </div>
</form>