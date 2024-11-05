@extends('layout.admin-index')
@section('title','ALL INFLATABLES Editor')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')
<script>
$( document ).ready(function() {
  $(".del-modal").click(function(){
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    var data_image = $(this).attr('data-image');
    
    $('.delete-form').attr('action','/admin/top-inflatable/delete/'+ delete_id);
    $('.delete-title').html(data_title);
    $('.delete-data-image').attr('src',data_image);
  });  
});


$(".page").addClass( "menu-is-opening menu-open");
$(".page a").addClass( "active-menu");

</script>
@endsection

@section('content')
@include('adm.widget.table-search-draggable')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ALL INFLATABLES Manage</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">ALL INFLATABLES</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">

        <div class="card card-default">
          <div class="card-body">
            <div class="form-horizontal row">
            
            <div class="col-md-4 card card-theme">
              <div class="card card-theme">
              <div class="card-header">
                <h3 class="card-title">Upload Top Inflatable</h3>
                <div id="example1_wrapper">

                </div>
              </div>
             
              <form method="post" enctype="multipart/form-data"  class="form-horizontal" action="{{route('top.inflatable.store')}}">
                @csrf

                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-8 mt-4 mb-4">
                        <label  class="" for="meta_description">Page Short Description</label>
                        <textarea type="text" class="form-control" name="page_title" 
                          placeholder="Page Short Description">@if(old('page_title')){{old('page_title')}}@else{{$pageData->page_title}}@endif</textarea>
                        <span class="text-danger"></span>
                      </div>
                    <div class="col-sm-12">
                    <input type="hidden" class="form-control">
                      <input type="text" class="form-control" name="title"
                         placeholder="topInflatable Title">
                         
                      <span class="text-danger">@error('title') {{$message}} @enderror</span>
                    </div>
                  </div> 
                  
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="url" class="form-control" name="url"
                         placeholder="View All Url">

                      <span class="text-danger">@error('url') {{$message}} @enderror</span>
                    </div>
                  </div>

                  
                <div class="form-group row">
                    <div class="col-sm-12">
                    <input type="file" class="" 
                      name="image" placeholder="Upload Image"
                         accept="image/png,image/jpeg,image/webp" />
                      </div>
                  </div>

                    
                    <div class="form-group">
                      <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input status-switch" 
                          name="status" value="0" id="customSwitch1">
                        <label class="custom-control-label float-right" for="customSwitch1">Status</label>
                      </div>
                    </div>
                  
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-dark">ALL INFLATABLES</button>
                </div>
              </form>
            </div>

            
            <div class="col-md-8 card card-theme">
              <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">ALL INFLATABLES List</h3>
              </div>
              
            <div class="card">
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($topInflatables as $topInflatable)
                      <tr>
                        <td><img width="100" src="{{url('/')}}/images/{{$topInflatable->image}}"></td>
                        <td>{{$topInflatable->title}}</td>
                        <td>@if($topInflatable->status == 0)<p class="badge badge-danger">Inactive</p>@else<p class="badge badge-success">Active</p>@endif</td>
                        
                        <td>
                        
                          <button class="btn btn-xs btn-danger del-modal float-left"  title="Delete topInflatable"  data-id="{{ $topInflatable->id}}" 
                            data-image="{{url('/')}}/images/{{ $topInflatable->image}}" data-title="{{ $topInflatable->title}}"  data-toggle="modal" data-target="#modal-default"><i class="fa fa-trash"></i>
                          </button>
                          
                      
                      
                      </td>

                      </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                
              </div>
              <!-- /.card-body -->
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
              <h4 class="modal-title">Delete topInflatable</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <label>topInflatable Name</label>
            <h5 class="modal-title delete-title">Delete Category</h5>
            <img  class="col-md-8 modal-title delete-data-image" src="">
            </div>
            <div class="modal-footer justify-content-between d-block ">
              
            <form class="delete-form float-right" action="" method="POST">
                    @method('DELETE')
                    @csrf
              <button type="button" class="btn btn-default mr-4" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger float-right" title="Delete Record"><i class="fa fa-trash"></i> Delete</button>
              

            </form>
            </div>
          </div>
        </div>
      </div>


  @endsection