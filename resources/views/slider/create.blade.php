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


@include('widget.table-search-draggable')


              <form id="addsliderajax" method="post" enctype="multipart/form-data" class="form-horizontal"
                onsubmit="return false;">
              
                @csrf
                
                <div class="cmsModal-row">
                  <div class="cmsModal-column">
                    <div class="cmsModal-formGroup">
              
                      <input type="text" class="cmsModal-formControl" name="title" placeholder="Slider Title"
                        value="{{old('title')}}">

                      <span class="text-danger">@error('title') {{$message}} @enderror</span>
                      <input type="hidden" id="page_type" value="singleUpload">
                    </div>
                  </div>

                  <div class="cmsModal-column">
                    <div class="cmsModal-formGroup">
                      <textarea class="cmsModal-formControl" name="description"
                        placeholder="Slider Alt Text / Description">{{old('description')}}</textarea>

                      <span class="text-danger">@error('description') {{$message}} @enderror</span>
                    </div>
                  </div>

                  <div class="cmsModal-column">
                    <div class="cmsModal-formGroup">
                      <input type="url" class="cmsModal-formControl" name="url" placeholder="Slider Url" value="{{old('url')}}">

                      <span class="text-danger">@error('url') {{$message}} @enderror</span>
                    </div>
                  </div>
                  </div>

                  <div class="cmsModal-row">
                    <div class="cmsModal-column">
                      <div class="cmsModal-formGroup">
                      <input type="file" class="file_input" name="image" placeholder="Slider Image" required
                        accept="image/png,image/jpeg,image/webp" />
                      <br>
                      <span class="text-danger col-12">@error('image') {{$message}} @enderror</span>

                      <p class="text-danger">
                        Image size for should be( 1351Px X 700Px ).<br>
                        Supportable Format: JPG,JPEG,PNG,WEBP
                      </p>
                      <img class="elevation-2 perview-img" width="120" src="{{asset('/')}}img/no-item.jpeg">
                    </div>
                  </div>
                </div>

                  <div class="cmsModal-row">
                    <div class="cmsModal-column">
                      <div class="cmsModal-formGroup">
                    <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1"
                      checked />

                    <h5> <span class="badge badge-success">Active</span></h5>

                    </td>
                  </div>
                  </div>
                  </div>


         

            <div class="cmsModal-footer">

              <button type="button" onclick="addslidersubmit()" class="cmsBtn blue">
                Save Slider </button>


            </div>
            
            </form>
         


       