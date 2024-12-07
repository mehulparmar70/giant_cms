
@section('toast')
 
@endsection

@if(session('LoggedUser'))
<style type="text/css">
  .product-video-div .onscreen-popup-title-link{
    background: white;
  }
  .product-video-div .active a{
    color: black !important;
  }
  .product_internal_title,.footer-partners-div .crud {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    padding: 4px 10px
    border: none;
    cursor: pointer;
    text-align: center;
    z-index: 99999999;
    background: black;
  }
</style>
@endif

	

<footer class="main-footer">
        <div class="footer-top">
          <div class="container">
            <div class="footer-top-row">
              <div class="footer-top-col wow fadeInUp" data-wow-offset="50">
              @php
        // Fetch specific menu items by ID from the url_list table
        $clientLink = App\Models\admin\UrlList::find(102);  // Home link
        $awardsLink = App\Models\admin\UrlList::find(103);  // Our Products link
        $videoLink = App\Models\admin\UrlList::find(104);  // About link
        $newsletterLink = App\Models\admin\UrlList::find(105);  // Case Studies link

        // Fetch specific menu items by ID from the url_list table
        $homeLink = App\Models\admin\UrlList::find(95);  // Home link
        $productLink = App\Models\admin\UrlList::find(96);  // Our Products link
        $aboutLink = App\Models\admin\UrlList::find(97);  // About link
        $caseStudiesLink = App\Models\admin\UrlList::find(100);  // Case Studies link

        $updatesLink = App\Models\admin\UrlList::find(113);  // Updates link
        $contactLink = App\Models\admin\UrlList::find(101);  // Contact Us link
        $sitemaplink = App\Models\admin\UrlList::find(114);  // Contact Us link
    @endphp
                <div class="footer-top-heading"><h6>Information</h6></div>
                <ul>
                  <li class="menu_crud" @if(session('LoggedUser'))
                data-link="{{route('admin.home.editor')}}"
            @endif><a href="{{ $homeLink->url }}" @if(session('LoggedUser'))
                data-link="{{route('admin.home.editor')}}"
            @endif>{{ $homeLink->name }}</a></li>
                  <li class="menu_crud" @if(session('LoggedUser'))
                  data-link="{{route('admin.product-page.editor')}}"
              @endif><a href="{{ $productLink->url }}" @if(session('LoggedUser'))
                  data-link="{{route('admin.product-page.editor')}}"
              @endif>{{ $productLink->name }}</a></li>
                  <li class="menu_crud" @if(session('LoggedUser'))
                data-link="{{route('admin.about-page.editor')}}"
            @endif><a href="{{ $aboutLink->url }}" @if(session('LoggedUser'))
                data-link="{{route('admin.about-page.editor')}}"
            @endif>{{ $aboutLink->name }}</a></li>
                  <li class="menu_crud" @if(session('LoggedUser'))
                data-link="{{route('admin.blog-page.editor')}}"
            @endif><a href="{{ $updatesLink->url }}" @if(session('LoggedUser'))
                data-link="{{route('admin.blog-page.editor')}}"
            @endif>{{ $updatesLink->name }}</a></li> 
                  <li class="menu_crud" @if(session('LoggedUser'))
                data-link="{{route('admin.contact-page.editor')}}"
            @endif><a href="{{ $contactLink->url }}" @if(session('LoggedUser'))
                data-link="{{route('admin.contact-page.editor')}}"
            @endif>{{ $contactLink->name }}</a></li>
                  <li class="menu_crud" ><a href="{{ $sitemaplink->url }}">{{ $sitemaplink->name }}</a></li>
               
                </ul>
              </div>
              <div class="footer-top-col wow fadeInUp" data-wow-offset="50" data-wow-delay="0.3s">
                <div class="footer-top-heading"><h6>Categories</h6></div>
                <ul>
                @foreach(customMainCat() as $key => $topInflatableLp)
             
                  <li class="menu_crud" data-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true  "><a href="{{url('')}}/{{$topInflatableLp->slug}}" @if(session('LoggedUser'))
                     
                      data-link="{{route('admin.category.edit', $topInflatableLp->id)}}?type=main_category&onscreenCms=true  "
                     
                    @endif>{{$topInflatableLp->name}}</a></li>
              
                  @endforeach
                  <li class="d-block" ><a class="text-red" href="{{ $updatesLink->url }}" >View All</a></li>
                </ul>
              </div>
              <div class="footer-top-col wow fadeInUp" data-wow-offset="50" data-wow-delay="0.6s">
                <div class="footer-top-heading"><h6>Products</h6></div>
                <ul>
                @foreach(customMainCat() as $key => $topInflatableLp)
          <?php 
          $getSubCategories = getSubCategories($topInflatableLp->id);
              if (!empty($getSubCategories)) {
                foreach($getSubCategories as $cat)
                {
          ?>
          <li class="menu_crud" data-link="{{route('admin.category.edit', $cat->id)}}?type=sub_category&onscreenCms=true&id={{$cat->parent_id}}"><a href="{{url('')}}/{{$cat->slug}}" @if(session('LoggedUser'))
                     data-link="{{route('admin.category.edit', $cat->id)}}?type=sub_category&onscreenCms=true&id={{$cat->parent_id}}"
                    
                   @endif>{{$cat->name}}</a></li>

                
                  <?php }}  ?>
                  @endforeach
                  <li class="d-block " ><a class="text-red" href="{{ $updatesLink->url }}" >View All</a></li>
                </ul>
              </div>
              <div class="footer-top-col wow fadeInUp" data-wow-offset="50" data-wow-delay="0.9s">
                <div class="footer-top-heading"><h6>Updates</h6></div>
                <ul>
                @foreach($blogsSlider as $blogsList)

                  <li class="menu_crud" @if(session('LoggedUser'))


