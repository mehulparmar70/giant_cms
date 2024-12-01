<script>
  $(document).ready(function () {
    $(".del-modal").click(function () {
      var delete_id = $(this).attr('data-id');
      var data_title = $(this).attr('data-title');
      var data_url = $(this).attr('data-url');

      $('.delete-form').attr('action', '/admin/url-list1/delete/' + delete_id);
      $('.delete-title').html(data_title);
      $('.delete-url').attr('src', data_url);
    });
  });


  $(".page").addClass("menu-is-opening menu-open");
  $(".page a").addClass("active-menu");

</script>





<form id="ajaxForm" method="post" enctype="multipart/form-data" class="form-horizontal"
  action="{{route('admin.page-editor.store')}}">
  @csrf

  <input type="hidden" name="type" value="home_page">
  
    <div class="cmsModal-row">

      <div class="cmsModal-column">
        <div class="cmsModal-formGroup">
          <label class="cmsModal-formLabel" for="meta_description">Page Short Description</label>
          <textarea type="text" class="cmsModal-formControl" name="short_description"
            placeholder="Page Short Description">@if(old('subtitle')){{old('subtitle')}}@else{{$homeAbout->subtitle}}@endif</textarea>
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

    
    </div>
    <div class="cmsModal-row">

      <div class="cmsModal-column">
        <div class="cmsModal-formGroup">
          <label class="text-dark" for="search_index">Home Page Description</label>
      <textarea id="editor" name="description" placeholder="Product Descriptions">
                        {{$homeAbout->description}}</textarea>
        </div>
      </div>

      
    </div>

    

    <div class="cmsModal-row">
      
      <div class="cmsModal-column">
        @include('widget.seo-content')
 
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
