
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>


<script>
$(".footer-url").addClass( "menu-is-opening menu-open");
$(".footer-url a").addClass( "active-menu");

$( document ).ready(function() {

$(".footer-url").addClass( "menu-is-opening menu-open");
$(".footer-url a").addClass( "active-menu");

  $(".del-modal").click(function(){
    var delete_form = $(this).attr('data-form');
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    
    $('.delete-form').attr('action', delete_form);

    $('.delete-title').html(data_title);
    $('.delete-id').val(delete_id);
    $('.delete-slug').val(data_slug);
  });  
});

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
      data:{position:data, table: 'url_list'},
      success:function(result){
        console.log(result);
      }
  })
}

function updateStatus($id) {
  $.ajax({
      url:"{{route('status.update')}}",
      type:'post',
      data:{id:$id, table: 'url_list'},
      success:function(result){
        location.reload();
      }
  })
}



</script>


                <form id="editlinks" method="post" enctype="multipart/form-data"  class="form-horizontal" 
                onsubmit="return false;">
                <div class="cmsModal-formGroup">
                  @csrf

                  <div class="p-2 pt-4">
                  <label class="cmsModal-formLabel" for="name">Display Name</label>
                  <input type="text" name="name" class="cmsModal-formControl"
                  value="@if(old('name')){{old('name')}}@else{{$pageLink->name}}@endif">
                
                  <input type="hidden" name="type" value="page_link">
                    <input type="hidden" name="form_type" value="edit">
                    <input type="hidden" name="id" value="{{$pageLink->id}}">

                  <label class="cmsModal-formLabel" for="name">Url</label>
                  <input type="url" name="url" class="cmsModal-formControl"
                  value="@if(old('url')){{old('url')}}@else{{$pageLink->url}}@endif">
                         

                      <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input  pull-right" name="status" 
                        id="exampleCheck1"
                        
                          @if($pageLink->status == 1)checked
                          @endif 
                          @if(old('status'))checked
                          @endif
                          />
                          
                        @if($pageLink->status == 0)
                        <h5> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span class="badge badge-success">Active</span></h5>@endif</td>
                    </div>	
          

                  </div>
                  <div class="card-footer text-right">
                    <button type="button" onclick="editpagelinksubmit({{$pageLink->id}})" class="cmsBtn blue"><i
                      class="fa fa-floppy-o" aria-hidden="true"></i>
                    Update </button>
                  </div>
                  </div>
                </form>

              