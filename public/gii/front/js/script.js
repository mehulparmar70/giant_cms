
$(document).ready(function(){
  $(window).scroll(function(){
    var scrollTop = $(window).scrollTop();
    if (scrollTop > 0) {
      $('.header ').addClass('fixed-header');
       
    } else {
      $('.header ').removeClass('fixed-header');
       
    }
  });
});



/* Script on ready
---------------------------------*/
$(document).ready(function () {
// mobile-menu
$('.menu-trigger').click(function(){
        $(this).stop().toggleClass('open')
        $('body, html').stop().toggleClass('scroll-hidden');
        $('.mob-navbar').stop().toggleClass('open');
    }); 
    if($('#mobile-menu ul ul').length > 0){   
        $('#mobile-menu ul ul ').before('<em class="submenu-caret"></em>')
    }

    $('.submenu-caret').click(function(){
        $(this).next().slideToggle();
        $(this).toggleClass('toggled');
        $(this).parent().siblings().find('ul').slideUp()
        $(this).parent().siblings().find('em').removeClass('toggled')
    }); 
});



// slider
$(document).ready(function () {
 

$('.banner_slider_blk').slick({
  dots: false,
  slidesToShow: 5,
  slidesToScroll: 1,
  arrows:true,
  autoplay: true,
  
  draggable: true,
  speed: 900,
    infinite: true,
    cssEase: 'ease-in-out',
    touchThreshold: 100,
  responsive: [
    {
      breakpoint: 1601,
      settings: {
        slidesToShow: 5,
         arrows:false,
         dots: false,
      }
    },
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 4,
         arrows:false,
         dots: false,
      }
    },
        {
      breakpoint: 1199,
      settings: {
        slidesToShow: 3,
         arrows:false,
         dots: false,
      }
    },
    {
      breakpoint: 1040,
      settings: {
        slidesToShow: 3,
         arrows:false,
         dots: false,
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 2,
         arrows:false,
         dots: false,
      }
    },
    {
      breakpoint: 502,
      settings: {
        slidesToShow: 1,
         arrows:false,
         dots: false,
      }
    },
    ]
})
.on('setPosition', function (event, slick) {
	slick.$slides.css('height', slick.$slideTrack.height() + 'px');
});
});



// tab
$.fn.responsiveTabs = function() {

  return this.each(function() {
    var el = $(this),
        tabs = el.find('dt'),
        content = el.find('dd'),
        placeholder = $('<div class="responsive-tabs-placeholder"></div>').insertAfter(el);

    tabs.on('click', function() {
      var tab = $(this);

      tabs.not(tab).removeClass('active');
      tab.addClass('active');

      placeholder.html( tab.next().html() );
    });

    tabs.filter(':first').trigger('click');
  });

}


$('.responsive-tabs').responsiveTabs();

// second slider

$(document).ready(function () {
  $('.client_blk').slick({
    dots: true,
    speed: 0,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows:false,
    autoplay: true,
    cssEase: 'linear',
    infinite: true,
    responsive: [
          {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
           arrows:false,
           dots: true,
        }
      },
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 2,
           arrows:false,
           dots: false,
        }
      },
      {
        breakpoint: 500,
        settings: {
          slidesToShow: 1,
           arrows:false,
           dots: false,
        }
      },
      ]
    
  })
})

$(document).ready(function () {
  $('.client_blk_page').slick({
    dots: true,
    speed: 0,
    slidesToShow: 6,
    slidesToScroll: 1,
    arrows:false,
    autoplay: true,
    cssEase: 'linear',
    infinite: true,
    responsive: [
          {
        breakpoint: 1200,
        settings: {
          slidesToShow: 5,
           arrows:false,
           dots: true,
        }
      },
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: 4,
           arrows:false,
           dots: false,
        }
      },
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 3,
           arrows:false,
           dots: false,
        }
      },
      {
        breakpoint: 500,
        settings: {
          slidesToShow: 1,
           arrows:false,
           dots: false,
        }
      },
      {
        breakpoint: 400,
        settings: {
          slidesToShow: 1,
           arrows:false,
           dots: false,
        }
      },
      ]
    
  })
})

$(document).ready(function () {
  $('.banner_123').slick({
    dots: false,
    speed: 1000,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows:false,
    autoplay: true,
    fade: true,
  })
})

// third slider

$(document).ready(function () {
  $('.update_blk').slick({
    dots: true,
    speed: 2500,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows:false,
    autoplay: true,
    fade:true,
    
  })
})

// fifth slider
$(document).ready(function () {
  $('.kiis_blk').slick({
    dots: true,
    speed: 2500,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows:false,
    autoplay: true,
    fade:true,
  })
})



// video

$(document).ready(function() {
  $("[data-fancybox]").fancybox({
    afterShow: function() {
      // After the show-slide-animation has ended - play the vide in the current slide
     var vid = document.getElementById("myVideo"); 
     vid.play(); 

      // Attach the ended callback to trigger the fancybox.next() once the video has ended.
      this.content.find('video').on('ended', function() {
        $.fancybox.next();
      });
    }
  });
});


