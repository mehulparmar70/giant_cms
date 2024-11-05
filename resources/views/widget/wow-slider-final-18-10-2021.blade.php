<!DOCTYPE html>
<html>
<head>
	<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
	<link rel="stylesheet" type="text/css" href="{{url('wow-slider')}}/engine1/style.css" />
	<script type="text/javascript" src="{{url('wow-slider')}}/engine1/jquery.js"></script>
	<!-- End WOWSlider.com HEAD section -->
	<style>
	#wowslider-container1 a.ws_next > span:after, #wowslider-container1 a.ws_prev > span:after, #wowslider-container1 .ws_playpause > span:after {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    -webkit-transform: rotateX(
	0deg);
		transform: rotateX(
	0deg);
		background: red;
		color: white;
	}
	#wowslider-container1 .ws-title {
    	left: 8% !important;
	}

	#wowslider-container1 .ws_thumbs{
		height: 15.3em;
	}
	#wowslider-container1 a.ws_next > span:before, #wowslider-container1 a.ws_prev > span:before, #wowslider-container1 .ws_playpause > span:before, #wowslider-container1 a.ws_next > span:after, #wowslider-container1 a.ws_prev > span:after, #wowslider-container1 .ws_playpause > span:after {
   
    background: red;
    color: white;
	}
	#wowslider-container1 .ws_images, #wowslider-container1 .ws_shadow {
    margin-bottom: 15.3em !important ;
}
	#wowslider-container1 .ws_images{
		max-height: 640px !important;
	}
.ws_images{
    border: 4px solid #f82600 !important;
}
.ws-title span{
	color:white !important;
}

	</style>

</head>
<body style="background-color:#d7d7d7;margin:auto">
	
	<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
	<div id="wowslider-container1" style="font-size: 7.26562px; z-index: 0;">
	<div class="ws_images"><ul class="ulclass">
	@foreach($productImages as $productImage)
		<li><img src="{{url('web')}}/media/lg/{{$productImage->image}}"
			title="{{$productImage->image_alt}}" title="{{$productImage->image_title}}" id="wows1_0"/></li>
	@endforeach

	</ul></div>
	<div class="ws_thumbs">
<div style="transition: all 0ms linear 0s;top: -8px;left: 253.5px;margin-top: 10px;">
	
@foreach($productImages as $productImage)
		<a href="#" title="{{$productImage->image_title}}"
		style="
    outline: 4px solid black;
    border-radius: 3px;
    margin: 16px;
"
		><img src="{{url('web')}}/media/lg/{{$productImage->image}}" alt="" /></a>
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