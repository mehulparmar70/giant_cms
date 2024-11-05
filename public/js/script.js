
$(document).ready(function(){
  setTimeout(function() {
    // $('.getCatogery.active').trigger('click');
    // console.log('Hello');
  },3000);
  // $('.getCatogery.active').trigger('click');
  /*$('.getCatogery.active').ready(function() {
    // $(this).click();
    console.log('Hello')
  }); */
  $(window).scroll(function(){
    var scrollTop = $(window).scrollTop();
    if (scrollTop > 0) {
      $('.header ').addClass('fixed-header');
       
    } else {
      $('.header ').removeClass('fixed-header');
       
    }
  });
  $('body').on('click','.adminAddItem',function(e){
    $('#isCMS').val('1')
    return false;
  });
  $('body').on('click','.adminEditItem',function(e){
    $('#isCMS').val('1')
    return false;
  });
  $('body').on('click','.adminDeleteItem',function(e){
    $('#isCMS').val('1')
    return false;
  });
});

/* Script on ready
---------------------------------*/
$(document).ready(function () {

$('.menu_item_img a').each(function() {
  var url = $(location).attr('href');
  var parts = url.split("/");
  var last_part = parts[parts.length-1];
  if (url == $(this).attr('href')) {
    $(this).addClass('menu_active')
  }
});

$('.nav-item').not(".no-effect").click(function (e) { 
  // e.preventDefault();
    $(this).css('background-image', 'none');
    
    $('.nav-item').not(".no-effect").removeClass('active');
    // $('.nav-item').not(".no-effect").removeClass('menu_active');
    $(this).addClass('active');    
    // $(this).addClass('menu_active');    
});
/*function mouseOver(){
  console.log('Hello');
  $(this).css('background-image', 'none');
}*/

// mobile-menu
$('.showIndustriesImg').click(function(e){
  var id = $(this).data('id');
  var caption = $(this).data('caption');
  var title = $(this).attr('title');
  var type = $(this).attr('type');
  if ($(this).attr('href') == '#') {
      e.preventDefault();
      $.ajax({
         type:'POST',
         url:'showimg',
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         data : {'id':id,'caption':caption,'type':type},
         success:function(response){
            if ($('#isCMS').val() != '1') {
                var response = jQuery.parseJSON(response);
                var data = response.Code;
                if (response.Code == undefined) {
                  $.fancybox.open(response);
                  $('.fancybox-navigation').append('<h1 style="text-align: center;padding: 10px;color:white">'+title+'</h1>');
                }
            }
         }
      });
      
  }
})

/*$(".fancybox").fancybox({
    type: 'iframe',
    beforeLoad: function() {
        var caption = this.element.attr('data-caption');
        this.tpl.wrap = '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div><p>'+caption+'</p></div></div></div>'
            
    },
    
    helpers:  {
        title : {
            type : 'inside',
            position: 'top'
        }
    }
});*/
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
  accessibility: false,
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


$('.main_div ul li a').each(function() {
  var url = $(location).attr('href');
  if (url == $(this).attr('href')) {
    $(this).addClass('active')
  }
});
$('.navbar ul li a').each(function() {
  var url = $(location).attr('href');
  if (url == $(this).attr('href')) {
    $(this).addClass('active')
  }
});

});



// tab
$.fn.responsiveTabs = function() {

  return this.each(function() {
    var el = $(this),
        tabs = el.find('dt'),
        content = el.find('dd'),
        placeholder = $('<div class="responsive-tabs-placeholder"></div>').insertAfter(el);
    placeholder.html(tabs.next().html());
    tabs.on('click', function() {
      var tab = $(this);
      // undefined
      if ($(tab).data('isproduct') != undefined ) {
        // console.log('Hello');
      } else if($(tab).data('isproducttab') != undefined){
        tabs.not(tab).removeClass('active');
        tabs.not(tab).remove('ft-clr-white');
        tab.addClass('active');
      }else {
        // return false;
        if ($(tab).data('tab') != undefined) {
          $('.main-img-slider').slick('unslick');
          $('.thumb-nav').slick('unslick');
        }
        tabs.not(tab).removeClass('active');
        tabs.not(tab).remove('ft-clr-white');
        tab.addClass('active');
        // $('.subCategoryImage').slick('setPosition');
        placeholder.html( tab.next().html() );
      }
    });

    // tabs.filter(':first').trigger('click');
  });

}


$('.responsive-tabs').responsiveTabs();
// $('#home-inflatable').responsiveTabs();

