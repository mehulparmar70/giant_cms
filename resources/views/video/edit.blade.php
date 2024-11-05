<script>

  $(document).ready(function () {
    $(".del-modal").click(function () {
      var delete_id = $(this).attr('data-id');
      var data_title = $(this).attr('data-title');
      var data_image = $(this).attr('data-image');

      $('.delete-form').attr('action', '/admin/video/' + delete_id);
      $('.delete-title').html(data_title);
      $('.delete-data-image').attr('src', data_image);
    });
  });



  $(".video").addClass("menu-is-opening menu-open");
  $(".video a").addClass("active-menu");

</script>

              <form id="videoajax" enctype="multipart/form-data" method="post" class="form-horizontal"
                onsubmit="return false;">
                @csrf
                @method('PUT')
                <div class="cmsModal-formGroup">
                <div class="form-group row">
                  <div class="col-sm-6">
                    <label for="title" class="cmsModal-formLabel">Video Title</label>
                    <input type="text" class="cmsModal-formControl" name="title" placeholder="Video Title"
                      value="@if(old('title')){{old('title')}}@else{{$video->title}}@endif">
                    <span class="text-danger">@error('title') {{$message}} @enderror</span>
                  </div>

                  <div class="col-sm-6">
                    <label for="short_description" class="cmsModal-formLabel">Short Desctiption</label>
                    <textarea type="text" class="cmsModal-formControl" name="short_description"
                      placeholder="Video Short Desctiption">@if(old('short_description')){{old('short_description')}}@else{{$video->short_description}}@endif</textarea>

                    <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
                  </div>
                </div>



                <div class="form-group row">
                  <div class="col-sm-6">
                    <label for="youtube_embed" class="cmsModal-formLabel">Youtube Embed Code</label>
                    <textarea type="text" class="cmsModal-formControl" name="youtube_embed"
                      placeholder="Video Short Desctiption">@if(old('youtube_embed')){{old('youtube_embed')}}@else{{$video->youtube_embed}}@endif</textarea>

                    <span class="text-danger">@error('youtube_embed') {{$message}} @enderror</span>
                  </div>

                  <div class="col-sm-6">
                    <label for="video_date" class="cmsModal-formLabel">Video Date</label>
                    <input type="date" class="cmsModal-formControl" name="video_date" placeholder="Video Date"
                      value="@if(old('video_date')){{old('video_date')}}@else{{$video->video_date}}@endif">

                    <span class="text-danger">@error('slug') {{$message}} @enderror</span>
                  </div>
                </div>


                <div class="form-check">
                  <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1"
                    onClick="updateStatus({{$video->id}})" @if($video->status == 1)checked
                  @endif
                  @if(old('status'))checked
                  @endif
                  />

                  @if($video->status == 0)
                  <h5> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span
                      class="badge badge-success">Active</span></h5>@endif</td>
                </div>



                <div class="card-footer text-center">
                  <button type="button" onclick="editvideosubmit({{$video->id}})" class="cmsBtn blue"><i
                      class="fa fa-floppy-o" aria-hidden="true"></i>
                    Update </button>
                </div>

            </div>
            </div>
            </form>
          