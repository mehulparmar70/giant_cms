  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{url('admin')}}" class="brand-link  text-center">
      <span class="brand-text font-weight-light text-strong text-uppercase">Giant Inflatable</span>
    </a>

    <div class="sidebar">

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
          <li class="nav-item dashboard">
            <a href="{{url('admin')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item setting">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
                Global Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li> -->

              <li class="nav-item">
                <a href="{{route('setting.social-media')}}" class="nav-link">
                  <i class="fa fa-plus-square nav-icon"></i>
                  <p>Social Media</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('customJs.create')}}" class="nav-link">
                  <i class="fa fa-plus-square nav-icon"></i>
                  <p>Header & Footer JS</p>
                </a>
              </li>

              <!-- <li class="nav-item">
                <a href="{{route('admin.category.create')}}" class="nav-link">
                  <i class="fa fa-plus-square nav-icon"></i>
                  <p>Mail Server</p>
                </a>
              </li> -->
<!-- 
              <li class="nav-item">
                <a href="{{route('admin.category.create')}}" class="nav-link">
                  <i class="fa fa-sitemap nav-icon"></i>
                  <p>Sitemap</p>
                </a>
              </li> -->

              
            </ul>
          </li>

          <li class="nav-item slider">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-columns"></i>
              <p>
                Sliders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('slider.index')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Sliders</p>
                </a>
              </li>

            </ul>
          </li>

          
          <!-- <li class="nav-item search">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-search"></i>
              <p>
                Search Criteria
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Search Criteria</p>
                </a>
              </li>

            </ul>
          </li> -->

          <li class="nav-item page">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.home.editor')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Home Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Product Page</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('about-page.editor')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>About Page</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('testimonial-page.editor')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Testimonial Page</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('video-page.editor')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Video Page</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('blog-page.editor')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Blog Page</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('contact-page.editor')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Contact Page</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          <!-- <li class="nav-item page">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Url Manage
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('url.group')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Url Group</p>
                </a>
              </li>

            </ul>
          </li> -->

          <li class="nav-item category">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-list-ol"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Category List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.category.create')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item product">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-product-hunt"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('product.index')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('product.create')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item video">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pencil-square-o"></i>
              <p>
                Video
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('video.index')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>View All</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('video.create')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>
          

          <li class="nav-item testimonial">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-address-card-o"></i>
              <p>
              Testimonials
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('testimonials.index')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>View All</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('testimonials.create')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>New New</p>
                </a>
              </li>

            </ul>
          </li>
       
          <!-- <li class="nav-item case-study">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-code-o"></i>
              <p>
                Case Studies
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>View Case Studies</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>New Case Studies</p>
                </a>
              </li>

            </ul>
          </li> -->

          <li class="nav-item infitable">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-suitcase"></i>
              <p>
                Block Control
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="{{route('topInflatable.create')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Top Inflatables</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('client.index')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Client</p>
                </a>
              </li>
              

            </ul>
          </li>

          <!-- <li class="nav-item partner">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Partners
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>View Partners</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>New Partners</p>
                </a>
              </li>

            </ul>
          </li> -->
          
          <!-- <li class="nav-item newsletter">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-newspaper-o"></i>
              <p>
                Newsletter
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>View All</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li> -->
          
          <li class="nav-item blog">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pencil-square-o"></i>
              <p>
                Blogs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('blog.index')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>View All</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('blog.create')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          <!-- <li class="nav-item seo">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-google"></i>
              <p>
                Seo Content
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>View All</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li> -->
          
          
            <li class="nav-item">            
            <a href="{{route('auth.logout')}}" class="nav-link bg-dark">
            
              <i class="nav-icon fa fa-lock "></i>
              <p>
                Logout
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            
            </li>
            
          </ul>
          </nav>
      
    </div>
  </aside>