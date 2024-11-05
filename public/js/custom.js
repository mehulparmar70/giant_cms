$(document).ready(function () {
  $('.btn-open-form').click(function (e) { 
    // alert('popup');
    $('.top-form').toggle();
  });
});

$(window).scroll(function () {
  var menu_height = $(".top_header").height();
  var logo_g = $(".logo-g").height();
  var collection_slider = $(".collection-slider").height();

  if($(window).scrollTop() > 60) {
    $("header").css({
      'background': '#ffffffb3'
    });
    console.log('white');
  }
  else{
    $("header").css({
      'background': 'transparent'
    });
    console.log('transparent');
  }

  // if($(window).width() > 100) {
  //   // alert('scroll up');
  //     $("header").css({
  //     'background': '#ffffffb3'
  //     });
  // }

});


// $(window).scroll(function () {
//   var menu_height = $(".top_header").height();
// var logo_g = $(".logo-g").height();
// var collection_slider = $(".collection-slider").height();

// if($(window).width() <= 767) {
//   if($(window).scrollTop() > $(".top_header").height()) {
//     $(".navbar-design").addClass('sticky');
//     $(".logo-g").show();
//     $(".top_header").hide();
//     $("body").addClass('sticky-menu-body');
//     $("body").css({
//       'position': 'relative',
//       'top': $('.top_header').height(),
//       });


//       $(".breadcrumb-left").css({
//       'position': 'fixed',
//       'left': '0px',
//       });

//       $(".border_breadcrumb").css({
//         'margin': 38,
//         'left': '0px'
//         });

      
//     }
//     else{
//     $(".top_header").show();
//       $(".navbar-design").removeClass('sticky');
//       $("body").removeClass('sticky-menu-body');
//       $("body").css({
//       'position': 'relative',
//       'top': 0,
//       });
//       $(".breadcrumb-left").css({
//       'position': 'relative',
//       'top': 0,
//       });

//   }
// }
// else{
//   if($(window).scrollTop() > 140) {
//     $(".navbar-design").addClass('sticky');
//     $(".logo-g").show();
//     $(".top_header").hide();
//     $("body").addClass('sticky-menu-body');

//     $("body").css({
//       'position': 'relative',
//       'top': $('.top_header').height() + 11,
//       });

//       if($(window).width() > 988){
//         $(".border_breadcrumb").css({
//           'margin': '0px auto',
//           'left': '0px'
//           });

//       $(".breadcrumb-left").css({
//         'position': 'fixed',
//         'top': $(".navbar").height(),
//         'left': '0px'
//         });
//       }
//       else if($(window).width() > 790){
//         $(".border_breadcrumb").css({
//           'left': '0px',
//           });

//       $(".breadcrumb-left").css({
//         'position': 'fixed',
//         'top': $(".navbar").height() - 1,
//         'left': '0px'
//         });
//       }
//       else
//       {
//       $(".border_breadcrumb").css({
//         'left': '0px',
//         'display' : 'none'
//         });
        
//       $(".breadcrumb-left").css({
//         'position': 'fixed',
//         'left': '0px',
//         'display' : 'none'
//         });
//       }



//     }
//     else{
//     $(".top_header").show();
//       $(".navbar-design").removeClass('sticky');
//       $("body").removeClass('sticky-menu-body');
//       $("body").css({
//       'position': 'relative',
//       'top': 0,
//       });
//       $(".breadcrumb-left").css({
//       'position': 'relative',
//       'top': 0,
//       });

//       $(".border_breadcrumb").css({
//       'margin': '17px auto',
//       });

//       // $(".border_breadcrumb").css({
//       // 'margin': '17px ​auto',
//       // 'background': 'transperant',
//       // });

//   }
// }

// });


$('.magnify-image').click(function () { 
  // alert('click');
});

// $('.enquiry_form').click(function () { 
//   // alert('click'); 
//   if(e.target.className !== "enquiry_form")
//     {
//       $(".enquiry_form").hide();
//     }
// });

// $("body").on("click", ":not(.dreamandbuild)", function(){
//   //execute
//   alert('test');

//  });


 $('.two_controls').click(function (e) { 
  $('.top-form').toggle();
});



$(document).click(function(event) {

  
  // element.hasClass('class1') || element.hasClass('class2')

  // if ( !$(event.target).hasClass('enquiry_form') || !$(event.target).hasClass('two_controls')) {
  //      $(".enquiry_form").hide();
  // }

  
});


// $('.magnify-button-prev').click(function () { 
//   // alert('left');
//   setTimeout(()=>{
//     $('.magnify-image').css({'left': 0});
//     alert('left');
//   },100)
// });


// $('.my_slider_block .Biginflatables .img_thumbnail img').click(function (e) { 
//   // $('.magnify-button-close').trigger('click');

//   setTimeout(()=>{
//   alert('click');
//   $('.magnify-image').css('height', '100%');
//   // $('.magnify-image').css('width', 'auto');
//   $('.magnify-image').css({'width': 'auto', 'left': 0});
//   },10)
  
// });

$('.magnify-maximize').not('.magnify-image').click(function (e) { 
  $('.magnify-button-close').trigger('click');
});

/*$(":submit").click(function (e) { 
  e.preventDefault();
  alert('submitted');
});*/

$(document).ready(function(){

  $(".border_breadcrumb").css({
    'margin': '',
    'left': '0px'
    });
  

  // $(".navbar-toggler").click(function(){
  //   if($("body").width() <= 992){
  //   $("#mySidenav").animate({
  //      width: "toggle"
  //    });
  //    $('.top-form').hide();
  //   }

  // });
  // $(".closeNavbtn, .two_controls").click(function(){
  //   if($("body").width() <= 992){
  //   $("#mySidenav").animate({
  //      width: "toggle"
  //    });
  //   }

  // });

});

