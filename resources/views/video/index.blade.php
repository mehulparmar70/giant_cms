<style>
  .youtube_embed1>iframe {
    max-width: 200px !important;
    width: 200px !important;
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
            <ol class=" float-sm-right"><button
                onclick="popupmenu(`{{route('video.create')}}?type=main_category`,'editmodal','','','','')"
                class="cmsBtn blue"><i class="fa fa-plus" aria-hidden="true"></i>
                &nbsp;&nbsp;Add New Video </button>


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

            <div class=" table-responsive p-0">
              <table data-table="video" id="clienttable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <!-- <th>ID</th> -->
                    <th>Youtube Video</th>
                    <th width="250">Title</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th width="140">Action</th>
                  </tr>
                </thead>
                <tbody class="row_position">
                  @foreach($videos as $i => $video)
                  <tr id="{{$video->id}}">
           


                    <td class="youtube_embed1">{!! html_entity_decode($video->youtube_embed) !!}</td>
                    <td>{{$video->title}}</td>
                    <td class="width-150">{{$video->video_date}}</td>


                    <td>


                      <div class="form-check">
                        <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1"
                          onClick="updateStatus({{$video->id}},'video')" @if($video->status == 1)checked
                        @endif
                        @if(old('status'))checked
                        @endif
                        />

                        @if($video->status == 0)
                        <h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>@else<h5> <span
                            class="badge badge-success">Active</span></h5>@endif
                      </div>
                    </td>
          
           

            <td>
              <a href="javascript:void(0);" class="btn btn-xs btn-info float-left mr-2 btn-edit-award"
                data-id="{{ $video->id }}" data-url="{{ route('video.edit', $video->id) }}" title="Edit Video"
                data-type="editmodal"
                onclick="popupmenu('{{ route('video.edit', $video->id) }}', 'editmodal', event); return false;">
                <i class="fa fa-edit"></i>
              </a>


              <button class="btn btn-sm btn-danger del-modal float-left" title="Delete Video"
                data-id="{{route('admin.index')}}/video/{{ $video->id}}" data-title="{{ $video->title}}"
                data-toggle="modal" data-target="#modal-default"><i class="fa fa-trash"></i>
              </button>


            </td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
                  <tr>
                    <!-- <th>Id</th> -->
                    <th>Youtube Video</th>
                    <th width="250">Title</th>
                    <th>Date</th>
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