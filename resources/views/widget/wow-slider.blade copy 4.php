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

.magnify-header .magnify-toolbar {
  background-color: rgba(0, 0, 0, .5);
}
.magnify-stage {
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  border-width: 0;
}
.magnify-footer{
  bottom:10px;
}
.magnify-footer .magnify-toolbar {
  background-color: rgba(0, 0, 0, .5);
  border-radius: 5px;
}
.magnify-loader{
  background-color: transparent;
}
.magnify-header,.magnify-footer{
  pointer-events: none;
}
.magnify-button{
  pointer-events: auto;
}

/* ---------------------------------
   Example Styles 
   --------------------------------- */
html,body{
  min-height:100%;
}
.image-set{
}
.image-set img{
  display:block;
}
.image-set a{
  display:inline-block;
  transition:border-color .3s ease
}
.image-set a:hover{
  border-color:#aaa;
}



/* ---------------------------------
   Example Styles 
   --------------------------------- */
   html,body{
  min-height:100%;
}
.image-set{
  margin-left:-5px;
  margin-right:-5px;
}
.image-set img{
  display:block;
}
.image-set a{
  display:inline-block;
  margin-left:5px;
  margin-right:5px;
  padding:2px;
  border:1px solid #ddd;
  transition:border-color .3s ease;
}
.image-set a:hover{
  border-color:#aaa;
}

.magnify-title a {
  color: #fff;
}
	</style>

</head>
<body style="background-color:#d7d7d7;margin:auto">
	
	<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
	<div id="wowslider-container1" style="font-size: 7.26562px; z-index: 0;">
	<div class="ws_images image-set">
		<div>
			<ul class="ulclass">
	@foreach($productImages as $productImage)

	<li>
				<img data-magnify="gallery" 
          data-src="{{url('web')}}/media/lg/{{$productImage->image}}"
         src="{{url('web')}}/media/lg/{{$productImage->image}}"
				title="{{$productImage->image_alt}}" title="{{$productImage->image_title}}" id="wows1_0"/>
			</li>
			
	@endforeach
	</ul>
		</div>
</div>
	<div class="ws_thumbs">
<div style="transition: all 0ms linear 0s;top: -8px;left: 253.5px;margin-top: 10px;">
	
@foreach($productImages as $productImage)
		<a href="#" title="{{$productImage->image_title}}"
		style="
    outline: 4px solid black;
    border-radius: 3px;
    margin: 16px;
" class="justified-gallery"
		><img src="{{url('web')}}/media/lg/{{$productImage->image}}" alt="" /></a>
@endforeach

</div>
</div>
</div>	

<h3>Example with default options:</h3>
<div class="image-set">
    <a data-magnify="gallery" data-caption="<a href='https://farm5.staticflickr.com/4267/34162425794_1430f38362_z.jpg'>查看大图</a>" href="https://farm5.staticflickr.com/4267/34162425794_1430f38362_z.jpg">
        <img src="https://farm5.staticflickr.com/4267/34162425794_1430f38362_s.jpg" alt="">
    </a>
    <a data-magnify="gallery" data-caption="<a href='https://farm1.staticflickr.com/4160/34418397675_18de1f7b9f_z.jpg'>查看大图</a>" href="https://farm1.staticflickr.com/4160/34418397675_18de1f7b9f_z.jpg">
        <img src="https://farm1.staticflickr.com/4160/34418397675_18de1f7b9f_s.jpg" alt="">
    </a>
    <a data-magnify="gallery" data-caption="<a href='https://farm1.staticflickr.com/512/32967783396_a6b4babd92_z.jpg'>查看大图</a>" href="https://farm1.staticflickr.com/512/32967783396_a6b4babd92_z.jpg">
        <img src="https://farm1.staticflickr.com/512/32967783396_a6b4babd92_s.jpg" alt="">
    </a>
</div>
								
	<script type="text/javascript" src="{{url('wow-slider')}}/engine1/wowslider.js"></script>
	<script type="text/javascript" src="{{url('wow-slider')}}/engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section -->

	<!-- <script src="{{url('magnify')}}/dist/jquery.magnify.js"></script> -->
  <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
  <script src="{{url('magnify')}}/dist/jquery.magnify.js"></script>

  <script type="text/javascript" src="https://codepen.io/nzbin/pen/ypVLXR.js"></script>

  <script type="text/javascript">



$('[data-magnify=gallery]').magnify({
		resizable: false,
		headerToolbar: [
			'close'
		],
		initMaximized: true
		})
  	// $('.Innerinflatables_slider').slick({
    //   arrows: true,
    //   infinite: true,
    //   speed:300,
    //   autoplay: true,
    //   slidesToShow:3,
    //   slidesToScroll:1,
    //   centerPadding: '50px',
    //   centerMode: false,
    //   responsive: [
       
    //     {
    //       breakpoint:1200,
    //       settings: {
    //         slidesToShow:2
    //       }
    //     },
    //     {
    //       breakpoint:1000,
    //       settings: {
    //         slidesToShow:1,
    //   		arrows: true

    //       }
    //     },
    //     {
    //       breakpoint: 767,
    //       settings: {
    //         arrows: true,
    //         centerPadding: '40px',
    //         slidesToShow: 1
    //       }
    //     }
    //   ]
    // });  

    // $('.ExploreNowslider').slick({
    //   arrows: true,
    //   infinite: true,
    //   speed:300,
    //   autoplay: true,
    //   slidesToShow:5,
    //   slidesToScroll:1,
    //   centerPadding: '20px',
    //   centerMode: false,
    //   responsive: [
       
    //     {
    //       breakpoint:1200,
    //       settings: {
    //         slidesToShow:3
    //       }
    //     },
    //     {
    //       breakpoint:1000,
    //       settings: {
    //         slidesToShow:2
    //       }
    //     },
    //     {
    //       breakpoint:767,
    //       settings: {
    //         arrows: true,
    //         centerPadding: '40px',
    //         slidesToShow: 1
    //       }
    //     }
    //   ]
    // });  




	</script>
</body>
</html>