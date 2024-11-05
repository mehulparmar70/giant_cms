<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    @include('ext.head')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


  <script type="text/javascript" src="{{url('sardar')}}/js/jcarousel.min.js"></script>


<style>
  /*
This is the visible area of you carousel.
Set a width here to define how much items are visible.
The width can be either fixed in px or flexible in %.
Position must be relative!
*/
.jcarousel {
    position: relative;
    overflow: hidden;
}

/*
This is the container of the carousel items.
You must ensure that the position is relative or absolute and
that the width is big enough to contain all items.
*/
.jcarousel ul {
    width: 10000em;
    position: relative;

    /* Optional, required in this case since it's a <ul> element */
    list-style: none;
    margin: 0;
    padding: 0;
}

/*
These are the item elements. jCarousel works best, if the items
have a fixed width and height (but it's not required).
*/
.jcarousel li {
    /* Required only for block elements like <li>'s */
    float: left;
}

.magnify-modal {
      box-shadow: 0 0 6px 2px rgba(0, 0, 0, .3);
    }

    .magnify-header .magnify-toolbar {
      background-color: rgba(0, 0, 0, .5);
    }

    .magnify-stage {
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      border-width: 0;
    }

    .magnify-footer {
      bottom: 10px;
    }

    .magnify-footer .magnify-toolbar {
      background-color: rgba(0, 0, 0, .5);
      border-radius: 5px;
    }

    .magnify-loader {
      background-color: transparent;
    }

    .magnify-header,
    .magnify-footer {
      pointer-events: none;
    }

    .magnify-button {
      pointer-events: auto;
    }
    #progstat::before{
      background:url("{{url('sardar')}}/img/{{getWebsiteOptions()['website_favicon']->option_value}}");
      background-size:30px auto;
    }

</style>


<link rel="stylesheet" type="text/css" href="{{url('jcarousel')}}/_shared/css/style.css">

<!-- Example assets -->
<link rel="stylesheet" type="text/css" href="{{url('jcarousel')}}/jcarousel.vertical.css">

<script type="text/javascript" src="{{url('jcarousel')}}/vendor/jquery/jquery.js"></script>
<script type="text/javascript" src="{{url('jcarousel')}}/dist/jquery.jcarousel.min.js"></script>

<script type="text/javascript" src="{{url('jcarousel')}}/jcarousel.vertical.js"></script>

<!-- <link href="{{url('magnify')}}/dist/jquery.magnify.css" rel="stylesheet"> -->

</head>

<!-- 

<div id="overlay" style="overflow-x: clip;">
    <h4 class="text-center" style="font-size: 2em;left: 67px;color: #b5b5b5;
    top: 150px;
    position: relative;
    ">We are <span style="color: #a90f0f;">INFLATING</span> <span style="color: black;">now</span></h4>
    <img style="top: 114px;position: relative;
    width: 83%;
    max-width: 900px;"
     src="{{url('sardar')}}/img/{{getWebsiteOptions()['website_logo']->option_value}}" 
     class="rounded mx-auto d-block" >

     <div class="row progrstat_container">
        <div id="progstat">
          </div>
    </div>

  <div class="row" style="position:relative; margin:0 auto; width:30%; top:20%">
     <img style=" left: -40px;position: relative;"
     src="{{url('sardar')}}/img/{{getWebsiteOptions()['website_favicon']->option_value}}" height="30" alt="">
        
    <div id="progress"></div>
  </div>
</div> -->



<div id="overlay" style="overflow-x: clip;">
<div class="loading_container">
    <h4 class="text-center" style="
    font-size: 2em;
    left: 67px;
    color: #b5b5b5;
    top: 30px;
    position: relative;
    ">We are <span style="color: #a90f0f;">INFLATING</span> <span style="color: black;">now</span></h4>
    <img style="
    position: relative;
    width: 83%;
    max-width: 900px;"
     src="{{url('sardar')}}/img/{{getWebsiteOptions()['website_logo']->option_value}}" 
     class="rounded mx-auto d-block" >

  <div class="row" style="position:relative;margin:0 auto;width:30%;margin-top: 18px;display: flex;left: 2%;">
     <img style=" left: -40px;position: relative;"
     src="{{url('sardar')}}/img/{{getWebsiteOptions()['website_favicon']->option_value}}" height="30" alt="">
        
    <div id="progress"></div>

  <div class="row progrstat_container">
        <div id="progstat">
          </div>
    </div>
  </div>
  
</div>
</div>


<!-- 
<div class="loader" style="height:100vh;">
    <img 
     src="{{url('sardar')}}/img/{{getWebsiteOptions()['website_logo']->option_value}}" 
     class="rounded mx-auto d-block" >
</div> -->

<body class="lazyload">

<!-- Set up your HTML -->
<?php $current_page = ''; ?>

    @include('ext.header-sports-vertical')
        

	@yield('content')


    @include('ext.footer-error')


    @include('ext.script')
	@yield('custom-js')

    <script>
        
  setTimeout(() => {
	
  $(".gsc-search-button .gsc-search-button-v2").addClass( "btn find-btn");
  $(".gsc-search-button .gsc-search-button-v2").text('Find');

}, 1200);

      ;(function(){
    function id(v){ return document.getElementById(v); }
    function loadbar() {
      var ovrl = id("overlay"),
          prog = id("progress"),
          stat = id("progstat"),

          img = document.images,
          c = 0,
          tot = img.length;
          
          stat.innerHTML = "Loading 0";
      if(tot == 0) return doneLoading();
  
      function imgLoaded(){
        c += 1;
        var perc = ((100/tot*c) << 0) +"%";
        prog.style.width = perc;
        stat.innerHTML = "Loading "+ perc;

        if(c===tot) return doneLoading();
      }
      function doneLoading(){
        ovrl.style.opacity = 0;
        setTimeout(function(){ 
          ovrl.style.display = "none";
        }, 1200);
      }
      for(var i=0; i<tot; i++) {
        var tImg     = new Image();
        tImg.onload  = imgLoaded;
        tImg.onerror = imgLoaded;
        tImg.src     = img[i].src;
      }    
    }
    document.addEventListener('DOMContentLoaded', loadbar, false);
  }());

$(document).ready(function () {
 
  // $(".slideshow > img:gt(0)").hide();
//   setInterval(function() {
//   $('.slideshow > img:first')
//     .fadeOut(1000)
//     .next()
//     .fadeIn(1000)
//     .end()
//     .appendTo('.slideshow');
// }, 2500);


// setInterval(function() {

//   $('.slideshow').each(function(i, obj) {
//       console.log(i);

//       // $( "ul li:nth-last-child(2)" ).append( "<span> - 2nd to last!</span>" );
//       $( "slideshow img:nth-last-child(2)" ).append( "<span> - 2nd to last!</span>" );
//       $('.slideshow img').eq(i).fadeOut(1000).next().fadeIn(1000).end().appendTo(('.slideshow img').eq(i));

//   });


// }, 2500);

});
    </script>
    
  
</body>

</html>