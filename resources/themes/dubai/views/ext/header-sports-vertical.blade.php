


     
        <div id="modalBodyContent"></div>
        <div id="addnewsletter"></div>

 
<!-- header -->
<div class="wrapper">
  <div class="main-container">
  <header class="main-header">

@if(session('LoggedUser'))
<style> 
    .onscreen-header{
        top: 24px;
    }
    .menu-wrapper{
        /*top: 40px !important;*/
        top: 63px !important;
    }
    .itemBlock {
    margin-top: 80px;
    }

    @media (min-width: 1600px){
        .itemBlock {
            margin-top: 118px;
        }
    }

    

</style>

<p class="route-category-list d-none">{{route('admin.category.list')}}?type=main_category&onscreenCms=true</p>
<p class="route-category-create d-none">{{route('admin.category.create')}}?type=main_category&onscreenCms=true</p>
<p class="route-sub-category-list d-none">{{route('admin.category.list')}}?type=sub_category&onscreenCms=true</p>
<p class="route-sub-category-create d-none">{{route('admin.category.create')}}?type=sub_category&onscreenCms=true</p>

<p class="route-testimonial-create d-none">{{route('testimonials.create')}}?onscreenCms=true</p>
<p class="route-testimonial-index d-none">{{route('testimonials.index')}}?onscreenCms=true</p>
<p class="route-video-create d-none">{{route('video.create')}}?onscreenCms=true</p>
<p class="route-video-index d-none">{{route('video.index')}}?onscreenCms=true</p>
<p class="route-blog-create d-none">{{route('blog.create')}}?onscreenCms=true</p>
<p class="route-blog-index d-none">{{route('blog.index')}}?onscreenCms=true</p>
<p class="route-slider-index d-none">{{route('slider.index')}}?onscreenCms=true</p>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	
$(document).ready(function () {
	
	// $('.navbar-brand, .logo-g').each(function(){
    // $(this).append(`<a href="`+$(this).attr('data-link')+'?onscreenCms=true'+
    // `"class='onscreen-logo' onclick="currentWindow = window.open('`+$(this).attr('data-link')+'?onscreenCms=true'+
    // `', 'toolbar=no, location=no',event); return false;"> 
    // <i class='fa fa-edit'></i></a>`);
	// });
	
});


</script>
<style type="text/css">
    .header .admin_header .header_top_blk p a {
        color: #050505;
    }
</style>
<div class="cf-turnstile" data-sitekey="your-site-key"></div>

