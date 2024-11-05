<div class="row ">
      


      <form id="addaward"  method="post" enctype="multipart/form-data" class="form-horizontal"
      onsubmit="return false;">
      <div class="cmsModal-formGroup">
        @csrf
        <input type="hidden" id="page_type" value="singleUpload">
        <div class=" p-2 pt-4">
          <div class="form-group row">
            <div class="col-sm-12">
              <div class="cmsModal-formGroup">
                <label for="name" class="cmsModal-formLabel">Award Name</label>
                <input class="cmsModal-formControl" type="text" name="name" placeholder="Award name">
                <span class="text-danger">@error('name') {{$message}} @enderror</span>
              </div>
             
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <div class="cmsModal-formGroup">
              <label for="note" class="cmsModal-formLabel">Award Note</label>
              <textarea class="cmsModal-formControl" type="text" name="note" placeholder="Alt Text / Award Note"></textarea>
              <span class="text-danger">@error('note') {{$message}} @enderror</span>
            </div>
          </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <div class="cmsModal-formGroup">
              <label for="image_alt" class="cmsModal-formLabel">Logo</label><br>
              <input type="file" name="image" class="file_input" id="image" required
                accept="image/png,image/jpeg,image/webp">
              <br>
              <p class="text-danger">Supportable Format: <br> JPG,JPEG,PNG,WEBP</p><br>
              <img class="perview-img favicon" height="120" src="{{asset('/')}}img/no-item.jpeg">
              <span class="text-danger">@error('image') {{$message}} @enderror</span>
            </div>
            </div>



            <div class="form-check mt-4">
              <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1" checked />

              <h5> <span class="badge badge-success">Active</span></h5>
            </div>


          </div>
        </div>
        <div class="card-footer text-right">
          @if(request()->get('onscreenCms') == 'true')
          <button type="submit" class="cmsBtn blue" name="close" value="1"><i class="fa fa-floppy-o"
              aria-hidden="true"></i>
            Save Award & Close</button>
          @else
          <button type="button" onclick="addawardsubmit()" class="cmsBtn blue"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Save
            Award</button>
          @endif
        </div>
      </form>

    </div>
    </div>