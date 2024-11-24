<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    
<meta name="description" content="@if(isset($pageData['meta_description'])){{$pageData['meta_description']}}@endif">
<meta name="keywords" content="@if(isset($pageData['meta_keyword'])){{$pageData['meta_keyword']}}@endif">
<title>@if(isset($pageData['meta_title'])){{$pageData['meta_title']}}@endif</title>

<meta itemprop="name" content="@if(isset($pageData['meta_title'])){{$pageData['meta_title']}}@endif">
<meta itemprop="description" content="@if(isset($pageData['meta_description'])){{$pageData['meta_description']}}@endif">


@if(isset($pageData->image))

  <meta itemprop="image" content="{{asset('/')}}/images/{{$pageData->image}}">
@elseif(isset($pageData['featured_image']))
  <meta itemprop="image" content="{{asset('/')}}/images/{{$pageData['featured_image']}}">
@else
  <meta itemprop="image" content="{{asset('/')}}/img/{{getWebsiteOptions()['website_logo']->option_value}}">
@endif

<meta property="og:type" content="article" />
<meta property="og:title" content="@if(isset($pageData['meta_title'])){{$pageData['meta_title']}}@endif" />

<meta property="og:image:type" content="image/jpeg" />
<meta property="og:url" content="{{ Request::url() }}" />
@if(isset($pageData['featured_image']))
  <meta property="og:image" content="{{asset('/')}}/images/{{$pageData['featured_image']}}" />
@else
  <meta property="og:image" content="{{asset('/')}}/img/{{getWebsiteOptions()['website_logo']->option_value}}" />
@endif

<meta property="og:image:width" content="730" />
<meta property="og:image:height" content="548" />
<meta property="og:description" content="@if(isset($pageData['meta_description'])){{$pageData['meta_description']}}@endif" />
<meta property="og:site_name" content="https://www.giantinflatables.in" />
<meta name="csrf-token" content="{{ csrf_token() }}" />

	  
@if($pageData['search_index'] == 1 && $pageData['search_follow'] == 1)
  <meta name="robots" content="index,follow">
@elseif($pageData['search_index'] == 1 && $pageData['search_follow'] == 0)
  <meta name="robots" content="index,nofollow">
@elseif($pageData['search_index'] == 0 && $pageData['search_follow'] == 0)
  <meta name="robots" content="noindex,nofollow">
@elseif($pageData['search_index'] == 0 && $pageData['search_follow'] == 1)
  <meta name="robots" content="noindex,follow">
@endif


@if(isset($pageData['canonical_url']))
  <link rel="canonical" href="{{$pageData['canonical_url']}}" />
@else
  <link rel="canonical" href="{{ Request::url() }}" />
@endif

<!-- iziToast CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">

  <link rel="shortcut icon" href="{{asset('/')}}images/{{getWebsiteOptions()['website_favicon']->option_value}}" type="image/x-icon">
  <link rel="icon" type="image/png" href="{{asset('/')}}images/{{getWebsiteOptions()['website_favicon']->option_value}}" /> 
  <!-- vendor css -->
  <link href="{{url('/')}}/dubai/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{url('/')}}/dubai/css/owl.carousel.min.css" rel="stylesheet" />
  <link href="{{url('/')}}/dubai/css/animate.css" rel="stylesheet">
  <!-- CODROP SLIDER CSS SETTINGS -->
  <link rel="stylesheet" type="text/css" href="{{url('/')}}/dubai/css/base.css" media="screen" />
  <!-- theme stylesheet -->
  <link href="{{url('/')}}/dubai/css/style.css" rel="stylesheet" />
  <link href="{{url('/')}}/dubai/css/responsive.css" rel="stylesheet" />
  


  <link rel="stylesheet" href="{{asset('/')}}css/bootstrap.css">

    <link rel="stylesheet" href="{{asset('/')}}/front/css/style.css">

    <link rel="stylesheet" href="{{asset('/')}}/front/css/responsive.css">
    <!-- <link rel="stylesheet" href="{{asset('/')}}/front/css/slick.css"> -->
    <link rel="stylesheet" href="{{asset('/')}}/front/css/slick.css">
    <link rel="stylesheet" href="{{asset('/')}}/front/css/slick-theme.css">
    <link rel="stylesheet" href="{{asset('/')}}/front/fonts/fonts.css">
    <link rel="stylesheet" href="{{asset('/')}}/front/css/fancybox.css">
    <!-- <link rel="stylesheet" href="{{asset('/')}}/plugins/toastr/toastr.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<?php

  $headerCode = DB::table('custom_codes')->where('type', 'header-code')->first();
  echo $headerCode->description;
?>
