var base_url =window.location.origin;
var url = base_url;
console.log('base_url',url);

// window.addEventListener('beforeunload', function(event) {
//   parent.console.info('I am the 2nd one.');
//   alert('aaaa');
//   return false;
// });
// window.addEventListener('unload', function(event) {
//   console.log('I am the 4th and last one…');
// });
// console.log('I am the 4th and last one…');

// window.onbeforeunload = function (event) {
//   var message = 'Sure you want to leave?';
//   if (typeof event == 'undefined') {
//     event = window.event;
//   }
//   if (event) {
//     event.returnValue = message;
//   }
//   return message;
// }

// $(window).bind('beforeunload', function(e) {
//   // Your code and validation
//   if (confirm) {
//       return "Are you sure?";
//   }
// });


$(document).ready(function(){
 
  var screen = $(window).width();
  var popupWinWidth = 990;
  var left = (screen - popupWinWidth) / 2;
  
  // var top = (screen.height - popupWinHeight) / 4;
    
  // var myWindow = popupmenu(pageURL, pageTitle, 
  //         'resizable=yes, width=' + popupWinWidth
  //         + ', height=' + popupWinHeight + ', top='
  //         + top + ', left=' + left);
var currentWindow;

  $('.navbar-brand, .logo-g').each(function(){
    $(this).append(`<a href="`+$(this).attr('data-link')+'?onscreenCms=true'+
    `"class='onscreen-logo' onclick="currentWindow = popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+
    `', 'toolbar=no, location=no',event); return false;"> 
    <i class='fa fa-edit'></i></a>`);
  });


// if(currentWindow){
//   currentWindow.close()
//   alert(currentWindow);

// }
// $('.logo-g, .product, .about, .testimonial, .blog, .contact,.menu_crud').each(function(){
//   $(this).append(`<a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"class='onscreen-menu adminEditItem' title="Edit" onclick="popupopen('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>`);
// });

$('.logo-g, .product, .about, .testimonial, .blog, .contact,.menu_crud').each(function(){
  $(this).append(`<a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"class='onscreen-menu adminEditItem' title="Edit" onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>`);
});


$('.home_menu, .product_menu, .about_menu, .case_studies_menu, .testimonials_menu, .updates_menu, .contact_menu').each(function(){
  if ($(this).attr('data-link')) {
      $(this).append(`<a href="` + $(this).attr('data-link') + `?onscreenCms=true" class='onscreen-menu adminEditItem' title="Edit" onclick="popupmenu('` + $(this).attr('data-link') + `?onscreenCms=true', 'toolbar=no, location=no','left=200,width=990,height=860'); return false;">
          <i class='fa fa-edit'></i>
      </a>`);
  }
});



$('.content_banners').each(function(){
  const createLink = $(this).attr('data-create-link');
  const editLink = $(this).attr('data-edit-link');
  const deleteLink = $(this).attr('data-delete-link');
  const listLink = $(this).attr('data-index-link');
  
  
  // Append buttons for Create, Edit, Delete, and List actions
  $(this).append(`
      <a class="onscreen-banner-slider" href="${createLink}" class="onscreen-menu adminEditItem" title="Create" onclick="popupmenu('${createLink}', 'editmodal', event); return false;">
          <i class="fa fa-plus"></i>
      </a>
      <a class="onscreen-banner-slider" href="${editLink}" class="onscreen-menu adminEditItem" title="Edit" onclick="popupmenu('${editLink}', 'editmodal', event); return false;">
          <i class="fa fa-edit"></i>
      </a>
      <a class="onscreen-banner-slider" href="${deleteLink}" class="onscreen-menu adminEditItem" title="Delete" onclick="popupmenu('${deleteLink}', 'deletemodal', event); return false;">
          <i class="fa fa-trash"></i>
      </a>
      <a class="onscreen-banner-slider" href="${listLink}" class="onscreen-menu adminEditItem" title="List" onclick="popupmenu('${listLink}', 'editmodal', event); return false;">
          <i class="fa fa-list"></i>
      </a>
  `);
});





$('.modal .close').on('click', function() {
  $('#ajaxModal').css('display', 'none');
});

// Close the modal when clicking outside of it
$(window).on('click', function(event) {
  if ($(event.target).is('#ajaxModal')) {
      $('#ajaxModal').css('display', 'none');
  }
});

// $('.onscreen-product-image').each(function(){
//   $(this).append(`<div class="onscreen-product-title image">
//   <a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;">
//   <i class='fa fa-edit'></i></a><a href="#" class="deleteImage"><i class='fa fa-trash'></i></a>`);
// });

$('.onscreen-product-image').each(function(){
  $(this).append(`<div class="onscreen-product-image1 image">
  <span class="deleteImage"><i class='fa fa-trash'></i></span>`);
});

$('.product_title_main').each(function(){
  $(this).prepend(`<div class="onscreen-product-title"><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-create-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-create-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>
  <a class="adminEditItem" title="Edit" href="`+$(this).attr('data-edit-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-edit-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>

  <a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+`"onclick="popupmenu('`+$(this).attr('data-delete-link')+`', 'deletemodal'); return false;"> <i class='fa fa-trash'></i></a>
  <a class="adminEditItem" title="Edit" href="`+$(this).attr('data-index-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-index-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-list'></i></a>`);
});

$('.product_title_1').each(function() {
  var html = `<div class="onscreen-our-product">
                <a class="adminEditItem" title="Edit" href="${$(this).attr('data-link')}?onscreenCms=true" 
                   onclick="popupmenu('${$(this).attr('data-link')}?onscreenCms=true', 'toolbar=no, location=no', event); return false;">
                  <i class='fa fa-edit'></i>
                </a>
              </div>`;
  $(this).prepend(html);
});

$('.product_title').each(function() {
  var html = `<div class="onscreen-our-product">
                <a class="adminAddItem" title="Add" href="${$(this).attr('data-link')}" 
                   onclick="popupmenu('${$(this).attr('data-link')}?onscreenCms=true', 'toolbar=no, location=no', event); return false;">
                  <i class='fa fa-plus'></i>
                </a>
                <a class="adminEditItem" title="Edit" href="${$(this).attr('data-link')}?onscreenCms=true" 
                   onclick="popupmenu('${$(this).attr('data-link')}?onscreenCms=true', 'toolbar=no, location=no', event); return false;">
                  <i class='fa fa-edit'></i>
                </a>`;
  
  if ($(this).attr('data-delete-link') != undefined) {
    html += `<a class="adminDeleteItem" title="Delete" href="${$(this).attr('data-delete-link')}" 
               data-msg='This action will delete Main-Category & photos permanently. If you are sure about this, then Press OK or Press Cancel Now'>
              <i class='fa fa-trash'></i></a>`;
  }
  
  html += `</div>`;
  $(this).prepend(html);
});


// $('.product_title_1').each(function() {
//   var html = `<div class="onscreen-our-product"><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>`;
//   $(this).prepend(html);
// });
// $('.product_title').each(function(){
//   var html = `<div class="onscreen-our-product"><a class="adminAddItem" title="Add" href="`+$(this).attr('data-link')+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>`;
//   html += `<a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>`;
//   if ($(this).attr('data-delete-link') != undefined) {
//     html += `<a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+`"data-msg='This action will delete Main-Category & photos permanently If you are sure about this, then Press OK  or Press Cancel Now'> <i class='fa fa-trash'></i></a>`;
//   }
//   $(this).prepend(html);
// });

$('.onscreen_media_testimonial_title').each(function(){
  $(this).prepend(`<div class="onscreen-media-title-link"><a style="font-size:18px !important" class="adminAddItem" title="Add" href="`+$('.route-testimonial-create').text()+`"onclick="popupmenu('`+$('.route-testimonial-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a style="font-size:18px !important" class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a style="font-size:18px !important" class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-trash'></i></a>`);
});

$('.onscreen_media_video_title').each(function(){
  $(this).prepend(`<div class="onscreen-media-video-link"><a href="`+$('.route-video-create').text()+`"onclick="popupmenu('`+$('.route-video-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-trash'></i></a>`);
});


$('.onscreen_media_blog_title').each(function(){
  $(this).prepend(`<div class="onscreen-media-blog-link"><a href="`+$('.route-blog-create').text()+`"onclick="popupmenu('`+$('.route-blog-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-trash'></i></a>`);
});


$('.onscreen_media_testimonial_item').each(function(){
  var html = `<div class="onscreen-media-testimonial-item-link" style="position: absolute;margin-left: 87%;display: flex;">`;
  
  if ($(this).attr('data-create-link') != undefined) {
    html += `<a class="adminAddItem" title="Add" href="`+$(this).attr('data-create-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-create-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>`;
  } else {
    html += `<a class="adminAddItem" title="Add" href="`+$('.route-testimonial-create').text()+`"onclick="popupmenu('`+$('.route-testimonial-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>`;
  }
  html += `<a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>
  <a class="adminDeleteItem" title="Delete" onclick="popupmenu('`+$(this).attr('data-delete-link')+`', 'deletemodal',event);"> <i class='fa fa-trash'></i></a>`;
  $(this).prepend(html);
});
$('.onscreen_media_casestudies_item').each(function(){
  var html = `<div class="onscreen-media-testimonial-item-link" style="position: absolute;margin-left: 87%;display: flex;">`;
  
  if ($(this).attr('data-create-link') != undefined) {
    html += `<a class="adminAddItem" title="Add" href="`+$(this).attr('data-create-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-create-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>`;
  } else {
    html += `<a class="adminAddItem" title="Add" href="`+$('.route-testimonial-create').text()+`"onclick="popupmenu('`+$('.route-testimonial-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>`;
  }
  html += `<a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>
  <a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+`" data-msg='This will delete testimonial Permanently. Do you want to continue?'> <i class='fa fa-trash'></i></a>`;
  $(this).prepend(html);
});

$('.onscreen_media_industries_item').each(function(){
  $(this).prepend(`<div class="onscreen-media-industries-item-link">
  <a href="`+$(this).attr('data-create-link')+'?onscreenCms=true'+`"class='onscreen-menu adminEditItem' title="Edit" onclick="popupmenu('`+$(this).attr('data-create-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>
  <a class="adminEditItem" title="Edit" href="`+$(this).attr('data-edit-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-edit-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>
  <a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+`"onclick="popupmenu('`+$(this).attr('data-delete-link')+`', 'deletemodal'); return false;"> <i class='fa fa-trash'></i></a>

  <a href="`+$(this).attr('data-index-link')+'?onscreenCms=true'+`"class='onscreen-menu adminEditItem' title="Edit" onclick="popupmenu('`+$(this).attr('data-index-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-list'></i></a>`);
});


$('.onscreen_media_video_item').each(function(){
  $(this).prepend(`<div class="onscreen-media-video-item-link">
  <a href="`+$('.route-video-create').text()+`"onclick="popupmenu('`+$('.route-video-create').text()+`', 'toolbar=no, location=no',event); return false;"><i class='fa fa-plus'></i></a>
  <a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>
  <a href="`+$(this).attr('data-delete-link')+`" data-msg='This will delete Video Permanently. Do you want to continue?''> <i class='fa fa-trash'></i></a>`);

});

$('.onscreen_media_blog_item').each(function(){
  $(this).prepend(`<div class="onscreen-media-blog-item-link">
  <a href="`+$('.route-blog-create').text()+`"onclick="popupmenu('`+$('.route-blog-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>
  <a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>
  <a href="`+$(this).attr('data-delete-link')+`" data-msg='This will delete Blog Permanently. Do you want to continue?'> <i class='fa fa-trash'></i></a>`);
});

$('.onscreen_explore_now_main_category').each(function(){
  $(this).prepend(`<div class="onscreen-explorenow-maincategory-link"><a href="`+$('.route-category-create').text()+`"onclick="popupmenu('`+$('.route-category-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a href="`+$('route-category-list').text()+`"onclick="popupmenu('`+$('.route-category-list').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-trash'></i></a>`);
});


$('.onscreen_explore_now_sub_category').each(function(){
  $(this).prepend(`<div class="onscreen-explorenow-subcategory-link"><a href="`+$(this).attr('data-create-subcategory')+`"onclick="popupmenu('`+$(this).attr('data-create-subcategory')+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a href="`+$(this).attr('data-delete-link')+`" data-msg='This action will delete Sub-Category & photos permanently If you are sure about this, then Press OK  or Press Cancel Now'> <i class='fa fa-trash'></i></a>`);
});


$('.facebooks_post_block, .google_map_block').each(function(){
  $(this).append(`<a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"class='onscreen-connect-block' onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>`);
});


$('.footer_logo_block').each(function(){
  $(this).after(`<a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"class='onscreen-connect-logo-block' onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>`);
});


$('.social_footer').each(function(){
  $(this).append(`<a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"class='onscreen-social-logo-block adminEditItem' title="Edit" onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>`);
});

$('.footer_page_link_information').each(function(){
  const link = $(this).attr('data-link'); // Get the data-link attribute
  $(this).append(`
      <a href="${link}?onscreenCms=true" class='footer-page-link-information' 
         onclick="popupmenu('${link}?onscreenCms=true', 'toolbar=no, location=no','left=${left},width=${popupWinWidth},height=860'); return false;">
         <i class='fa fa-edit'></i>
      </a>
  `);
});


$('.footer_page_blog_information').each(function(){
  $(this).after(`<a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"class='footer-page-link-blog' onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>`);
});

$('.TopContent, .FieldsTexts').each(function(){
  $(this).before(`<a  href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"class='top-content-pages adminEditItem' title="Edit" onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>`);
});

$('.onscreen_product_internal_title2').each(function(){
  $(this).prepend(`<div class="onscreen-product-internal-title-link2"><a href="`+$('.route-category-create').text()+`"onclick="popupmenu('`+$('.route-category-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a href="`+$(this).attr('data-delete-link')+`"data-msg="This action will delete Sub-Category & photos permanently If you are sure about this, then Press OK  or Press Cancel Now"> <i class='fa fa-trash'></i></a>`);
});
$('.onscreen_casestudiesedit').each(function(){
  $(this).prepend(`<div class="onscreen-product-internal-title-link2"><a href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>`);
});

$('.onscreen_product_internal_title3').each(function(){
  $(this).prepend(`<div class="onscreen-product-internal-title-link3"><a class="adminAddItem" title="Add" href="`+$(this).attr('data-create-subcategory')+`"onclick="popupmenu('`+$(this).attr('data-create-subcategory')+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+`"data-msg="This action will delete Sub-Category & photos permanently If you are sure about this, then Press OK  or Press Cancel Now"> <i class='fa fa-trash'></i></a>`);
});

$('.header_crud').each(function(){
  $(this).prepend(`<a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"class='onscreen-menu adminAddItem' title="Add" onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"class='onscreen-menu adminEditItem' title="Edit" onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"class='onscreen-menu adminEditItem' title="Edit" onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-trash'></i></a>`);
});

$('.crud').each(function(){
  $(this).prepend(`<a class="adminAddItem" title="Add" href="` + $(this).attr('data-create-link') + `"onclick="popupmenu('` + $(this).attr('data-create-link') + `', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>
  <a class="adminEditItem" title="Edit" href="` + $(this).attr('data-edit-link') + `"onclick="popupmenu('` + $(this).attr('data-edit-link') + `', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>
  <a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+`"data-msg="This will delete data Permanently. Do you want to continue?"> <i class='fa fa-trash'></i></a>`);
});

$('.title-crud').each(function() {
  $(this).prepend(`
    <a class="adminAddItem" title="Add" href="${$(this).attr('data-create-link')}" onclick="popupmenu('${$(this).attr('data-create-link')}?onscreenCms=true', 'toolbar=no, location=no', event); return false;">
      <i class='fa fa-plus'></i>
    </a>
    <a class="adminEditItem" title="Edit" href="${$(this).attr('data-link')}?onscreenCms=true" onclick="popupmenu('${$(this).attr('data-link')}?onscreenCms=true', 'toolbar=no, location=no', event); return false;">
      <i class='fa fa-edit'></i>
    </a>
    <a class="adminDeleteItem" title="Delete" href="${$(this).attr('data-link')}?onscreenCms=true" onclick="popupmenu('${$(this).attr('data-link')}?onscreenCms=true', 'toolbar=no, location=no', event); return false;">
      <i class='fa fa-trash'></i>
    </a>
  `);
});

// $('.title-crud').each(function(){
//   $(this).prepend(`<a class="adminAddItem" title="Add" href="`+$(this).attr('data-create-link')+`"onclick="popupmenu('`+$(this).attr('data-create-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event,event); return false;"> <i class='fa fa-plus'></i></a>
//   <a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event,event); return false;"> <i class='fa fa-edit'></i></a>
//   <a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event,event); return false;"> <i class='fa fa-trash'></i></a>`);
// });

$('.clients_crud').each(function(){
  $(this).prepend(`<a style="font-size: 18px !important;" class="adminAddItem" title="Add" href="`+$('.data-create').text()+`"onclick="popupmenu('`+$('.route-video-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>
  <a style="font-size: 18px !important;" class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>
  <a style="font-size: 18px !important;" class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+` data-msg="This will delete Video Permanently. Do you want to continue?"> <i class='fa fa-trash'></i></a>`);
});

$('.onscreen_popup_block').each(function(){
  $(this).before(`<div class="onscreen-popup-title-link">
  <a class="adminAddItem" title="Add" href="`+$('.route-testimonial-create').text()+`"onclick="popupmenu('`+$('.route-testimonial-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>
  <a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>
  <a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+`"data-msg="This will delete testimonial Permanently. Do you want to continue?"> <i class='fa fa-trash'></i></a>`);
});

$('.onscreen_popup_crud').each(function(){
  $(this).before(`<div class="onscreen-popup-title-link">
  <a class="adminAddItem" title="Add" href="`+$(this).attr('data-create-link')+`"onclick="popupmenu('`+$(this).attr('data-create-link')+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>
  <a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>
  <a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+`"data-msg="This will delete Permanently. Do you want to continue?"> <i class='fa fa-trash'></i></a>`);
});

$('.onscreen_video_popup_block').each(function(){
  // Get the data attributes from the current element
  const createLink = $(this).attr('data-create-link');
  const editLink = $(this).attr('data-edit-link');
  const deleteLink = $(this).attr('data-delete-link');
  const indexLink = $(this).attr('data-index-link');
  
  // Append buttons dynamically with the proper links
  $(this).before(`
      <div class="onscreen-popup-title-link">
          <a class="adminAddItem" title="Add" href="${createLink}" onclick="popupmenu('${createLink}', 'toolbar=no, location=no','left=${left},width=${popupWinWidth},height=860'); return false;">
              <i class='fa fa-plus'></i>
          </a>
          <a class="adminEditItem" title="Edit" href="${editLink}?onscreenCms=true" onclick="popupmenu('${editLink}?onscreenCms=true', 'toolbar=no, location=no','left=${left},width=${popupWinWidth},height=860'); return false;">
              <i class='fa fa-edit'></i>
          </a>
          <a class="adminDeleteItem" title="Delete" href="${deleteLink}" data-msg="This will delete the video permanently. Do you want to continue?">
              <i class='fa fa-trash'></i>
          </a>
          <a class="onscreen-menu adminEditItem" title="List" href="${indexLink}?onscreenCms=true" onclick="popupmenu('${indexLink}?onscreenCms=true', 'toolbar=no, location=no','left=${left},width=${popupWinWidth},height=860'); return false;">
              <i class='fa fa-list'></i>
          </a>
      </div>
  `);
});



$('.onscreen_page_blog_block').each(function(){
  $(this).before(`<div class="onscreen-popup-title-link"><a class="adminAddItem" href="`+$('.route-blog-create').text()+`"onclick="popupmenu('`+$('.route-blog-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>
  <a class="adminEditItem" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>
  <a class="adminDeleteItem" href="`+$(this).attr('data-delete-link')+`"data-msg="This will delete Blog Permanently. Do you want to continue?"> <i class='fa fa-trash'></i></a>`);


});

$('.onscreen_blog_detail_page').each(function(){
  $(this).before(`<div class="onscreen-popup-title-link"><a class="adminAddItem" title="Add" href="`+$('.route-blog-create').text()+`"onclick="popupmenu('`+$('.route-blog-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a class="adminDeleteItem" title="Delete" href="`+$('route-blog-index').text()+`"onclick="popupmenu('`+$('.route-blog-index').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-trash'></i></a>`);
});

$('.product_internal_title').each(function() {
  var html = '';

  // Accessing the data attributes properly using $(this).attr('data-create-link'), etc.
  html += `<a class="adminAddItem" title="Add" href="` + $(this).attr('data-create-link') + `" onclick="popupmenu('` + $(this).attr('data-create-link') + `', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a>`;

  html += `<a class="adminEditItem" title="Edit" href="` + $(this).attr('data-edit-link') + `" onclick="popupmenu('` + $(this).attr('data-edit-link') + `', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>`;

  html += `<a class="adminDeleteItem" title="Delete" href="` + $(this).attr('data-delete-link') + `" data-msg="This action will delete Sub-Category & photos permanently. If you are sure about this, press OK or Cancel now."> <i class='fa fa-trash'></i></a>`;

  html += `<a class="adminListItem" title="List" href="` + $(this).attr('data-index-link') + `" onclick="popupmenu('` + $(this).attr('data-index-link') + `', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-list'></i></a>`;

  // Append the generated HTML
  $(this).prepend(html);
});


$('.product_internal_title_slick').each(function(){
  $(this).append(`<div class="onscreen-product-internal-title-link"><a class="adminAddItem" title="Add" href="`+$(this).attr('data-link')+`"onclick="popupmenu('`+$(this).attr('data-link')+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+`"data-msg="This action will delete Sub-Category & photos permanently If you are sure about this, then Press OK  or Press Cancel Now"> <i class='fa fa-trash'></i></a>`);
});

$('.onscreen_left_sidebar_list').each(function(){
  $(this).prepend(`<div class="onscreen-left-sidebar-list-link"><a href="`+$('.route-sub-category-create').text()+`"onclick="popupmenu('`+$('.route-sub-category-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a href="`+$('route-sub-category-list').text()+`"onclick="popupmenu('`+$('.route-sub-category-list').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-trash'></i></a>`);
});

$('.onscreen_product_main_category_title').each(function(){
  $(this).prepend(`<div class="onscreen-product-maincategory-title-link"><a href="`+$('.route-category-create').text()+`"onclick="popupmenu('`+$('.route-category-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a href="`+$('route-category-list').text()+`"onclick="popupmenu('`+$('.route-category-list').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-trash'></i></a>`);
});


$('.onscreen_product_main_category_title2').each(function(){
  $(this).prepend(`<div class="onscreen-product-maincategory-title-link2"><a class="adminAddItem" title="Add" href="`+$('.route-category-create').text()+`"onclick="popupmenu('`+$('.route-category-create').text()+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a class="adminDeleteItem" title="Delete" href="`+$(this).attr('data-delete-link')+`"data-msg="This action will delete Main-Category & photos permanently If you are sure about this, then Press OK  or Press Cancel Now"> <i class='fa fa-trash'></i></a>`);
});
// Menu Item
$('.onscreen_product_main_category_menu').each(function(){
  $(this).append(`<a href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"class='onscreen-menu adminEditItem' title="Edit" onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'  style="color: black !important;"></i></a>`);
});

//   $(this).append(`<div class="onscreen-product-detail-slider-thumb"><a href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a href="`+$(this).attr('data-delete-link')+`"data-msg="This action will delete Main-Category & photos permanently If you are sure about this, then Press OK  or Press Cancel Now"> <i class='fa fa-trash'></i></a>`);

$('.my_slider_thumb').each(function(){
  $(this).append(`<span class="deleteImageSlider" data-id="`+$(this).attr('data-delete-link')+`"><i class='fa fa-trash'></i></span>`);
});

$('body').on('click','.adminDeleteItem',function (e) { 
  var mainClass = $(this).parent().parent().parent().attr('class');
  var isClass = 'showIndustriesImg';
  
  if (mainClass.indexOf(isClass) != -1) {
    $(this).parent().parent().parent().addClass('isDelete')
  }
  
  e.preventDefault();
  var msg = $(this).data('msg');
  if(confirm(msg)){
    // location.reload();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      success: function (response) {
        // location.reload();
        toastr.options = {
            "positionClass": "toast-top-center",
            "showEasing": "swing",
            "showMethod": "show",
        };
        toastr.options.timeOut = 3000;
        toastr.options.fadeOut = 3000;
        toastr.success(response.success);
        setTimeout(pageLoadFun, 3000)
        toastr.options.onHidden = function(){
            $.ajax({
               type: "GET",
               url: "{{url('')}}/destorySession",
               success: function(res){
                  location.reload();
               },fail:function(){
                  location.reload();
               }
          });
        };
        
      },
      fail: function(xhr, textStatus, errorThrown){
        toastr.options = {
            "positionClass": "toast-top-center",
            "showEasing": "swing",
            "showMethod": "show",
        };
        toastr.options.timeOut = 3000;
        toastr.options.fadeOut = 3000;
        toastr.options.onHidden = function(){
            $.ajax({
               type: "GET",
               url: "{{url('')}}/destorySession",
               success: function(res){
                location.reload();
               }
          });
        };
        toastr.success("Data Deleted successfully","success");
      }
    });
  }
})
$('.deleteImageSlider').click(function (e) { 
  e.preventDefault();
  if(confirm("This will delete photo Permanently. Do you want to continue?")){
    var url = $(this).attr('data-id');
    $.ajax({
      type: "post",
      url: url,
      success: function (response) {
        location.reload();
      }
    });
  }
  else{
      return false;
  }
});
// Product Photo Image
$('.BigInnerinflatableSub_slider').each(function(){
  $(this).prepend(`<div class="onscreenCmsIconWraper"><div class="onscreen-product-maincategory-title-link3"><a class="adminAddItem" title="Add" href="`+$(this).attr('data-link')+`"onclick="popupmenu('`+$(this).attr('data-link')+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a class="adminEditItem" title="Edit" href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a></div>`);
});


  $('.deleteImage').click(function (e) { 
    e.preventDefault();
    if(confirm("This will delete photo Permanently. Do you want to continue?")){
      
      var url = $(this).parent().parent().parent().children('.slick-current').attr('data-id');
      $.ajax({
        type: "post",
        url: url,
        success: function (response) {
          location.reload();
        }
      });
    }
    else{
        return false;
    }
  
    // alert($(this).parent().parent().parent().children('.slick-current').attr('data-id'));
});


function pageLoadFun() {
  location.reload();
}

// $('.onscreen-product-image').each(function(){
//   $(this).append(`<div class="onscreen-product-image-slider"><a href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-plus'></i></a><a href="`+$(this).attr('data-link')+'&onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a><a href="`+$('.route-category-list').text()+`"onclick="popupmenu('`+$(this).attr('data-link')+'&onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-trash'></i></a>`);
// });

$('.onscreen_top_inflatable').each(function(){
  $(this).append("<a href="+$(this).attr('data-link')+'?onscreenCms=true'+" class='onscreen-edit2'><i class='fa fa-edit'></i></a>");
});

$('.about_part, .our_clients').each(function(){
  $(this).append(`<a style="font-size: 18px !important;" class='onscreen-block adminEditItem' title="Edit" href="`+$(this).attr('data-link')+'?onscreenCms=true'+`"onclick="popupmenu('`+$(this).attr('data-link')+'?onscreenCms=true'+`', 'toolbar=no, location=no',event); return false;"> <i class='fa fa-edit'></i></a>`);
});


$('.testOnload').append("<a href="+$('.testOnload').attr('data-link')+'?onscreenCms=true'+" class='onscreen-logo'><i class='fa fa-edit'></i></a>");


  $('.navbar-brand, .logo-g, .home, .product, .about').each(function(){
    // $(this).child("data-link").hide();
  
  });
  
});
$(document).off('click', '.adminDeleteItem').on('click', '.adminDeleteItem', function(event) {
  popupmenu(link, 'deletemodal', event);
});

function popupmenu(link, type, event) {

  if (event) {
    event.preventDefault();
    event.stopPropagation(); // Prevent any additional handlers from triggering
}

  console.log('Popupmenu function triggered'); // For debugging
  // First fetch request to get the content for #modalBodyContent
  if (type === 'editmodal') {
    // Create a new modal container for the 'edit' modal
    const modalContainer = document.createElement('div');
    modalContainer.classList.add('modal-container');
    modalContainer.style.zIndex = getMaxZIndex() + 1; // Increment zIndex for each new popup
    document.body.appendChild(modalContainer);

    fetch(link)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            modalContainer.innerHTML = `<div >${data}</div>`;
            modalContainer.querySelector('.cmsModal').style.display = 'block';
            initializeDynamicContent();
            const editorElement = modalContainer.querySelector('#editor');
            initializeEditor(editorElement); 
            // initializeEditor();
        })
        .catch(error => {
            console.error('Error loading content:', error);
        });
}
else if(type === 'deletemodal')
{Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    // Perform the delete action if confirmed
    fetch(link, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Content-Type': 'application/json'
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Failed to delete the item.');
      }
      return response.json();
    })
    .then(data => {
      if (data.success) {
        // Show success message using SweetAlert2
        Swal.fire({
          icon: 'success',
          title: 'Deleted!',
          text: data.message,
          timer: 2000, // Auto close after 2 seconds
          showConfirmButton: false
        });
        window.location.reload(); // Optionally reload the page after successful deletion
      } else {
        // Show error message if the server response indicates failure
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: data.message
        });
      }
    })
    .catch(error => {
      // Handle any unexpected errors during the fetch request
   
      console.error('Error deleting item:', error);
    });
  }
});
}
else
{
  fetch(link)
  .then(response => response.text())
            .then(data => {
                document.getElementById('modalBodyContent').innerHTML = data;
                document.getElementById('ajaxModal').style.display = 'block';

                const editorElement = document.querySelector('#ajaxModal #editor'); // Ensure the correct selector
                if (editorElement) {
                    initializeEditor(editorElement);
                }
                initializeDynamicContent();
             
            })
            .catch(error => console.error('Error loading content:', error));
}
 
}

function getMaxZIndex() {
  let maxZIndex = 0;
  const elements = document.querySelectorAll('.modal-container');
  elements.forEach(el => {
      const zIndex = parseInt(window.getComputedStyle(el).zIndex, 10);
      if (!isNaN(zIndex) && zIndex > maxZIndex) {
          maxZIndex = zIndex;
      }
  });
  return maxZIndex;
}

async function initializeEditor(editorElement) {
  
  const { initializeCKEditor } = await import('./ckeditor.js');
  initializeCKEditor(editorElement);
}


function closeModal(modalType) {
  // Select the modal by its class name, which is based on the type
  $('.'+modalType).css("display","none");
  // const modal = document.querySelector(`${modalType}`);
  
  // if (modal) {
  //   modal.style.display = 'none'; // Hide the modal
  // }
}

$(document).ready(function() {
  // Initialize the modal with JavaScript to prevent closing on outside click
  $('#ajaxModal').modal({
      backdrop: 'static',  // Prevent modal from closing when clicking outside of it
      keyboard: false      // Prevent modal from closing when pressing the Esc key
  });

  // Additional logic to prevent modal from closing when clicking outside
  $('#ajaxModal').on('click', function(e) {
      // Check if the target clicked is the modal itself and not the modal content
      if ($(e.target).is('#ajaxModal')) {
          e.stopPropagation();
      }
  });
});


function saveData(event) {
  event.preventDefault(); // Prevent the default form submission
  var form = $('#ajaxForm'); // Select the form
  var formData = new FormData(form[0]); // Create FormData object with the form data

  $.ajax({
      url: form.attr('action'), // Use the form's action attribute
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
          // Handle success
          console.log(response);

        
          console.log('Form submitted successfully.');
          $('#ajaxModal').css('display', 'none'); // Close the modal
          location.reload(); 
          // Optionally, update the content on the main page if needed
      },
      error: function(jqXHR, textStatus, errorThrown) {
          console.log('Error submitting form: ' + textStatus);
      }
  });
}

$(document).ready(function() {
  $(document).on('submit', '#ajaxForm', saveData); // Bind the submit event to the form using event delegation
});



$(document).ready(function () {
  
 


// $(".row_position").sortable({
//     stop: function () {
//         var selectedData = [];
//         $('.row_position>tr').each(function () {
//             selectedData.push($(this).attr("id"));
//         });
//         updateOrder(selectedData);

//         toastr.success('Client Order Updated...');
//     }
// });

// function updateOrder(data) {
//     $.ajax({
//         url: "{{ url('api') }}/admin/item/update-item-priority",
//         type: 'post',
//         data: {
//             position: data,
//             table: 'client'
//         },
//         success: function (result) {
//             console.log(result);
//         },
//         error: function (error) {
//             console.error('Error updating order:', error);
//         }
//     });
// }

  function getOnscreenUrl(url) {
  
      popupmenu(url, 'toolbar=no, location=no', 'left=' + left + ',width=' + popupWinWidth + ',height=860');
  }

  // Bind dynamically if content is loaded via AJAX
  $(document).on('click', '.menu_item_img a', function (e) {
      
      getOnscreenUrl($(this).data('link'));
  });
});


function editclientsubmit(id) {
  var form = document.getElementById('clienteditajax'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  $.ajax({
      type: "POST",
      url: base_url+"/powerup/client/"+id, // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
                        // Close the edit modal
                        $('.modal-container').remove();

                        // Refresh the content of the already open popup or page
                        // If you want to refresh specific content, you can re-fetch it using an AJAX request or reload the page
                        location.reload(); // This will refresh the entire page
                        // OR, you can selectively refresh the content
                        //  $('#contentSection').load(location.href + ' #contentSection');
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },


  });
}

function editpartnersubmit(id) {
  var form = document.getElementById('partnereditajax'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  $.ajax({
      type: "POST",
      url: base_url+"/powerup/partners/update/"+id, // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
                        // Close the edit modal
                        $('.modal-container').remove();

                        // Refresh the content of the already open popup or page
                        // If you want to refresh specific content, you can re-fetch it using an AJAX request or reload the page
                        location.reload(); // This will refresh the entire page
                        // OR, you can selectively refresh the content
                        //  $('#contentSection').load(location.href + ' #contentSection');
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },


  });
}

function editslidersubmit(id) {
  var form = document.getElementById('slideridajax'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  $.ajax({
      type: "POST",
      url: base_url+"/powerup/slider/"+id, // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            // Close the edit modal
            $('.modal-container').remove();

            // Refresh the content of the already open popup or page
            // If you want to refresh specific content, you can re-fetch it using an AJAX request or reload the page
            location.reload(); // This will refresh the entire page
            // OR, you can selectively refresh the content
            // Example: $('#contentSection').load(location.href + ' #contentSection')
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },


  });
}
function editcasestudiesubmit(id) {
  var form = document.getElementById('editcasestudies'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  if (window.globalEditorInstance) {
    const editorData = window.globalEditorInstance.getData(); // Get data from the global editor instance
    formData.append('full_description', editorData); // Append the CKEditor data to the FormData
} else {
    console.error('CKEditor instance not found'); // Log if no instance is found
    return; // Exit the function to prevent submission without editor data
}

  $.ajax({
      type: "POST",
      url: base_url+"/powerup/casestudies/"+id, // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            // Close the edit modal
            $('.modal-container').remove();

            // Refresh the content of the already open popup or page
            // If you want to refresh specific content, you can re-fetch it using an AJAX request or reload the page
            location.reload(); // This will refresh the entire page
            // OR, you can selectively refresh the content
            // Example: $('#contentSection').load(location.href + ' #contentSection')
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },


  });
}
function editindustriessubmit(id) {
  var form = document.getElementById('editindustries'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/industries-update/"+id, // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },


  });
}
function editpagelinksubmit(id) {
  var form = document.getElementById('editlinks'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/block-control/page-links/update/"+id, // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'topRight'
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'topRight'
            });
        }
    },


  });
}


function editblogsubmit(id) {
  var form = document.getElementById('editblogajax'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/blog/update/"+id, // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },


  });
}

function editcategoriessubmit(id) {
  var form = document.getElementById('editCategoryidajax'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  if (window.globalEditorInstance) {
    const editorData = window.globalEditorInstance.getData(); // Get data from the global editor instance
    formData.append('editorContent', editorData); // Append the CKEditor data to the FormData
} else {
    console.error('CKEditor instance not found'); // Log if no instance is found
    return; // Exit the function to prevent submission without editor data
}
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/category/update/"+id, // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },


  });
}


function addslidersubmit() {
  var form = document.getElementById('addsliderajax'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  $.ajax({
      type: "POST",
      url: base_url+"/powerup/slider/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },


  });
}

function addseoajax() {
  var form = document.getElementById('addseoajax'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  $.ajax({
      type: "POST",
      url: base_url+"/powerup/settings/seo-manage-image", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}

function addlogoajax() {
  var form = document.getElementById('addseoajax'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  $.ajax({
      type: "POST",
      url: base_url+"/powerup/settings/seo-manage-image", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}

function customCodeStore() {
  var form = document.getElementById('customCodeStore'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  $.ajax({
      type: "POST",
      url: base_url+"/powerup/custom-code/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,           
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,           
            });
        }
    },
  });
}

function caseStudies() {
  var form = document.getElementById('caseStudies'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  $.ajax({
      type: "POST",
      url: base_url+"/powerup/admin/page-editor/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}

function addcasestudiessubmit() {
  var form = document.getElementById('addcasestudies'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  $.ajax({
      type: "POST",
      url: base_url+"/powerup/casestudies/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },


  });
}
function addindustriessubmit() {
  var form = document.getElementById('addindustires'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/industries-store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}
function addclientsubmit() {
  var form = document.getElementById('addclient'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/client/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}
function addawardsubmit() {
  var form = document.getElementById('addaward'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/award/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}
function addtestimonialsubmit() {
  var form = document.getElementById('createtestimonial'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/testimonials/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}
function addblogsubmit() {
  var form = document.getElementById('addblogajax'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/blog/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}

function addpartnersubmit() {
  var form = document.getElementById('addpartners'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/partners/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}
function addproductsubmit() {
  var form = document.getElementById('adproductsform'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/products/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}

function addvideosubmit() {
  var form = document.getElementById('addvideo'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/video/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}
function addnewslettersubmit() {
  var form = document.getElementById('addnewslettercr'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/newsletter/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}

function addCategorieSubmit() {
  var form = document.getElementById('addCategory'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/category/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}
function editsocialmediasubmit() {
  var form = document.getElementById('socialmediaajax'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/settings/social-media", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}
function editnewslettersubmit(id) {
  var form = document.getElementById('editnewsletter'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/newsletter/update/"+id, // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}
function edittestimonailsubmit(id) {
  var form = document.getElementById('testimonaileditajax'); // Get the form element
  var formData = new FormData(form); 
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/testimonials/update/"+id, // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}

function editawardsubmit(id) {
  var form = document.getElementById('awardeditajax'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  $.ajax({
      type: "POST",
      url: base_url+"/powerup/award/"+id, // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();

            // Refresh the content of the already open popup or page
            // If you want to refresh specific content, you can re-fetch it using an AJAX request or reload the page
            location.reload(); 
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },


  });
}
function editvideosubmit(id) {
  var form = document.getElementById('videoajax'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  $.ajax({
      type: "POST",
      url: base_url+"/powerup/video/update/"+id, // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();

            // Refresh the content of the already open popup or page
            // If you want to refresh specific content, you can re-fetch it using an AJAX request or reload the page
            location.reload(); 
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },


  });
}
function addnewsletter()
{

  $.ajax({
    url: base_url+"/powerup/newsletter/create",
    method: 'get',
  
    processData: false,
    contentType: false,
    success: function(response) {
        // Handle success

        const modalContainer = document.createElement('div');
        modalContainer.classList.add('modal-container');
        modalContainer.style.zIndex = getMaxZIndex() + 1; // Increment zIndex for each new popup
        document.body.appendChild(modalContainer);
        console.log(response);
        modalContainer.innerHTML = `<div >${response}</div>`;
        modalContainer.querySelector('.modal').style.display = 'block';

        // Optionally, update the content on the main page if needed
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log('Error submitting form: ' + textStatus);
    }
});

}


function initializeDynamicContent() {
  // Check if jQuery is loaded
  if (typeof jQuery == 'undefined') {
      // Load jQuery dynamically
      var script = document.createElement('script');
      script.src = "https://code.jquery.com/jquery-3.6.0.min.js";
      document.head.appendChild(script);

      // Wait for jQuery to load, then load jQuery UI
      script.onload = function() {
          loadJQueryUI();
      };
  } else {
      // jQuery is already loaded, directly load jQuery UI
      loadJQueryUI();
  }

  function loadJQueryUI() {
      // Check if jQuery UI is loaded
      if (typeof jQuery.ui == 'undefined') {
          // Load jQuery UI dynamically
          var scriptUI = document.createElement('script');
          scriptUI.src = "https://code.jquery.com/ui/1.12.1/jquery-ui.min.js";
          document.head.appendChild(scriptUI);

          // Optional: Load jQuery UI CSS for styling
          var link = document.createElement('link');
          link.rel = "stylesheet";
          link.href = "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
          document.head.appendChild(link);

          // Wait for jQuery UI to load, then initialize sortable
          scriptUI.onload = function() {
              initializeSortable();
          };
      } else {
          // jQuery UI is already loaded, directly initialize sortable
          initializeSortable();
      }
  }

  function initializeSortable() {
      $(document).ready(function() {
          // Apply sortable to the elements after jQuery UI is loaded
          $(".row_position").sortable({
              stop: function() {
                  var selectedData = [];
                  $('.row_position>tr').each(function() {
                      selectedData.push($(this).attr("id"));
                  });
                  console.log(selectedData);
                  var tableType = $(this).closest('table').data('table');
                console.log("Table Type:", tableType);
                  updateOrder(selectedData,tableType);

                  toastr.success(' Order Updated...');
              }
          });
      });
  }
}




  // Function to update the slider order
  function updateOrder(data,table) {
    let url;
    if (table === 'slider') {
        url = base_url + "/api/admin/slider/update-status";
    } else if (table === 'industries' || table === 'casestudies' || table === 'categories'
      || table === 'clients' || table === 'awards' || table === 'blogs'
      || table === 'case_studies' || table === 'testimonials' || table === 'newsletters'
      || table === 'videos' || table === 'partners' 
    ) {
      url = base_url + "/api/admin/item/update-item-priority"; // Adjust this based on your actual route
  }
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            position: data,
            table: table, // Send the table name
            _token: "{{ csrf_token() }}" // Ensure CSRF token is sent with the request
        },
        success: function(result) {
            iziToast.success({
                title: 'Success',
                message: 'Order Updated..',
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        },
        error: function(xhr, status, error) {
            console.error('Error updating order:', error);
        }
    });
  }

  // Function to update the slider status
  window.updateStatus = function(id,type) {
      $.ajax({
          url:  base_url+"/api/admin/update-status",
          type: 'POST',
          data: {
              id: id,
              table: type,
              _token: "{{ csrf_token() }}" // CSRF token
          },
          success: function(result) {
            iziToast.success({
              title: 'Success',
              message: 'Status Updated..',
              position: 'center',   // Centering the notification
              timeout: 5000,        // Adjust timeout (in milliseconds) as needed
              transitionIn: 'fadeInDown',   // Smooth transition like macOS
              transitionOut: 'fadeOutUp',
              class: 'mac-style-toast',     // Custom class for macOS style
              layout: 2,    
          });

          var checkbox = $('#exampleCheck1');
          var statusText = $('#statusText' + id);
          
          if (checkbox.is(':checked')) {
            checkbox.prop('checked', false);  // Uncheck the checkbox
            statusText.removeClass('badge-success').addClass('badge-danger').text('Inactive');  // Set status to inactive
          } else {
            checkbox.prop('checked', true);  // Check the checkbox
            statusText.removeClass('badge-danger').addClass('badge-success').text('Active');  // Set status to active
          }
              location.reload(); // Reload page after status update
          },
          error: function(xhr, status, error) {
              console.error('Error updating status:', error);
          }
      });
  };


  $(document).on('change', '.category_parent_id', function() {
    console.log("this change");
      var parent = $(this).find(':selected').val();
  
      $.get(base_url+`/api/get/getSubCategories/` + parent, { category_parent_id: parent })
      .done(function(data) {
          if (data.length === 0) {
              $('.sub_category_parent_id').html('<option value="">Select Sub Category</option>');
          } else {
              $('.sub_category_parent_id').empty().append('<option value="">Select Sub Category</option>');
              data.forEach(function(item) {
                  $('.sub_category_parent_id').append(`<option value="${item.id}">${item.name}</option>`);
              });
          }
      });
      
      $('.category_id').val(parent);
  });

  $(document).on('change', '.sub_category_parent_id', function() {
    var parent = $(this).find(':selected').val();

    $.get(base_url+`/api/get/getDepartment/` + parent, { sub_category_parent_id: parent })
    .done(function(data) {
        if (data.length === 0) {
            $('.subcategory2_id').html('<option value="">Select Sub Category2</option>');
        } else {
            $('.subcategory2_id').empty().append('<option value="">Select Sub Category2</option>');
            data.forEach(function(item) {
                $('.subcategory2_id').append(`<option value="${item.id}">${item.name}</option>`);
            });
        }
    });
    
    $('.category_id').val(parent);
});


$(document).on('change', '.subcategory2_id', function() {
  var parent = $(this).find(':selected').val();
  $('.category_id').val(parent);
});


$('.subcategory2_id').on('change', function() {
  var parent = $(this).find(':selected').val();
  $('.category_id').val(parent);
 
});

$(".listing").addClass( "menu-is-opening menu-open");
$(".listing a").addClass( "active-menu");

var dataCounter = 1;
$(document).on('click', '.add-more', function() {
var dataCounter = Number($('.image-container').data('counter') || 1) + 1;
$('.image-container').data('counter', dataCounter);

var data = `
 <div class="row col-sm-12 p-0 image-block mb-3">
     <div class="col-sm-4">
         <input type="file" class="image" name="image[]" required accept="image/png,image/jpeg,image/webp">
     </div>
     <div class="col-sm-4">
         <input type="text" class="form-control title" name="title[]" placeholder="Title">
     </div>
     <div class="col-sm-4 p-0">
         <input type="text" class="form-control alt" name="alt[]" placeholder="Alt Text">
     </div>
 </div>`;
$('.res').append(data);
});


async function updateProductImage(e) {
  e.preventDefault();


  const formData = new FormData();
  formData.append('image_alt', e.target.image_alt.value);
  formData.append('image_title', e.target.image_title.value);

  axios.post(GLOBAL.API + 'media/update-product-image', formData)
  .then(res => {
    if(res.data == 'success'){
      toastr.success('Field Updated...')
        getMedias();
        console.log('done');  
    }
    else if(res.data == 'not-exists'){
      alert('0');

        console.log('file Already deleted');
    }
  })
}

$(document).on('submit', '.update-form', function(e) {
  e.preventDefault();
  var form = $(this);
  var url = form.attr('action');

  $.ajax({
      type: "POST",
      url: url,
      data: form.serialize(),
      success: function(data) {
          toastr.success('Image Field Updated...');
      }
  });
});


$(document).on('click', '.btnDelete', function(e) {
  var url = $(this).attr('data-url');
  var el = $(this);

  $.ajax({
      type: "GET",
      url: url,
      success: function(result) {
          toastr.error('Image Field Deleted...');
          el.closest('.update-form').remove().slideUp(1000);
      },
      error: function() {
          alert('error');
      }
  });
});


function searchphoto() {
  $.ajax({
    type: 'GET',
    url: base_url+'/powerup/dashboard/photo', // Replace with your endpoint
    data: $('#searchphoto').serialize(), // Serialize form data
    success: function(response) {
      // Handle the response, such as updating content or showing a success message
      
      $('#resultssearch').html(response);
      $('.file_input').imageuploadify();
    },
    error: function(error) {
      console.log(error);
      toastr.error('An error occurred while searching.');
    }
  });
}


$(".row_position_photo").sortable({
  stop: function () {
    var selectedData = new Array();
    $('.row_position_photo>form').each(function () {
      selectedData.push($(this).attr("id"));
    });
    updateOrderphoto(selectedData);

  }
});


function updateOrderphoto(data) {
  $.ajax({
    url: base_url + "/api/admin/item/update-item-priority",
    type: 'post',
    data: { position: data, table: 'media' },
    success: function (result) {
      toastr.success('Photo Order Updated...')
      console.log(result);
    }
  })
}


$(document).ready(function() {
  $('#file_input').on('change', function(event) {
      // Prevent default behavior
      event.preventDefault();

      // Create a FormData object from the form
      var formData = new FormData($('#uploadForm')[0]);

      $.ajax({
          url: $('#uploadForm').attr('action'), // The URL to which the request is sent
          type: 'POST', // The type of request (GET or POST)
          data: formData, // The data to send (FormData)
          processData: false, // Prevent jQuery from converting the data
          contentType: false, // Prevent jQuery from setting content type
          success: function(response) {
              // Handle the success response
              toastr.success('Images uploaded successfully.'); // Show a success message
              // Optionally clear the form or handle the response data
              $('#file_input').val(''); // Clear the file input if needed
          },
          error: function(error) {
              // Handle the error response
              console.log(error);
              toastr.error('An error occurred while uploading images.');
          }
      });
  });
});

function uploadiamges() {
  var form = document.getElementById('photoupload'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data

  $.ajax({
      type: "POST",
      url: base_url+"/api/media/upload-multiple-image", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();

            // Refresh the content of the already open popup or page
            // If you want to refresh specific content, you can re-fetch it using an AJAX request or reload the page
            location.reload(); 
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },


  });
}


function searchproduct() {
  $.ajax({
    type: 'GET',
    url: base_url+'/powerup/dashboard/products-list', // Replace with your endpoint
    data: $('#searchproduct').serialize(), // Serialize form data
    success: function(response) {
      // Handle the response, such as updating content or showing a success message
      
      $('#resultproduct').html(response);
      // $('.file_input').imageuploadify();
    },
    error: function(error) {
      console.log(error);
      toastr.error('An error occurred while searching.');
    }
  });
}


//page update code
function updateblogpage() {
  var form = document.getElementById('editblogpage'); // Get the form element
  var formData = new FormData(form); // Create FormData object with form data
  $.ajax({
      type: "POST",
      url: base_url+"/powerup/admin/page-editor/store", // Form action URL
      data: formData, // Form data
      contentType: false, // Let the browser set the content type
      processData: false, // Do not process the data
      success: function(response) {
        if (response.success) { 
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
            $('.modal-container').remove();
            location.reload();
        } else {
            iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'center',   // Centering the notification
                timeout: 5000,        // Adjust timeout (in milliseconds) as needed
                transitionIn: 'fadeInDown',   // Smooth transition like macOS
                transitionOut: 'fadeOutUp',
                class: 'mac-style-toast',     // Custom class for macOS style
                layout: 2,    
            });
        }
    },
  });
}
function removeimage(id, table, field, url) {
  $.ajax({
    type: "POST",
    url: url,
    data: { 'table': table, 'field': field, 'id': id },
    success: function(response) {
      if (response.success) {
        iziToast.success({
          title: 'Success',
          message: response.message,
          position: 'center',
          timeout: 5000,
          transitionIn: 'fadeInDown',
          transitionOut: 'fadeOutUp',
          class: 'mac-style-toast',
          layout: 2,
        });
        $('.modal-container').remove();
        location.reload();
      } else {
        iziToast.error({
          title: 'Error',
          message: response.message,
          position: 'center',
          timeout: 5000,
          transitionIn: 'fadeInDown',
          transitionOut: 'fadeOutUp',
          class: 'mac-style-toast',
          layout: 2,
        });
      }
    },
    error: function() {
      iziToast.error({
        title: 'Error',
        message: 'An error occurred during the request.',
        position: 'center',
      });
    }
  });
}


// Function to update photo details
function updatephoto(imageId) {
  let form = $('#addimageproducts_' + imageId);
  // let url = "{{ route('update.multiple-image-field', ':id') }}".replace(':id', imageId);

  $.ajax({
    url: base_url+"/api/media/update-multiple-image-field/"+imageId,
    type: 'POST',
    data: form.serialize(),
    success: function(response) {
      if (response.success) {
        iziToast.success({
          title: 'Success',
          message: 'Image details updated successfully',
          position: 'center',
          timeout: 3000,
          transitionIn: 'fadeInDown',
          transitionOut: 'fadeOutUp'
        });
      } else {
        iziToast.error({
          title: 'Error',
          message: response.message,
          position: 'center',
          timeout: 3000,
          transitionIn: 'fadeInDown',
          transitionOut: 'fadeOutUp'
        });
      }
    },
    error: function(xhr) {
      iziToast.error({
        title: 'Error',
        message: 'Failed to update image details',
        position: 'center',
        timeout: 3000,
        transitionIn: 'fadeInDown',
        transitionOut: 'fadeOutUp'
      });
    }
  });
}

// Function to delete photo
function deletephoto(imageId) {
  let url = $('.btnDelete[data-id="' + imageId + '"]').data('url');

  if (!confirm('Are you sure you want to delete this image?')) {
    return; // Exit if user cancels
  }
  $.ajax({
    url: base_url+"/api/media/media-delete/"+imageId,
    type: 'DELETE',
    success: function(response) {
      if (response.success) {
        iziToast.success({
          title: 'Success',
          message: 'Image deleted successfully',
          position: 'center',
          timeout: 3000,
          transitionIn: 'fadeInDown',
          transitionOut: 'fadeOutUp'
        });
        $('#addimageproducts_' + imageId).remove(); // Remove the form from DOM
      } else {
        iziToast.error({
          title: 'Error',
          message: response.message,
          position: 'center',
          timeout: 3000,
          transitionIn: 'fadeInDown',
          transitionOut: 'fadeOutUp'
        });
      }
    },
    error: function(xhr) {
      iziToast.error({
        title: 'Error',
        message: 'Failed to delete image',
        position: 'center',
        timeout: 3000,
        transitionIn: 'fadeInDown',
        transitionOut: 'fadeOutUp'
      });
    }
  });
}