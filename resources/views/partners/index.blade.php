
<style>

.width-150{
    max-width: 150px !important;
    width: 150 !important;
    height: auto !important;
}.width-300{
    max-width: 300px !important;
    width: 300 !important;
    height: auto !important;
}

</style>


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





<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">


      <div class="row">
      
   

        
        <div class="col-sm-12">
          <ol class=" float-sm-right">
          <ol class=" float-sm-right"><button onclick="popupmenu(`{{route('partners.create')}}`,'editmodal','','','','')" class="cmsBtn blue"><i class="fa fa-plus" aria-hidden="true"></i>
                  &nbsp;&nbsp;Add New Partner </button>
        
          </ol>
        </div>
        
    </div>


      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
      
        <div class="row">
          <div class="col-12">
            <div>


              <div class=" table-responsive p-0">
                <table data-table="partners" id="clienttable" class="table table-bordered table-striped" >
                  <thead>
                    <tr>
                      <!-- <th>ID</th> -->
                      <th>Image</th>
                      <th>Title</th>
                      <th width="200">slug</th>
                      <th>Status</th>
                      <th width="140">Action</th>
                    </tr>
                  </thead>
                  
                  <tbody class="row_position">
                    @foreach($blogs as $i => $blog)
                      <tr id="{{$blog->id}}"> 
                        <!-- <td>{{$blog->item_no}}</td> -->

                        @if(isset($blog->image))
                        <td><img class="rounded object-fit"  width="150"
                          src="{{asset('/')}}images/{{$blog->image}}"></td>
                          @else

                        <td><img class="rounded"    width="100"
                          src="{{asset('/')}}img/no-item.jpeg"></td>
                          @endif

                        <td>{{$blog->title}}</td>
                        <td class="width-150">{{$blog->slug}}</td>
                        <td>
                        
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input  pull-right" name="status" 
                        id="exampleCheck1"
                        
                          onClick="updateStatus({{$blog->id}},'partners')"
                          @if($blog->status == 1)checked
                          @endif 
                          @if(old('status'))checked
                          @endif
                          />
                          
                        @if($blog->status == 0)
                        <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span class="badge badge-success">Active</span></h5>@endif
                    </div>	
                    </td>
                        <td width="150">
                        
                        
                         
                          <a target="_blank" href="{{url('partners')}}/{{$blog->slug}}" class="btn btn-sm btn-warning float-left mr-2"  title="View Partners"><i class="fa fa-eye"></i></a>
                          <a href="javascript:void(0);" 
                            class="btn btn-xs btn-info float-left mr-2 btn-edit-client" 
                            data-id="{{ $blog->id }}" 
                            data-url="{{ route('partners.edit', $blog->id) }}" 
                            title="Edit Partners" 
                            data-type="editmodal" 
                            onclick="popupmenu('{{ route('partners.edit', $blog->id) }}', 'editmodal', event); return false;">
                            <i class="fa fa-edit"></i>
                         </a>
                          
             <a href="{{route('partners.delete', $blog->id)}}" 
                            class="btn btn-xs btn-danger float-left mr-2"  
                            title="Delete partners" 
                            onclick="popupmenu('{{route('partners.delete', $blog->id)}}', 'deletemodal', event); return false;">
                            <i class="fa fa-trash"></i>
                          </a>
                      
                      
                      </td>
                      </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <!-- <th>Id</th> -->
                    <th>Image</th>
                      <th>Title</th>
                      <th width="200">slug</th>
                      <th>Status</th>
                      <th width="140">Action</th>
                  </tr>
                </tfoot>
                </table>
                
              </div>
            </div>
          </div>
        </div>


      </div>
    </section>
  </div>
  
 