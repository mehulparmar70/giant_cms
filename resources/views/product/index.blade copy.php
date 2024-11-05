@extends('layout.admin-index')
@section('title','Product List')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')
<!-- DataTables  & Plugins -->
<script src="{{url(/)}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url(/)}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url(/)}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url(/)}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{url(/)}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{url(/)}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{url(/)}}/plugins/jszip/jszip.min.js"></script>
<script src="{{url(/)}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{url(/)}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{url(/)}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{url(/)}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{url(/)}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>

// $('body').hide();

  
$('.category_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();

        $.get( `{{url('api')}}/get/getPetaKacheri/`+parent, { category_parent_id: parent })
        .done(function( data ) {
          // alert(JSON.stringify(data));

        if(JSON.stringify(data.length) == 0){
            $('.sub_category_parent_id').html('<option value="">Select Sub Category</option>');
        }
        else{
                $('.sub_category_parent_id').empty();     
            $('.sub_category_parent_id').html('<option value="">Select Sub Category</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.sub_category_parent_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
    $('.category_id').val(parent);
    $('.search').val(parent);
    $('.search_link').attr('href',`{{route('product.index')}}?search=`+parent);

    });


    $('.sub_category_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();

        $.get( `{{url('api')}}/get/getDepartment/`+parent, { sub_category_parent_id: parent })
        .done(function( data ) {
          // alert(JSON.stringify(data));

        if(JSON.stringify(data.length) == 0){
            $('.subcategory2_id').html('<option>Select Sub Category2</option>');
        }
        else{
                $('.subcategory2_id').empty();     
            $('.subcategory2_id').html('<option value="">Select Sub Category2</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.subcategory2_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
    $('.category_id').val(parent);
    $('.search_link').attr('href',`{{route('product.index')}}?search=`+parent);
    $('.search').val(parent);

    });

$( document ).ready(function() {
  $(".del-modal").click(function(){
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    
    $('.delete-form').attr('action',delete_id);
    $('.delete-title').html(data_title);
  });  
});


$(".listing").addClass( "menu-is-opening menu-open");
$(".listing a").addClass( "active-menu");

function updateStatus($id) {
  $.ajax({
      url:"{{route('status.update')}}",
      type:'post',
      data:{id:$id, table: 'product'},
      success:function(result){
        // console.log(result);

      }
  })
}

  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-12:eq(0)');

  });
  
</script>

@if(isset(getParentCategory($current_cat->id)['category']))
	<?php $finalSlug = getParentCategory($current_cat->id)['category']->slug.'/';
		$mainCategorySlug = $finalSlug;
	?>
	@endif

		@if(isset(getParentCategory($current_cat->id)['subcategory']))
			<?php $finalSlug = $finalSlug.getParentCategory($current_cat->id)['subcategory']->slug.'/' ;
				$subCategorySlug = $finalSlug;
				// dd($subCategorySlug);

			?>
		@endif

		@if(isset(getParentCategory($current_cat->id)['subcategory2']))
			<?php $finalSlug = $finalSlug.getParentCategory($current_cat->id)['subcategory2']->slug.'/';
				$subCategory2Slug = $finalSlug;
				// dd($subCategory2Slug);
			?>
		@endif
    
@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Photos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Photos</li>

              <a href="{{route('product.create')}}" class="btn btn-success btn-sm ml-2"><i class="fa fa-plus" aria-hidden="true"></i>
                &nbsp;&nbsp;Add Sub Category </a>
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
              
            <div class="card card-dark">
                <div class="card-header">
                    
                  <input type="hidden" name="category_id" class="category_id" > 
                    <div class="row">

                  <form method="get" action="?search=" class="col-sm-12">
                    <select 
                    class="form-control form-control-sm  mr-3 col-sm-3 category_parent_id pull-left" required>
                          <option value="">Select Main Category</option>
                            @foreach($parent_categories as $parent_category)
                                <option value="{{$parent_category->id}}"
                                
                                @if(getParentCategory($seach_id)['category']->id == $parent_category->id)
                                  selected
                                @endif
                                >{{$parent_category->name}}</option>
                            @endforeach
                        </select>
                        @if( Request::query('search') )
                          <input type="hidden" name="search" class="search" value="{{Request::query('search')}}" />
                        @else
                          <input type="hidden" name="search" class="search" value="" />

                        @endif
                      <select 
                      class="form-control form-control-sm mr-3 search-font1 col-sm-3 sub_category_parent_id pull-left" required>
                          
                      @if(getParentCategory($seach_id)['subcategory'])
                           <option value="{{getParentCategory($seach_id)['subcategory']->id}}">{{getParentCategory($seach_id)['subcategory']->name}}</option>
                          
                          @else
                           <option value="">Select Sub Category</option>
                           @endif
                        </select>


                        <button type="submit" class="btn btn-sm btn-dark search_link"> 
                          <i class="fa fa-search" aria-hidden="true"></i>  Search</button>
                      </div>
                  </form>

                  
                </div>
                </div>
                
              @if($products->count() > 0)
                <div class="card-body table-responsive p-0 display-data">
                  <form action="{{route('item.bulk-delete')}}" method="post">
                  <input type="hidden" name="type" value="product">
                  @if(isset($request->query))
                    <input type="hidden" class="media_id" value="{{$$request->query('image')}}">
                  @endif

                  <input type="hidden" class="image_type" value="product">


                    <table id="example2" class="table table-bordered table-striped" p-1>
                      <thead>
                        <tr>
                          <th>
                            <input type="checkbox" class="checkAll" name="status" 
                                id="checkAll"
                            />

                          </th>
                          <th>Images</th>
                          <th width="200">Name</th>
                          <th width="200">Description</th>
                          <th  width="">status</th>
                          <th  width="150">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($products as $i => $product)

                          <tr> 
                            <td>
                            <input type="checkbox" class="checkList" name="checkList[]" 
                                id="checkList" value="{{$product->id}}"
                            />    
                            </td>
                            
                            <td>
                            @if(getProductImages($product->id, 1)->count() > 0)
                              @foreach (getProductImages($product->id, 1) as $getProductImage)
                                <img class="rounded"  width="250"
                                  src="{{asset('web')}}/media/sm/{{$getProductImage->image}}">  
                              @endforeach
                              
                              @else
                                <img class="rounded"  width="180"
                                src="{{asset(/)}}/img/no-item.jpeg">
                              @endif
                              </td>

                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            
                            <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input  pull-right" name="status" 
                            id="exampleCheck1"
                            
                              onClick="updateStatus({{$product->id}})"
                              @if($product->status == 1)checked
                              @endif 
                              @if(old('status'))checked
                              @endif
                              />
                              
                            @if($product->status == 0)
                            <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span class="badge badge-success">Active</span></h5>@endif</td>
                        </div>	
                        </td>


                            <td class="btn-block">
                            
                        @if(isset(getParentCategory($product->category_id)['category']))
                          <?php $finalSlug = getParentCategory($product->category_id)['category']->slug.'/';
                            // echo $mainCategorySlug = $finalSlug;
                          ?>
                          @endif

                            @if(isset(getParentCategory($product->category_id)['subcategory']))
                              <?php $finalSlug = $finalSlug.getParentCategory($product->category_id)['subcategory']->slug.'/' ;
                                $subCategorySlug = $finalSlug;
                                // echo($subCategorySlug);

                              ?>
                            @endif

                            @if(isset(getParentCategory($product->category_id)['subcategory2']))
                              <?php $finalSlug = $finalSlug.getParentCategory($product->category_id)['subcategory2']->slug.'/';
                                $subCategory2Slug = $finalSlug;
                                // echo($subCategory2Slug);
                              ?>
                            @endif
                            
                            <a target="_blank" href="{{url('')}}/{{$finalSlug}}{{$product->slug}}" 
                              class="btn btn-xs btn-warning float-left mr-2"  title="View Product Details">

                              <i class="fa fa-eye"></i></a> 

                              <a href="{{route('admin.index')}}/product?image={{$product->id}}" class="btn btn-xs btn-info float-left mr-2"  title="Manage Photos"><i class="fa fa-edit"></i></a>
                              
                              
                              <button type="button" class="btn btn-xs btn-danger del-modal float-left"  title="Delete product"  data-id="{{route('admin.index')}}/product/{{$product->id}}"  
                              data-title="{{ $product->name}}"  data-toggle="modal" data-target="#modal-default"><i class="fa fa-trash"></i>
                              </button>
                          
                          


                          </td>
                          </tr>
                        @endforeach

                      </tbody>
                      <tfooter>
                        <tr>
                        
                        <td>
                            <input type="checkbox" class="checkAll" name="status" 
                                id="checkAll"
                            />

                        <td colspan="7">
                          
                        <button type="submit" name="action" value="active"
                            class="btn btn-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;
                            Active</button>

                          <button type="submit" name="action" value="deactive"
                            class="btn btn-info btn-sm"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Deactive</button>

                            <button type="submit" name="action" value="delete"
                            class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete</button>

                        </td></tr>

                      </tfooter>
                    </table>
                    
                 </form>
                </div>
              @endif

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
              <h4 class="modal-title">Delete product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <label>Product Name</label>
            <h5 class="modal-title delete-title">Delete Product</h5>
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

  