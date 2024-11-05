<div class="row">
<form id="ajaxForm" method="post" enctype="multipart/form-data" class="form-horizontal" action="{{ route('admin.page-editor.store') }}">
    @csrf

  
        <!-- Main Category and Custom URL Section -->
        <div class="cmsModal-row">
            <!-- <div class="col-md-4">
                <label for="main_category">Add Main Category</label>
                <input type="text" class="cmsModal-formControl" name="main_category" placeholder="Add Main Category">
            </div> -->
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
        
        <div class="cmsModal-column">
            <div class="cmsModal-formGroup">
            <label class="cmsModal-formLabel" for="short_description">Short Description</label>
            <input type="hidden" class="cmsModal-formControl" name="type" value="about_page">
            <input type="text" class="cmsModal-formControl" name="short_description" placeholder="Short Description" value="{{ $pageData->subtitle }}">
        </div>
        </div>
        </div>
        <!-- Description Section -->
        <div class="cmsModal-row">
            <div class="cmsModal-column">
                <div class="cmsModal-formGroup">
            <label class="cmsModal-formLabel" for="description">Add Description</label>
            <textarea id="editor" name="description" placeholder="About Descriptions" >{{ $pageData->description }}</textarea>
            <span class="text-danger">@error('description') {{ $message }} @enderror</span>
        </div>
        </div>
        </div>

        <!-- Feature Image Upload Section -->
        <div class="cmsModal-row">
            <div class="cmsModal-column">
            @include('widget.seo-content')
            <span class="text-danger">@error('about_url') {{$message}} @enderror</span>
          </div>
          <div class="cmsModal-column">
            @include('widget.seo-content-2')
          </div>
        </div>

        <!-- Form Footer Buttons -->
        <div class="card-footer text-center">
            <button type="submit" class="cmsBtn blue"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save & Close</button>
            <button  class="cmsBtn blue" name="closemodal"><i class="fa fa-close" aria-hidden="true"></i> Close</button>
        </div>
   
</form>


</div>