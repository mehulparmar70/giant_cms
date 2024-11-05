  <form id="ajaxForm" method="post" enctype="multipart/form-data" class="form-horizontal" action="{{ route('admin.page-editor.store') }}">
    @csrf
    <div class="cmsModal-formGroup">
    <div class="card-body p-2">
        <div class="form-group row">
            <div class="col-md-6">
                <label class="cmsModal-formLabel" for="short_description">Page Short Description</label>
                <input type="hidden" class="cmsModal-formControl" name="type" value="industrie_page">
                <input type="text" class="cmsModal-formControl" name="short_description" placeholder="Short Description">
            </div>
        </div>

        <div class="form-group">
            <label class="cmsModal-formLabel" for="description">Add Description</label>
            <textarea id="editor" name="description" placeholder="Industries Descriptions" class="ckeditor cmsModal-formControl">{{ $pageData->description }}</textarea>
            <span class="text-danger">@error('description') {{ $message }} @enderror</span>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label class="cmsModal-formLabel" for="feature_image">Add Feature Image</label>
                <div class="input-group">
                    <input type="file" class="custom-file-input" id="feature_image" name="feature_image">
                    <label class="custom-file-label" for="feature_image">Choose file</label>
                </div>
                <div id="imagePreview" class="mt-3">
                </div>
            </div>

            <div class="col-md-6">
                <label class="cmsModal-formLabel">Add SEO Contents</label>
                <input type="text" class="cmsModal-formControl mb-2" name="seo_title" placeholder="SEO Title">
                <input type="text" class="cmsModal-formControl mb-2" name="seo_keywords" placeholder="SEO Keywords">
                <textarea class="cmsModal-formControl mb-2" name="seo_description" placeholder="SEO Description"></textarea>
                <div class="row">
                    <div class="col-md-6">
                        <label class="cmsModal-formLabel" for="allow_search_engines">Allow Search Engines?</label>
                        <select class="cmsModal-formControl" name="allow_search_engines">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="cmsModal-formLabel" for="follow_links">Follow Links?</label>
                        <select class="cmsModal-formControl" name="follow_links">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>

                <input type="text" class="cmsModal-formControl mt-2" name="canonical_url" placeholder="Canonical URL">
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="active" value="1" id="active" checked>
                    <label class="form-check-label" for="active">
                        Active
                    </label>
                </div>
            </div>
        </div>

        <div class="card-footer text-center">
            <button type="submit" class="cmsBtn blue"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save & Close</button>
            <button  class="cmsBtn blue" name="closemodal"><i class="fa fa-close" aria-hidden="true"></i> Close</button>
        </div>
    </div>
    </div>
</form>
