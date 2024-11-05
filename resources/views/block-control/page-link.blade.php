

<script src="{{url('/')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{url('/')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{url('/')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{url('/')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{url('/')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>


<script>
$( document ).ready(function() {
  $(".del-modal").click(function(){
    var delete_form = $(this).attr('data-form');
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    
    $('.delete-form').attr('action', delete_form);
    $('.delete-title').html(data_title);
    $('.delete-id').val(delete_id);
    // $('.delete-slug').val(data_slug);

  });  
});
$(".footer-url").addClass( "menu-is-opening menu-open");
$(".footer-url a").addClass( "active-menu");


$( ".row_position" ).sortable({
      stop: function() {
			var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            console.log(selectedData);
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
        // console.log(result);
        location.reload();
      }
  })
}



</script>


<div class="content-wrapper">
    
<div class="cmsModal-formGroup">

    <section class="content">
      <div class="container-fluid">
      
        <div class="row">

          <div class="col-md-5 ">
              <div class="">
                      <h3 class="">Add Page Link</h3>
                </div>
                

                <form id="ajaxForm" method="post" enctype="multipart/form-data"  class="form-horizontal" 
                action="{{route('admin.pageLink.store')}}">

                  @csrf

                  <div class=" p-2 pt-4">
                  <label class="cmsModal-formLabel" for="name">Display Name</label>
                  <input type="text" name="name" class="cmsModal-formControl" required>
                  <input type="hidden" name="type" value="page_link">

                  <label class="cmsModal-formLabel" for="name">Url</label>
                  <input type="url" name="url" class="cmsModal-formControl"  required>


                  <div class="form-check mt-4">
                    <input type="checkbox" class="form-check-input  pull-right" name="status" 
                        id="exampleCheck1"
                      checked
                        />
                        
                      <h5> <span class="badge badge-success">Active</span></h5>
                      </div>

                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-dark">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Save Page Link</button>
                  </div>
                </form>

              </div>
           
           <div class="col-md-7">
              <div class="">
                      <h3 class="">Page Links Lists</h3>
                </div>
                <div class=" table-responsive p-0">
                  <table class="clienttable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th width="300">Name</th>
                        <th width="300">Url</th>
                        <th>Status</th>
                        <th width="100">Action</th>
                      </tr>
                    </thead>
                    <tbody class="row_position">
                      @foreach($pageLinks as $i => $pageLink)
                        <tr id="{{$pageLink->id}}">
                          <td>{{$pageLink->item_no}}</td>
                          <td>{{$pageLink->name}}</td>
                          <td>{{$pageLink->url}}</td>
                          <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input  pull-right" name="status" 
                        id="exampleCheck1"
                        
                          onClick="updateStatus({{$pageLink->id}})"
                          @if($pageLink->status == 1)checked
                          @endif 
                          @if(old('status'))checked
                          @endif
                          />
                          
                        @if($pageLink->status == 0)
                        <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span class="badge badge-success">Active</span></h5>@endif</td>
                    </div>	
                    
                        
                        </td>
                          <td>
                            <a href="javascript:void(0);" 
                            class="btn btn-xs btn-info float-left mr-2 btn-edit-award"
                            data-id="{{ $pageLink->id }}" 
                            data-url="{{ route('admin.pageLink.create', ['id' => $pageLink->id]) }}" 
                            title="Edit Page Link"
                            data-type="editmodal"
                            onclick="popupmenu('{{ route('admin.pageLink.create') }}?type=edit&id={{ $pageLink->id }}', 'editmodal', event); return false;">
                            <i class="fa fa-edit"></i>
                         </a>
                         
                          <!-- <a href="{{route('admin.pageLink.create')}}?type=edit&id={{$pageLink->id}}" class="btn btn-xs btn-info float-left mr-2" title="Edit Page Link"><i class="far fa-edit"></i></a> -->
                          
                            <button class="btn btn-xs btn-danger del-modal float-left" title="Delete pageLink" data-id="{{$pageLink->id}}"
                             data-form="{{route('admin.blockControl.delete')}}" data-title="{{ $pageLink->name}}"  data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
                            </button>                      
                        </td>
                        </tr>
                      @endforeach

                    </tbody>
                  </table>
                  
                </div>
              </div>
           </div>
           
      


 
    </section>
  </div>
  </div>
  
 