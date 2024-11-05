@extends('adm.layout.admin-index')
@section('title','Category Links')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')

<script src="{{url('adm')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('adm')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('adm')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('adm')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{url('adm')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{url('adm')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{url('adm')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{url('adm')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{url('adm')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{url('adm')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{url('adm')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{url('adm')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

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
  });  
});


$( ".row_position" ).sortable({
      stop: function() {
			var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            console.log(selectedData);
            updateOrder(selectedData);

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
      }
  })
}


$(".footer-url").addClass( "menu-is-opening menu-open");
$(".footer-url a").addClass( "active-menu");


</script>
@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">


    <div class="row">
      
      <div class="col-sm-6">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Category Link List</li>
            </ol>
          </div>

        
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <a class="btn btn-dark btn-sm ml-1" onclick="goBack()"> ❮ Back</a>
              
          </ol>
        </div>
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Category Link List</h1>
          </div>
        </div>
    </div>

      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
      
        <div class="row">

          <div class="col-md-5 card card-theme">
              <div class="card-header">
                      <h3 class="card-title">Add Category Link</h3>
                </div>
                

                <form method="post" enctype="multipart/form-data"  class="form-horizontal" 
                action="{{route('admin.pageLink.store')}}">

                  @csrf

                  <div class="card-body p-2 pt-4">
                  <label for="name">Display Name</label>
                  <input type="text" name="name" class="form-control" required>

                  <input type="hidden" name="type" value="category_link">
                  <input type="hidden" name="table" value="table" value="{{$table}}">

                    <select class="form-control" name="item_no">
                        
                    </select>

                  <div class="form-check mt-4">
                    <input type="checkbox" class="form-check-input  pull-right" name="status" 
                        id="exampleCheck1"
                      checked
                        />
                        
                      <h5> <span class="badge badge-success">Active</span></h5>
                      </div>

                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-dark">Save Category Link</button>
                  </div>
                </form>

              </div>
           
           <div class="col-md-7 card card-theme">
              <div class="card-header">
                      <h3 class="card-title">Category Links Lists</h3>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th width="30%">Name</th>
                        <th width="40%">Url</th>
                        <th>Status</th>
                        <th>Action</th>
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
                          <a href="{{route('admin.pageLink.create')}}?type=edit&id={{$pageLink->id}}" class="btn btn-xs btn-info float-left mr-2" title="Edit Category Link"><i class="far fa-edit"></i></a>
                          
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
           
        </div>


      </div>
    </section>
  </div>
  
  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Category Links</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <label>Item Name</label>
            <h5 class="modal-title delete-title">Delete Category Link</h5>
            </div>
            <div class="modal-footer justify-content-between d-block ">
              
            <form class="delete-form float-right" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" class="delete-id" name="id" >
                    <input type="hidden" class="table" name="table" value="url_list" >
                    
              <button type="button" class="btn btn-default mr-4" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger float-right" title="Delete Record"><i class="fas fa-trash-alt"></i> Delete</button>
              

            </form>
            </div>
          </div>
        </div>
      </div>

  @endsection

  