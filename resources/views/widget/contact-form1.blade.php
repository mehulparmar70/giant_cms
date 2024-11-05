<form action="{{route('send-contact')}}" method="post">
  @csrf
  <input type="hidden" name="token_response" class="token_response">
  <div class="top_orange">
    <img src="{{ url('/') }}/images/mail1.png" />DISCUSS WITH US
  </div>
  <div class="form_wrap">
    <div class="form_item">
      <img src="{{ url('/') }}/images/home.png" /><input
        type="text"
        name="name"
        placeholder="Name" required=""
      />
    </div>
    <div class="form_item">
      <img src="{{ url('/') }}/images/phone1.png" /><input
        type="number"
        name="Phone Number"
        placeholder="Phone Number"
      />
    </div>
    <div class="form_item">
      <img src="{{ url('/') }}/images/email2.png" /><input
        type="email"
        name="Email"
        placeholder="Email"
      />
    </div>
    <div class="form_item">
      <img src="{{ url('/') }}/images/map.png" /><input
        type="text"
        name="Select Country"
        placeholder="Select Country"
      />
    </div>
    <div class="form_item">
      <img src="{{ url('/') }}/images/chat.png" / style=" margin-top: -30px;">
      <textarea
        name="Share Your Inflatables Requirement"
        placeholder="Share Your Inflatables Requirement"
      ></textarea>
    </div>
    
    <p class="blue_text">
      We do not Sell or Rent your information.
      {{ Session::get('success')}}
    </p>
    <div class="discuss">
      <input type="submit" value="submit" />
    </div>
  </div>
</form>