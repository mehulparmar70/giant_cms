


<?php

  if(isset($_GET['type']) && $_GET['type'] == 'main_category'){
    $pageSlug = $_GET['type'];
    $pageType = "Main Category";
  }
  elseif(isset($_GET['type']) && $_GET['type'] == 'sub_category'){
    $pageSlug = $_GET['type'];
    $pageType = "Sub Category";
  }else{
    $pageSlug = 'main_category';
    $pageType = "Main Category";

  }


?>


<div class="content-wrapper">

    <div class="container-fluid">

      <div class="row">

        <div class="col-sm-6">

        <ol class=" float-sm-right">
            <button onclick="popupmenu(`{{route('admin.category.create')}}?type=main_category`,'editmodal','','','','')"
              class="cmsBtn blue"><i class="fa fa-plus" aria-hidden="true"></i>
              &nbsp;&nbsp;Add Main Category </button>
          </ol>

        </div>

        <div class="col-sm-6">

 
          <ol class=" float-sm-right">
            <button onclick="popupmenu(`{{route('admin.category.create')}}?type=sub_category`,'editmodal','','','','')"
              class="cmsBtn blue"><i class="fa fa-plus" aria-hidden="true"></i>
              &nbsp;&nbsp;Add Sub Category </button>
          </ol>
     
        </div>


      </div>
    </div>


  @if($pageSlug == 'main_category' || $pageSlug == null )
 
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <div class="">

            <div class=" p-0">

              <input type="hidden" name="type" value="main_category">

              <table data-table="categories" id="clienttable" class="table table-bordered table-striped">
                <thead>
                  <tr>

                    
                    <th>Image</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="row_position">

                  @foreach($categories as $i => $parent_category)


           
                  <tr id="{{$parent_category->id}}">
                

                    @if(isset($parent_category->image))
                    <td><img class="rounded img-block" width="200"
                        src="{{asset('/')}}images/{{$parent_category->image}}" /></td>
                    @else

                    <td><img class="rounded" width="100" src="{{asset('/')}}img/no-item.jpeg"></td>
                    @endif

                    <td>{{$parent_category->name}}</td>

                    <td>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1"
                          onClick="updateStatus({{$parent_category->id}},'category')" @if($parent_category->status == 1)checked
                        @endif
                        @if(old('status'))checked
                        @endif
                        />

                        @if($parent_category->status == 0)
                        <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span
                            class="badge badge-success">Active</span></h5>@endif
                            </div> 
                          </td>
            
         
            <td width="150">

              <div class="row">

           




                <!-- <a class="btn btn-xs btn-dark" 
                          href="{{route('admin.category.edit',$parent_category->id)}}?type=main_category"><i class="fa fa-edit"></i></a> -->
                <a href="javascript:void(0);" class="btn btn-sm btn-dark float-left mr-2" title="Edit Main Category"
                  onclick="popupmenu('{{url('powerup/category/edit',$parent_category->id)}}', 'editmodal');">
                  <i class="fa fa-edit"></i>
                </a>
                &nbsp;&nbsp;&nbsp;

                <a href="{{route('admin.category.delete', $parent_category->id)}}" 
                            class="btn btn-xs btn-danger float-left mr-2"  
                            title="Delete slider" 
                            onclick="popupmenu('{{route('admin.category.delete', $parent_category->id)}}', 'deletemodal', event); return false;">
                            <i class="fa fa-trash"></i>
                          </a>
             
              </div>
            </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
                  <tr>
                    <!-- <th>Id</th> -->
                    <th>Image</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
            </table>
            <!-- </form> -->

          </div>
        </div>
      </div>
    </div>





@elseif($pageSlug == 'sub_category')

  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="">

          <div class=" p-0">

            <input type="hidden" name="type" value="main_category">

            <table data-table="categories" id="clienttable" class="table table-bordered table-striped">
              <thead>
                <tr>

                  <!-- <th width="50">Order</th> -->
                  <th>Image</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="row_position">

                @foreach($categories as $i => $parent_category)


                <tr id="{{$parent_category->id}}">
                  <!-- <td>{{$parent_category->item_no}}</td> -->

                  @if(isset(getImageFromCategory($parent_category->id)[0]->image))
                  <td><img class="rounded img-block" width="200"
                      src="{{asset('/')}}/images/{{getImageFromCategory($parent_category->id)[0]->image}}" /></td>
                  @else

                  <td><img class="rounded" width="100" src="{{asset('/')}}img/no-item.jpeg"></td>
                  @endif

                  <td>{{$parent_category->name}}</td>

                  <td>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1"
                        onClick="updateStatus({{$parent_category->id}},'category')" @if($parent_category->status == 1)checked
                      @endif
                      @if(old('status'))checked
                      @endif
                      />

                      @if($parent_category->status == 0)
                      <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span
                          class="badge badge-success">Active</span></h5>@endif
                  </td>
          </div>
          </td>
          <td width="150">

            <div class="row">


              <!-- <a class="btn btn-xs btn-dark" 
                        href="{{route('admin.category.edit',$parent_category->id)}}?type=main_category"><i class="fa fa-edit"></i></a> -->
              <a href="javascript:void(0);" class="btn btn-sm btn-dark float-left mr-2" title="Edit Main Category"
                onclick="popupmenu('{{url('powerup/category/edit',$parent_category->id)}}', 'editmodal');">
                <i class="fa fa-edit"></i>
              </a>
              &nbsp;&nbsp;&nbsp;


              <button type="button" class="btn btn-xs btn-danger del-modal" title="Delete Category"
                data-id="{{route('admin.index')}}/category/delete/{{ $parent_category->id}}"
                data-title="{{ $parent_category->name}}" data-toggle="modal" data-target="#modal-default"><i
                  class="fa fa-trash"></i>
              </button>
            </div>
          </td>
          </tr>
          @endforeach
          </tbody>
          <tfoot>
                  <tr>
                    <!-- <th>Id</th> -->
                    <th>Image</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                  </tr>
                </tfoot>
          </table>
          <!-- </form> -->

        </div>
      </div>
    </div>
  </div>




