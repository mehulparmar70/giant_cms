<script>

  $(document).ready(function () {
    $(".del-modal").click(function () {
      var delete_id = $(this).attr('data-id');
      var data_title = $(this).attr('data-title');
      var data_image = $(this).attr('data-image');

      $('.delete-form').attr('action', '/admin/casestudies/' + delete_id);
      $('.delete-title').html(data_title);
      $('.delete-data-image').attr('src', data_image);
    });
  });

  $(".casestudies").addClass("menu-is-opening menu-open");
  $(".casestudies a").addClass("active-menu");

  var dataCounter = 1;
  $('.add-more').click(function () {
    // alert('text');

    var imageBlockCode = $('.image-container').html();

    dataCounter = Number(dataCounter) + 1;
    var data = ` 
  <div class="row col-sm-12 p-0 image-block mb-3">
      <div class="col-sm-4">
          <input type="file" class="image" name="images[]"  required   accept="image/png,image/jpeg,image/webp">
      </div>

      <div class="col-sm-4">
          <input type="text" class="cmsModal-formControl cmsModal-formControl-sm title" name="img_title[]" placeholder="Title">
      </div>

      <div class="col-sm-3 p-0">
          <input type="text" class="cmsModal-formControl cmsModal-formControl-sm alt" name="img_alt[]" placeholder="Alt Text">
      </div>

      <div class="col-sm-1 p-0 delField" style="margin: auto;">
        <button class="btn btn-sm btn-danger ml-3 delField" type="button">X</button>
      </div>
  </div>
  `;

    $('.res').append(data);

  });
</script>



<form id="addcasestudies" enctype="multipart/form-data" method="post" class="form-horizontal" onsubmit="return false;">
  <div class="cmsModal-formGroup">
  @csrf
  <div >
    @if(isset($_REQUEST['onscreenCms']) && $_REQUEST['onscreenCms'] == 'true')
    <input type="hidden" name="onscreenCms" value="true">
    @endif
    <div class="col-md-12 col-sm-12 row">
      <div class="col-sm-6">
        <label class="cmsModal-formLabel" for="title">Add CaseStudies Title</label>
        <input type="text" class="cmsModal-formControl" name="title" placeholder="Title" value="{{old('title')}}" required>
        <span class="text-danger">@error('title') {{$message}} @enderror</span>
      </div>
      <div class="col-sm-6">
        <label class="cmsModal-formLabel" for="short_description">Add CaseStudies Page Url</label>
        <input type="text" class="cmsModal-formControl" name="slug" placeholder="URL label" required>
        <span class="text-danger">@error('slug') {{$message}} @enderror</span>
      </div>
      <div class="col-sm-12 mt-3">
        <label class="cmsModal-formLabel" for="short_description">Add CaseStudies Description</label>
        <textarea id="editor" name="short_description"
          placeholder="Testimonial Descriptions">{{old('short_description')}}</textarea>

        <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
      </div>
    </div>
    <div class="col-md-12 col-sm-12 row mt-4">
      <div class="col-sm-6">
        <div class="col-md-12 col-sm-12 col-lg-12">
          <input type="hidden" id="page_type" value="singleUpload">
          <label class="cmsModal-formLabel" for="image_alt">Upload Thumb Image</label><br>
          <input type="file" name="image" class="file_input " id="image" require
            accept="image/png,image/jpeg,image/webp" required />
          <p class="text-danger">
            <span class="text-danger">@error('image') {{$message}} @enderror</span>
            Minimum Image Size Should be : 612px X 858px
          </p>
          <img class="elevation-2 perview-img" width="120" src="{{asset('/')}}img/no-item.jpeg">
        </div>
        <div class="col-sm-12 row">
          <div class="col-sm-6">
            <label class="cmsModal-formLabel" for="image_alt">Image Alt</label>
            <input type="text" class="cmsModal-formControl" name="image_alt" placeholder="Image Alter Text (SEO)"
              value="{{old('image_alt')}}">

            <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>
          </div>
          <div class="col-sm-6">
            <label class="cmsModal-formLabel" for="image_title">Image Title</label>
            <input type="text" class="cmsModal-formControl" name="image_title" placeholder="Product Image Title (SEO)"
              value="{{old('image_title')}}">

            <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
          </div>
        </div>
        <div class="col-sm-6 mt-3">
          <label class="cmsModal-formLabel" for="image_alt">Upload Pdf</label><br>
          <input type="file" name="file" class="file " id="file" require accept="pdf" required />

          <p class="text-danger">
            <span class="text-danger">@error('image') {{$message}} @enderror</span>
            Supported Format PDF only
          </p>
        </div>
      </div>
      <div class="col-sm-6">
        <label class="cmsModal-formLabel"  for="search_index">Add SEO CONTENTS</label>
        <div class="form-group">
          <input type="text" class="cmsModal-formControl" name="meta_title" placeholder="Seo Title">
          <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
          <input type="text" class="cmsModal-formControl" name="meta_keyword" placeholder="Seo Keywords with ,">
          <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
          <textarea type="text" class="cmsModal-formControl" name="meta_description" placeholder="Seo Description"></textarea>
          <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
        </div>
        <div class="col-sm-12 row">
          <div class="col-sm-6">
            <label class="cmsModal-formLabel"   for="search_index">Allow search engines?</label>
            <select class="cmsModal-formControl" name="search_index">
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label class="cmsModal-formLabel"   for="search_follow">Follow links?</label>
            <select class="cmsModal-formControl" name="search_follow">
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>
        </div>
        <div class="col-sm-12 form-group mt-3">
          <label class="cmsModal-formLabel"  for="canonical_url">Canonical URL</label>
          <input type="text" class="cmsModal-formControl" name="canonical_url" placeholder="Canonical URL">
          <span ></span>
        </div>
        <div class="col-sm-12 row">
          <div class="form-check">
            <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1" checked />

            <h5> <span class="badge badge-success">Active</span></h5>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="card-footer text-center">
    <button type="button" onclick="addcasestudiessubmit()" class="cmsBtn blue"><i class="fa fa-floppy-o"
        aria-hidden="true"></i>
      Save</button>
  </div>
</form>