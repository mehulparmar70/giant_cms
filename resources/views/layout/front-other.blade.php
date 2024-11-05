<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    @yield('custom-head')
    
    @include('ext.head')
</head>

<div class="loader" style="height:100vh;">
    <img 
     src="{{url('/')}}/img/{{getWebsiteOptions()['website_logo']->option_value}}" 
     class="rounded mx-auto d-block" >
</div>


<body class="stretched">


<div id="overlay" style="overflow-x: clip;">
<div class="loading_container">

<h4 class="text-center" style="
    font-size: 2em;
    color: #b5b5b5;
    position: relative;
    top: 42px;    
    left: 3.5%;
    ">We are <span style="color: #a90f0f;">INFLATING</span> <span style="color: black;">now</span></h4>


    <img style="
    position: relative;
    width: 83%;
    max-width: 900px;"
     src="{{url('sardar')}}/img/{{getWebsiteOptions()['website_logo']->option_value}}" 
     class="rounded mx-auto d-block" >

     <div class="row progrstat_container">
        <div id="progstat">
          </div>
    </div>
    
  <div  class="row loader-bar-wrapper">
     <img style=" left: -40px;position: relative; width:50px; height:auto"
     src="{{url('sardar')}}/img/{{getWebsiteOptions()['website_favicon']->option_value}}" height="30" width="30" alt="">
        
    <div id="progress"></div>

  </div>
  
</div>
</div>



	<div id="wrapper" class="clearfix">

    @include('ext.header')

    <section id="page-title" class="page-title-mini"  
        style="
        
        
					background:url(http://localhost:8000/home/images/ccpl/bg-header2.jpg);
    background-size: 100%;
    background-position: 0px;
    background-repeat: no-repeat;
        ">

        
    <div class="container clearfix">
        <h1>@yield('breadcrumb-name')</h1>
        <span style="display:block"><strong>@yield('breadcrumb-title')</strong></span>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">@yield('breadcrumb-name')</li>
        </ol>
    </div>
</section>

	@yield('content')

    @include('ext.footer')
	</div>

	<div id="gotoTop" class="icon-angle-up"></div>

	<script src="{{url('/')}}/js/jquery.js"></script>

    <!-- @yield('custom-footer') -->
	
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyAeMV-FMGnR139m8rBqa5LNKyP5rBqMhIE"></script>

    <script src="{{url('/')}}/js/functions.js"></script>
	<script src="{{url('/')}}/js/custom.js"></script>



</body>
</html>