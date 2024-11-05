<style>
#wowslider-container1 {
    z-index: 0;   
    max-height: 400px;
    height: 400px; 
}
</style>
	<link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="{{url('wow-slider')}}/engine1/jquery.js"></script>
	
	<div id="wowslider-container1" class="mb-3" style="400px !important">
	<div class="ws_images"><ul class="ulclass">

    @foreach($productImages as $productImage)
		<li><img src="{{url('web')}}/media/lg/{{$productImage->image}}" /></li>
    @endforeach

    </ul></div>
	<div class="ws_thumbs">
<div>
    
@foreach($productImages as $productImage)
		<a href="#"><img src="{{url('web')}}/media/lg/{{$productImage->image}}" alt="" /></a>
@endforeach
    
    </div>
</div>
<div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.net">bootstrap slideshow</a> by WOWSlider.com v9.0m</div>
	<div class="ws_shadow"></div>
	</div>	
	<script type="text/javascript" src="{{url('wow-slider')}}/engine1/wowslider.js"></script>
	<script type="text/javascript" src="{{url('wow-slider')}}/engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section -->
