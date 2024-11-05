
// video

$(document).ready(function() {
    $("[data-fancybox]").fancybox({
      afterShow: function() {
        // After the show-slide-animation has ended - play the vide in the current slide
       var vid = document.getElementById("myVideo"); 
       vid.play(); 
  
        // Attach the ended callback to trigger the fancybox.next() once the video has ended.
        this.content.find('video').on('ended', function() {
          $.fancybox.next();
        });
      }
    });
  });

  