<div class="header_bottom d-none">
    <div class="header_nav">
        <div class="container">
          <div class="navbar">
            <ul class="ulclass">
              
                <!-- <li><a href="{{route('admin.index')}}" target="_blank" ><i class="fa fa-home "></i>  Go To Admin</a></li> -->
                 <!-- <li> <a href="#">Add New</a></li> -->
                <li>
                    <a href="#">Add New</a>
                    <ul class="ulclass">
                        <!-- <li><a href=""onclick="popupmenu('{{route('admin.index')}}/category/create?type=main_category&onscreenCms=true'); return false;">Page</a></li>  -->
                        {{-- <li><a href=""onclick="popupmenu('{{route('admin.index')}}/category/create?type=main_category&onscreenCms=true','','','','',''); return false;">Main Category</a></li> 
                        <dt data-isproducttab="1" class="product_title_main" @if(session('LoggedUser'))
                        data-link="{{route('admin.category.list')}}?type=main_category"
                        @endif> --}}
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.category.create')}}?type=main_category&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Main Category</a></li>
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.category.create')}}?type=sub_category&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Sub Category</a></li>
                        <!-- <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.photo.manage')}}?type=photo&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Manage Products</a></li> -->
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.photo.manage')}}?type=photo&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Manage Photos</a></li>
                        <!-- <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('video.create')}}?type=video&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Video</a></li> -->
                        {{-- <li><a href=""onclick="popupmenu('{{route('admin.index')}}/category/create?type=sub_category&onscreenCms=true','','','','',''); return false;">Sub Category</a></li>  --}}
                        {{-- <li><a href=""onclick="popupmenu('{{route('admin.index')}}/photo?page=list&onscreenCms=true','','','','',''); return false;">Manage Products</a></li>  --}}
                        <!-- {{-- <li><a href=""onclick="popupmenu('{{route('admin.index')}}/video/create?onscreenCms=true','','','','',''); return false;">Video</a></li>  --}} -->
                        <!-- <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('testimonials.create')}}?type=testimonial_create&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Testimonial</a></li> -->
                        {{-- <li><a href=""onclick="popupmenu('{{route('testimonials.create')}}/testimonials/create?onscreenCms=true','','','','',''); return false;">Testimonial</a></li>  --}}
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('blog.create')}}?type=testimonial_create&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Blog</a></li>
                        {{-- <li><a href="{{route('admin.index')}}/blog/create?onscreenCms=true"onclick="popupmenu('{{route('admin.index')}}/blog/create?onscreenCms=true','','','','',''); return false;">Blog</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="#">Manage Contents</a>
                    <ul class="ulclass">
                      <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.category.list')}}?type=testimonial_create&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Main Category</a></li>
                        {{-- <li><a href=""
                            onclick="popupmenu('{{route('admin.index')}}/category?type=main_category&onscreenCms=true','','','','',''); return false;"
                        >Main Category</a></li> --}}
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.category.list')}}?type=sub_category&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Sub Category</a></li>
                        {{-- <li><a href=""
                            onclick="popupmenu('{{route('admin.index')}}/category?type=sub_category&onscreenCms=true','','','','',''); return false;"
                        >Sub Category</a></li> --}}
                     
                        <li><a class="adminEditItem" href=""
                            onclick="popupmenu('{{route('admin.index')}}/photo?page=list&onscreenCms=true','','','','',''); return false;"
                        >Manage Photos</a></li>
                        <!-- <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('video.index')}}?type=videoIndex&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Video</a></li> -->
                        <!-- {{-- <li><a href=""
                            onclick="popupmenu('{{route('admin.index')}}/video?onscreenCms=true','','','','',''); return false;"
                        >Video</a></li> --}} -->
                        <!-- <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('testimonials.index')}}?type=Testimonial&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Testimonial</a></li> -->
                        {{-- <li><a href=""
                            onclick="popupmenu('{{route('admin.index')}}/testimonials?onscreenCms=true','','','','',''); return false;"
                        >Testimonial</a></li> --}}
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('blog.index')}}?type=Testimonial&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Blog</a></li>
                        {{-- <li><a href=""
                            onclick="popupmenu('{{route('admin.index')}}/blog?onscreenCms=true','','','','',''); return false;"
                        >Blog</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="#">Global Setting</a>
                    <ul class="ulclass">
                        {{-- <li><a href=""
                            onclick="popupmenu('{{route('admin.index')}}/slider?onscreenCms=true','','','','',''); return false;"
                        >Slider / Banner</a></li> --}}
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('slider.index')}}?type=Slider&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Slider / Banner</a></li>
{{-- 
                        <li><a href=""
                            onclick="popupmenu('{{route('admin.index')}}/settings/seo-manage?onscreenCms=true','','','','',''); return false;"
                        >Logo Manage</a></li> --}}
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.setting.seo-manage')}}?type=SocialMediaManagers&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Logo Manage</a></li>

                        {{-- <li><a href=""
                            onclick="popupmenu('{{route('admin.index')}}/settings/social-media?onscreenCms=true','','','','',''); return false;"
                        >Social Media</a></li> --}}
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('setting.social-media')}}?type=SocialMedia&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Social Media</a></li>

                        {{-- <li><a href=""
                            onclick="popupmenu('{{route('admin.index')}}/custom-code/js?onscreenCms=true','','','','',''); return false;"
                        >Header Footer</a></li> --}}
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.customJs.create')}}?type=customJs&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Header Footer</a></li>
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('sitemapEdit')}}?onscreenCms=true', 'toolbar=no, location=no',event); return false;">Sitemap</a></li>
                    </ul>
                </li>
                <li>
                    <a href="">{{session('LoggedUser')->name}}</a>
                </li>

                <li class="onscreen-bg2">
                    <a href="{{route('admin.auth.logoutOnscreen')}}"><i class="nav-icon fa fa-lock "></i> &nbsp;Logout</a>
                </li>
            </ul>
          </div>
        </div>
      </div>
