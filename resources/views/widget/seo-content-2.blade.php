<div div class="cmsModal-formGroup">

  <!-- <h5 class="bg-dark pl-4 pr-4">SEO CONTENTS</h5> -->
  <label class="cmsModal-formLabel" for="search_index">SEO CONTENTS</label>
  
   
    <input type="text" class="cmsModal-formControl" name="meta_title" placeholder="Seo Friendly Title"
      value="@if(old('meta_title')){{old('meta_title')}}@else{{$pageData->meta_title}}@endif">
    <span class="text-danger"></span>
 

    <input type="text" class="cmsModal-formControl" name="meta_keyword" placeholder="Seo Keywords with ,"
      value="@if(old('meta_keyword')){{old('meta_keyword')}}@else{{$pageData->meta_keyword}}@endif">

    <span class="text-danger"></span>


    <textarea type="text" class="cmsModal-formControl" name="meta_description"
      placeholder="Seo Friendly Title">@if(old('meta_description')){{old('meta_description')}}@else{{$pageData->meta_description}}@endif</textarea>
    <span class="text-danger"></span>
 


      <label class="cmsModal-formLabel" class="" for="search_index">Allow search engines to show this Page in search results?</label>
      <select class="cmsModal-formSelect" name="search_index">
        <option value="1" @if($pageData->search_index == 1)
          selected
          @endif
          >Yes</option>
        <option value="0" @if($pageData->search_index == 0)
          selected
          @endif
          >No</option>
      </select>
  


      <label class="cmsModal-formLabel" class="" for="search_follow">Follow links on this Page?</label>
      <select class="cmsModal-formSelect" name="search_follow">
        <option value="1" @if($pageData->search_follow == 1)
          selected
          @endif
          >Yes</option>
        <option value="0" @if($pageData->search_follow == 0)
          selected
          @endif
          >No</option>
      </select>
    


    <input type="text" class="cmsModal-formControl" name="canonical_url" placeholder="Canonical URL"
      value="@if(old('canonical_url')){{old('canonical_url')}}@else{{$pageData->canonical_url}}@endif">
    <span class="te xt-danger"></span>
 

</div>