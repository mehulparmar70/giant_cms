@extends('adm.layout.admin-index')
@section('title','List:- Category')
@section('content')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')



<script>

$( document ).ready(function() {
  $(".del-modal").click(function(){
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    
    // $('.delete-form').attr('action','/admin/category/'+ delete_id);
    $('.del-link').attr('href',delete_id);
    
    $('.delete-title').html(data_title);
  });  
});

function updateStatus($id) {
  $.ajax({
      url:"{{route('status.update')}}",
      type:'post',
      data:{id:$id, table: 'category'},
      success:function(result){
        console.log(result);

      }
  })
}
$(".category").addClass( "menu-is-opening menu-open");
$(".category a").addClass( "active-menu");

</script>
@endsection
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h3>List :- Categories</h3>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    
    <section class="content">
      <div class="container-fluid">
      
        <div class="row">
          <div class="col-12">
            <div class="card">
              
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th class="bg-gray">ID</th>
                      <th class="bg-info">Category</th>
                      <th class="bg-danger">Sub Category</th>
                      <th class="bg-warning">Sub Category 2</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($parent_categories as $i => $parent_category)                  
                    <tr>
                      <td>{{++$i}}</td>
                      <td>
                      {{$parent_category->name}}
                      <a  class="badge badge-info" href="{{route('admin.category.edit',$parent_category->id)}}"><i class="fa fa-edit"></i></a>
                      
                      &nbsp;&nbsp;&nbsp;
                              <button class="btn btn-xs btn-danger del-modal"  title="Delete Category"  data-id="{{route('admin.index')}}/category/delete/{{ $parent_category->id}}" data-title="{{ $parent_category->name}}"  data-toggle="modal" data-target="#modal-default"><i class="fa fa-trash"></i>
                              </button>

                              
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input  pull-right" name="status" 
                          value="0" id="exampleCheck1"
                          
                            onClick="updateStatus({{$parent_category->id}})"
                            @if($parent_category->status == 1)checked
                            @endif 
                            @if(old('status'))checked
                            @endif
                            />
                          @if($parent_category->status == 0)<p class="badge badge-danger">Inactive</p>@else<p class="badge badge-success">Active</p>@endif</td>
                      </div>	
                        
                      
                      </td>
                      
                      <td>
                      
                        @if($parent_category->subCategories1($parent_category->id)->count() > 0)
                        <table class="table-border-none">
                          @foreach($parent_category->subCategories1($parent_category->id) as $subCategory1)
                          <tr>
                            <td>
                            {{$subCategory1->name}}
                            <a  class="badge badge-info"  href="{{route('admin.category.edit',$subCategory1->id)}}"><i class="fa fa-edit"></i></a>

                            &nbsp;&nbsp;&nbsp;
                              <button class="btn btn-xs btn-danger del-modal"  title="Delete Category"  data-id="{{route('admin.index')}}/category/delete/{{ $subCategory1->id}}" data-title="{{ $subCategory1->name}}"  data-toggle="modal" data-target="#modal-default"><i class="fa fa-trash"></i>
                              </button>
                      
                              <div class="form-check">
                                  <input type="checkbox" class="form-check-input  pull-right" name="status" 
                                  value="0" id="exampleCheck1"
                                  
                                    onClick="updateStatus({{$subCategory1->id}})"
                                    @if($subCategory1->status == 1)checked
                                    @endif 
                                    @if(old('status'))checked
                                    @endif
                                    />
                                  @if($subCategory1->status == 0)<p class="badge badge-danger">Inactive</p>@else<p class="badge badge-success">Active</p>@endif</td>
                                </div>	
                                
                                 @if($parent_category->subCategories2($subCategory1->id)->count() > 0)
                                  @foreach($parent_category->subCategories2($subCategory1->id) as $subCategory2)
                                  
                                  <tr>
                                      <td></td>
                                  </tr>        
                                  @endforeach
                              @endif        
                            </td>
                          </tr>
                          @endforeach
                          </table>
                        @endif
                        </td>
                      <td>
                        @if($parent_category->subCategories1($parent_category->id)->count() > 0)
                              <table>
                          @foreach($parent_category->subCategories1($parent_category->id) as $subCategory1)
                            @if($parent_category->subCategories2($subCategory1->id)->count() > 0)
                              @foreach($parent_category->subCategories2($subCategory1->id) as $subCategory2)
                              
                              <tr>
                                <td>
                                {{$subCategory2->name}}
                                  <a class="badge badge-info" href="{{route('admin.category.edit',$subCategory2->id)}}"><i class="fa fa-edit"></i></a>
                              
                      &nbsp;&nbsp;&nbsp;
                              <button class="btn btn-xs btn-danger del-modal"  title="Delete Category"  data-id="{{route('admin.index')}}/category/delete/{{ $subCategory2->id}}" data-title="{{ $subCategory2->name}}"  data-toggle="modal" data-target="#modal-default"><i class="fa fa-trash"></i>
                              </button>

                              
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input  pull-right" name="status" 
                                value="0" id="exampleCheck1"
                                
                                  onClick="updateStatus({{$subCategory2->id}})"
                                  @if($subCategory2->status == 1)checked
                                  @endif 
                                  @if(old('status'))checked
                                  @endif
                                  />
                                @if($subCategory2->status == 0)<p class="badge badge-danger">Inactive</p>@else<p class="badge badge-success">Active</p>@endif</td>
                            </div>	


                              
                              </td>
 
                              </tr>        
                              @endforeach
                              @endif                   
                            @endforeach
                              </table>
                        @endif

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
              <h4 class="modal-title">Delete Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <label>Category Name</label>
            <h5 class="modal-title delete-title">Delete Category</h5>
            </div>
            <div class="modal-footer justify-content-between d-block ">
              
            <form class="delete-form float-right" action="" method="POST">
                    @method('DELETE')
                    @csrf
              <button type="button" class="btn btn-default mr-4" data-dismiss="modal">Close</button>
              <a  href="" class="btn btn-danger float-right del-link" title="Delete Record"><i class="fa fa-trash"></i> Delete</a>
              

            </form>
            </div>
          </div>
        </div>
      </div>
  @endsection