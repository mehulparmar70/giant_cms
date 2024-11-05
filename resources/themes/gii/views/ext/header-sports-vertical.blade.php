<!DOCTYPE html>
<html>

<head>
  
</head>
<body>
  
<style>
  /* Limit the text to 5 characters */
.text-limit {
    display: inline-block;
    max-width: 5ch; /* Limits to 5 characters */
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    vertical-align: middle;
    cursor: pointer;
    position: relative;
}

/* Tooltip styling */
.text-limit:hover::after {
    content: attr(data-full-text); /* Display the full content on hover */
    position: absolute;
    background-color: rgba(0, 0, 0, 0.7);
    color: #fff;
    padding: 5px;
    border-radius: 3px;
    top: 100%; /* Position the tooltip below the text */
    left: 0;
    white-space: nowrap;
    z-index: 100;
    font-size: 12px;
    min-width: 100px;
}

  .mac-style-toast {
    background-color: #f5f5f7 !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1) !important;
    color: #333 !important;
}

.mac-style-toast .iziToast-title {
    font-weight: bold;
    color: #333 !important;
}

.mac-style-toast .iziToast-message {
    font-size: 14px;
    color: #555 !important;
}

/* Modal Background */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1050; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.8); /* Black with opacity */
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Modal Content */
.modal-content {
    background-color: #2e2e2e; /* Dark background color */
    color: #fff; /* White text */
    margin: auto;
    padding: 0;
    border-radius: 8px; /* Rounded corners */
    
    width: 90%; /* Responsive width */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); /* Shadow for depth */
    position: relative; /* For absolute positioned close button */
    border: 1px solid #444;
}

/* Header */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 1px solid #444;
    background-color: #2e2e2e;
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 500;
    color: #fff;
}

.close {
    font-size: 1.5rem;
    color: #fff;
    cursor: pointer;
    border: none;
    background: none;
    outline: none;
}

/* Body */
.modal-body {
    padding: 20px;
    background-color: #2e2e2e;
}

/* Input Fields */
.modal-body input[type="text"],
.modal-body textarea,
.modal-body select {
    background-color: #3c3c3c; /* Slightly lighter background for input fields */
    color: #ddd; /* Slightly lighter text color */
    border: 1px solid #444; /* Subtle border */
    border-radius: 5px; /* Rounded corners */
    width: 100%; /* Full width */
    padding: 10px; /* Padding for better UX */
    margin-bottom: 15px; /* Space between fields */
    font-size: 0.9rem;
}

/* File Upload Area */
.input-group {
    margin-top: 10px;
}

.custom-file-input {
    display: none; /* Hide default file input */
}

.custom-file-label {
    background-color: #444; /* Dark background */
    color: #ccc; /* Light text */
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
}

#imagePreview {
    display: flex;
    align-items: center;
    margin-top: 10px;
    gap: 10px;
}

/* Footer */
.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-top: 1px solid #444;
    background-color: #2e2e2e;
}

