

<div class="card-body p-2">



  <div class="form-group row">




  <div class="col-sm-12">
        <ol class=" float-sm-right">
        <ol class=" float-sm-right"><button  onclick="popupmenu(`{{url('powerup/award/createaward')}}`,'editmodal','','','','')" class="cmsBtn blue"><i class="fa fa-plus" aria-hidden="true"></i>
                &nbsp;&nbsp;Add New Award </button>
            
        </ol>
      </div>

    <div class="col-md-12">
 
      <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-striped" id="clienttable" data-table="awards">
          <thead>
            <tr>
              <!-- <th>ID</th> -->
              <th>Name</th>
              <th>Logo</th>
              <th>Note</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody class="row_position">
            @foreach($awards as $i => $client)
            <tr id="{{$client->id}}">
              <!-- <td>{{$client->item_no}}</td> -->

              <td>{{$client->name}}</td>
              @if($client->image)
              <td><img class="rounded" style="width:150px" src="{{asset('/')}}images/{{$client->image}}" width="120">
              </td>
              @else

              <td><img class="rounded" style="width:150px" src="{{asset('/')}}/img/no-user.jpeg" width="120"></td>
              @endif

              <td>{{$client->note}}</td>
              <td>

                <div class="form-check">
                  <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1"
                    onClick="updateStatus({{$client->id}},'award')" @if($client->status == 1)checked
                  @endif
                  @if(old('status'))checked
                  @endif
                  />

                  @if($client->status == 0)
                  <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span
                      class="badge badge-success">Active</span></h5>@endif
              </td>
      </div>

      </td>
      <td>
        @if(request()->get('onscreenCms') == 'true')

        <a href="javascript:void(0);" class="btn btn-xs btn-info float-left mr-2 btn-edit-award"
          data-id="{{ $client->id }}" data-url="{{ route('award.edit', $client->id) }}" title="Edit Award"
          data-type="editmodal"
          onclick="popupmenu('{{ route('award.edit', $client->id) }}', 'editmodal', event); return false;">
          <i class="fa fa-edit"></i>
        </a>

        @else
        <a href="{{route('award.edit',$client->id)}}" class="btn btn-xs btn-info float-left mr-2" title="Edit award"><i
            class="fa fa-edit"></i></a>
        @endif

        <a href="{{route('award.delete', $client->id)}}" 
                            class="btn btn-xs btn-danger float-left mr-2"  
                            title="Delete slider" 
                            onclick="popupmenu('{{route('award.delete', $client->id)}}', 'deletemodal', event); return false;">
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





</div>
</div>