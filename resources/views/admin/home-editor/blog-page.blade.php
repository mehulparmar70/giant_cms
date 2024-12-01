
<script>


  $(".page").addClass("menu-is-opening menu-open");
  $(".page a").addClass("active-menu");

</script>


<form id="editblogpage" method="post" enctype="multipart/form-data" class="form-horizontal"
onsubmit="return false;">
  @csrf


    <div class="cmsModal-row">
      <div class="cmsModal-column">
        <div class="cmsModal-formGroup">
        <label class="cmsModal-formLabel" for="meta_description">Page Short Description</label>
        <textarea type="text" class="cmsModal-formControl" name="short_description"
          placeholder="Page Short Description">@if(old('subtitle')){{old('subtitle')}}@else{{$pageData->subtitle}}@endif</textarea>
        <span class="text-danger"></span>
      </div>
    </div>
      <div class="cmsModal-column">
        <div class="cmsModal-formGroup">
        <label class="cmsModal-formLabel"  label for="custom_url">Add Custom URL</label>

        <input type="text" class="cmsModal-formControl" name="page_url" 
          placeholder="Custom Url" value="<?= $url_list['url']?>">
          <input type="hidden" class="cmsModal-formControl" name="page_name" 
          placeholder="Custom Url" value="<?= $url_list['name']?>">
        <span class="text-danger"></span>
      </div>
      </div>
      <div class="cmsModal-column">
        <div class="cmsModal-formGroup">
          <label class="cmsModal-formLabel" for="name">Display Main Menu</label>
          <input type="text" name="name" class="cmsModal-formControl"
          value="{{ old('name', $url_list->name ?? '') }}">
      </div>
      </div>
      </div>
      <div class="cmsModal-row">
        <div class="cmsModal-column">
          <div class="cmsModal-formGroup">
        <textarea id="editor" class="cmsModal-formControl" name="description" placeholder="Blog Description">
                          {{$pageData->description}}</textarea>
        <span class="text-danger">@error('description') {{$message}} @enderror</span>
        <input type="hidden" name="type" value="blog_page">
      </div>
      </div>
      </div>

      
  
    <div class="cmsModal-row">
      <div class="cmsModal-column">
          @include('widget.seo-content')
          <span class="text-danger">@error('about_url') {{$message}} @enderror</span>
          </div>
          <div class="cmsModal-column">
          @include('widget.seo-content-2')
        </div>
      </div>
    
 

  <div class="cmsModal-footer">

    @if(request()->get('onscreenCms') == 'true')
    <button type="button" onclick="updateblogpage()" class="cmsBtn blue" name="close" value="1">
      Save & Close</button>
    @else
    <button type="submit" class="cmsBtn blue">Save
      Data</button>
    @endif

  </div>

</form>