/* Buttons */
.btn {
    padding: 10px 15px;
    font-size: 0.9rem;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

#ajaxForm
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addindustires
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#awardeditajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#editcasestudies
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#createtestimonial
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addnewslettercr
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addpartners
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#searchphoto
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addimageproducts
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addaward
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addclient
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#editblogajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addblogajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#partnereditajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#videoajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addvideo
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#socialmediaajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#testimonaileditajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#editnewsletter
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addcasestudies
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#adproductsform
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#editindustries
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#clienteditajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#slideridajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#editCategoryidajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addCategory
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addsliderajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addseoajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#addlogoajax
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#customCodeStore
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#caseStudies
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#editblogpage
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#editlinks
{
  background-color: #272B2E; /* Slightly lighter background for input fields */
  box-shadow: none;
  width: 100%;
}
#clienttable
{
  color:white;
}
</style>


     
        <div id="modalBodyContent"></div>
        <div id="addnewsletter"></div>

<!-- header -->

<?php if(request()->route()->getName() == 'index'){ ?>
  <header class="header">
<?php } else{  ?>
  <header class="header header_position">
<?php } ?>
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

<div class="header_bottom">
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
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('video.create')}}?type=video&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Video</a></li>
                        {{-- <li><a href=""onclick="popupmenu('{{route('admin.index')}}/category/create?type=sub_category&onscreenCms=true','','','','',''); return false;">Sub Category</a></li>  --}}
                        {{-- <li><a href=""onclick="popupmenu('{{route('admin.index')}}/photo?page=list&onscreenCms=true','','','','',''); return false;">Manage Products</a></li>  --}}
                        {{-- <li><a href=""onclick="popupmenu('{{route('admin.index')}}/video/create?onscreenCms=true','','','','',''); return false;">Video</a></li>  --}}
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('testimonials.create')}}?type=testimonial_create&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Testimonial</a></li>
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
                        <!-- <li><a class="adminEditItem" href=""
                            onclick="popupmenu('{{route('admin.index')}}/products?page=list&onscreenCms=true','','','','',''); return false;"
                        >Manage Products</a></li> -->
                        <li><a class="adminEditItem" href=""
                            onclick="popupmenu('{{route('admin.index')}}/photo?page=list&onscreenCms=true','','','','',''); return false;"
                        >Manage Photos</a></li>
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('video.index')}}?type=videoIndex&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Video</a></li>
                        {{-- <li><a href=""
                            onclick="popupmenu('{{route('admin.index')}}/video?onscreenCms=true','','','','',''); return false;"
                        >Video</a></li> --}}
                        <li><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('{{route('testimonials.index')}}?type=Testimonial&onscreenCms=true', 'toolbar=no, location=no',event); return false;">Testimonial</a></li>
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
@endif
  <div class="header_top">
    <div class="container">
      <div class="header_top_blk">
        <p class="ulclass">
          <img src="{{url('/')}}/images/call.png" alt="call" /><a href="tel:1300 463 528"
            >1300 463 528</a
          >
        </p>
        <p class="mobile_none ulclass">
          <img src="{{url('/')}}/images/location.png" alt="location" /><a href="#"
            >27 Woodlands Dr, Braeside VIC 3195, Australia</a
          >
        </p>
        <p class="mobile_none ulclass">
          <img src="{{url('/')}}/images/mail.png" alt="mail" /><a
            href="mailto: industrial@giantinflatablesindustrial.com.au"
            >industrial@giantinflatablesindustrial.com.au</a
          >
        </p>
        <p class="ulclass">
          <a href="#" class="mobile_none">Let's Connect</a>
          <span class="social-icon"
            ><img src="{{url('/')}}/images/youtube.png" alt="youtube" /><img
              src="{{url('/')}}/images/pip.png"
              alt="pip" /><img src="{{url('/')}}/images/twitter.png" alt="twitter" /><img
              src="{{url('/')}}/images/fb.png"
              alt="b"
          /></span>
        </p>
      </div>
    </div>
  </div>
  <div class="back-img">
    <div class="header_bottom">
      <div class="header_bottom_blk">
        <div class="container">
          <div class="logo">
            <a href="{{url('')}}"><img src="{{url('/')}}/img/logo.png" alt="logo" /></a>
          </div>

          <div class="search">
            <form method="POST" action="{{url('search')}}">
              @csrf
              <input type="text" name="search" placeholder="I am looking for.. Type here" value="<?php echo isset($searchTitle)?$searchTitle:''; ?>" required />
              <!-- <img src="{{url('/')}}/images/search.png" alt="search" /> -->
              <input type="submit" name="Submit" value="" >
            </form>
          </div>
          <div class="solution">
          @php
    // Fetch specific menu items by ID from the url_list table
    $clientLink = App\Models\admin\UrlList::find(102);  // Home link
    $awardsLink = App\Models\admin\UrlList::find(103);  // Our Products link
    $videoLink = App\Models\admin\UrlList::find(104);  // About link
    $newsletterLink = App\Models\admin\UrlList::find(105);  // Case Studies link
    $partnersLink = App\Models\admin\UrlList::find(106);  // Testimonials link