</div>
<div class="graphite nav-slide-container">
  <div class="btn-slide"></div>
  <div class="dd-menu">
      <div class="nav-body">
          <div class="head-slide">Add New</div>
          <div class="body-slide">
              <ul class="nav">
                <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.category.create')}}?type=main_category&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Main Category</a></li>
                <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.category.create')}}?type=sub_category&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Sub Category</a></li>
                <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.photo.manage')}}?type=photo&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Manage Photos</a></li>
                <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('blog.create')}}?type=testimonial_create&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Blog</a></li>
              </ul>
          </div>
      </div>
      <div class="nav-body">
          <div class="head-slide">Manage Contents</div>
          <div class="body-slide">
              <ul class="nav">
                <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.category.list')}}?type=testimonial_create&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Main Category</a></li>
                <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.category.list')}}?type=sub_category&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Sub Category</a></li>
                <li><a class="adminEditItem" href=""
                  onclick="popupmenu('{{route('admin.index')}}/photo?page=list&onscreenCms=true','','','','',''); return false;"
              >Manage Photos</a></li>
              <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('blog.index')}}?type=Testimonial&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Blog</a></li>
                  
              </ul>
          </div>
      </div>
      <div class="nav-body">
          <div class="head-slide">Global Setting</div>
          <div class="body-slide">
              <ul class="nav">
                <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('slider.index')}}?type=Slider&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Slider / Banner</a></li>
                <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.setting.seo-manage')}}?type=SocialMediaManagers&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Logo Manage</a></li>
                <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('setting.social-media')}}?type=SocialMedia&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Social Media</a></li>
                <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('admin.customJs.create')}}?type=customJs&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Header Footer</a></li>
                <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('sitemapEdit')}}?onscreenCms=true', 'toolbar=no, location=no',event); return false;">Sitemap</a></li>
               
              </ul>
          </div>
      </div>
      <div class="nav-body">
          <div class="head-slide"> <a href="{{route('admin.auth.logoutOnscreen')}}"><i class="nav-icon fa fa-lock "></i> &nbsp;Logout</a></div>
   
      </div>
  </div>
