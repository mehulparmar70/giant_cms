<!DOCTYPE HTML>
<html>
  <head>
  {{-- Try to load 'head' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.head', 'ext.head'])

    {{-- Additional theme-specific CSS --}}
    @yield('addon-css')

    @if($redirectUrl)
    <script type="text/javascript">
      // Set the countdown time (3 seconds in this case)
      var countdownTime = 10;
      
      // Function to update the countdown every second
      function updateCountdown() {
          if (countdownTime > 0) {
              countdownTime--;
              document.getElementById("countdown").textContent = countdownTime + " Sec";
          } else {
            window.location.href = "{{ $redirectUrl }}"; // Redirect to the homepage
          }
      }

      // Update the countdown every 1 second (1000ms)
      setInterval(updateCountdown, 1000);
  </script>
  @endif
  </head>
  <body>
  <?php $current_page = ''; 
    $productLink = App\Models\admin\UrlList::find(96);  // Our Products link
    $homeLink = App\Models\admin\UrlList::find(95);  // Home link
    $contactLink = App\Models\admin\UrlList::find(101);  // Contact Us link
    ?>
    
    {{-- Try to load 'header-sports-vertical' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.header-sports-vertical', 'ext.header-sports-vertical'])

    {{-- Main content of the page --}}
        <!-- banner area part -->
        <section class="error-banner-section common-inner-banner header-top-space position-relative">
          <div class="container">
            <div class="error-content pt-4 text-center wow zoomIn" data-wow-offset="100">
            <h1 class="h3">
              <span>Thank you!</span> Your inquiry has been <span>successfully submitted,</span> <br>
              and we will get back to you within 24 hours. <br>
              Redirecting you to the <span>HOME</span> page shortly...
              <img class="d-block mx-auto mt-md-4 mt-2 mb-md-1" src="{{asset('/')}}/dubai/images/home-big-icon.jpg" alt="home-icon">
              <span id="countdown">in 10 Sec</span>
            </h1>

            </div>
            <div class="contact-section position-relative pt-4">
              <div class="d-flex flex-sm-nowrap flex-wrap justify-content-center gap-md-4 gap-3">
                <div class="share-concept-form-box wow flipInY" data-wow-offset="100">
                  <img class="w-full" src="{{asset('/')}}/dubai/images/share-concept.png" alt="share-concept">
                  @include('widget.contact-form1')
                </div>
                <div class="contact-links-box text-center wow flipInY" data-wow-offset="100">
                  <p>Award Winning Inflatable Designer & Manufacturer</p>
                  <img src="{{asset('/')}}/dubai/images/logo.svg" alt="logo">
                  <div class="mt-sm-4 mt-2 mb-2">
                    <a class="contact-link" href="tel:+919429613531"><img src="{{asset('/')}}/dubai/images/phone-icon.svg" alt="phone-icon"> +91 87587 13931</a>
                  </div>
                  <div class="mb-sm-4 mb-2">
                    <a class="contact-link" href="mailto:sales@giantinflatables.ae"><img src="{{asset('/')}}/dubai/images/mail-icon.svg" alt="mail-icon"> sales@giantinflatables.ae</a>
                  </div>
                  <div class="mb-2">
                    <a class="contact-social-link" href="#" target="_blank"><img src="{{asset('/')}}/dubai/images/facebook.png" alt="facebook-icon"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      @includeFirst(['theme::ext.footer', 'ext.footer'])
  
    </div>
    <!-- Modal -->
 

    @includeFirst(['theme::ext.script', 'ext.script'])
  </body>
</html>