@endphp
            <h2>Innovative Industrial Inflatable Solutions</h2>
            <div class="solution-blk main_div">
              <ul class="ulclass">
                <li class="our_clients" @if(session('LoggedUser'))
            data-link="{{route('admin.client-page.editor')}}"
          @endif><a href="{{ url('client') }}" class="nav-item">{{ $clientLink->name }}</a></li>
                <li class="menu_crud"
                @if(session('LoggedUser'))
                    data-link="{{route('admin.awards-page.editor')}}"
                @endif><a href="{{ url('awards') }}" class="nav-item">{{ $awardsLink->name }}</a></li>
                <li class="menu_crud"
                @if(session('LoggedUser'))
                    data-link="{{route('admin.video-page.editor')}}"
                @endif><div ></div><a href="{{ url('videos') }}" class="nav-item">{{ $videoLink->name }}</a></li>
                <li class="menu_crud"
                @if(session('LoggedUser'))
                    data-link="{{route('admin.newsletter-page.editor')}}"
                @endif><a href="{{ url('news-letters') }}" class="nav-item newsletter">{{ $newsletterLink->name }}</a></li>
                <li class="menu_crud"
                @if(session('LoggedUser'))
                    data-link="{{route('admin.partners-page.editor')}}"
                @endif><a href="{{ url('partners') }}" class="nav-item partenrs">{{ $partnersLink->name }}</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      @php
    // Fetch specific menu items by ID from the url_list table
    $homeLink = App\Models\admin\UrlList::find(95);  // Home link
    $productLink = App\Models\admin\UrlList::find(96);  // Our Products link
    $aboutLink = App\Models\admin\UrlList::find(97);  // About link
    $caseStudiesLink = App\Models\admin\UrlList::find(100);  // Case Studies link
    $testimonialsLink = App\Models\admin\UrlList::find(98);  // Testimonials link
    $updatesLink = App\Models\admin\UrlList::find(113);  // Updates link
    $contactLink = App\Models\admin\UrlList::find(101);  // Contact Us link
