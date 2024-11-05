



	<section class="collection-slider">
		<div class="container-fluid">
			<div class="col-12">

			<section>
			<div class="row p-3 sitemap">
				<div class="col-sm-3">
                @foreach($urls as $url)
                <li><a href="{{url('')}}/{{$url->url}}">{{$url->name}}</a></li>
                    @endforeach
				</div>


				<div class="col-sm-4">
					<h4 class="active_color"><a href="{{url('products')}}">Products</a></h4>
						<ul>
							@foreach($mainCategories as $mainCategory)
								<li> <a href="{{url('')}}/{{$mainCategory->slug}}">{{$mainCategory->name}}</a></li>

								@if(count(getAllSubCategories($mainCategory->id)))
									<ul>
										@foreach(getAllSubCategories($mainCategory->id) as $subCategory)
											<li><a href="{{url('')}}/{{$subCategory->slug}}">{{$subCategory->name}}</a></li>
										@endforeach
									</ul>
								@endif
							@endforeach
						</ul>
				</div>

				<div class="col-sm-5">
					<h4 class="active_color"><a href="{{url('blog')}}">Blog</a></h4>
						<ul>
							@foreach($blogs as $blog)
								<li> <a href="{{url('blog')}}/{{$blog->slug}}">{{$blog->title}}</a></li>
							@endforeach
						</ul>
				</div>

				<div class="clearfix"></div>
			</div>
			</section>

		</div>	
	</section>