// second slider

$(document).ready(function () {
  /*$('.adminAddItem').click(function(e){
    return false;
  })
  $('.adminEditItem').click(function(e){
    return false;
  })
  $('.adminDeleteItem').click(function(e){
    return false;
  })*/
  
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
  $('.subCategoryImage').slick({
    dots: false,
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
    accessibility: false,
    slidesToShow: 4,
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
  slidesToScroll: 1,
  lazyLoad: 'ondemand',
  infinite: true,
  arrows: true,
  fade:true,
  autoplay: true,
  autoplaySpeed: 4000,
  speed: 300,
  lazyLoad: 'ondemand',
  asNavFor: '.thumb-nav',
  prevArrow: '<div class="slick-prev"><i class="i-prev"></i><span class="sr-only sr-only-focusable">Previous</span></div>',
  nextArrow: '<div class="slick-next"><i class="i-next"></i><span class="sr-only sr-only-focusable">Next</span></div>'
});

// Thumbnail/alternates slider for product page
$('.thumb-nav').slick({
  dots: false,
  infinite: false,
  lazyLoad: 'ondemand',
  speed: 300,
  slidesToShow: 8,
  slidesToScroll: 1,
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
    autoplay: true,
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
/*var $opts = {
    dots: false,
    speed: 2500,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows:false,
    autoplay: true,
    fade:true,
}
$('.subCategoryImage').slick('unslick');*/

  $('body').on('click','.getCatogery',function(e){
      // return false;
      var id = $(this).data('id');
      e.preventDefault();
      $.ajax({
         type:'POST',
         url:'getCatogery',
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         data : {'id':id},
         success:function(response){
            var html = '';
            var response = jQuery.parseJSON(response);
            if (response.categorieData != undefined) {
                $.each(response.categorieData,function(i,index){
                    if (index.Code == 200) {
                      html += '<div class="item_img showProductDetails" data-link="'+index.Slug+'"> <div class="tab_top subCategoryImage">';
                      $.each(index.Image,function(image,imgIndex){
                        html += '<img src="'+imgIndex+'" style="height: 542px !important;" />';
                      })
                      html += '</div>'
                      if (response.IsLogged != undefined) {
                        html += '<div class="product_internal_title" data-create-link="'+index.Create+'" data-link="'+index.Link+'" data-delete-link="'+index.Delete+'" ></div>'
                      }
                      html += '<div class="big_text small_text"> <a href="'+index.Slug+'">'+index.Name+'</a> </div> </div>';
                    } else {
                      var imgIndex = index.Image[0];
                      html += '<div class="item_img showProductDetails" data-link="'+index.Slug+'"> <div class="tab_top subCategoryImage"> <img src="'+imgIndex+'" style="height: 540px !important;" /></div>';
                      if (response.IsLogged != undefined) {
                        html += '<div class="product_internal_title" data-create-link="'+index.Create+'" data-link="'+index.Link+'" data-delete-link="'+index.Delete+'" ></div>';
                      }
                      html += ' <div class="big_text small_text"> <a class="noImageFontClr" href="'+index.Slug+'">'+index.Name+'</a> </div> </div>';
                    }
                })
            }else{
              var imgIndex = response.MainCategoryData.Image;
              html += '<div class="item_img showProductDetails" data-link="'+response.MainCategoryData.slug+'"> <div class="tab_top subCategoryImage"> <img src="'+imgIndex+'" style="height: 540px !important;" /></div>';
              if (response.IsLogged != undefined) {
                html += '<div class="product_internal_title" data-create-link="'+response.MainCategoryData.Create+'" data-link="'+response.MainCategoryData.Link+'" data-delete-link="'+response.MainCategoryData.Delete+'" ></div>';
              }
              html += ' <div class="big_text small_text"> <a class="noImageFontClr" href="'+response.MainCategoryData.slug+'">'+response.MainCategoryData.name+'</a> </div> </div>';
            }
            $('.categorieImage').html('');
            $('.categorieImage').append(html);
            var screen = $(window).width();
            var popupWinWidth = 990;
            var left = (screen - popupWinWidth) / 2;
            $('.product_internal_title').each(function(){
              // $(this).prepend(`<div class="onscreen-product-internal-title-link"><a class="adminAddItem" title="Add" href="`+$(this).attr('data-link')+`"onclick="window.open('`+$(this).attr('data-link')+`', 'toolbar=no, location=no','left=`+left+`,width=`+popupWinWidth+`,height=860'); return false;"> <i class='fa fa-plus'></i></a><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="window.open('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no','left=`+left+`,width=`+popupWinWidth+`,height=860'); return false;"> <i class='fa fa-edit'></i></a><a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+`"data-msg="This action will delete Sub-Category & photos permanently If you are sure about this, then Press OK  or Press Cancel Now"> <i class='fa fa-trash'></i></a>`);
              var html = '';
              if ($(this).attr('data-create-link') != undefined) {
                html += `<a class="adminAddItem" title="Add" href="`+$(this).attr('data-create-link')+'?onscreenCms=true'+`"onclick="window.open('`+$(this).attr('data-create-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no','left=`+left+`,width=`+popupWinWidth+`,height=860'); return false;"> <i class='fa fa-plus'></i></a>`;
              } else {
                html += `<a class="adminAddItem" title="Add" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="window.open('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no','left=`+left+`,width=`+popupWinWidth+`,height=860'); return false;"> <i class='fa fa-plus'></i></a>`;
              }
              html += `<a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="window.open('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no','left=`+left+`,width=`+popupWinWidth+`,height=860'); return false;"> <i class='fa fa-edit'></i></a>
              <a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+`" data-msg="This action will delete Sub-Category & photos permanently If you are sure about this, then Press OK  or Press Cancel Now"> <i class='fa fa-trash'></i></a>`;
              $(this).prepend(html);

            });
            $('.subCategoryImage').slick({
              dots: false,
              speed: 2500,
              slidesToShow: 1,
              slidesToScroll: 1,
              arrows:false,
              autoplay: true,
              fade:true,
            });
         }
      });
  })
  $('body').on('click','.showProductDetails',function(e){
    e.preventDefault();
    $(this).addClass('orange_border');
    // return false;
    var url = $(this).data('link');
    window.location =  url;
  })
  /*$('body').on('click','.setSlider',function(e){
      e.preventDefault();
      var tabNo = $(this).data('tab');

      $('.responsive-tabs-placeholder #main-img-slider-'+tabNo).slick({
        slidesToShow: 1,
        slidesToScroll: 5,
        infinite: true,
        arrows: true,
        fade:true,
        autoplay: true,
        autoplaySpeed: 4000,
       
        speed: 300,
        lazyLoad: 'ondemand',
        asNavFor: '.responsive-tabs-placeholder #thumb-nav-'+tabNo,
        prevArrow: '<div class="slick-prev"><i class="i-prev"></i><span class="sr-only sr-only-focusable">Previous</span></div>',
        nextArrow: '<div class="slick-next"><i class="i-next"></i><span class="sr-only sr-only-focusable">Next</span></div>'
      });

      // Thumbnail/alternates slider for product page
      $('.responsive-tabs-placeholder #thumb-nav-'+tabNo).slick({
        slidesToShow: 8,
        slidesToScroll: 5,
        infinite: true,
        centerPadding: '0px',
        asNavFor: '.responsive-tabs-placeholder #main-img-slider-'+tabNo,
        dots: false,
        centerMode: true,
        
        draggable: true,
        speed:200,
        focusOnSelect: true,
        arrows: true,
        prevArrow: '<div class="slick-prev"><i class="i-prev"></i><span class="sr-only sr-only-focusable">Previous</span></div>',
        nextArrow: '<div class="slick-next"><i class="i-next"></i><span class="sr-only sr-only-focusable">Next</span></div>'  
      });

      $('.responsive-tabs-placeholder #main-img-slider-'+tabNo).on('afterChange', function(event, slick, currentSlide, nextSlide){
        //remove all active class
        $('.responsive-tabs-placeholder #thumb-nav-'+tabNo+' .slick-slide').removeClass('slick-current');
        //set active class for current slide
        $('.responsive-tabs-placeholder #thumb-nav-'+tabNo+' .slick-slide:not(.slick-cloned)').eq(currentSlide).addClass('slick-current');  
      });
  });*/

})

$(window).scroll(function () {
  if ($(window).scrollTop() >= 100) {
    $(".responsive_tabs").addClass("responsive-tabs-fiexd");
  } else {
    $(".responsive_tabs").removeClass("responsive-tabs-fiexd");
  }
});
$(window).scroll(function () {
  if ($(window).scrollTop() >= 100) {
    $(".responsive_tabs").addClass("responsive_tabs");
  }
});
$(document).ready(function(){
  setTimeout(function() {
    $('.getCatogery.active').trigger('click');
    console.log('Hello');
  },1000);
});