<div class="client_wrap">

  <div class="big_text mid_text">

    <a href="{{ url('testimonials') }}">TESTIMONIALS</a>

    <div class="onscreen_media_testimonial_title"

            

            @if(session('LoggedUser'))

              data-link="{{route('testimonials.index')}}"

            @endif



            >

    </div>

  </div>

  <div class="update_blk">

    @foreach($testimonials as $testimonial)
   

    <a href="{{url('testimonials')}}?testimonial={{$testimonial->id}}" class="client_item slick-slide" >

      <div class="update_img onscreen_media_testimonial_item" @if(session('LoggedUser'))

                        data-link="{{route('testimonials.edit', $testimonial->id)}}"

                        data-delete-link="{{route('admin.index')}}/testimonial/delete/{{ $testimonial->id}}"

                      @endif><img src="{{url('/')}}/images/{{$testimonial->image}}" /></div>

      <p>

        {{$testimonial->client_name}} <br>  
        {{$testimonial->short_description}}

        <span>Read More</span>

      </p>

    </a>

    @endforeach

  </div>

  <a href="{{ url('testimonials') }}" class="read_all explore_all"><p>VIEW ALL</p></a>

</div>