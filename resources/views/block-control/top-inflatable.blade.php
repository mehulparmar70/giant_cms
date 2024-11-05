@extends('adm.layout.admin-index')
@section('title','ALL INFLATABLES')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')
<script>
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
      data:{position:data, table: 'top_inflatable'},
      success:function(result){
        console.log(result);
      }
  })
}

function updateStatus($id) {
  $.ajax({
      url:"{{route('status.update')}}",
      type:'post',
      data:{id:$id, table: 'top_inflatable'},
      success:function(result){
        // console.log(result);
        location.reload();
      }
  })
}




</script>
@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Top Inflatable List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Inflatable</li>
            
            </ol>
          </div>
        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
      
        <div class="row">

          <div class="col-md-5 card card-dark">
              <div class="card-header">
                      <h3 class="card-title">Add Top Inflatable</h3>
                </div>
                

                <form method="post" enctype="multipart/form-data"  class="form-horizontal" 
                action="{{route('admin.topInflatable.store')}}">

                  @csrf

                  <div class="card-body p-2 pt-4">

                   <div class="form-group row">
                      <div class="col-sm-12">
                        <label for="name">Inflatable Name</label>
                            <select class="form-control" name="category_id" required>
                              <option value="">Select Product</option>
                              @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                            </select>
                            <span class="text-danger">@error('category_id') {{$message}} @enderror</span>
                          </div>

                      </div>
                      

                  <div class="form-check mt-4">
                    <input type="checkbox" class="form-check-input  pull-right" name="status" 
                        id="exampleCheck1"
                      checked
                        />
                        
                      <h5> <span class="badge badge-success">Active</span></h5>
                      </div>


                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-dark"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Save Top Inflatable</button>
                  </div>
                </form>

              </div>
           
           <div class="col-md-7 card card-theme">
              <div class="card-header">
                      <h3 class="card-title">ALL INFLATABLES Lists</h3>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="row_position">
                      @foreach($topInflatables as $i => $topInflatable)
                        <tr id="{{$topInflatable->id}}">
                          <td>{{$topInflatable->item_no}}</td>
                          <td>{{$topInflatable->name}}</td>
                          <td>

                          @if($topInflatable->product_image)
                          <img class="img-circle elevation-2 object-fit-sm" 
                              src="{{asset('web')}}/media/lg/{{$topInflatable->product_image}}"></td>
                          @endif
                          </td>
                          <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input  pull-right" name="status" 
                        id="exampleCheck1"
                        
                          onClick="updateStatus({{$topInflatable->id}})"
                          @if($topInflatable->status == 1)checked
                          @endif 
                          @if(old('status'))checked
                          @endif
                          />
                          
                        @if($topInflatable->status == 0)
                        <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span class="badge badge-success">Active</span></h5>@endif</td>
                    </div>	
                    
                        
                        </td>
                          <td>
                            <button class="btn btn-xs btn-danger del-modal float-left" title="Delete topInflatable" data-id="{{$topInflatable->id}}"
                             data-form="{{route('admin.blockControl.delete')}}" data-title="{{ $topInflatable->name}}"  data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
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
              <h4 class="modal-title">Delete ALL INFLATABLES</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <label>Inflatable Name</label>
            <h5 class="modal-title delete-title">Delete Top Inflatable</h5>
            </div>
            <div class="modal-footer justify-content-between d-block ">
              
            <form class="delete-form float-right" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" class="delete-id" name="id" >
                    <input type="hidden" class="table" name="table" value="top_inflatable" >
                    
              <button type="button" class="btn btn-default mr-4" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger float-right" title="Delete Record"><i class="fas fa-trash-alt"></i> Delete</button>
              

            </form>
            </div>
          </div>
        </div>
      </div>

  @endsection

  