$(document).on('hide.bs.modal',"#exampleModal, #exampleModal2", function () {
  $(".lazyload").addClass('pr-0');
});

  setTimeout(() => {
	
    $(".gsc-search-button .gsc-search-button-v2").addClass( "btn find-btn");
    $(".gsc-search-button .gsc-search-button-v2").text('Find');
  
  }, 1200);

  $('.navbar-design .nav-item').not(".no-effect").click(function () { 
    // alert('clcik 3');
    $('.navbar-design .nav-item').not(".no-effect").removeClass('active');
    $(this).addClass('active');
    
  });
  $('.top-buttons').click(function () { 
    $('.top-buttons').removeClass('active');
    $(this).addClass('active');
    
  });
  $('.top-buttons').focus(function (e) { 
    // alert('clock');
    $('.top-buttons').removeClass('activeTitle');
    $(this).addClass('activeTitle');
    
  });
  $('.product_internal_title').click(function (e) { 
    // alert('clock');
    $('.product_internal_title').removeClass('activeTitle');
    $(this).addClass('activeTitle');
    
  });
  


  // $(".gsc-search-button .gsc-search-button-v2").addClass( "btn find-btn");
  // $(".gsc-search-button .gsc-search-button-v2").text('Find');

  
//   $('.item-block').hover(function () {
//     $(this).children('.bottom_links').css('background', 'red');
//     // over
    
//   }, function () {
//     // out
//     $(this).children('.bottom_links').css('background', 'white');
//   }
// );


$(".clickExplore").hover(function () {
  $(this).children('a').css('color', 'white');
  // over
  
}, function () {
  $(this).children('a').css('color', 'black');
  // out
}
);

$(".infa_bg").hover(function () {
  $(this).children('a').css('color', 'white');
  // over
  
}, function () {
  $(this).children('a').css('color', 'black');
  // out
}
);

$(".explore-now-title").hover(function () {
  // over
  
}, function () {
  // out
}
);


// $('.slick-slide').hover(function () {
//   alert('test');
//   // $(this).children('.infa_bg').addClass('activeTitle');
//   // over
  
// }, function () {
//   alert('no');

//   // $(this).children('.infa_bg').removeClass('activeTitle');
//   // out
// }
// );

$('.clickExplore', '.top-buttons', '.c_explores a').hover(function () {
  $(this).addClass('hoverTitle');
  // over
  
}, function () {
  // out
}
);

$("a").each(function() {
  var url = $(this).attr('href')
  //var baseUrl = "<?php echo url('/'); ?>"; 

  if (url == baseUrl+'/products') {
    // console.log(baseUrl);  
    $(this).attr('href',baseUrl+'/custom-industrial-inflatable-products')
  }
  // console.log(url);
  // console.log(baseUrl);
  /*if (url.split("/") != undefined) {
    var parts = url.split("/");
    var last_part = parts[parts.length-1];
  }*/
});

$(".blur_box").width(function () {

  // $(this).css('height', $(this).width());
  
  // alert($(this).width());

  // over
  
});

$(".blur_box").width(function () {

  // $(this).child('.blur_original').css('height', $(this).width());
  // $(this).child('.blur_original').css('object-fit', 'cover');
  
  // alert($(this).width());

  // over
  
});


$(".open-modal, .enquiry-form-block").click(function(){
  // alert('enquiry-form-block');
  $('.exampleModal').show();
    // alert('test');
  var data_image = $(this).attr('data-image');
  var data_type = $(this).attr('data-type');
  var data_title = $(this).attr('data-title');
  var data_clientName = $(this).attr('data-clientName');
  var data_short_description = $(this).attr('data-short_description');
  var data_full_description = $(this).attr('data-full_description');
  var data_product_url = $(this).attr('data-product-url');

  $('.card-product-url').val(data_product_url);
  $('.card-image').val(data_image);
  $('.card-title').val(data_title);
  $('.card-client').html(data_clientName);
  $('.short-description').html(data_short_description);
  $('.full-description').html(data_full_description);


});       



//  $(".slideshow > img:gt(0)").hide();
//   setInterval(function() {
//   $('.slideshow > img:first')
//     .fadeOut(1000)
//     .next()
//     .fadeIn(1000)
//     .end()
//     .appendTo('.slideshow');
// }, 200);



//   setInterval(function() {
// $( ".slideshow" ).each(function( index ) {

//   // $(".slideshow > img:gt("+index+")").hide();
  
//   $(this).children("img:gt(0)").hide();

//     $(this).children("img:first")
//     .fadeOut(1000)
//     .next()
//     .fadeIn(1000)
//     .end()
//     .appendTo('.slideshow');
//   }, 3000);
// });





$('.carousel .vertical .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  for (var i=1;i<2;i++) {
    next=next.next();
    if (!next.length) {
    	next = $(this).siblings(':first');
  	}
    
    next.children(':first-child').clone().appendTo($(this));
  }
});


  $(window).scroll(function () {
    if ($(window).scrollTop() >= 100) {
      $(".our-responsive-tabs").addClass("responsive-tabs-fiexd");
    } else {
      $(".our-responsive-tabs").removeClass("responsive-tabs-fiexd");
    }
  });
  $( ".breadcrumb-item" ).last().addClass( "active");
  $( ".breadcrumb-item a:before" ).last().css( "background", "none");



