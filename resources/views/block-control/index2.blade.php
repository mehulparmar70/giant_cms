@extends('adm.layout.admin-index')
@section('title','ALL INFLATABLES')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')
<script>
$( document ).ready(function() {
  $(".del-modal").click(function(){
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    
    $('.delete-form').attr('action', delete_id);
    $('.delete-title').html(data_title);
  });  
});
$(".client").addClass( "menu-is-opening menu-open");
$(".client a").addClass( "active-menu");
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
              <li class="breadcrumb-item active">Client</li>
            
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
                

                <form method="post" enctype="multipart/form-data"  class="form-horizontal" action="{{route('client.store')}}">
                  @csrf

                  <div class="card-body p-2 pt-4">

                   <div class="form-group row">
                      <div class="col-sm-12">
                        <label for="name">Inflatable Name</label>
                          <input class="form-control" type="text" name="name" placeholder="Product name">
                          <span class="text-danger">@error('name') {{$message}} @enderror</span>
                          </div>
                      </div>
                      

                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-dark">Save Client</button>
                  </div>
                </form>

              </div>
           
           <div class="col-md-7 card card-theme">
              <div class="card-header">
                      <h3 class="card-title">Clien Lists</h3>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Note</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($clients as $i => $client)
                        <tr>
                          <td>{{++$i}}</td>
                          <td>{{$client->name}}</td>
                          @if($client->image)
                          <td><img class="img-circle elevation-2 object-fit-sm" 
                              src="{{asset('web')}}/media/lg/{{$client->image}}"></td>
                              @else
                              
                          <td><img class="img-circle elevation-2 object-fit-sm" 
                              src="{{asset('adm')}}/img/no-user.jpeg"></td>
                          @endif

                          <td>{{$client->note}}</td>
                          <td>
                          <!-- <a href="{{route('client.edit',$client->id)}}" class="btn btn-xs btn-info float-left mr-2"  title="Edit client"><i class="far fa-edit"></i></a> -->
                            <button class="btn btn-xs btn-danger del-modal float-left"  title="Delete client" 
                             data-id="{{route('admin.index')}}/client/{{ $client->id}}" data-title="{{ $client->name}}"  data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
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
              <h4 class="modal-title">Delete Client</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <label>Client Name</label>
            <h5 class="modal-title delete-title">Delete Category</h5>
            </div>
            <div class="modal-footer justify-content-between d-block ">
              
            <form class="delete-form float-right" action="" method="POST">
                    @method('DELETE')
                    @csrf
              <button type="button" class="btn btn-default mr-4" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger float-right" title="Delete Record"><i class="fas fa-trash-alt"></i> Delete</button>
              

            </form>
            </div>
          </div>
        </div>
      </div>

  @endsection

  