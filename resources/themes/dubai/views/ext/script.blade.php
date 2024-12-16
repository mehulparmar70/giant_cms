

    @if(session('LoggedUser'))
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.css">
 

     <!-- CODROP SLIDER CSS SETTINGS -->
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
   
    <script type="importmap">
            {
                "imports": {
                    "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.js",
                    "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.1.0/"
                }
            }
        </script>

        <link rel="stylesheet" href="{{asset('/')}}/dubai/css/popup.css">
     <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/super-build/ckeditor.js"></script>


         <!-- jquery library --> 

    @endif
    <script src="{{asset('/')}}dubai/js/jquery-3.7.1.min.js" ></script>
    <!-- vendor js -->
    <script src="{{asset('/')}}dubai/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/')}}dubai/js/owl.carousel.min.js"></script>
    <script src="{{asset('/')}}dubai/js/scrollspy.js"></script>
    <script src="{{asset('/')}}dubai/js/wow.min.js"></script>
    <script src="{{asset('/')}}dubai/js/wowjs-repeat-animation.js"></script>
    <script src="{{asset('/')}}dubai/js/anime.min.js"></script>
    <script src="{{asset('/')}}dubai/js/fancybox.umd.js"></script>
    <script src="{{asset('/')}}js/jquery-slide-menu.js"></script>
    <!-- CODROP SLIDER SCRIPTS  -->
    <script type="text/javascript" src="{{asset('/')}}dubai/js/imagesloaded.pkgd.min.js" ></script>
    <script type="text/javascript" src="{{asset('/')}}dubai/js/TweenMax.min.js" ></script>
    <script type="text/javascript" src="{{asset('/')}}dubai/js/demo.js" ></script>
    <!-- theme script --> 

    






@if(session('LoggedUser'))
    
<script src="{{asset('/')}}gii/js/bootstrap.min.js"></script>

<script src="{{asset('/')}}/js/custom.js"></script>
<script src="{{asset('/')}}/dist/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

<link rel="stylesheet" href="{{url('/')}}/drag-drop/dist/imageuploadify.min.css">
<script src="{{asset('/')}}drag-drop/dist/imageuploadify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazyloadjs/3.2.2/lazyload.min.js" integrity="sha512-3WLY2nDlx1c6leUk3gyqneF+bWq4Ub/HsGjmJoo7qRlMFMXcOwzw6gqf+PwKLzd/TUjWlpSaHBy6L6o1hS2y9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('/')}}js/ckeditor.js" rel="stylesheet"></script>
  <script src="{{asset('/')}}js/onscreen-cms.js" rel="stylesheet"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/super-build/ckeditor.js"></script>
  <link rel="stylesheet" href="{{url('/')}}/plugins/summernote/summernote-bs4.min.css">
@endif



<script src="{{asset('/')}}dubai/js/scripts.js"></script> 
   

    
<script>
  

$(".contact-submission").submit(function(e) {
// alert('clicked');
e.preventDefault(); // prevent actual form submit
// alert('clicked');
var form = $(this);
var url = form.attr('action'); //get submit url [replace url here if desired]

// $("#modalForm").trigger("reset");


$.ajax({
     type: "POST",
     url: url,
     data: form.serialize(), // serializes form input
     success: function(res){
      
      if(res == 'success'){
        window.location = "{{route('thankyou')}}";
      }else{
        alert('Something went wrong! Please refresh page and try it again...');
      }

     }
});
});

$(document).mouseup(function (e) {
if ($(e.target).closest(".top-form").length === 0) {
      $(".top-form").hide();
}

});

$('.navbar-toggler').click(function (e) { 
  // alert('menu');
  $('.top-form').hide();
  $('#navbarNav').toggle();

  // alert($('.navbar-toggler').height());
});

$('.two_controls').click(function (e) { 

  // $('#navbarNav').toggle();
});

$('#open_btn').click(function (e) { 
  e.preventDefault();
  // alert('opem');
  $('.navbar-toggler').hide();
  $('.enquiry_form_modal').show();
});

// $('.active').parent('.subMenu').css('display', 'block');
// $( ".active" ).parent( ".subMenu" ).css( "background", "yellow" );

$('.activeMenu').parents().eq(2).css({
          "display" : "block",
          "border" : "1px solid white"
      });
      
  $('.activeMenu').parents().eq(3).children('.item').addClass("active");

</script>

<?php

$footerCode = DB::table('custom_codes')->where('type', 'footer-code')->first();
echo $footerCode->description;

?>
@if(Session::get('success'))
  <script>
    $(function() {
      // alert();
      /*var Toast = Swal.mixin({
        toast: true,
        // position: 'bottom',
        showConfirmButton: false,
        timer: 3000
      });*/
    });
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
            
           }
      });
    };
    toastr.success(`{{ Session::get('success')}}`);
  </script>

  @if(Session::get('close'))
    <script>
      setTimeout(myGreeting, 5000);
      function myGreeting() {
        // window.top.close();
        $('.onscreenCloseBtn').trigger("click");
      }
    </script>
  @endif

@elseif(Session::get('fail'))

<script>
    $(function() {
      /*var Toast = Swal.mixin({
        toast: true,
        // position: 'bottom',
        showConfirmButton: false,
        timer: 3000
      });*/
    });
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
            
           }
      });
    };
    toastr.error(`{{Session::get('fail')}}`);
  </script>

@endif
