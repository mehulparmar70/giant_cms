
<form action="{{route('send-contact')}}" method="post" class="share-concept-form ms-2">
  @csrf
  <input type="hidden" name="token_response" class="token_response">

  <div class="share-concept-field d-flex align-items-start">
    <div class="share-concept-icon d-flex align-items-center justify-content-center">
      <img src="{{asset('/')}}/dubai/images/user-icon.svg" alt="user icon">
    </div>
    <input class="share-concept-form-input" type="text" name="name" placeholder="Name" required>
  </div>

  <div class="share-concept-field d-flex align-items-start">
    <div class="share-concept-icon d-flex align-items-center justify-content-center">
      <img src="{{asset('/')}}/dubai/images/phone-icon.svg" alt="phone icon">
    </div>
    <input class="share-concept-form-input" type="tel" name="phone" placeholder="Phone Number">
  </div>

  <div class="share-concept-field d-flex align-items-start">
    <div class="share-concept-icon d-flex align-items-center justify-content-center">
      <img src="{{asset('/')}}/dubai/images/mail-icon.svg" alt="mail icon">
    </div>
    <input class="share-concept-form-input" type="email" name="email" placeholder="Email">
  </div>

  <div class="share-concept-field d-flex align-items-start">
    <div class="share-concept-icon d-flex align-items-center justify-content-center">
      <img src="{{asset('/')}}/dubai/images/country-glob-icon.svg" alt="country icon">
    </div>
    <select class="share-concept-form-input" name="country">
      <option value="">Select Country</option>
      <option value="Dubai">Dubai</option>
      <option value="America">America</option>
    </select>
  </div>

  <div class="share-concept-field d-flex align-items-start">
    <div class="share-concept-icon d-flex align-items-center justify-content-center">
      <img src="{{asset('/')}}/dubai/images/message-icon.svg" alt="message icon">
    </div>
    <textarea class="share-concept-form-input" name="message" placeholder="Share Your Inflatables Requirement"></textarea>
  </div>

  <div class="share-concept-field d-flex justify-content-center mb-0">
  <div class="cf-turnstile"
                 data-sitekey="{{ config('services.cloudflare.turnstile.site_key') }}"
                 data-callback="onTurnstileSuccess"
            ></div>
    <!-- <img src="{{asset('/')}}/dubai/images/captcha-image.jpg" alt="captcha-image"> -->
  </div>

  <div class="share-concept-field text-center share-concept-info mb-4">
    <strong>We do not sell or rent your information.</strong>
    {{ Session::get('success') }}
  </div>

  <div class="text-center">
    <button class="btn btn-animation--infinity" type="submit">SUBMIT</button>
  </div>
</form>
