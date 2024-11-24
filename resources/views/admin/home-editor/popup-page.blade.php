<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="ajaxModal" 
     class="cmsModal {{ $type }}" 
     tabindex="-1" 
     role="dialog" 
     aria-labelledby="popupFormLabel" 
     aria-hidden="false">

  <div class="cmsModal-dialog " role="document">
    <div class="cmsModal-content">
      <div class="cmsModal-header">
        <h5 class="cmsModal-title" id="modalTitleId">{{ $type }}</h5>
        <div class="cmsModal-cta">
                        <!-- <a href="javascript:void(0);" class="cmsLinkBtn green">
                            <span class="icon">&times</span>
                            Save & Exit
                        </a> -->
                   
                        <a href="javascript:void(0);" type="button" class="cmsLinkBtn red" aria-label="Close" onclick="closeModal('{{ $type }}')">
                        <span class="icon">&times</span>
                        Exit without saving
        </a>
                    </div>
       
      </div>
      <div class="cmsModal-body" id="modalBodyContentpopup">
        @if(isset($pageData) && !empty($pageData))
          @includeWhen($type == 'About', 'admin.home-editor.about-page')
          @includeWhen($type == 'Product', 'admin.home-editor.product-page')
          @includeWhen($type == 'CaseStudies', 'admin.home-editor.casestudies-page')
          @includeWhen($type == 'Blog_Page', 'admin.home-editor.blog-page')
          @includeWhen($type == 'Testimonial', 'admin.home-editor.testimonial-page')
          @includeWhen($type == 'Contact', 'admin.home-editor.contact-page')
          @includeWhen($type == 'Video_Page', 'admin.home-editor.video-page')
          @includeWhen($type == 'Client', 'client.index')
          @includeWhen($type == 'client_edit', 'client.edit')
          @includeWhen($type == 'AddClient', 'client.create')
          @includeWhen($type == 'Award', 'award.index')
          @includeWhen($type == 'award_edit', 'award.edit')
          @includeWhen($type == 'AddAward', 'award.create')
          @includeWhen($type == 'newsletter', 'newsletter.index')
          @includeWhen($type == 'newsletter_add', 'newsletter.create')
          @includeWhen($type == 'IndustriesPage', 'admin.home-editor.industrie-page')
          @includeWhen($type == 'Videos', 'video.index')
          @includeWhen($type == 'partners', 'admin.home-editor.partners-page')
          @includeWhen($type == 'category', 'category.index')
          @includeWhen($type == 'Main_Category', 'category.edit')
          @includeWhen($type == 'Sub_Category', 'category.edit')
          @includeWhen($type == 'sub_category', 'category.create')
          @includeWhen($type == 'homeedit', 'admin.home-editor.index')
          @includeWhen($type == 'EditClient', 'admin.home-editor.client-page')
          @includeWhen($type == 'EditAward', 'admin.home-editor.awards-page')
          @includeWhen($type == 'Editnewsletter', 'admin.home-editor.newsletter-page')
       
          @includeWhen($type == 'Casestudies', 'casestudies.index')
          @includeWhen($type == 'casestudies_edit', 'casestudies.edit')
          @includeWhen($type == 'CasestudiesCreate', 'casestudies.create')
          @includeWhen($type == 'Slider', 'slider.index')
          @includeWhen($type == 'EditSlider', 'slider.edit')
          @includeWhen($type == 'Industries', 'industries.index')
          @includeWhen($type == 'industries_edit', 'industries.edit')
          @includeWhen($type == 'Testimonials', 'testimonial.index')
          @includeWhen($type == 'testimonial_create', 'testimonial.create')
          @includeWhen($type == 'newsletter_edit', 'newsletter.edit')
          @includeWhen($type == 'Testimonial_edit', 'testimonial.edit')
          @includeWhen($type == 'SocialMedia', 'setting.social-media')
          @includeWhen($type == 'Video_edit', 'video.edit')
          @includeWhen($type == 'Add_Slider', 'slider.create')
          
          @includeWhen($type == 'Addpartners', 'partners.create')
          @includeWhen($type == 'partners_edit', 'partners.edit')
          @includeWhen($type == 'Partners_List', 'partners.index')
          @includeWhen($type == 'Blogs', 'blog.index')
          @includeWhen($type == 'AddBlog', 'blog.create')
          @includeWhen($type == 'BlogEdit', 'blog.edit')
          @includeWhen($type == 'BlogEdit', 'blog.edit')
          

        @elseif(isset($sliders) && !empty($sliders))
          @includeWhen($type == 'Slider', 'admin.home-editor.slider-page')
        @endif
        @includeWhen($type == 'Addvideo', 'video.create')
        @includeWhen($type == 'videoIndex', 'video.index')
        @includeWhen($type == 'Product_List', 'product.index')
        @includeWhen($type == 'Product_Add', 'product.create')
        @includeWhen($type == 'product_edit', 'product.edit')

        @includeWhen($type == 'AddIndustries', 'industries.create')
        @includeWhen($type == 'CreateMainCategory', 'category.create')  

        @includeWhen($type == 'photo_manage', 'photo.list-photo')
        @includeWhen($type == 'photo_manage_edit', 'photo.manage')

        @includeWhen($type == 'video', 'video.create')
        @includeWhen($type == 'SocialMediaManagers', 'setting.seo-manage')
        @includeWhen($type == 'customJs', 'custom-code.custom-js')
        @includeWhen($type == 'EditpageLink', 'block-control.page-link-edit')
        @includeWhen($type == 'pageLink', 'block-control.page-link')
        @includeWhen($type == 'sitemap', 'site-map')

        
      </div>
     
    </div>
  </div>
</div>
</div>