
<script>


  $(".page").addClass("menu-is-opening menu-open");
  $(".page a").addClass("active-menu");

</script>


<form id="editblogpage" method="post" enctype="multipart/form-data" class="form-horizontal"
onsubmit="return false;">
  @csrf
  <div class="cmsModal-formGroup">
  <div class=" p-2">

    <div class="form-group row">
      <div class="col-sm-4 mt-4 mb-4">
        <label class="cmsModal-formLabel" for="meta_description">Page Short Description</label>
        <textarea type="text" class="cmsModal-formControl" name="short_description"
          placeholder="Page Short Description">@if(old('subtitle')){{old('subtitle')}}@else{{$pageData->subtitle}}@endif</textarea>
        <span class="text-danger"></span>
      </div>
      <div class="col-sm-4 mt-4 mb-4">
        <label class="cmsModal-formLabel"  label for="custom_url">Add Custom URL</label>

        <input type="text" class="cmsModal-formControl" name="page_url" 
          placeholder="Custom Url" value="<?= $url_list['url']?>">
          <input type="hidden" class="cmsModal-formControl" name="page_name" 
          placeholder="Custom Url" value="<?= $url_list['name']?>">
        <span class="text-danger"></span>
      </div>
      <div class="col-sm-4 mt-4 mb-4">
        <div class="cmsModal-formGroup">
          <label class="cmsModal-formLabel" for="name">Display Main Menu</label>
          <input type="text" name="name" class="cmsModal-formControl"
          value="{{ old('name', $url_list->name ?? '') }}">
      </div>
      </div>
      <div class="col-sm-12">
        <textarea id="editor" name="description" placeholder="Blog Description">
                          {{$pageData->description}}</textarea>
        <span class="text-danger">@error('description') {{$message}} @enderror</span>
      </div>

      <input type="hidden" name="type" value="blog_page">
    </div>
    <div class="form-group">
      <div class="col-sm-12 row">
        <div class="col-sm-6">
          @include('widget.seo-content')
          <span class="text-danger">@error('about_url') {{$message}} @enderror</span>
        </div>
        <div class="col-sm-6">
          @include('widget.seo-content-2')
        </div>
      </div>
    </div>
  </div>

  <div class="card-footer text-center">

    @if(request()->get('onscreenCms') == 'true')
    <button type="button" onclick="updateblogpage()" class="cmsBtn blue" name="close" value="1"><i class="fa fa-floppy-o" aria-hidden="true"></i>
      Save & Close</button>
    @else
    <button type="submit" class="cmsBtn blue"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Save
      Data</button>
    @endif

  </div>
  </div>
</form>
