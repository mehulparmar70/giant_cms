



<div class="card-body p-2">
    


    <div class="form-group row">
      <div class="col-sm-12">
        <ol class=" float-sm-right">
        <ol class=" float-sm-right"><button  onclick="popupmenu(`{{url('powerup/client/create')}}`,'editmodal','','','','')" class="cmsBtn blue"><i class="fa fa-plus" aria-hidden="true"></i>
                &nbsp;&nbsp;Add New Client </button>
            
        </ol>
      </div>
                <div class="card-body table-responsive p-0">
                  <table data-table="clients" id="clienttable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                 
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Note</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    
                  <tbody class="row_position">
                      @foreach($clients as $i => $client)
                      <tr id="{{$client->id}}"> 
            

                          <td>{{$client->name}}</td>
                          @if($client->image)
                          <td><img class="rounded" style="width:150px"
                              src="{{asset('/')}}images/{{$client->image}}" width="120"></td>
                              @else
                              
                          <td><img class="rounded" style="width:150px"
                              src="{{asset('/')}}/img/no-user.jpeg" width="120"></td>
                          @endif

                          <td>{{$client->note}}</td>
                          <td>
                          
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input  pull-right" name="status" 
                                id="exampleCheck1"
                                
                                  onClick="updateStatus({{$client->id}},'client')"
                                  @if($client->status == 1)checked
                                  @endif 
                                  @if(old('status'))checked
                                  @endif
                                  />
                                  
                                @if($client->status == 0)
                                <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span class="badge badge-success">Active</span></h5>@endif
                            </div>	
                            
                          </td>
                          <td>
                            <a href="javascript:void(0);" 
                            class="btn btn-xs btn-info float-left mr-2 btn-edit-client" 
                            data-id="{{ $client->id }}" 
                            data-url="{{ route('client.edit', $client->id) }}" 
                            title="Edit client" 
                            data-type="editmodal" 
                            onclick="popupmenu('{{ route('client.edit', $client->id) }}', 'editmodal', event); return false;">
                            <i class="fa fa-edit"></i>
                         </a>
                         
                         <a href="{{route('client.delete', $client->id)}}" 
                            class="btn btn-xs btn-danger float-left mr-2"  
                            title="Delete client" 
                            onclick="popupmenu('{{route('client.delete', $client->id)}}', 'deletemodal', event); return false;">
                            <i class="fa fa-trash"></i>
                          </a>                  
                        </td>
                        </tr>
                      @endforeach

                    </tbody>
                    <tfoot>
                  <tr>
                    <!-- <th>Id</th> -->
                    <th>Name</th>
                        <th>Logo</th>
                        <th>Note</th>
                        <th>Status</th>
                        <th>Action</th>
                  </tr>
                </tfoot>
                  </table>
                  
                </div>
          
           
           
      
 
  
  


    </div>
    </div>

  