@endphp
      <div class="header_nav">
        <div class="container">
          <div class="header_menu">
            <p class="menu_button">
              <img src="{{url('/')}}/images/menu1.png"  alt="menu" />MENU
            </p>
            <div class="menu_item_img">
              <a href="{{ $homeLink->url }}" class="item nav-item home_menu" @if(session('LoggedUser'))
                  data-link="{{route('admin.home.editor')}}"
              @endif>
                  <i class="fa fa-home home_menu_active" aria-hidden="true">
                      <div class="border"></div>
                      <span class="tooltiptext">{{ $homeLink->name }}</span>
                  </i>
              </a>
          
              <a href="{{ $productLink->url }}" class="nav-item product_menu" @if(session('LoggedUser'))
                  data-link="{{route('admin.product-page.editor')}}"
              @endif>
                  <i class="fa fa-product-hunt product_menu_active" aria-hidden="true">
                      <div class="border"></div>
                      <span class="tooltiptext">{{ $productLink->name }}</span>
                  </i>
              </a>
          
              <a href="{{ $aboutLink->url }}" class="nav-item about_menu" @if(session('LoggedUser'))
                  data-link="{{route('admin.about-page.editor')}}"
              @endif>
                  <i class="fa fa-info-circle about_menu_active" aria-hidden="true">
                      <div class="border"></div>
                      <span class="tooltiptext">{{ $aboutLink->name }}</span>
                  </i>
              </a>
          
              <a href="{{ $caseStudiesLink->url }}" class="nav-item case_studies_menu" @if(session('LoggedUser'))
                  data-link="{{route('admin.casestudies-page.editor')}}"
              @endif>
                  <i class="fa fa-book case_studies_menu_active" aria-hidden="true">
                      <div class="border"></div>
                      <span class="tooltiptext">{{ $caseStudiesLink->name }}</span>
                  </i>
              </a>
          
              <a href="{{ $testimonialsLink->url }}" class="nav-item testimonials_menu" @if(session('LoggedUser'))
                  data-link="{{route('admin.testimonial-page.editor')}}"
              @endif>
                  <i class="fa fa-quote-left testimonials_menu_active" aria-hidden="true">
                      <div class="border"></div>
                      <span class="tooltiptext">{{ $testimonialsLink->name }}</span>
                  </i>
              </a>
          
              <a href="{{ $updatesLink->url }}" class="nav-item updates_menu" @if(session('LoggedUser'))
                  data-link="{{route('admin.blog-page.editor')}}"
              @endif>
                  <i class="fa fa-refresh updates_menu_active" aria-hidden="true">
                      <div class="border"></div>
                      <span class="tooltiptext">{{ $updatesLink->name }}</span>
                  </i>
              </a>
          
              <a href="{{ $contactLink->url }}" class="nav-item contact_menu" @if(session('LoggedUser'))
                  data-link="{{route('admin.contact-page.editor')}}"
              @endif>
                  <i class="fa fa-address-book contact_menu_active" aria-hidden="true">
                      <div class="border"></div>
                      <span class="tooltiptext">{{ $contactLink->name }}</span>
                  </i>
              </a>
          
              <i class="fa fa-envelope-o ">
                  <div class="border"></div>
                  <span class="tooltiptext">Discuss with us</span>
              </i>
          
              @include('widget.contact-form1')
              <img src="{{url('/')}}/images/graylogo.png" alt="graylogo" class="graylogo" />
          </div>
          
          </div>

          <div class="navbar main_div">
            <ul class="ulclass">
              <li class="menu_crud" @if(session('LoggedUser'))
                data-link="{{route('admin.home.editor')}}"
                @endif><a href="{{url('')}}" class="home nav-item">{{ $homeLink->name }}</a>
            </li>
              <li class="menu_crud" @if(session('LoggedUser'))
                data-link="{{route('admin.product-page.editor')}}"
                @endif>
                <a href="{{url('custom-industrial-inflatable-products')}}" class="our_product_menu nav-item">{{ $productLink->name }}</a>
              </li>
              <li class="menu_crud" @if(session('LoggedUser'))
                data-link="{{route('admin.about-page.editor')}}"
                @endif>
                <a class="item nav-item" href="{{url('about')}}">{{ $aboutLink->name }}</a>
              </li>
              <li class="menu_crud" @if(session('LoggedUser'))
                data-link="{{route('admin.casestudies-page.editor')}}"
                @endif><a href="{{url('case-studies')}}" class="nav-item case_studies_menu">{{ $caseStudiesLink->name }}</a></li>
              <li class="menu_crud nav-item" @if(session('LoggedUser'))
                    data-link="{{route('admin.testimonial-page.editor')}}"
                @endif>
                <a href="{{url('testimonials')}}" class="item nav-item testimonials_menu"
                >{{ $testimonialsLink->name }}</a>
              </li>
              <li class="menu_crud" @if(session('LoggedUser'))
                data-link="{{route('admin.blog-page.editor')}}"
                @endif><a class="updates_menu nav-item" href="{{url('updates')}}">{{ $updatesLink->name }}</a></li>
              <li class="menu_crud " @if(session('LoggedUser'))
                    data-link="{{route('admin.contact-page.editor')}}"
                @endif>
                <a href="{{url('contact-us')}}" class="item nav-item">{{ $contactLink->name }}</a></li>
            </ul>
          </div>
          <!-- <div class="btn_form">
            <a href="#" class="discuss">
              <img src="{{url('/')}}/images/mail1.png" alt="mail" />Discuss with us
            </a>
            @include('widget.contact-form1')
          </div> -->
          <div class="btn_form">
                <a class="discuss">
                  <img src="{{url('/')}}/images/mail1.png" alt="mail" />Discuss with us
                </a>
                <form action="{{route('send-contact')}}" method="post">
                  @csrf
                  <input type="hidden" name="token_response" class="token_response">
                  <div class="form_wrap">
                    <div class="form_item">
                      <img src="{{ url('/') }}/images/home.png" /><input
                        type="text"
                        name="name"
                        placeholder="Name" required=""
                      />
                    </div>
                    <div class="form_item">
                      <img src="{{ url('/') }}/images/phone1.png" /><input
                        type="number"
                        name="Phone Number"
                        placeholder="Phone Number"
                      />
                    </div>
                    <div class="form_item">
                      <img src="{{ url('/') }}/images/email2.png" /><input
                        type="email"
                        name="Email"
                        placeholder="Email"
                      />
                    </div>
                    <div class="form_item">
                      <img src="{{ url('/') }}/images/map.png" /><input
                        type="text"
                        name="Select Country"
                        placeholder="Select Country"
                      />
                    </div>
                    <div class="form_item">
                      <img src="{{ url('/') }}/images/chat.png" / style=" margin-top: -30px;">
                      <textarea
                        name="Share Your Inflatables Requirement"
                        placeholder="Share Your Inflatables Requirement"
                      ></textarea>
                    </div>
                    <div class="form_item">
                      <div class="g-recaptcha" data-sitekey="6Leh9bkUAAAAAKVlEaSgl7pW4Sn0fom2KGGIB5m_"></div>
                    </div>
                    <p class="blue_text">
                      We do not Sell or Rent your information.
                      {{ Session::get('success')}}
                    </p>
                    <div class="discuss">
                      <input type="submit" value="submit" />
                    </div>
                  </div>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
</header>
<input sdf type='hidden' name="isCMS" id='isCMS'>

    </div>

  
    <!-- iziToast JS -->
<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
</body>

</html>
