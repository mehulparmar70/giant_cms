<link href="https://www.cssscript.com/demo/sticky.css" rel="stylesheet" type="text/css">
<link type="text/css" rel="stylesheet" href="<?=SITEURL?>css/lightgallery-bundle.css" />
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/css/justifiedGallery.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.css'>


<style>
    body {
    font-family: 'Montserrat-Regular'!important; 
    font-size: inherit !important;
    font-weight: inherit !important;
    background-color: #121212 !important;
    }
    a {
    text-decoration: none !important;
}
</style>
<div class="mygallery" style="display:none;">
  <div class="tn3 album">
    
    <ol>
      <?php

$dir = UPLOAD_FILEPATH_PHOTO_IMAGES;

$pc1_title=photoCategoryTitle($pageAlias[2]); 

$dir = $dir.$pc1_title;

$pp1_title=photoProjectTitle($pageAlias[3]); 

$dir = $dir."/".$pp1_title;



//$dir = UPLOAD_FILEPATH_PHOTO_IMAGES.$pc_title."/".$pp_title ;



				$dirContents = scandir($dir);

				$count = 0;

				foreach($dirContents as $image) {

					if (isImageFile($image)) {

					  

						$path1 = READ_FILEPATH_PHOTO_IMAGES.$pc1_title."/";

						$pp_title =$pp1_title .'/';

						$imgName = $image ; ?>
      <li>
        <h4>
          <?=$pp1_title?>
        </h4>
        <div class="tn3 description">
          <?=$imgName?>
        </div>
        <a href="<?=SITEURL?><?=$path1?><?=$pp_title?><?=$imgName?>"> <img src="<?=SITEURL?><?=$path1?><?=$pp_title?><?=$imgName?>" style="height:235px;" /> </a> </li>
      <?php	 $count++;

						

					}

				} ?>
    </ol>
  </div>
</div>


<div class="">
  <div class="justify-content-center">
    <div class="col ">
      <div class="gallery-container" id="animated-thumbnails-gallery">
          
          <?php

$dir = UPLOAD_FILEPATH_PHOTO_IMAGES;

$pc1_title=photoCategoryTitle($pageAlias[2]);

//$pc1_title=$pageAlias[2];

$dir = $dir.$pc1_title;

$pp1_title=photoProjectTitle($pageAlias[3]); 

//$pp1_title=$pageAlias[3];

$dir = $dir."/".$pp1_title;



//$dir = UPLOAD_FILEPATH_PHOTO_IMAGES.$pc_title."/".$pp_title ;



				$dirContents = scandir($dir);

				$count = 0;

				foreach($dirContents as $image) {

					if (isImageFile($image)) {

					  

						$path1 = READ_FILEPATH_PHOTO_IMAGES.$pc1_title."/";

						$pp_title =$pp1_title .'/';

						$imgName = $image ; ?>
        <a data-lg-size="1600-1067" class="gallery-item" data-src="<?=SITEURL?><?=$path1?><?=$pp_title?><?=$imgName?>" data-sub-html="<h4><?=$imgName?></h4>">
          <img alt="<?=$imgName?>" class="img-responsive" src="<?=SITEURL?><?=$path1?><?=$pp_title?><?=$imgName?>" />
        </a>
        <?php	 $count++;

						

					}

				} ?>
        
      </div>
    </div>
  </div>
</div>




<script src='https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.js'></script>
<script src='https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/js/jquery.justifiedGallery.js'></script>
<script src="https://www.cssscript.com/demo/responsive-lightbox-gallery-pure-javascript-css3-lightgallery/lightgallery.umd.js"></script>
<script src="https://www.cssscript.com/demo/responsive-lightbox-gallery-pure-javascript-css3-lightgallery/plugins/autoplay/lg-autoplay.umd.js"></script>
<script src="https://www.cssscript.com/demo/responsive-lightbox-gallery-pure-javascript-css3-lightgallery/plugins/comment/lg-comment.umd.js"></script>
<script src="https://www.cssscript.com/demo/responsive-lightbox-gallery-pure-javascript-css3-lightgallery/plugins/fullscreen/lg-fullscreen.umd.js"></script>
<script src="https://www.cssscript.com/demo/responsive-lightbox-gallery-pure-javascript-css3-lightgallery/plugins/hash/lg-hash.umd.js"></script>
<script src="https://www.cssscript.com/demo/responsive-lightbox-gallery-pure-javascript-css3-lightgallery/plugins/pager/lg-pager.umd.js"></script>
<script src="https://www.cssscript.com/demo/responsive-lightbox-gallery-pure-javascript-css3-lightgallery/plugins/rotate/lg-rotate.umd.js"></script>
<script src="https://www.cssscript.com/demo/responsive-lightbox-gallery-pure-javascript-css3-lightgallery/plugins/share/lg-share.umd.js"></script>
<script src="https://www.cssscript.com/demo/responsive-lightbox-gallery-pure-javascript-css3-lightgallery/plugins/thumbnail/lg-thumbnail.umd.js"></script>
<script src="https://www.cssscript.com/demo/responsive-lightbox-gallery-pure-javascript-css3-lightgallery/plugins/video/lg-video.umd.js"></script>
<script src="https://www.cssscript.com/demo/responsive-lightbox-gallery-pure-javascript-css3-lightgallery/plugins/zoom/lg-zoom.umd.js"></script>
<script>jQuery("#animated-thumbnails-gallery").
justifiedGallery({
  captions: true,
  //lastRow: "hide",
  rowHeight: 180,
  margins: 5 }).

on("jg.complete", function () {
  window.lightGallery(
  document.getElementById("animated-thumbnails-gallery"),
  {
    galleryId: "nature",
    plugins: [lgAutoplay, lgComment, lgFullscreen, lgHash, lgPager, lgRotate, lgShare, lgVideo, lgZoom, lgThumbnail],
 });



});
</script>








