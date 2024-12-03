<form id="ajaxForm" method="post" enctype="multipart/form-data" class="form-horizontal" action="{{route('admin.page-editor.store')}}">

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
        <label for="description">Contact Description</label>
        <textarea id="editor" name="description" class="cmsModal-formControl" placeholder="Product Descriptions">
                          {{$pageData->description}}</textarea>
        <span class="text-danger">@error('description') {{$message}} @enderror</span>
        <input type="hidden" name="type" value="contact_page">
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
    <button type="submit" class="cmsBtn blue" name="close" value="1">
      Save & Close</button>
    @else
    <button type="submit" class="cmsBtn blue">Save
      Data</button>
    @endif


  </div>

</form>