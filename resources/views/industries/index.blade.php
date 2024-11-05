
<style>

.youtube_embed1 > iframe{
    max-width: 200px !important;
    width: 178px !important;
    height: auto !important;
}
</style>





<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">

      
    <div class="row">
      
 

        
        <div class="col-sm-12">
          <ol class=" float-sm-right">
          <ol class=" float-sm-right"><button  onclick="popupmenu(`{{url('powerup/industries-create')}}`,'editmodal','','','','')" class="cmsBtn blue"><i class="fa fa-plus" aria-hidden="true"></i>
                  &nbsp;&nbsp;Add New Industries </button>
              
          </ol>
        </div>
       
    </div>


      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
      
        <div class="row">
          <div class="col-12">
            <div class="">
              
              <div class="  p-0">                
                <table data-table="industries"  id="clienttable" class="table table-bordered table-striped" >
                  <thead>
                    <tr>
                      <!-- <th>ID</th> -->
                      <th>Image</th>
                      <th>Title</th>
                      <th style="min-width: 50% !important;">Short Description</th>
                      <th>Status</th>
                      <th width="100">Action</th>
                    </tr>
                  </thead>

                  <tbody class="row_position">
                    @foreach($testimonials as $i => $testimonial)
                      <tr id="{{$testimonial->id}}"> 
                        <!-- <td>{{$testimonial->item_no}}</td> -->
                        

                        @if(isset($testimonial->image))
                          <td><img class="rounded"  width="150"
                            src="{{asset('/')}}images/{{$testimonial->image}}"></td>
                        @else

                          <td><img class="rounded"  width="150"
                          src="{{asset('/')}}img/no-item.jpeg"></td>
                        @endif

                        <td>{{$testimonial->title}}</td>
                        <td >{{$testimonial->short_description}}</td>
                        
							
                        <td>
                         
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input  pull-right" name="status" 
                        id="exampleCheck1"
                        
                          onClick="updateStatus({{$testimonial->id}},'industries')"
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
                        
                        <a href="javascript:void(0);" class="btn btn-sm btn-dark float-left mr-2" title="Edit Industries" 
                            onclick="popupmenu('{{url('powerup/industries-edit',$testimonial->id)}}', 'editmodal');">
                            <i class="fa fa-edit"></i>
                          </a>

                          <a href="{{route('industries.delete', $testimonial->id)}}" 
                            class="btn btn-xs btn-danger float-left mr-2"  
                            title="Delete slider" 
                            onclick="popupmenu('{{route('industries.delete', $testimonial->id)}}', 'deletemodal', event); return false;">
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
                      <th style="min-width: 50% !important;">Short Description</th>
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
  
  