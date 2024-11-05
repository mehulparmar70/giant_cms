<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Giant Industrial Inflatables Admin Panel</title>
 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/summernote/summernote-bs4.min.css">

	<!-- <link rel="stylesheet" href="{{url('/')}}/plugins/toastr/toastr.min.css"> -->
    <link rel="stylesheet" href="{{url('/')}}/dist/css/custom.css">

  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;600&family=Rasa:wght@300;400;700&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;600&family=Hind+Vadodara:wght@300&family=Kumar+One+Outline&family=Rasa:wght@300;400;700&display=swap" rel="stylesheet"> 

	@yield('custom-css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake"  
    src="{{url('sardar')}}/img/{{getWebsiteOptions()['website_favicon']->option_value}}"
    height="60" width="60">
      

  </div>


    @include('ext.header')
    @include('ext.sidebar')
    
	@yield('content')
    @include('ext.footer')

</div>

@include('ext.script')


@yield('toast')

@if(isset($_REQUEST['onscreenCms']) && $_REQUEST['onscreenCms'] == true)
<script>
// $('body').hide();
// $('.main-header, .breadcrumb , .main-footer, .main-sidebar').remove();
$('aside, .main-header, .breadcrumb , .main-footer').hide();
$('.content-wrapper').css({'margin-left': '0px'});

// alert("You are now leaving, are you sure?");
window.onbeforeunload = function(){
  // alert("You are now leaving, are you sure?")
}

</script>
@endif
@yield('custom-js')


</body>

</html>
