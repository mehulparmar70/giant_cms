
<script>
$( document ).ready(function() {
  $(".del-modal").click(function(){
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    
    $('.delete-form').attr('action', delete_id);
    $('.delete-title').html(data_title);
  });  
});

$(".block-control").addClass( "menu-is-opening menu-open");
$(".block-control a").addClass( "active-menu");


function updateStatus($id) {
  $.ajax({
      url:"{{route('status.update')}}",
      type:'post',
      data:{id:$id, table: 'client'},
      success:function(result){
        console.log(result);
        location.reload();

      }
  })
}

$( ".row_position" ).sortable({
      stop: function() {
			var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
          }
  });

function updateOrder(data) {
  $.ajax({
      url:"{{url('api')}}/admin/item/update-item-priority",
      type:'post',
      data:{position:data, table: 'client'},
      success:function(result){
        console.log(result);
      }
  })
}

</script>


<div class="content-wrapper">
    


  
      <div class="container-fluid">
      
        <div class="row">

          <div class="col-md-12 ">
             
                

                <form id="sectionajax" method="post" enctype="multipart/form-data"  class="form-horizontal editawardform" 
                onsubmit="return false;">
                @csrf
                @method('PUT')
                <input type="hidden" id="page_type" value="singleUpload">
                  <div class=" p-2 pt-4">

                  <div class="form-group row">
                      <div class="col-sm-12">
                      <div class="cmsModal-formGroup">
                        <label for="name" class="cmsModal-formLabel">Title</label>
                          <input class="cmsModal-formControl" type="text" name="title" placeholder="Title"
                          value="@if(old('title')){{old('title')}}@else{{$section->title}}@endif">
                          <span class="text-danger">@error('title') {{$message}} @enderror</span>
                          </div>
                      </div>
                      </div>

                      <div class="form-group row">
                      <div class="col-sm-12">
                        <div class="cmsModal-formGroup">
                        <label for="note" class="cmsModal-formLabel">Description</label>
                          <textarea class="cmsModal-formControl" type="text" name="description" placeholder="Description">@if(old('description')){{old('description')}}@else{{$section->description}}@endif</textarea>
                          <span class="text-danger">@error('description') {{$message}} @enderror</span>
                          </div>
                      </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <div class="cmsModal-formGroup">
                        <label for="image_alt" class="cmsModal-formLabel">Icon</label><br>
                        <input type="file" name="image" class="image file_input" id="image"
                        accept="image/png,image/jpeg,image/webp"
                        >
                          <input type="hidden" name="old_image" value="{{$section->icon}}">

                          @if($section->icon)
                            <img class="mt-2 perview-img" width="200px"
                              src="{{asset('/')}}images/{{$section->icon}}">
                              @else
                              <img class="perview-img"  width="200px"
                            src="{{asset('/')}}img/no-item.jpeg">
                          @endif

                        <span class="text-danger">@error('icon') {{$message}} @enderror</span>
                      </div>
                      </div>



             	

                    </div>
                  </div>



                  <div class="card-footer text-right">
                    @if(request()->get('onscreenCms') == 'true')
                      <button type="submit" class="cmsBtn blue" name="close" value="1"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                      Save section & Close</button>
                    @else
                    <button type="button" onclick="editsectionsubmit({{$section->id}})" class="cmsBtn blue"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                    Update </button>
                    @endif
                  </div>
                </form>

              </div>
           
         
           </div>
           
        </div>


      </div>
   
  </div>
  
  
   