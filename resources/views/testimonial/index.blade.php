
<style>

.youtube_embed1 > iframe{
    max-width: 200px !important;
    width: 178px !important;
    height: auto !important;
}
</style>

<!-- DataTables  & Plugins -->
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
          <ol class=" float-sm-right"><button onclick="popupmenu(`{{url('powerup/testimonials/create')}}`,'editmodal','','','','')" class="cmsBtn blue"><i class="fa fa-plus" aria-hidden="true"></i>
                  &nbsp;&nbsp;Add New Testimonial </button>

              
          </ol>
        </div>
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Testimonial List</h1>
          </div>
        </div>
    </div>


      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
      
        <div class="row">
          <div class="col-12">
            <div class="">
              
              <div class=" p-0">                
                <table data-table="testimonials" id="clienttable" class="table table-bordered table-striped" >
                  <thead>
                    <tr>
                     
                      <th>Image</th>
                      <th>Client Name</th>
                      <th style="min-width: 50% !important;">Short Description</th>
                      <th>Youtube Embed</th>
                      <th>Status</th>
                      <th width="100">Action</th>
                    </tr>
                  </thead>

                  <tbody class="row_position">
                    @foreach($testimonials as $i => $testimonial)
                      <tr id="{{$testimonial->id}}"> 
                        
                        

                        @if(isset($testimonial->image))
                          <td><img class="rounded"  width="150"
                            src="{{asset('/')}}images/{{$testimonial->image}}"></td>
                        @else

                          <td><img class="rounded"  width="150"
                          src="{{asset('')}}img/no-item.jpeg"></td>
                        @endif

                        <td>{{$testimonial->client_name}}</td>
                        <td>{{$testimonial->short_description}}</td>
                        <td class="youtube_embed1">{!! html_entity_decode($testimonial->youtube_embed) !!}</td>
                        
							
                        <td>
                         
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input  pull-right" name="status" 
                        id="exampleCheck1"
                        
                          onClick="updateStatus({{$testimonial->id}},'testimonial')"
                          @if($testimonial->status == 1)checked
                          @endif 
                          @if(old('status'))checked
                          @endif
                          />
                          
                        @if($testimonial->status == 0)
                        <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span class="badge badge-success">Active</span></h5>@endif</td>
                    </div>	
                        </td>
                        <td width="150">
                        <a href="javascript:void(0);" 
                            class="btn btn-xs btn-info float-left mr-2 btn-edit-client" 
                            data-id="{{ $testimonial->id }}" 
                            data-url="{{ route('testimonials.edit', $testimonial->id) }}" 
                            title="Edit Testimonial" 
                            data-type="editmodal" 
                            onclick="popupmenu('{{ route('testimonials.edit', $testimonial->id) }}', 'editmodal', event); return false;">
                            <i class="fa fa-edit"></i>
                         </a>
                          
                          
             <a href="{{route('testimonials.delete', $testimonial->id)}}" 
                            class="btn btn-xs btn-danger float-left mr-2"  
                            title="Delete testimonials" 
                            onclick="popupmenu('{{route('testimonials.delete', $testimonial->id)}}', 'deletemodal', event); return false;">
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
                      <th>Client Name</th>
                      <th style="min-width: 50% !important;">Short Description</th>
                      <th>Youtube Embed</th>
                      <th>Status</th>
                      <th width="100">Action</th>
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
  
 