<div class="col-sm-6">
    <?php 
      $currentRoute = Route::current ()->getName();
      $pageEditorRoute = array('admin.about-page.editor','admin.product-page.editor','admin.testimonial-page.editor','admin.video-page.editor','admin.blog-page.editor','admin.contact-page.editor','admin.home.editor','admin.casestudies-page.editor','admin.newsletter-page.editor','admin.partenrs-page.editor','admin.industries-page.editor');
    ?>
    @if (in_array($currentRoute,$pageEditorRoute))
      <h5 class="bg-dark pl-4 pr-4">Page Title</h5>
      <div class="col-sm-12 mb-4">
        <label  class="" for="meta_description">Title</label>
        <textarea type="text" class="form-control" name="page_title" 
          placeholder="Page Title">@if(old('page_title')){{old('page_title')}}@else{{$pageData->page_title}}@endif</textarea>
        <span class="text-danger"></span>
      </div>
    @endif
                    <h5 class="bg-dark pl-4 pr-4">SEO CONTENTS</h5>
                    <div class="col-sm-12">
                      <label  class="text-danger" class="" for="meta_title">SEO Title</label>
                      <input type="text" class="form-control" name="meta_title" 
                        placeholder="Seo Friendly Title" value="@if(old('meta_title')){{old('meta_title')}}@else{{$pageData->meta_title}}@endif">
                      <span class="text-danger"></span>
                    </div>
                    <div class="col-sm-12">
                      <label  class="" for="meta_keyword">Keyword</label>
                      <input type="text" class="form-control" name="meta_keyword" 
                        placeholder="Seo Keywords with ," 
                        value="@if(old('meta_keyword')){{old('meta_keyword')}}@else{{$pageData->meta_keyword}}@endif">
                      
                      <span class="text-danger"></span>
                    </div>
                    <div class="col-sm-12">
                      <label  class="" for="meta_description">Description</label>
                      <textarea type="text" class="form-control" name="meta_description" 
                        placeholder="Seo Friendly Title">@if(old('meta_description')){{old('meta_description')}}@else{{$pageData->meta_description}}@endif</textarea>
                      <span class="text-danger"></span>
                    </div>
                    
                    <div class="col-sm-12 row mt-4">
                      <div class="col-sm-6">
                        <label  class="text-danger" class="" for="search_index">Allow search engines to show this Page in search results?</label>
                        <select class="form-control" name="search_index">
                            <option value="1"
                              @if($pageData->search_index == 1)
                                  selected
                              @endif
                            >Yes</option>
                            <option value="0"
                            
                            
                              @if($pageData->search_index == 0)
                                  selected
                              @endif
                            >No</option>
                        </select>
                      </div>
                      
                      <div class="col-sm-6">
                        <label  class="text-danger" class="" for="search_follow">Follow links on this Page?</label>
                        <select class="form-control" name="search_follow">
                            <option value="1"

                              @if($pageData->search_follow == 1)
                                    selected
                                @endif
                            >Yes</option>
                            <option value="0"
                            
                              @if($pageData->search_follow == 0)
                                  selected
                              @endif                            
                            >No</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <label  class="" for="canonical_url">Canonical URL</label>
                      <input type="text" class="form-control" name="canonical_url" 
                        placeholder="Canonical URL" 
                        value="@if(old('canonical_url')){{old('canonical_url')}}@else{{$pageData->canonical_url}}@endif">
                      <span class="text-danger"></span>
                    </div>

                  </div>