</div>
@endif
<div class="container-fluid">
  <div class="header-top-mobile d-lg-none d-flex justify-content-center">
    <div class="header-bottom theme-heading">
      <ul>
        <li><a href="tel:+918758713931">
          <img src="{{url('/')}}/images/tel-icon.svg" alt="tel-icon">
          +91 87587&nbsp;<span>13931</span>
        </a></li> 
        <li><a href="mailto:sales@giantinflatables.ae">
          <img src="{{url('/')}}/images/envelope-line-icon.svg" alt="mail-icon">
          sales@<span>giantinflatables.ae</span>
        </a></li>
      </ul>
    </div>
  </div>
  <div class="header-upper-part">
    <div class="header-top d-flex">
      <div class="header-top-left d-flex align-items-stretch">
        <a href="{{url('')}}" class="header-main-logo">
          <img src="{{route('index')}}/img/{{getWebsiteOptions()['website_logo']['option_value']}}" alt="logo">
        </a>
        <a href="{{url('')}}" class="header-mobile-logo">
          <img class="d-lg-flex d-none" src="{{url('/')}}/images/sticky-logo.png" alt="small logo">
          <img class="d-lg-none d-flex" src="{{url('/')}}/images/mobile-logo.jpg" alt="small logo">
        </a>
        @php
        // Fetch specific menu items by ID from the url_list table
        $clientLink = App\Models\admin\UrlList::find(102);  // Home link
        $awardsLink = App\Models\admin\UrlList::find(103);  // Our Products link
        $videoLink = App\Models\admin\UrlList::find(104);  // About link
        $newsletterLink = App\Models\admin\UrlList::find(105);  // Case Studies link
        $partnersLink = App\Models\admin\UrlList::find(106);  // Testimonials link
        // Fetch specific menu items by ID from the url_list table
        $homeLink = App\Models\admin\UrlList::find(95);  // Home link
        $productLink = App\Models\admin\UrlList::find(96);  // Our Products link
        $aboutLink = App\Models\admin\UrlList::find(97);  // About link
        $caseStudiesLink = App\Models\admin\UrlList::find(100);  // Case Studies link
        $testimonialsLink = App\Models\admin\UrlList::find(98);  // Testimonials link
        $updatesLink = App\Models\admin\UrlList::find(113);  // Updates link
        $contactLink = App\Models\admin\UrlList::find(101);  // Contact Us link
    @endphp
        <a href="{{url('')}}" class="header-top-home sticky-show d-lg-flex d-none align-items-center text-uppercase me-4">
          <img class="me-2" src="{{url('/')}}/images/home-icon.png" alt="home-icon">
          <div class="hover-underline-animation left text-red">Home</div>
        </a>
        <div class="main-dropdown-nav-wrap sticky-show d-flex align-items-center">
          <span class="hamburger-overlay"></span>
          <a href="javascript:;" class="hamburger">
            <span class="wrap">
              <span class="line"></span>
              <span class="line"></span>
              <span class="line"></span>
            </span>
            <span class="hover-underline-animation left d-inline-block text-uppercase mx-2">Menu</span>
          </a>
          <div class="main-dropdown-nav">
            <ul>
              <li class="menu_crud"><a href="{{ url($homeLink->url) }}" class="active" @if(session('LoggedUser'))
                data-link="{{route('admin.home.editor')}}"
            @endif><span class="hover-underline-animation left">{{ $homeLink->name }}</span></a></li>
              <li class="menu_crud" @if(session('LoggedUser'))
              data-link="{{route('admin.about-page.editor')}}"
          @endif><a href="{{ url($aboutLink->url) }}" @if(session('LoggedUser'))
                data-link="{{route('admin.about-page.editor')}}"
            @endif><span class="hover-underline-animation left">{{ $aboutLink->name }}</span></a></li>
              <li class="menu_crud" @if(session('LoggedUser'))
              data-link="{{route('admin.product-page.editor')}}"
          @endif>
                <a href="{{ url($productLink->url) }}" @if(session('LoggedUser'))
                  data-link="{{route('admin.product-page.editor')}}"
              @endif><span class="hover-underline-animation left">{{ $productLink->name }}</span></a>
               
              </li>
              <li class="menu_crud"  @if(session('LoggedUser'))
              data-link="{{route('admin.blog-page.editor')}}"
          @endif>
          <a href="{{ url($updatesLink->url) }}" @if(session('LoggedUser'))
                data-link="{{route('admin.blog-page.editor')}}"
            @endif><span class="hover-underline-animation left">{{ $updatesLink->name }}</span></a>
          </li>
              <li class="menu_crud" @if(session('LoggedUser'))
              data-link="{{route('admin.contact-page.editor')}}"
          @endif><a href="{{ url($contactLink->url) }}" @if(session('LoggedUser'))
                data-link="{{route('admin.contact-page.editor')}}"
            @endif><span class="hover-underline-animation left">{{ $contactLink->name }}</span></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="header-top-middle text-center">
        <div class="header-top-middle-line sticky-hide theme-heading invisible">
          <span>Award</span> Winning Inflatable <span>Designer</span> & Manufacturer
        </div>
        <form action="{{url('search')}}" method="GET" class="header-search position-relative d-flex">
          <input type="search" name="search" placeholder="Got an idea... Type here...">
          <button type="submit" name="Submit" class="header-search-submit btn-animation position-absolute top-0 end-0">
            <img src="{{url('/')}}/images/search-icon.svg" alt="search-icon">
          </button>
        </form>
        <div class="d-flex justify-content-center">
          <a href="{{ url($homeLink->url) }}" @if(session('LoggedUser'))
            data-link="{{route('admin.home.editor')}}"
        @endif class="header-top-home sticky-hide d-lg-flex d-none align-items-center text-uppercase">
            <img src="{{url('/')}}/images/home-icon.png" alt="home-icon">
            <!-- <div class="hover-underline-animation left text-red">{{ $homeLink->name }}</div> -->
          </a>
          <div class="main-menu d-lg-flex d-none align-items-center">
            <ul>
          
              <li class="menu_crud {{ rtrim(url()->current(), '/') == rtrim($homeLink->url, '/') ? 'active' : '' }}"  @if(session('LoggedUser'))
              data-link="{{route('admin.home.editor')}}"
              @endif><a class="btn-animation {{ rtrim(url()->current(), '/') == rtrim($homeLink->url, '/') ? 'btn-animation--infinity' : '' }}" href="{{ url($homeLink->url) }}">{{ $homeLink->name }}</a></li>
              <li class="menu_crud {{ basename(url()->current()) == $aboutLink->url ? 'active' : '' }}"  @if(session('LoggedUser'))
              data-link="{{route('admin.about-page.editor')}}"
              @endif><a class="btn-animation {{ basename(url()->current()) == $aboutLink->url ? 'btn-animation--infinity' : '' }}" href="{{ url($aboutLink->url) }}">{{ $aboutLink->name }}</a></li>
             
              <li class="menu_crud {{ request()->is($productLink->url) || (isset($finalSlug) && trim($finalSlug, '/') === trim($finalSlug, '/')) ? 'active' : '' }}" 
                @if(session('LoggedUser'))
                    data-link="{{ route('admin.product-page.editor') }}"
                @endif>
                <a class="btn-animation {{ request()->is($productLink->url) || (isset($finalSlug) && trim($finalSlug, '/') === trim($finalSlug, '/')) ? 'btn-animation--infinity' : '' }}" href="{{ url($productLink->url) }}" 
                    @if(session('LoggedUser'))
                        data-link="{{ route('admin.product-page.editor') }}"
                    @endif>
                    {{ $productLink->name }}
                </a>
            </li>
            
              <li class="menu_crud {{ basename(url()->current()) == $updatesLink->url || (isset($updateslug) && trim($updateslug, '/') === trim($updateslug, '/')) ? 'active' : ''  }}" @if(session('LoggedUser'))
              data-link="{{route('admin.blog-page.editor')}}"
          @endif><a class="btn-animation {{ basename(url()->current()) == $updatesLink->url || (isset($updateslug) && trim($updateslug, '/') === trim($updateslug, '/')) ? 'btn-animation--infinity' : ''  }}" href="{{ url($updatesLink->url) }}" @if(session('LoggedUser'))
                data-link="{{route('admin.blog-page.editor')}}"
            @endif>{{ $updatesLink->name }}</a></li>
              <li class="menu_crud {{ basename(url()->current()) == $contactLink->url ? 'active' : '' }}" @if(session('LoggedUser'))
              data-link="{{route('admin.contact-page.editor')}}"
          @endif><a class="btn-animation {{ basename(url()->current()) == $contactLink->url ? 'btn-animation--infinity' : '' }}" href="{{ url($contactLink->url) }}" @if(session('LoggedUser'))
                data-link="{{route('admin.contact-page.editor')}}"
            @endif>{{ $contactLink->name }}</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="header-top-right d-lg-block d-none">
        <div class="header-bottom theme-heading">
          <ul>
            <li><a href="tel:+918758713931">
              <img src="{{url('/')}}/images/tel-icon.svg" alt="tel-icon">
              <div class="hover-underline-animation left">+91 87587&nbsp;<span>13931</span></div>
            </a></li>
            <li><a href="mailto:sales@giantinflatables.ae">
              <img src="{{url('/')}}/images/envelope-line-icon.svg" alt="mail-icon">
              <div class="hover-underline-animation left">sales@<span>giantinflatables.ae</span></div>
            </a></li>
          </ul>
        </div>
        <div class="header-lower-right theme-heading d-lg-inline-block d-none">
          <strong>Any <span>Size,</span> Any <span>Shape</span></strong>
        </div>
        <div class="header-share-concept">
          <a href="#" class="d-flex" onclick="loadInquiryModal(event)"><img src="{{url('/')}}/images/share-concept.png" alt="share-concept"></a>
        </div>
      </div>
    </div>
  </div>           
