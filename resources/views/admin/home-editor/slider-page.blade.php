<div class="row">

<a href="{{route('slider.index')}}?onscreenCms=true" 
   class="cmsBtn blue mt-2"
   onclick="popupmenu('{{route('slider.index')}}?onscreenCms=true', 'editmodal', event); return false;">
   <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Add New Sliders
</a>
    


<div  >
    <div >
      <div class="card-header">
        <h3 class="card-title">Slider List</h3>
      </div>
      <div >
   
          <table id="example2 " class="table table-bordered table-striped" style="color:white !important">
            <thead>
            <tr>
              <th>Id</th>
              <th>Image</th>
              <th>Title</th>
              <th>Descriptions</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>

            <tbody class="row_position">
              @foreach($slider as $key => $slider)
                <tr id="{{$slider->id}}">
                <td>{{$slider->slider_no}}</td>
                  <td><img width="100" src="{{url('/')}}/images/{{$slider->image}}"></td>
                  <td>{{$slider->title}}</td>
                  <td>{{$slider->description}}</td>
                  <td>
                  
                  
              <div class="form-check">
                  <input type="checkbox" class="form-check-input  pull-right" name="status" 
                  id="exampleCheck1"
                  
                    onClick="updateStatus({{$slider->id}})"
                    @if($sliders->status == 1)checked
                    @endif 
                    @if(old('status'))checked
                    @endif
                    />
                    
                  @if($slider->status == 0)
                  <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span class="badge badge-success">Active</span></h5>@endif</td>
              </div>	
                  
                  </td>
                  
                  <td>
                  
                  <a href="{{route('slider.edit', $slider->id)}}" 
                    class="btn btn-xs btn-info float-left mr-2"  
                    title="Edit slider" 
                    onclick="popupmenu('{{route('slider.edit', $slider->id)}}', 'editmodal', event); return false;">
                    <i class="fa fa-edit"></i>
                  </a>

                  <button class="btn btn-xs btn-danger del-modal float-left" 
                          title="Delete slider" 
                          data-id="{{route('admin.index')}}/slider/{{$slider->id}}" 
                          data-image="{{url('/')}}/images/{{ $slider->image}}" 
                          data-title="{{ $slider->title}}"  
                          data-toggle="modal" 
                          data-target="#modal-default">
                    <i class="fa fa-trash"></i>
                  </button>

                
                
                </td>

                </tr>
              @endforeach

            </tbody>
            <tfoot>
            <tr>
              <th>Id</th>
              <th>Image</th>
              <th>Title</th>
              <th>Descriptions</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>
        
      </div>
    </div>
  </div>


</div>
