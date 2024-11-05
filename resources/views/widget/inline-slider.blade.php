<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link type="text/css" rel="stylesheet" href="{{url('lightjs')}}/css/lightgallery.css" />

<!-- lightgallery plugins -->
<link type="text/css" rel="stylesheet" href="{{url('lightjs')}}/css/lg-zoom.css" />
<link type="text/css" rel="stylesheet" href="{{url('lightjs')}}/css/lg-thumbnail.css" />


<!-- OR -->

<link type="text/css" rel="stylesheet" href="{{url('lightjs')}}/css/lightgallery-bundle.css" />

    <style>
    body {
  padding: 40px;
  background-image: linear-gradient(#e8f0ff 0%, white 52.08%);
  color: #0e3481;
  min-height: 100vh;
}

.header .lead {
  max-width: 620px;
}

.inline-gallery-container {
  width: 700px;
  height: 500px;
  position: relative;
}


    </style>
</head>
<body>


<div class="header d-flex flex-column align-items-center">
  <h1 class="display-6 mt-3 mb-0">lightGallery</h1>
  <p class="lead mt-2 mb-4">
    lightGallery is a feature-rich, modular JavaScript gallery plugin for building beautiful image and video galleries for the web and the mobile
  </p>
  <a class="btn mb-5 btn-outline-primary" href="https://github.com/sachinchoolur/lightGallery" target="_blank">View on GitHub</a>
</div>
<div class="d-flex justify-content-center">
  <div id="inline-gallery-container" class="inline-gallery-container"></div>
</div>
    
</body>
<script>
   
   const lgContainer = document.getElementById('inline-gallery-container');
const inlineGallery = lightGallery(lgContainer, {
    container: lgContainer,
    dynamic: true,
    // Turn off hash plugin in case if you are using it
    // as we don't want to change the url on slide change
    hash: false,
    // Do not allow users to close the gallery
    closable: false,
    // Add maximize icon to enlarge the gallery
    showMaximizeIcon: true,
    // Append caption inside the slide item
    // to apply some animation for the captions (Optional)
    appendSubHtmlTo: '.lg-item',
    // Delay slide transition to complete captions animations
    // before navigating to different slides (Optional)
    // You can find caption animation demo on the captions demo page
    slideDelay: 400,
    dynamicEl: [
        {
            src: 'img/img1.jpg',
            thumb: 'img/thumb1.jpg',
            subHtml: `<div class="lightGallery-captions">
                <h4>Caption 1</h4>
                <p>Description of the slide 1</p>
            </div>`,
        },
        {
            src: 'img/img2.jpg',
            thumb: 'img/thumb2.jpg',
            subHtml: `<div class="lightGallery-captions">
                <h4>Caption 2</h4>
                <p>Description of the slide 2</p>
            </div>`,
        },
        ...
    ],
});

// Since we are using dynamic mode, we need to programmatically open lightGallery
inlineGallery.openGallery();


setTimeout(() => {
  inlineGallery.openGallery();
}, 200);

</script>
    <script src="{{url('lightjs')}}/js/lightgallery.umd.js"></script>

    <!-- lightgallery plugins -->
    <script src="{{url('lightjs')}}/js/plugins/lg-thumbnail.umd.js"></script>
    <script src="{{url('lightjs')}}/js/plugins/lg-zoom.umd.js"></script>

</html>