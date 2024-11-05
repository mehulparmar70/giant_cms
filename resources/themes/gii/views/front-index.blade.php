
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
@includeFirst(['theme::ext.head', 'ext.head'])

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  @yield('addon-css')

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



<link rel="stylesheet" type="text/css" href="{{url('/')}}/jcarousel/_shared/css/style.css">

<!-- Example assets -->
<link rel="stylesheet" type="text/css" href="{{url('/')}}/jcarousel/jcarousel.vertical.css">


<!-- <link href="{{url('magnify')}}/dist/jquery.magnify.css" rel="stylesheet"> -->

</head>

<!-- <div id="overlay" style="overflow-x: clip;">
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
</div> -->

<body class="lazyload pr-0" >
<?php $current_page = ''; ?>
        
@includeFirst(['theme::ext.header-sports-vertical', 'ext.header-sports-vertical'])


	@yield('content')

  @includeFirst(['theme::ext.footer', 'ext.footer'])


  @includeFirst(['theme::ext.script', 'ext.script'])
	@yield('custom-js')


  <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js?ver=1.6.4'></script>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="{{url('jcarousel')}}/dist/jquery.jcarousel.min.js"></script>


<script type="text/javascript" src="{{url('jcarousel')}}/jcarousel.vertical.js"></script>

  <!-- <button onclick="topFunction()" id="myBtn" title="Go to top">
    <i class="fa fa-arrow-up" aria-hidden="true"></i> &nbsp;&nbsp;Top</button> -->
  
    <script>
document.onreadystatechange = function(e) {
  if (document.readyState == "interactive") {
    var all = document.getElementsByTagName("*");
    for (var i = 0, max = all.length; i < max; i++) {
      set_ele(all[i]);
    }
  }
}

function check_element(ele) {
  var all = document.getElementsByTagName("*");
  var totalele = all.length;
  var per_inc = 100 / all.length;

  if ($(ele).on()) {
    var prog_width = per_inc + Number(document.getElementById("progress_width").value);
    document.getElementById("progress_width").value = prog_width;
    $("#bar1").animate({
      width: prog_width + "%"
    }, 10, function() {
      if (document.getElementById("bar1").style.width == "100%") {
        $(".progress").fadeOut("slow");
      }
    });
  } else {
    set_ele(ele);
  }
}

function set_ele(set_element) {
  check_element(set_element);
}


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
    
<script>
//Get the button
// var mybutton = document.getElementById("myBtn");
// // When the user scrolls down 20px from the top of the document, show the button
// window.onscroll = function() {scrollFunction()};

// function scrollFunction() {
//   if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
//     mybutton.style.display = "block";
//   } else {
//     mybutton.style.display = "none";
//   }
// }


// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

</body>
  <script type="text/javascript" src="{{url('/')}}/js/jquery.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/front/js/fancybox.js"></script>
  <script type="text/javascript" src="{{url('/')}}/js/slick.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/js/custom-fancybox.js"></script>
  <script type="text/javascript" src="{{url('/')}}/js/script.js"></script>

  <script type="text/javascript">
  
  $('.slider-for').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.slider-nav'
			});
			$('.slider-nav').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: '.slider-for',
			dots: true,
			centerMode: true,
			focusOnSelect: true
		});


  
var count = 1;
//   setTimeout(function(){
//     // $(".slideshow img:nth-child(1)").fadeOut(400);
//     count = ($(".slideshow :nth-child("+count+")").fadeOut(1500).next().length == 0) ? 1 : count+1;
//     console.log(count);
//     $(".slideshow :nth-child("+count+")").fadeIn(1500);
// }, 1000);


// var $img = $(".slideshow"), i = 0, speed = 200;
// window.setInterval(function() {
//   $img.fadeOut(speed, function() {
//     $img.attr("src", images[(++i % images.length)]);
//     $img.fadeIn(speed);
//   });
// }, 1000);

// setInterval(function() {
//     count = ($(".slideshow :nth-child("+count+")").fadeOut(500).next().length == 0) ? 1 : count+1;
//     console.log(count);
//     $(".slideshow :nth-child("+count+")").fadeIn(500);
    
// }, 4000);

$('.slideshow').slick({
  dots: false,
  infinite: true,
  speed: 3000,
      autoplay: true,
      arrows: false,
  fade: true,
  cssEase: 'linear',
      slidesToShow:1,
      slidesToScroll:1,
      centerMode: true,

  slidesToShow: 1,
  slidesToScroll: 1,
  focusOnSelect: true,

      responsive: [
        {
          breakpoint:1200,
          settings: {
            arrows: false,
            centerPadding: '0px',
            slidesToShow:1
          }
        },]
});

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

    $( ".btn .btn-primary" ).click();

//  $("body").fadeOut(5000);


//     var count = 1;
// setInterval(function() {

//     count = $(".slideshow img:nth-child("+count+")").fadeOut(1000).next();

//     $(".slideshow img:nth-child("+count+")").fadeIn(1000).end();

//   count ++;
// }, 3000);



  </script>
</html>