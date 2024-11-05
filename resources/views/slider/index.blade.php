

@include('widget.table-search-draggable')

<div class="content-wrapper">



  <div class="container-fluid">

    <div class="">
      <div class="card-body">
        <div class="form-horizontal row">

          <div class="col-sm-12">
            <ol class=" float-sm-right">
              <ol class=" float-sm-right"><button
                  onclick="popupmenu(`{{route('slider.create')}}`,'editmodal','','','','')"
                  class="cmsBtn blue"><i class="fa fa-plus" aria-hidden="true"></i>
                  &nbsp;&nbsp;Add New Slider </button>
  
  
              </ol>
          </div>
            
            <div class="col-md-12 ">
           
             
              
       
         
         

            
                  <table  data-table="slider" id="clienttable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                       
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody class="row_position">
                      @foreach($sliders as $key => $slider)
                      <tr id="{{$slider->id}}">
                        <!-- <td>{{$slider->slider_no}}</td> -->
                        <td><img width="100" src="{{url('/')}}/images/{{$slider->image}}"></td>
                        <td>{{$slider->title}}</td>
                        <td>{{$slider->description}}</td>
                        <td>
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="status" value="0" id="exampleCheck1"
                              onClick="updateStatus({{ $slider->id }}, 'slider')" 
                              @if($slider->status == 1) checked @endif 
                            />
                        
                            <!-- Status text -->
                            <span id="statusText{{ $slider->id }}" class="badge @if($slider->status == 0) badge-danger @else badge-success @endif">
                              @if($slider->status == 0) Inactive @else Active @endif
                            </span>
                          </div>
                        </td>
                        
                        <td>
                        <a href="{{route('slider.edit', $slider->id)}}" 
                            class="btn btn-xs btn-info float-left mr-2"  
                            title="Edit slider" 
                            onclick="popupmenu('{{route('slider.edit', $slider->id)}}', 'editmodal', event); return false;">
                            <i class="fa fa-edit"></i>
                          </a>
                        <a href="{{route('slider.delete', $slider->id)}}" 
                            class="btn btn-xs btn-danger float-left mr-2"  
                            title="Delete slider" 
                            onclick="popupmenu('{{route('slider.delete', $slider->id)}}', 'deletemodal', event); return false;">
                            <i class="fa fa-trash"></i>
                          </a>

                        
                      
                      
                      </td>



                </td>

                </tr>
                @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <!-- <th>Id</th> -->
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                </table>

           
        

    




  


    </div>

  </div>