// slider
$(document).ready(function () {
 

  $('.banner_slider_blk_top').slick({
    dots: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows:true,
    autoplay: false,
    draggable: true,
    speed: 900,
      infinite: true,
      cssEase: 'ease-in-out',
      touchThreshold: 100,
    responsive: [
      {
        breakpoint: 1601,
        settings: {
          slidesToShow: 4,
           arrows:false,
           dots: false,
        }
      },
      {
        breakpoint: 1300,
        settings: {
          slidesToShow: 4,
           arrows:false,
           dots: false,
        }
      },
          {
        breakpoint: 1199,
        settings: {
          slidesToShow: 3,
           arrows:false,
           dots: false,
        }
      },
      {
        breakpoint: 1040,
        settings: {
          slidesToShow: 3,
           arrows:false,
           dots: false,
        }
      },
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 2,
           arrows:false,
           dots: false,
        }
      },
      {
        breakpoint: 502,
        settings: {
          slidesToShow: 1,
           arrows:false,
           dots: false,
        }
      },
      ]
  })
  .on('setPosition', function (event, slick) {
    slick.$slides.css('height', slick.$slideTrack.height() + 'px');
  });
  });




  $(document).ready(function () {
$('.main-img-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 5,
  infinite: true,
  arrows: true,
  fade:true,
  autoplay: false,
  autoplaySpeed: 4000,
  speed: 300,
  lazyLoad: 'ondemand',
  asNavFor: '.thumb-nav',
  prevArrow: '<div class="slick-prev"><i class="i-prev"></i><span class="sr-only sr-only-focusable">Previous</span></div>',
  nextArrow: '<div class="slick-next"><i class="i-next"></i><span class="sr-only sr-only-focusable">Next</span></div>'
});

// Thumbnail/alternates slider for product page
$('.thumb-nav').slick({
  slidesToShow: 8,
  slidesToScroll: 8,
  infinite: true,
  centerPadding: '0px',
  asNavFor: '.main-img-slider',
  dots: false,
  centerMode: true,
  draggable: true,
  speed:200,
  focusOnSelect: true,
  arrows: true,
  prevArrow: '<div class="slick-prev"><i class="i-prev"></i><span class="sr-only sr-only-focusable">Previous</span></div>',
  nextArrow: '<div class="slick-next"><i class="i-next"></i><span class="sr-only sr-only-focusable">Next</span></div>'  ,
  responsive: [
    {
      breakpoint: 1601,
      settings: {
        slidesToShow: 7,
         arrows:false,
         dots: false,
      }
    },
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 6,
         arrows:false,
         dots: false,
      }
    },
        {
      breakpoint: 1199,
      settings: {
        slidesToShow: 5,
         arrows:false,
         dots: false,
      }
    },
    {
      breakpoint: 1040,
      settings: {
        slidesToShow: 4,
         arrows:false,
         dots: false,
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 3,
         arrows:false,
         dots: false,
      }
    },
    {
      breakpoint: 502,
      settings: {
        slidesToShow: 2,
         arrows:false,
         dots: false,
      }
    },
    ]
});


//keeps thumbnails active when changing main image, via mouse/touch drag/swipe
$('.main-img-slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
  //remove all active class
  $('.thumb-nav .slick-slide').removeClass('slick-current');
  //set active class for current slide
  $('.thumb-nav .slick-slide:not(.slick-cloned)').eq(currentSlide).addClass('slick-current');  
});
});


$(document).ready(function(){
  $('.header_nav .btn_form .discuss').click(function(event){
      event.stopPropagation();
       $(".header_nav .btn_form form").slideToggle("fast");
  });
  $(".header_nav .btn_form form").on("click", function (event) {
      event.stopPropagation();
  });
});

$(document).on("click", function () {
  $(".header_nav .btn_form form").hide();
});

//
//	Equal height - by Lewi Hussey
//
$(document).ready(function(){
  equalheight = function(container){

    var currentTallest = 0,
         currentRowStart = 0,
         rowDivs = new Array(),
         $el,
         topPosition = 0;
     $(container).each(function() {
    
       $el = $(this);
       $($el).height('auto')
       topPostion = $el.position().top;
    
       if (currentRowStart != topPostion) {
         for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
           rowDivs[currentDiv].height(currentTallest);
         }
         rowDivs.length = 0; // empty the array
         currentRowStart = topPostion;
         currentTallest = $el.height();
         rowDivs.push($el);
       } else {
         rowDivs.push($el);
         currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
      }
       for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
         rowDivs[currentDiv].height(currentTallest);
       }
     });
    }
    
    $(window).load(function() {
      equalheight('.match');
    });
    
    
    $(window).resize(function(){
      equalheight('.match');
    });
    
});



$(document).ready(function(){

});

$(document).ready(function () {
  $('.news_letters .video_product').slick({
    dots: false,
    speed: 1000,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows:false,
    autoplay: false,
    responsive: [
      {
        breakpoint: 1601,
        settings: {
          slidesToShow: 3,
           arrows:false,
           dots: false,
        }
      },
      {
        breakpoint: 1300,
        settings: {
          slidesToShow: 3,
           arrows:false,
           dots: false,
        }
      },
          {
        breakpoint: 1199,
        settings: {
          slidesToShow: 3,
           arrows:false,
           dots: false,
        }
      },
      {
        breakpoint: 1040,
        settings: {
          slidesToShow: 2,
           arrows:false,
           dots: false,
        }
      },
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 1,
           arrows:false,
           dots: false,
        }
      },
      {
        breakpoint: 502,
        settings: {
          slidesToShow: 1,
           arrows:false,
           dots: false,
        }
      },
      ]
    
  })
})