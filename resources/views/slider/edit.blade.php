<script>
  $(document).ready(function () {
    $(".del-modal").click(function () {
      var delete_id = $(this).attr('data-id');
      var data_title = $(this).attr('data-title');
      var data_image = $(this).attr('data-image');

      $('.delete-form').attr('action', delete_id);
      $('.delete-title').html(data_title);
      $('.delete-data-image').attr('src', data_image);
    });
  });


  $(".slider").addClass("menu-is-opening menu-open");
  $(".slider a").addClass("active-menu");

</script>
<script type="text/javascript">

  $(".row_position").sortable({
    stop: function () {
      var selectedData = new Array();
      $('.row_position>tr').each(function () {
        selectedData.push($(this).attr("id"));
      });
      console.log(selectedData);
      updateOrder(selectedData);

      toastr.success('Slider Order Updated...')
    }
  });


  function updateOrder(data) {
    $.ajax({
      url: "{{url('api')}}/admin/slider/update-status",
      type: 'post',
      data: { position: data },
      success: function (result) {
        console.log(result);
      }
    })
  }


  function updateStatus($id) {
    $.ajax({
      url: "{{route('status.update')}}",
      type: 'post',
      data: { id: $id, table: 'slider' },
      success: function (result) {
        // console.log(result);
        location.reload();

      }
    })
  }

</script>



<form id="slideridajax" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false;">
  <div class="cmsModal-formGroup">
  @csrf
  @method('PUT')
  <input type="hidden" id="page_type" value="singleUpload">
  <div class=" p-2 pt-4">
    <div class="form-group row">
      <div class="col-sm-12">
        <input type="hidden" class="cmsModal-formControl">

        <input type="text" class="cmsModal-formControl" name="title" placeholder="Slider Title"
          value="@if(old('title')){{old('title')}}@else{{$slider->title}}@endif">

        <span class="text-danger">@error('title') {{$message}} @enderror</span>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-12">
        <textarea class="cmsModal-formControl" name="description"
          placeholder="Slider Alt Text / Description">@if(old('description')){{old('description')}}@else{{$slider->description}}@endif</textarea>

        <span class="text-danger">@error('description') {{$message}} @enderror</span>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-12">
        <input type="url" class="cmsModal-formControl" name="url" placeholder="Slider Url"
          value="@if(old('url')){{old('url')}}@else{{$slider->url}}@endif">

        <span class="text-danger">@error('url') {{$message}} @enderror</span>
      </div>
    </div>

    <!-- <div class="form-group row">
                    <div class="col-sm-12">
                      <textarea class="cmsModal-formControl" name="youtube_embed"
                         placeholder="Add Youtube Embed Code"></textarea>

                      <span class="text-danger">@error('youtube_embed') {{$message}} @enderror</span>
                    </div>
                  </div> -->


    <div class="form-group row">

      <div class="col-sm-12">
        <input type="file" class="file_input" name="image" placeholder="Slider Image"
          accept="image/png,image/jpeg,image/webp" />

        <span class="text-danger">@error('image') {{$message}} @enderror</span>

        <p class="text-danger">
          Image size for should be( 1351Px X 700Px ).<br>
          Supportable Format: JPG,JPEG,PNG,WEBP
        </p>

        @if($slider->image)
        <img class="mt-2 perview-img" height="120" src="{{asset('/')}}images/{{$slider->image}}">
        @else
        <img class="perview-img" height="120" src="{{asset('/')}}img/no-item.jpeg">
        @endif
        <input type="hidden" name="old_image" value="{{$slider->image}}">

      </div>
    </div>




    <!-- <div class="form-group">
                      <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input status-switch" 
                          name="status" value="0" id="customSwitch1">
                        <label class="custom-control-label float-right" for="customSwitch1">Status</label>
                      </div>
                    </div> -->


    <div class="form-check">
      <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1" @if($slider->status
      == 1)checked
      @endif
      @if(old('status'))checked
      @endif
      />

      @if($slider->status == 0)
      <h5> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span
          class="badge badge-success">Active</span></h5>@endif</td>
    </div>

  </div>
  </div>

  <div class="card-footer">
    @if(request()->get('onscreenCms') == 'true')


    @else
    <button type="button" onclick="editslidersubmit({{$slider->id}})" class="cmsBtn blue"><i class="fa fa-floppy-o"
        aria-hidden="true"></i>
      Update </button>
    @endif
  </div>
  </div>
</form>