</div>
</header>
<svg class="hidden">
  <symbol id="icon-caret" viewBox="0 0 16 24">
    <title>caret</title>
    <path d="M15.45 2.8L12.65 0l-12 12 12 12 2.8-2.8-9.2-9.2z"/>
  </symbol>
</svg>

<input sdf type='hidden' name="isCMS" id='isCMS'>

<div id="inquirypopup">
  
</div>

<script>
  function loadInquiryModal(event) {
  event.preventDefault();

  fetch('{{ route("load-inquiry-modal") }}')
    .then(response => response.text())
    .then(html => {
      document.getElementById('inquirypopup').innerHTML = html;

      // Ensure modal element is properly initialized
      const modalElement = document.getElementById('shareconceptModal');
      const modal = new bootstrap.Modal(modalElement);
      
      modal.show();

      // Attach the close event listener (if needed for manual control)
      modalElement.addEventListener('hidden.bs.modal', function () {
        // Optional: Clean up the modal-container div when closed
        document.getElementById('modal-container').innerHTML = '';
      });
    })
    .catch(error => console.error('Error loading modal:', error));
}
$(document).ready(function(){
    $('.nav-slide-container').SlideMenu({
        speedLR: 500,
        speedUD: 500,
        expand: true,
        collapse: true
    });
});
</script>
