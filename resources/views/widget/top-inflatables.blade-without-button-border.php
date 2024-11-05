
                <div class="row big_slide top_inflatable mb-3 justify-content-center">
                    @foreach($topInflatableAll as $topInflatable)
                        @if(getSubCategories($topInflatable->id)->count() > 0)
                        <div class="col-sm-6 col-lg-4 inflatables item-block disply-block"
                        >
                        
                        <!-- <a href="{{url('')}}/{{$topInflatable->slug}}">
                            <div class="top-buttons infa_bg title_bg_md mb-1 product_title_main "
                            
                                @if(session('LoggedUser'))
                                    data-link="{{route('admin.category.edit', $topInflatable->id)}}?type=main_category"
                                @endif
                            >

                                <img  style="max-width: 18px;margin-right: 10px;"
                                src="{{ url('sardar') }}/img/active-link-icon.png">

                        {{$topInflatable->name}}</div></a> -->
                            <a href="{{url('')}}/{{$topInflatable->slug}}">
                            <div class="img_thumbnail m-auto">
                                     <div class="slideshow">
                                    @foreach(getSubCategories($topInflatable->id, 2) as $subCategories1)
                                        @if(isset(getSubCategoryImages($subCategories1->id, 2, 'DESC')[0]))
                                            @foreach(getSubCategoryImages($subCategories1->id, 2, 'DESC') as $i => $media)
                                                <div class="blur_box onscreen-product-image" 

                                                @if(session('LoggedUser'))
                                                    data-link="{{route('admin.photo.manage')}}?page=manage&main_category={{$topInflatable->id}}&sub_category={{$subCategories1->id}}"
                                                @endif
                                                >

                                                    <!-- <img style="" class="img-fluid blur_bg" src="{{url('web')}}/media/icon/{{$media['image']}}"> -->
                                                    <img class="img-fluid slideshow_img blur_original" src="{{url('')}}/images/{{$media['image']}}">
                                                </div>
                                            @endforeach
                                        @else
                                        @endif
                                    @endforeach
                                    </div>

                                    <p class="product-image-title">{{$topInflatable->name}}</p>
                            </div>
          
                            </a>

                            <!-- <div class="bottom_links d-flex justify-content-between">
                                <div class="bottom_links1">
                                    <a href="{{url('')}}/{{$topInflatable->slug}}">
                                    <i class="fa fa-eye" aria-hidden="true"></i> &nbsp;
                                            View All </a>
                                </div>
                               
                                <div class="bottom_links1">
                                    <a class="open-modal" id="{{$topInflatable->id}}"
									data-title="{{$topInflatable->name}}" 
									data-image="{{url('web')}}/media/md/{{$topInflatable->image}}" 
									data-page-url="{{url('')}}/{{$topInflatable->slug}}" 
									data-product-url="{{url('')}}/{{$topInflatable->slug}}" 
                                            data-target="#exampleModal"
                                            data-toggle="modal" 
                                            
                                    > 
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;
                                            Enquire Now</a>
                                </div>

                            </div> -->
                        </div>
                        @endif
                    @endforeach
                </div>
                
