<div class="client_wrap">

  <div class="big_text mid_text">

    <a href="{{ url('case-studies') }}">CASE STUDY</a>

    <div class="title-crud fontSize" @if(session('LoggedUser')) data-create-link="{{route('casestudies.create')}}" data-delete="{{route('casestudies.index')}}" data-link="{{route('casestudies.index')}}" @endif></div>

  </div>

  <div class="update_blk">

    @foreach($caseStudiesSlider as $caseStudiesList)

    <a href="{{ url('case-studies') }}/{{$caseStudiesList->slug}}" class="client_item slick-slide">

      <div class="update_img onscreen_media_testimonial_item" @if(session('LoggedUser'))

                        data-create-link="{{route('casestudies.create')}}"

                        data-link="{{route('casestudies.edit', $caseStudiesList->id)}}"

                        data-delete-link="{{route('admin.index')}}/casestudies/delete/{{ $caseStudiesList->id}}"

                      @endif><img src="{{url('/')}}/images/{{$caseStudiesList->image}}" style="height: 252px;width: 359px;" /></div>

          <p>

            {!! strip_tags($caseStudiesList->title) !!} <br>
            {!! strip_tags($caseStudiesList->short_description) !!}

            <span>Read More</span>

          </p>

    </a>

    @endforeach

  </div>

  <a href="{{ url('case-studies') }}" class="read_all explore_all"><p>VIEW ALL CASE STUDY</p></a>

</div>