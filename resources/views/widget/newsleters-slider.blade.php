<div class="client_wrap">

  <div class="big_text mid_text">

    <a href="{{url('news-letters')}}">NEWSLETERS</a>

    <div class="title-crud fontSize" @if(session('LoggedUser')) data-create-link="{{route('newsletter.create')}}" data-delete="{{route('newsletter.index')}}" data-link="{{route('newsletter.index')}}" @endif></div>

  </div>

  <div class="update_blk">

    @foreach($newsletterSlider as $newsletterList)

    <a href="{{ url('news-letters') }}/{{$newsletterList->slug}}" class="client_item slick-slide">

      <div class="update_img onscreen_media_testimonial_item" @if(session('LoggedUser'))

                        data-create-link="{{route('newsletter.create')}}"

                        data-link="{{route('newsletter.edit', $newsletterList->id)}}"

                        data-delete-link="{{route('admin.index')}}/newsletter/delete/{{ $newsletterList->id}}"

                      @endif><img src="{{url('/')}}/images/{{$newsletterList->image}}" style="height: 252px;width: 359px;" /></div>

      <p>

        {{ $newsletterList->title }} <br>
        {{ $newsletterList->short_description }}

        <span>Read More</span>

      </p>

    </a>

    @endforeach

  </div>

  <a href="{{url('news-letters')}}" class="read_all explore_all"><p>VIEW ALL</p></a>

</div>