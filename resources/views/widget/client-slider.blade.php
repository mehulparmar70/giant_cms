
          <div class="owl-carousel owl-theme our-clients">

            
            @if(count($clients) > 0)

              <div class="item">
                <div class="row">

                <?php

                    $clientArrs = array_chunk(json_decode(json_encode($clients), true), 2);

                ?>
                  <!-- 12 Client logo -->
                  @foreach($clientArrs as $i => $clientArr)
                    @foreach($clientArr as $client)
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="logo-boder"><img src="{{url('/')}}/images/{{$client['logo']}}" alt=""  title=""  class="img-fluid"></div>
                        </div>
                    @endforeach
                  @endforeach
                  </div>
              </div>
            
            @else
            <h1>No client</h1>
            
              @endif


  
        </div>