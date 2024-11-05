@extends('adm.layout.admin-index')
@section('title','Social Media Manage')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')
<script>
$( document ).ready(function() {
  $(".del-modal").click(function(){
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    var data_url = $(this).attr('data-url');
    
    $('.delete-form').attr('action','/admin/url-list1/delete/'+ delete_id);
    $('.delete-title').html(data_title);
    $('.delete-url').attr('src',data_url);
  });  
});


$(".setting").addClass( "menu-is-opening menu-open");
$(".setting a").addClass( "active-menu");

</script>
@endsection

@section('content')
@include('adm.widget.table-search-draggable')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">

    <div class="row">
          <div class="col-sm-6">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Settings / Email Id Blocker</li>
            </ol>
          </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <a class="btn btn-dark btn-sm ml-1" onclick="goBack()"> ❮ Back</a>
          </ol>
        </div>
        <div class="col-sm-6">
            <h3 class="mb-0">Settings / Email Id Blocker</h3>
          </div>
    </div>
    

    </section>

    <div class="card-body">
                	<div class="row">
                    <div class="col-md-10">
                    <form role="form" action="{{ route('email-filter.store') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                    <h5 class="text-danger text-center">Block Email Id</h5>
                      <table class="table">
                        <tr>
                          <td class="col-3"><label for="email">Email List</label></td>
                          <td><textarea type="text" rows="10" class="form-control" id="email"  name="email" 
                          placeholder="Multiple Emails Seprated by , ">@if(old('email')){{old('email')}}@else{{$emailFilter->email}}@endif</textarea></td>
                        </tr>
                        
                        <tr>
                          <td></td>
                          <td><input type="submit" class="btn btn-success float-right" id="btn-social-media"  name="btn-social-media" 
                          value="Update Email List"></td>
                        </tr>

                      </table>
                      </form>
                  </div>
                </div>
                </div>
                </div>


@endsection