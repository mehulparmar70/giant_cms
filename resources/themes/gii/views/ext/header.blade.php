
@if(session('LoggedUser'))
	<div class="onscreen-header">
		<ul class="float-left">
			<li class="onscreen-bg1">
				<a href="{{url('admin')}}">Go To Admin</a>
			</li>

			<div class="dropdown">
				<a class="dropbtn">Add New</a>
					<div class="dropdown-content">
						<a href="{{url('admin')}}/category/create?type=main_category">Main Category</a>
						<a href="{{url('admin')}}/category/create?type=sub_category">Sub Category</a>
						<a href="{{url('admin')}}/photo?page=list">Manage Photos</a>
						<a href="{{url('admin')}}/video/create">Video</a>
						<a href="{{url('admin')}}/testimonials/create">Testimonial</a>
						<a href="{{url('admin')}}/blog/create">Blog</a>
					</div>
			</div>

			<div class="dropdown">
				<a class="dropbtn">Manage Contents</a>
					<div class="dropdown-content">
						<a href="{{url('admin')}}/category?type=main_category">Main Category</a>
						<a href="{{url('admin')}}/category?type=sub_category">Sub Category</a>
						<a href="{{url('admin')}}/photo?page=list">Manage Photos</a>
						<a href="{{url('admin')}}/video">Video</a>
						<a href="{{url('admin')}}/testimonials">Testimonial</a>
						<a href="{{url('admin')}}/blog">Blog</a>
					</div>
			</div>

			<div class="dropdown">
				<a class="dropbtn">Global Setting</a>
					<div class="dropdown-content">
						<a href="{{url('admin')}}/settings/seo-manage">Seo Manage</a>
						<a href="{{url('admin')}}/settings/social-media">Social Media</a>
						<a href="{{url('admin')}}/custom-code/js">Header Footer</a>
					</div>
			</div>

			<div class="dropdown">
				<a class="dropbtn">Global Setting</a>
					<div class="dropdown-content">
						<a href="{{url('admin')}}/settings/seo-manage">Seo Manage</a>
						<a href="{{url('admin')}}/settings/social-media">Social Media</a>
						<a href="{{url('admin')}}/custom-code/js">Header Footer</a>
					</div>
			</div>

		</ul>
		
		<ul class="float-right">
			<li>
				<a href="">{{session('LoggedUser')->name}}</a>
			</li>

			<li class="onscreen-bg2">
				<a href="{{url('admin')}}"><i class="nav-icon fa fa-lock "></i> &nbsp;Logout</a>
			</li>
		</ul>
	</div>
@else

@endif

<header id="head"> 
	
<div id="mySidenav" class="sidenav">
  
  <ul class="navbar-nav" 
			>
				
			 <li class="logo-g" 
			 style="
						margin: 10px 0 0px;
						min-width: 100px;
						text-align: center;
						position: relative;
						padding: 0 10px;
					"
			 >
  <a 
  style="float: left;" 
  href="javascript:void(0)" class="closeNavbtn">&times;</a>

		        <a class="nav-link" href="{{url('')}}">
					<img style="max-width: 26px;margin-right: 0px;" 
						src="{{url('/')}}/img/active-link-icon.png">
				</a>
		      </li>

		      <li class="nav-item home">
		        <a class="nav-link" href="{{url('')}}">Home <span class="sr-only">(current)</span></a>
		      </li>

		      <li class="nav-item product">
		        <a class="nav-link" href="{{url('products')}}">our products</a>
		      </li>
		      <li class="nav-item about">
		        <a class="nav-link" href="{{url('about')}}">about</a>
		      </li>
		      <li class="nav-item testimonial">
		        <a class="nav-link" href="{{url('testimonials')}}">testimonials</a>
		      </li>
		      <li class="nav-item video">
		        <a class="nav-link" href="{{url('videos')}}">videos</a>
		      </li>
		      <li class="nav-item blog">
		        <a class="nav-link" href="{{url('blog')}}">blog</a>
		      </li>
		      <li class="nav-item contact">
		        <a class="nav-link" href="{{url('contact-us')}}">contact us</a>
		      </li>
			  <div class="two_controls">    
			      <li class="nav-item eneveloper_menu no-effect">
			        <a class="nav-link"><img src="{{url('/')}}/img/envlp.png" class="img-fluid"> </a>
			      </li>

			      <li class="nav-item no-effect  nav-form-btn">
			        <a class="nav-link"> send us your enquiry </a>
			      </li>
			  </div>    
		    </ul>
