<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>



    @include('ext.head')
    

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>




  
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
</head>
<div id="overlay" style="overflow-x: clip;">

<div class="loading_container">
    <img style="
    position: relative;
    width: 83%;
    max-width: 900px;"
     src="{{url('sardar')}}/img/{{getWebsiteOptions()['website_logo']->option_value}}" 
     class="rounded mx-auto d-block" >


     <div id="progstat">Loading 0%</div>
  <div class="row loader-bar-wrapper">
     <img class="loader-icon" 
     src="{{url('sardar')}}/img/{{getWebsiteOptions()['website_favicon']->option_value}}"
     height="30" width="30" alt="">
        
    <div id="progress"></div>

  <div class="row progrstat_container">
    </div>
  </div>

  <h4 class="text-center" style="
    font-size: 2em;
    color: #b5b5b5;
    position: relative;
    top: -8px;    
    left: 3.5%;
    ">We are <span style="color: #a90f0f;">INFLATING</span> <span style="color: black;">now</span></h4>

         
    </div>
</div>


<body class="lazyload pr-0">
<?php $current_page = ''; ?>

@include('ext.header-sports-vertical')
@include('ext.sidebar')

        
	@yield('content')

    @include('ext.footer2')

    @include('ext.script')
    
	@yield('custom-js')
    
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>


  ;(function(){
    function id(v){ return document.getElementById(v); }
    function loadbar() {
      var ovrl = id("overlay"),
          prog = id("progress"),
          stat = id("progstat"),
          img = document.images,
          c = 0,
          tot = img.length;
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
</script>

<script type="text/javascript" src="{{url('sardar')}}/js/slick.min.js"></script>

<script type="text/javascript">
  	$('.Innerinflatables_slider').slick({
      arrows: false,
      infinite: true,
      speed:300,
      autoplay: true,
      slidesToShow:1,
      slidesToScroll:1,
      centerPadding: '50px',
      centerMode: false,
      responsive: [
       
        {
          breakpoint:1200,
          settings: {
            arrows: false,
            centerPadding: '0px',
            slidesToShow:1
          }
        },
        {
          breakpoint:1000,
          settings: {
            slidesToShow:1,
            centerPadding: '0px',
      		arrows: false

          }
        },
        {
          breakpoint: 767,
          settings: {
            arrows: false,
            centerPadding: '0px',
            slidesToShow: 1
          }
        }
      ]
    });  

    $('.ExploreNowslider').slick({
      arrows: false,
      infinite: true,
      speed:300,
      autoplay: true,
      slidesToShow:1,
      slidesToScroll:1,
      centerPadding: '20px',
      centerMode: false,
      responsive: [
       
        {
          breakpoint:1200,
          settings: {
            slidesToShow:3
          }
        },
        {
          breakpoint:1000,
          settings: {
            slidesToShow:2
          }
        },
        {
          breakpoint:767,
          settings: {
            arrows: false,
            centerPadding: '40px',
            slidesToShow: 1
          }
        }
      ]
    });  



  </script>
  
</body>

</html>