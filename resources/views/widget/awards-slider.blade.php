<div class="client_wrap">

  <div class="big_text mid_text">

    <a href="{{url('/awards')}}">AWARDS & ASSOCATIONS</a>

    <div class="title-crud fontSize" @if(session('LoggedUser')) data-create-link="{{route('award.index')}}" data-delete="{{route('award.index')}}" data-link="{{route('award.index')}}" @endif></div>

  </div>

  <div class="client_blk">

    @foreach($awardSlider as $awardList)

    <a class="client_item" data-fancybox="gallery" href="{{url('web')}}/media/lg/{{$awardList->image}}">

      <img src="{{url('/')}}/images/{{$awardList->image}}" />

    </a>

    @endforeach

  </div>

  <a href="{{ url('awards') }}" class="read_all explore_all"><p>exeplore ALL</p></a>

</div>