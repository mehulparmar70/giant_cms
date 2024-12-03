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

  $(".blog").addClass("menu-is-opening menu-open");
  $(".blog a").addClass("active-menu");

</script>


<form id="addblogajax" enctype="multipart/form-data" method="post" class="form-horizontal" onsubmit="return false;">

  @csrf
  <div class="cmsModal-row">
    <div class="cmsModal-column">
      <div class="cmsModal-formGroup">
      <label for="title" class="cmsModal-formLabel">Add Title</label>
      <input type="text" class="cmsModal-formControl" name="title" placeholder="Blog Title" value="{{old('title')}}" required>
      <span class="text-danger">@error('title') {{$message}} @enderror</span>
    </div>
    </div>
    <div class="cmsModal-column">
      <div class="cmsModal-formGroup">
      <label for="title" class="cmsModal-formLabel">Add Short Description</label>
      <input type="text" class="cmsModal-formControl" name="short_description" placeholder="Blog Short Description"
        value="{{old('short_description')}}" required>
      <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
    </div>
    </div>
    </div>
   
    <div class="cmsModal-row">
      <div class="cmsModal-column">
        <div class="cmsModal-formGroup">
      <label for="full_description" class="cmsModal-formLabel">Add Description</label>
      <textarea id="editor" name="full_description"
        placeholder="Blog Descriptions">{{old('full_description')}}</textarea>
      <span class="text-danger">@error('full_description') {{$message}} @enderror</span>
    </div>
  </div>
  </div>
  <div class="cmsModal-row">
    <div class="cmsModal-column">
        <div class="cmsModal-formGroup">
        <label for="image_alt" class="cmsModal-formLabel">Add Featured Image</label><br>
        <input type="hidden" id="page_type" value="singleUpload">
        <input type="file" name="image" class="file_input " id="image" require accept="image/png,image/jpeg,image/webp"
          required />
        <br>
        <img class="elevation-2 perview-img" width="120" src="{{asset('/')}}img/no-item.jpeg">
        <span class="text-danger">@error('image') {{$message}} @enderror</span>
        <label for="image_alt" class="cmsModal-formLabel">Image Alt</label>
        <input type="text" class="cmsModal-formControl" name="image_alt" placeholder="Image Alter Text (SEO)"
          value="{{old('image_alt')}}">
        <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>
        <label for="image_title" class="cmsModal-formLabel">Image Title</label>
        <input type="text" class="cmsModal-formControl" name="image_title" placeholder="Blog Image Title (SEO)"
          value="{{old('image_title')}}">
        <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
      </div>
      </div>
      <div class="cmsModal-column">
        <div class="cmsModal-formGroup">
    <label class="cmsModal-formLabel" for="search_index">Add SEO CONTENTS</label>
      <input type="text" class="cmsModal-formControl" name="slug" placeholder="Url" value="{{old('slug')}}" required>
      <span class="text-danger">@error('slug') {{$message}} @enderror</span>

        <input type="text" class="cmsModal-formControl" name="meta_title" placeholder="Seo Title" value="{{old('meta_title')}}">
        <span class="text-danger">@error('meta_title') {{$message}} @enderror</span>

        <input type="text" class="cmsModal-formControl" name="meta_keyword" placeholder="Seo Keywords with ,"
          value="{{old('meta_keyword')}}">
        <span class="text-danger">@error('meta_keyword') {{$message}} @enderror</span>
    
        <textarea type="text" class="cmsModal-formControl" name="meta_description"
          placeholder="Seo Description">{{old('meta_description')}}</textarea>
        <span class="text-danger">@error('meta_description') {{$message}} @enderror</span>
      </div>
      <div class="cmsModal-row">
        <div class="cmsModal-column">
            <div class="cmsModal-formGroup">
                <label for="" class="cmsModal-formLabel">Allow Search Engine?</label>
                <select class="cmsModal-formControl col-sm-5" name="search_index">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
            </div>
        </div>
        <div class="cmsModal-column">
            <div class="cmsModal-formGroup">
                <label for="" class="cmsModal-formLabel">Follow Links?</label>
                <select class="cmsModal-formControl col-sm-5" name="search_follow">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
            </div>
        </div>
    </div>

      <div class="cmsModal-formGroup">
        <label class="cmsModal-formLabel" for="canonical_url">Canonical URL</label>
        <input type="text" class="cmsModal-formControl" name="canonical_url" placeholder="Canonical URL">
        <span class="text-danger"></span>
        <div class="mt-15px">
          <input type="checkbox" class="cmsModal-formCheckbox mr-15px" name="status" id="exampleCheck1" checked />
          <h5> <span class="cmsBtn green">Active</span></h5>
        </div>
      </div>

    </div>
  </div>
  <div class="cmsModal-footer">
    <button type="button" onclick="addblogsubmit()" class="cmsBtn blue">
      Save</button>
 
  </div>
</form>