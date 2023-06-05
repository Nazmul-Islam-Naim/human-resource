@extends('website.layouts.layout')
@section('content')
@php
	'use Illuminate\Support\Str'
@endphp
<div role="main" class="main">

	<!---- done ---->
	<div id="slider" class="owl-carousel owl-carousel-light owl-carousel-light-init-fadeIn owl-theme manual dots-inside dots-horizontal-center show-dots-hover show-dots-xs nav-style-diamond custom-nav-with-transparency nav-inside nav-inside-plus nav-dark nav-md nav-font-size-md show-nav-hover mb-0" data-plugin-options="{'autoplayTimeout': 9000}" data-dynamic-height="['650px','650px','650px','550px','500px']" style="height: 650px;">
		<div class="owl-stage-outer">
			<div class="owl-stage">
				@if(!empty($slider))
				<!-- Carousel Slide 1 -->
				<div class="owl-item position-relative" style="background-image: url({{asset('storage/'.$slider->image3)}}); background-size: cover; background-position: center; height: 650px;">

					<div class="d-none d-md-block position-absolute top-50pct left-50pct transform3dxy-n50 w-100 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="1500" style="max-width: 1080px;">
						<img src="{{asset('storage/'.$slider->image3)}}" class="img-fluid" alt="" />
					</div>
					<div class="container h-100">
						<div class="row align-items-center h-100">
							<div class="col text-center">
								<p class="text-4 text-color-secondary font-weight-light opacity-7 mb-0" data-plugin-animated-letters data-plugin-options="{'startDelay': 800, 'minWindowWidth': 0}">{{$slider->message3}}</p>
								<h1 class="text-color-secondary font-weight-extra-bold text-12 mt-3 mb-4 appear-animation" data-appear-animation="fadeInLeftShorterPlus" data-appear-animation-delay="300" data-plugin-options="{'minWindowWidth': 0}">{{$slider->message3}}</h1>
								<a href="{{($slider->url3)??'#'}}" target="_blank" class="btn btn-primary btn-outline font-weight-bold btn-py-3 px-5 mt-2 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1000" data-plugin-options="{'minWindowWidth': 0}">GET STARTED</a>
							</div>
						</div>
					</div>
				</div>

				<!-- Carousel Slide 2 -->
				<div class="owl-item position-relative" style="background-image: url({{asset('storage/'.$slider->image1)}}); background-size: cover; background-position: center; height: 650px;">

					<div class="container h-100">
						<div class="row align-items-center h-100">
							<div class="col text-center">
								<p class="text-4 text-color-secondary font-weight-light opacity-7 mb-0" data-plugin-animated-letters data-plugin-options="{'startDelay': 800, 'minWindowWidth': 0}">{{$slider->message1}}</p>
								<h1 class="text-color-secondary font-weight-extra-bold text-12 mt-3 mb-4 appear-animation" data-appear-animation="fadeInLeftShorterPlus" data-appear-animation-delay="300" data-plugin-options="{'minWindowWidth': 0}">{{$slider->title1}}</h1>
								<a href="{{($slider->url1)??'#'}}" target="_blank" class="btn btn-primary btn-outline font-weight-bold btn-py-3 px-5 mt-2 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1000" data-plugin-options="{'minWindowWidth': 0}">GET STARTED</a>
							</div>
						</div>
					</div>
				</div>

				<!-- Carousel Slide 3 -->
				<div class="owl-item position-relative" style="background-image: url({{asset('storage/'.$slider->image2)}}); background-size: cover; background-position: center; height: 650px;">

					<div class="container h-100">
						<div class="row align-items-center h-100">
							<div class="col text-center">
								<p class="text-4 text-color-secondary font-weight-light opacity-7 mb-0" data-plugin-animated-letters data-plugin-options="{'startDelay': 800, 'minWindowWidth': 0}">{{$slider->message2}}</p>
								<h1 class="text-color-secondary font-weight-extra-bold text-12 mt-3 mb-4 appear-animation" data-appear-animation="fadeInLeftShorterPlus" data-appear-animation-delay="300" data-plugin-options="{'minWindowWidth': 0}">{{$slider->title2}}</h1>
								<a href="{{($slider->url2)??'#'}}" target="_blank" class="btn btn-primary btn-outline font-weight-bold btn-py-3 px-5 mt-2 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1000" data-plugin-options="{'minWindowWidth': 0}">GET STARTED</a>
							</div>
						</div>
					</div>
				</div>
				@endif

			</div>
		</div>
	</div>
	
	<!---- done ---->
	<section class="section custom-angled section-angled bg-tertiary border-top-0 pt-0 pb-0 pb-lg-5 mb-5 mb-lg-0">
		<div class="section-angled-layer-bottom bg-light d-none d-lg-block"></div>
		<div class="section-angled-content mb-0 mb-lg-5 pb-lg-5 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="300">
			<div class="container container-xl-custom pb-5">
				<div class="row pb-lg-5">
					@if (!empty($projects))
						@foreach ($projects as $project)
						<div class="col-lg-4 position-relative py-2 active" data-carousel-navigate data-carousel-navigate-id="#slider" data-carousel-navigate-to="1">
							<div class="mt-5 mb-lg-5">
								<h4 class="text-color-secondary font-weight-bold text-5">{{$project->title ?? ''}}</h4>
								<p class="mb-2 text-justify">{{Str::limit((!empty($project->info) ? $project->info : 'Click read more to know more about this project.'), 250)}}</p>
								<p class="font-weight-bold mb-lg-3">
									<a href="{{route('project-details',$project->slug)}}" class="link-hover-style-1 text-color-primary">READ MORE+</a>
								</p>
							</div>
						</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</section>
	
	<!---- done ---->
	<section class="section bg-light border-0 p-0 m-0" id="services">
		<div class="container container-xl-custom">
			<div class="row">
				<div class="col">
					<p class="mb-1">WHAT WE DO</p>
					<h3 class="text-secondary font-weight-bold text-capitalize text-7 mb-2">Our Services</h3>
				</div>
			</div>
			<div class="row">
				<div class="owl-carousel owl-theme custom-dots mt-3 mb-0" data-plugin-options="{'responsive': {'0': {'items': 1}, '476': {'items': 1}, '768': {'items': 2}, '992': {'items': 3}, '1200': {'items': 4}}, 'margin': 18, 'loop': false, 'nav': false, 'dots': true}">
					@if (!empty($services))
						@foreach ($services as $service)
						<div>
							<div class="card custom-card border-radius-0">
								<div class="card-body text-center py-3">
									<div class="feature-box-icon d-flex justify-content-center w-auto my-2 py-4">
										<img width="80" height="80" src="{{asset('storage/'.($service->image1 ?? ''))}}" alt="" data-plugin-options="{'color': '#220c3c', 'animated': true, 'delay': 0, 'strokeBased': true}" />
									</div>
									<h5 class="card-title mb-3 text-5 text-secondary font-weight-bold">{{$service->title ?? ''}}</h5>
									<p class="card-text">{!! Str::limit(strip_tags($service->details ?? ''),150) !!}</p>
									<p class="font-weight-bold mb-0 pb-4">
										<a href="{{route('service-details',$service->slug)}}" class="link-hover-style-1 text-color-primary">READ MORE+</a>
									</p>
								</div>
							</div>
						</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</section>
	
	<!---- done ---->
	<section class="section custom-angled section-angled bg-tertiary border-top-0 pb-0 pb-lg-5 mb-5 mb-lg-0">
		<div class="section-angled-layer-top bg-light"></div>
		<div class="section-angled-layer-bottom bg-light d-none d-lg-block"></div>
		<div class="section-angled-content mb-0 mb-lg-5">
			<div class="container py-5 container-xl-custom custom-container">
				<div class="row align-items-center justify-content-center pt-5 pb-lg-5">
					<div class="col-md-8 col-xl-6 mb-md-5 mb-xl-4">
						<div class="position-relative pb-lg-5 mb-lg-5">
							<img src="{{asset('storage/'.($aboutUs->image1??''))}}" class="img-fluid custom-img border-radius-0 max-w-90 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="600ms" alt="">
							<img src="{{asset('storage/'.($aboutUs->image2??''))}}" class="img-fluid custom-img border-radius-0 position-absolute custom-img-about appear-animation" data-appear-animation="expandIn" data-appear-animation-delay="600ms" alt="">
						</div>
					</div>
					<div class="col-xl-6 mt-lg-5 mt-xl-0 pb-lg-5 mb-lg-5">
						<div class="ps-md-4 mt-5">
							<div class="row">
								<div class="col">
									<h5 class="mb-1">WHO WE ARE</h5>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<p style="text-align: justify">{!! Str::limit(strip_tags($aboutUs->description ?? '' ), 550) !!}</p>	
									<p class="font-weight-bold mb-3">
										<a href="{{route('about-us')}}" class="link-hover-style-1 text-color-primary">READ MORE+</a>
									</p>
									<div class="row mb-4 counters counters-sm text-secondary">
										<div class="col-6 col-lg-3 mb-4 mb-lg-0 mt-4">
											<div class="counter">
												<strong data-to="{{$aboutUs->business_year ?? '1'}}" data-append="+">{{$aboutUs->business_year ?? '1'}}+</strong>
												<label class="text-2 pt-1">Business Year</label>
											</div>
										</div>
										<div class="col-6 col-lg-3 mb-4 mb-lg-0 mt-4">
											<div class="counter">
												<strong data-to="{{$aboutUs->clients ?? '1'}}" data-append="+">{{$aboutUs->clients ?? '1'}}+</strong>
												<label class="text-2 pt-1">Satisfed Clients</label>
											</div>
										</div>
										<div class="col-6 col-lg-3 mb-4 mb-sm-0 mt-4">
											<div class="counter">
												<strong data-to="{{$aboutUs->cases ?? '1'}}" data-append="+">{{$aboutUs->cases ?? '1'}}+</strong>
												<label class="text-2 pt-1">Successfull Cases</label>
											</div>
										</div>
										<div class="col-6 col-lg-3 mt-4">
											<div class="counter">
												<strong data-to="{{$aboutUs->consultants ?? '1'}}" data-append="+">{{$aboutUs->consultants ?? '1'}}+</strong>
												<label class="text-2 pt-1">Pro Consultants</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!---- done ---->
	<section class="container-fluid mb-5 mb-lg-0">
		<div class="row">
			<div class="col-lg-6 px-0">
				<section class="section custom-angled section-angled bg-secondary border-top-0">
					<div class="section-angled-layer-top bg-light"></div>
					<div class="section-angled-layer-bottom bg-light d-none d-lg-block"></div>
					<div class="section-angled-content">
						<div class="container container-xl-custom">
							<div class="row justify-content-lg-end py-3">
								<div class="col-lg-10 custom-col pt-5 pb-lg-5 mt-5 mb-lg-5 px-3 px-lg-1 pe-lg-3">
									<div class="col px-0">
										<h3 class="text-light font-weight-bold text-capitalize text-7 mb-2">Special Service</h3>
									</div>
									<div class="row pe-3">
										<div class="col">
											<p style="text-align: justify; font-size:15px">{!! Str::limit(strip_tags($aboutUs->special_service ?? ''),400) !!}</p>
											<p class="mb-2 font-weight-bold">
												<a href="{{route('about-us')}}" class="link-hover-style-1 text-color-primary">GET A QUOTE+</a>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="col-lg-6 px-0 d-none d-lg-flex">
				<section class="section section-angled custom-angled section-angled-reverse section-center bg-secondary border-top-0 flex-grow-1 lazyload" style="background-image: url({{asset('storage/'.($aboutUs->image2??''))}});">
					<div class="section-angled-layer-top bg-light d-none d-lg-block"></div>
					<div class="section-angled-layer-bottom bg-light"></div>
					<div class="section-angled-content">
					</div>
				</section>
			</div>
		</div>
	</section>
	
	<!---- done ---->
	<section class="section bg-light border-0 p-0 m-0" >
		<div class="container container-xl-custom">
			<div class="row">
				<div class="col">
					<h2 class="text-color-dark font-weight-bold text-7 line-height-1 mb-3-5 appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="200">Blog</h2>
					<p class="text-4 font-weight-light mb-5-5 appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="400">Enter the Blogs menu to see more blogs. </p>
				</div>
			</div>
			<div class="row row-gutter-sm justify-content-center mb-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600">
				@if (!empty($latestBlogs))
					@foreach ($latestBlogs as $latestBlog)
					<div class="col-sm-9 col-md-6 col-lg-4 mb-4 mb-lg-0">
						<a href="{{route('blog-details',$latestBlog->slug)}}" class="text-decoration-none" data-cursor-effect-hover="plus">
							<div class="card border-0">
								<div class="card-img-top position-relative overlay">
									<div class="position-absolute bottom-10 right-0 d-flex justify-content-end w-100 py-3 px-4 z-index-3">
										<span class="text-center bg-primary text-color-light font-weight-semibold text-5-5 line-height-2 px-3 py-2">
											<span class="position-relative z-index-2">
												{{date('d',strtotime($latestBlog->created_at))}}
												<span class="d-block custom-font-size-1 positive-ls-2 px-1">{{date('F',strtotime($latestBlog->created_at))}}</span>
											</span>
										</span>
									</div>
									<img src="{{asset('storage/'.($latestBlog->image ?? ''))}}" class="img-fluid" alt="Lorem Ipsum Dolor" />
								</div>
								<div class="card-body py-4 px-0">
									<span class="d-block text-color-grey font-weight-semibold positive-ls-2 text-2">{{$latestBlog->category->title ?? ''}} | {{$latestBlog->creator->name ?? ''}}</span>
									<h3 class="text-transform-none font-weight-bold text-5 text-color-hover-primary mb-2">{{$latestBlog->title}}</h3>
									<p class="mb-2">{!! Str::limit(strip_tags($latestBlog->details),50) !!} </p>
									<span class="custom-view-more d-inline-flex font-weight-medium text-color-primary">
										View More
										<img width="27" height="27" src="{{asset('website/img/arrow-right.svg')}}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary ms-2'}" style="width: 27px;" />
									</span>
								</div>
							</div>
						</a>
					</div>
					@endforeach
				@endif
			</div>
		</div>
	</section>

	<!---- done ---->
	<section class="section section-height-3 bg-light border-0 pt-3 pt-lg-0 pb-4">
		<div class="container container-xl-custom appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="300">
			<div class="row">
				<div class="col">
					<p class="mb-1">WHAT THEY SAY</p>
					<h3 class="text-secondary font-weight-bold text-capitalize text-7 mb-2">Customers Reviews</h3>
				</div>
			</div>
			<div class="row">
				<div class="owl-carousel owl-theme custom-dots mt-3 mb-0" data-plugin-options="{'responsive': {'0': {'items': 1}, '476': {'items': 1}, '768': {'items': 2}, '992': {'items': 2}, '1200': {'items': 2}}, 'margin': 18, 'loop': true, 'nav': false, 'dots': true}">
					@if (!empty($customerReviews))
						@foreach ($customerReviews as $customerReview)
						<div>
							<div class="testimonial testimonial-style-4 custom-testimonial py-4 px-3">
								<blockquote class="px-3 ms-4">
									<p class="mb-0 font-weight-normal">{{$customerReview->comment}}</p>
								</blockquote>
								<div class="testimonial-arrow-down"></div>
								<div class="testimonial-author pb-3 mt-1 ms-5">
									<div class="testimonial-author-thumbnail">
										<img src="{{asset('storage/'.($customerReview->image ?? ''))}}" width="55" height="55" class="img-fluid rounded-circle" alt="">
									</div>
									<p><strong class="font-weight-extra-bold">{{$customerReview->name}}</strong><span class="text-1">{{$customerReview->profession}}</span></p>
								</div>
							</div>
						</div>
						@endforeach
					@endif

				</div>
			</div>
		</div>
	</section>

</div>
@endsection
