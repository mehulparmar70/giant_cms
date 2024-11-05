


<script>

    $( document ).ready(function() {
    $(".del-modal").click(function(){
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    var data_image = $(this).attr('data-image');
    
    $('.delete-form').attr('action','/admin/industries/'+ delete_id);
    $('.delete-title').html(data_title);
    $('.delete-data-image').attr('src',data_image);
  });  
});

$(".industries").addClass( "menu-is-opening menu-open");
$(".industries a").addClass( "active-menu");

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
<style type="text/css">
  .imageuploadify{
    min-height: 0px;
  }
  .imageuploadify .imageuploadify-images-list i{
    margin-top: 0px;
    padding-bottom: 0px;
  }
</style>


              <form id="addindustires" method="post" enctype="multipart/form-data"
              class="form-horizontal"  onsubmit="return false;">
              <div class="cmsModal-formGroup">
                @csrf
                <div class="row">
                  <div class="col-sm-4 col-md-3">
                    <div class="form-group">
                      <label class="cmsModal-formLabel" for="client_name">Add QuickView Title</label>
                      <input type="text" class="cmsModal-formControl" name="name" placeholder="Title" value="{{old('name')}}" required> 
                      <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    </div>
                  </div>
                  <div class="col-sm-2 col-md-3">
                    <div class="form-group">
                      <label class="cmsModal-formLabel" for="client_name">Add QuickView Icon</label><br>
                      <input type="file" name="image" class="image" id="image" require accept="image/png,image/jpeg,image/webp" required/>
                      <span class="text-danger">@error('image') {{$message}} @enderror <br>Icon size for should be( 65Px   X   60Px ).</span><br> <!-- <br> Supportable Format: JPG,JPEG,PNG -->
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="cmsModal-formLabel" for="image_alt">Add Icon Alt</label>
                      <input type="text" class="cmsModal-formControl" name="image_alt" placeholder="Icon Alter Text (SEO)" value="{{old('image_alt')}}">          
                      <span class="text-danger">@error('image_alt') {{$message}} @enderror</span>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="cmsModal-formLabel" for="image_alt">Add Icon Title</label>
                      <input type="text" class="cmsModal-formControl" name="image_title" placeholder="Icon Title (SEO)" value="{{old('image_title')}}">
                      <span class="text-danger">@error('image_title') {{$message}} @enderror</span>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <label class="cmsModal-formLabel" for="short_description">Add Short Description</label>
                      <textarea type="text" class="cmsModal-formControl mb-3" required name="short_description" 
                          style="min-height: 200px;"
                         placeholder="Industries Short Description">{{old('short_description')}}</textarea>
                         
                    <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
                  </div>
                  <div class="col-sm-12 row">
                    <div class="col-sm-4">
                      <label class="cmsModal-formLabel" for="link">Link</label>
                      <input type="text" class="cmsModal-formControl" name="page_link" placeholder="Link" value="{{old('page_link')}}">    
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
                      <label class="cmsModal-formLabel" for="link">Image</label>
                      <input type="file" class="file_input" name="images[]" accept="image/png,image/jpeg,image/webp" multiple>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 res">
                </div>
                <div class="col-sm-12 text-center row">
                  <div class="col-sm-12 text-center">
                      <button type="button" onclick="addindustriessubmit()" class="cmsBtn blue"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Save</button>
                  </div>
                </div>
                </div>
              </form>
              