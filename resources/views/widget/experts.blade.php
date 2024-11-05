

<div class="gray_blk">

  <div class="gray_item">

    <h2>WE'RE AVAILABLE</h2>

    <p>

      <i class="fa fa-mobile" aria-hidden="true"></i

      ><a href="tel:{{getSocialMedia()->phone}}" class="call">{{getSocialMedia()->phone}}</a>

    </p>

  </div>

  <div class="gray_item">

    <h2>We're social

      @if(session('LoggedUser'))

        <div class="social_footer text-center d-block"

            

            @if(session('LoggedUser'))

              data-link="{{route('setting.social-media')}}"

            @endif

            > 

      @endif

    </h2>

    <span class="social-icon">

      @if(isset(getSocialMedia()->youtube))

      <a href="{{getSocialMedia()->youtube}}"><img src="{{url('/')}}/images/youtube.png" alt="YouTube" /></a>

      @endif

      @if(isset(getSocialMedia()->linkedin))

      <a href="{{getSocialMedia()->linkedin}}"><img src="{{url('/')}}/images/pip.png" alt="Linkedin" /></a>

      @endif

      @if(isset(getSocialMedia()->twitter))

      <a href="{{getSocialMedia()->twitter}}"><img src="{{url('/')}}/images/twitter.png" alt="Twitter" /></a>

      @endif

      @if(isset(getSocialMedia()->facebook))

      <a href="{{getSocialMedia()->facebook}}"><img src="{{url('/')}}/images/fb.png"alt="Faceebook"/></a>

      @endif

    </span> 

  </div>

  <div class="gray_item">

    <h2>WE'RE AVAILABLE</h2>

    <p>

      <i class="fa fa-envelope-o"></i><a href="mailto: {{getSocialMedia()->email}}" class="mail" >{{getSocialMedia()->email}}</a>

    </p>

  </div>

</div>