data-link="{{route('blog.edit', $blogsList->id)}}"

@endif><a href="{{ $updatesLink->url }}" @if(session('LoggedUser'))


data-link="{{route('blog.edit', $blogsList->id)}}"

@endif>{!! html_entity_decode($blogsList->title) !!} </a></li>

                  @endforeach
                  <li class="d-block" ><a class="text-red" href="{{ $updatesLink->url }}" >View All</a></li>
                </ul>
              </div>

            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <div class="footer-bottom-bg">
            <img src="{{asset('/')}}/dubai/images/footer-bg-pattern.webp" alt="footer-bg-pattern">
          </div>
          <div class="container-fluid">
            <div class="footer-bottom-row text-center">
              <div class="footer-bottom-col wow fadeInLeft" data-wow-offset="50">
                <h6>This Website is Designed By:</h6>
                <div class="footer-bottom-img d-flex align-items-center justify-content-center">
                  <a href="https://www.thestudio5.com.au" target="_blank">
                    <img src="{{asset('/')}}/dubai/images/studio-logo.webp" alt="studio-logo">
                  </a>
                </div>
                <div class="footer-web-url theme-heading">
                  <a href="https://www.thestudio5.com.au/">www.<span>TheStudio5</span>.com.au</a>
                </div>
              </div>
              <div class="footer-bottom-col wow zoomIn -middle" data-wow-offset="50">
                <h6>A Venture of Giant Inflatables Indla</h6>
                <div class="footer-bottom-img d-flex align-items-center justify-content-center">
                  <a href="https://www.giantinflatables.in/" target="_blank">
                    <img src="{{asset('/')}}/dubai/images/footer-logo.webp" alt="footer-logo">
                  </a>
                </div>
                <div class="footer-web-url theme-heading">
                  <a href="https://www.giantinflatables.in/">www.<span>GiantInflatables</span>.in</a>
                </div>
                <strong>@ All Rights Reserved</strong>
              </div>
              <div class="footer-bottom-col wow fadeInRight" data-wow-offset="50">
                <h6>Digital Brand & Marketing Partner</h6>
                <div class="footer-bottom-img d-flex align-items-center justify-content-center">
                  <a href="https://www.searchmediabroker.com/" target="_blank">
                    <img src="{{asset('/')}}/dubai/images/search-media-broker-logo.webp" alt="search-media-broker-logo">
                  </a>
                </div>
                <div class="footer-web-url theme-heading">
                  <a href="https://www.searchmediabroker.com/">www.<span>SearchMediaBroker</span>.com</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>


	





	