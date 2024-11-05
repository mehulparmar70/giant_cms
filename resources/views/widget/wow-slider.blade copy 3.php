<!DOCTYPE html>
<html>
<head>
	<title>Image carousel</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Made with WOW Slider - Create beautiful, responsive image sliders in a few clicks. Awesome skins and animations. Image carousel" />
	
	<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
	<link rel="stylesheet" type="text/css" href="{{url('wow-slider')}}/engine1/style.css" />
	<script type="text/javascript" src="{{url('wow-slider')}}/engine1/jquery.js"></script>
	<!-- End WOWSlider.com HEAD section -->

</head>
<body style="background-color:#d7d7d7;margin:auto">
	
	<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul class="ulclass">
	@foreach($productImages as $productImage)
		<li><img src="{{url('web')}}/media/lg/{{$productImage->image}}" alt="horse1" title="horse1" id="wows1_0"/></li>
	@endforeach

	</ul></div>
	<div class="ws_thumbs">
<div>
	
@foreach($productImages as $productImage)
		<a href="#" title="horse1"><img src="{{url('web')}}/media/lg/{{$productImage->image}}" alt="" /></a>
@endforeach

</div>

</div>
<div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.net">image carousel</a> by WOWSlider.com v9.0m</div>
	<div class="ws_shadow"></div>
	</div>	
	<script type="text/javascript" src="{{url('wow-slider')}}/engine1/wowslider.js"></script>
	<script type="text/javascript" src="{{url('wow-slider')}}/engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section -->

</body>
</html>