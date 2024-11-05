
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
              <div class="">
                      <h3 class="card-title">Edit Award</h3>
                </div>
                

                <form id="awardeditajax" method="post" enctype="multipart/form-data"  class="form-horizontal editawardform" 
                onsubmit="return false;">
                @csrf
                @method('PUT')
                <input type="hidden" id="page_type" value="singleUpload">
                  <div class=" p-2 pt-4">

                  <div class="form-group row">
                      <div class="col-sm-12">
                      <div class="cmsModal-formGroup">
                        <label for="name" class="cmsModal-formLabel">Client Name</label>
                          <input class="cmsModal-formControl" type="text" name="name" placeholder="Client name"
                          value="@if(old('name')){{old('name')}}@else{{$award->name}}@endif">
                          <span class="text-danger">@error('name') {{$message}} @enderror</span>
                          </div>
                      </div>
                      </div>

                      <div class="form-group row">
                      <div class="col-sm-12">
                        <div class="cmsModal-formGroup">
                        <label for="note" class="cmsModal-formLabel">Client Note</label>
                          <textarea class="cmsModal-formControl" type="text" name="note" placeholder="Alt Text / Client Note">@if(old('note')){{old('note')}}@else{{$award->note}}@endif</textarea>
                          <span class="text-danger">@error('note') {{$message}} @enderror</span>
                          </div>
                      </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <div class="cmsModal-formGroup">
                        <label for="image_alt" class="cmsModal-formLabel">Logo</label><br>
                        <input type="file" name="image" class="image file_input" id="image"
                        accept="image/png,image/jpeg,image/webp"
                        >
                          <input type="hidden" name="old_image" value="{{$award->image}}">

                          @if($award->image)
                            <img class="mt-2 perview-img" width="200px"
                              src="{{asset('/')}}images/{{$award->image}}">
                              @else
                              <img class="perview-img"  width="200px"
                            src="{{asset('/')}}img/no-item.jpeg">
                          @endif

                        <span class="text-danger">@error('image') {{$message}} @enderror</span>
                      </div>
                      </div>



                      <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input  pull-right" name="status" 
                        id="exampleCheck1"
                        
                          @if($award->status == 1)checked
                          @endif 
                          @if(old('status'))checked
                          @endif
                          />
                          
                        @if($award->status == 0)
                        <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span class="badge badge-success">Active</span></h5>@endif</td>
                    </div>	

                    </div>
                  </div>



                  <div class="card-footer text-right">
                    @if(request()->get('onscreenCms') == 'true')
                      <button type="submit" class="cmsBtn blue" name="close" value="1"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                      Save Award & Close</button>
                    @else
                    <button type="button" onclick="editawardsubmit({{$award->id}})" class="cmsBtn blue"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                    Update </button>
                    @endif
                  </div>
                </form>

              </div>
           
         
           </div>
           
        </div>


      </div>
   
  </div>
  
  
   