@else


  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header  bg-dark">
            <h3 class="card-title"><i class="fa fa-th-list nav-icon"></i>&nbsp;&nbsp;
              {{$pageType}}


            </h3>

          </div>

          <div class="card-body table-responsive p-0">
            <form action="{{route('item.bulk-delete')}}" method="post">
              @csrf
              <input type="hidden" name="type" value="main_category">
              <table id="example2" class="table table-bordered">
                <thead>
                  <tr>

                    <th width="50">Order</th>
                    <th>
                      <input type="checkbox" class="checkAll" name="status" id="checkAll" />

                    </th>
                    <th>Image</th>
                    <th>Main Category</th>
                    <th>Status</th>
                    <th width="150">Action</th>
                  </tr>
                </thead>

                <tbody class="row_position">

                  @foreach($parent_categories as $i => $parent_category)


                  <tr>
                    <td>
                      <input type="checkbox" class="checkList" name="checkList[]" id="checkList"
                        value="{{$parent_category->id}}" />

                    </td>
                    <td>{{++$i}}</td>
                    @if(isset($parent_category->image))
                    <td><img class="rounded img-block" width="200"
                        src="{{asset('/')}}/images/{{$parent_category->image}}" /></td>
                    @else

                    <td><img class="img-circle elevation-2" height="30" width="30"
                        src="{{asset('/')}}img/no-item.jpeg"></td>
                    @endif

                    <td>{{$parent_category->name}}</td>

                    <td>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1"
                          onClick="updateStatus({{$parent_category->id}},'category')" @if($parent_category->status == 1)checked
                        @endif
                        @if(old('status'))checked
                        @endif
                        />

                        @if($parent_category->status == 0)
                        <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span
                            class="badge badge-success">Active</span></h5>@endif
                    </td>
          </div>
          </td>

          <th width="50">Order</th>

          <th class="">
            <div class="row">



              <a target="_blank" href="{{url('')}}/{{$finalSlug}}{{$product->slug}}"
                class="btn btn-xs btn-warning float-left mr-2">
                <i class="fa fa-eye"></i></a>

              <!-- <a class="btn btn-xs btn-dark"
                           href="{{route('admin.category.edit',$parent_category->id)}}"><i class="fa fa-edit"></i></a> -->
              <a href="javascript:void(0);" class="btn btn-sm btn-dark float-left mr-2" title="Edit Main Category"
                onclick="popupmenu('{{url('category/edit',$parent_category->id)}}', 'editmodal');">
                <i class="fa fa-edit"></i>
              </a>
              &nbsp;&nbsp;&nbsp;


              <button type="button" class="btn btn-xs btn-danger del-modal" title="Delete Category"
                data-id="{{route('admin.index')}}/category/delete/{{ $parent_category->id}}"
                data-title="{{ $parent_category->name}}" data-toggle="modal" data-target="#modal-default"><i
                  class="fa fa-trash"></i>
              </button>
            </div>
          </th>
          </tr>
          @endforeach
          </tbody>

          @if($parent_categories->count() > 0)
          <tfooter>
            <tr>
              <td>

                <input type="checkbox" class="checkAll" name="status" id="checkAll" />
              </td>
              <td colspan="5">

                <button type="submit" name="action" value="active" class="btn btn-primary btn-sm"><i class="fa fa-check"
                    aria-hidden="true"></i>&nbsp;&nbsp;
                  Active</button>

                <button type="submit" name="action" value="deactive" class="btn btn-info btn-sm"><i class="fa fa-times"
                    aria-hidden="true"></i>&nbsp;&nbsp;Deactive</button>

                <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"
                    aria-hidden="true"></i>&nbsp;&nbsp;Delete</button>


              </td>
            </tr>
          </tfooter>
          @endif

          </table>
          </form>

        </div>
      </div>
    </div>
  </div>




@endif


</div>