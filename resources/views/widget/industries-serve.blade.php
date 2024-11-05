<div class="banner_slider_blk">

  @foreach($industries as $industriesList)

  <?php 

    $href =  isset($industriesList->page_link)?$industriesList->page_link:'#';

  ?>

  <a href="{{ $href }}" class="banner_slider_item showIndustriesImg slick-slide" data-id="{{ $industriesList->id }}" title="{{ $industriesList->title }}" data-caption="{{ $industriesList->short_description }}" data-type="industries">

    <div class="onscreen_media_industries_item" @if(session('LoggedUser'))

      data-create-link="{{url('powerup/industries-create')}}"

      
      data-edit-link="{{ route('industries.edit', $industriesList->id) }}" 
      data-delete-link="{{ route('industries.delete', $industriesList->id) }}"
      data-index-link="{{route('industries.index')}}"

    @endif></div>

    <img src="{{url('/')}}/images/{{$industriesList->image}}" />

    <h3>{{$industriesList->title}}</h3>

    <p>

      {!! Str::limit(strip_tags($industriesList->short_description),250) !!}

    </p>

    <span>Explore</span>



  </a>

  @endforeach

</div>