</div>


		<div class="top_header">
			<div class="left-aligns">  
			  <div class="logo">
			  	<a class="navbar-brand" href="{{url('')}}"
				 
				  data-link="http://www.alivecreate.com"
				  
				  >
				  <img src="{{url('/')}}/img/{{getWebsiteOptions()['website_logo']->option_value}}"
				   class="img-fluid"> </a>
				   
			  </div>	
			  <div class="search-bar">
			  	<!-- <input type="text" placeholder="enhanced by" name=""> -->
				  
				<div class="gcse-search"></div>
				
			  	<!-- <button class="btn find-btn">Find</button> -->
			  </div>	
			</div>	

		  <div class="dreamandbuild">
		  	<h3>YOU <span>DREAM</span> IT... WE'LL <span>BUILD</span> IT</h3>
		  	<ul class="ulclass"> 
		  		<li><a 
				  href="tel:{{getSocialMedia()->phone}}"> <i
				    style="" class="fa fa-mobile"></i> {{getSocialMedia()->phone}} </a> </li>
		  		<li><a 
				   href="mailto:{{getSocialMedia()->email}}"> <i class="far fa-envelope"></i>{{getSocialMedia()->email}}</a> </li>
		  	</ul>
		  </div>	
		</div>  
		<nav class="navbar navbar-expand-lg navbar-design p-lg-0 ">
		  <button class="navbar-toggler p-0" type="button" 
		  aria-expanded="false" aria-label="Toggle navigation">
		    	<i class="fas fa-bars"></i>
		  </button>
		  <div class="collapse navbar-collapse align-items-center" id="navbarNav">

		    <ul class="navbar-nav" 
			>
				
			 <li class="logo-g" 
			 style="
						margin: 10px 0 0px;
						min-width: 100px;
						text-align: center;
						position: relative;
						padding: 0 10px;
						display: none;
					"
			 >
		        <a class="nav-link" href="{{url('')}}">
					<img style="max-width: 26px;margin-right: 0px;" 
						src="{{url('/')}}/img/active-link-icon.png">
				</a>
		      </li>

		      <li class="nav-item home">
		        <a class="nav-link" href="{{url('')}}">Home <span class="sr-only">(current)</span></a>
		      </li>

		      <li class="nav-item product">
		        <a class="nav-link" href="{{url('products')}}">our products</a>
		      </li>
		      <li class="nav-item about">
		        <a class="nav-link" href="{{url('about')}}">about</a>
		      </li>
		      <li class="nav-item testimonial">
		        <a class="nav-link" href="{{url('testimonials')}}">testimonials</a>
		      </li>
		      <li class="nav-item video">
		        <a class="nav-link" href="{{url('videos')}}">videos</a>
		      </li>
		      <li class="nav-item blog">
		        <a class="nav-link" href="{{url('blog')}}">blog</a>
		      </li>
		      <li class="nav-item contact">
		        <a class="nav-link" href="{{url('contact-us')}}">contact us</a>
		      </li>
			  <div class="two_controls">    
			      <li class="nav-item eneveloper_menu no-effect">
			        <a class="nav-link"><img src="{{url('/')}}/img/envlp.png" class="img-fluid"> </a>
			      </li>

			      <li class="nav-item no-effect">
			        <a class="nav-link"> send us your enquiry </a>
			      </li>
			  </div>    
		    </ul>
		  </div>
		  
		<div class="top-form">
			@include('widget.contact-form-header')
		</div>	
		</nav>
	</header>