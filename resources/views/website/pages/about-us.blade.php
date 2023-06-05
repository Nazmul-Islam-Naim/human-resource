@extends('website.layouts.layout')
@section('content')
<div role="main" class="main">
	<section class="page-header bg-color-tertiary custom-page-header page-header-modern page-header-background page-header-background-sm parallax mt-0" data-plugin-parallax data-plugin-options="{'speed': 1.2}" data-image-src="{{asset('storage/'.($aboutUs->slider_image ?? ''))}}">
		<div class="container">
			<div class="row">
				<div class="col-md-12 align-self-center">
					<ul class="breadcrumb custom-breadcrumb d-block text-center text-4">
						<li><a href="{{route('home')}}">Home</a></li>
						<li class="active">About us</li>
					</ul>
				</div>
				<div class="col-md-12 align-self-center p-static text-center mt-2">
					<h1 class="font-weight-bold text-color-secondary text-11">About Us</h1>
				</div>
			</div>
		</div>
	</section>
	
	<div class="container container-xl-custom pt-4">
		<div class="row">
			<div class="col">
				<h3 class=" font-weight-bold text-capitalize text-7 mb-2">How are we</h3>
				<p class="text-4"> {!! $aboutUs->description??'' !!}</p>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col">
				<div class="featured-boxes featured-boxes-style-7">
					<div class="row">
						@if (!empty($services))
							@foreach ($services as $service)
							<div class="col-lg-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="150">
								<div class="featured-box custom-featured-box featured-box-primary featured-box-effect-7">
									<div class="box-content d-flex text-start align-items-center">
										<div>
											<img class="icon-featured text-8 text-secondary ms-0" src="{{asset('storage/'.($service->image1 ?? ''))}}" alt="">
										</div>
										<div>
											<h4 class="font-weight-bold text-5 text-secondary my-2">{{$service->title}}</h4>
											<p class="mb-2">{!! Str::limit(strip_tags($service->details),50) !!}</p>
											<p class="text-2 font-weight-semibold mb-0">
												<a href="{{route('service-details',$service->slug)}}" class="link-hover-style-1 text-primary">READ MORE +</a>
											</p>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="section bg-primary border-0 my-5">
		<div class="container container-xl-custom">
			<div class="row row-gutter-sm my-4 py-2 lightbox" data-plugin-options="{'delegate': 'a', 'type': 'image', 'gallery': {'enabled': true}, 'mainClass': 'mfp-with-zoom', 'zoom': {'enabled': true, 'duration': 300}}">
				<div class="col-md-4 pb-4 pb-md-0">
					<a href="{{asset('storage/'.($aboutUs->image1 ?? ''))}}" style="width: 457px; height:306px" class="appear-animation" data-appear-animation="fadeInDownShorter" data-appear-animation-delay="100">
						<img src="{{asset('storage/'.($aboutUs->image1 ?? ''))}}" style="width: 457px; height:306px" class="img-fluid" alt="">
					</a>
				</div>
				<div class="col-md-4 pb-4 pb-md-0">
					<a href="{{asset('storage/'.($aboutUs->image2 ?? ''))}}" style="width: 457px; height:306px" class="appear-animation" data-appear-animation="fadeInDownShorter" data-appear-animation-delay="300">
						<img src="{{asset('storage/'.($aboutUs->image2 ?? ''))}}" style="width: 457px; height:306px" class="img-fluid" alt="">
					</a>
				</div>
				<div class="col-md-4">
					<a href="{{asset('storage/'.($aboutUs->image1 ?? ''))}}" style="width: 457px; height:306px" class="appear-animation" data-appear-animation="fadeInDownShorter" data-appear-animation-delay="500">
						<img src="{{asset('storage/'.($aboutUs->image1 ?? ''))}}" style="width: 457px; height:306px" class="img-fluid" alt="">
					</a>
				</div>
			</div>
		</div>
	</section>

	<div class="container container-xl-custom pt-3">
		<div class="row">
			<div class="col">
				<h3 class=" font-weight-bold text-capitalize text-7 mb-2">Special Service</h3>
				<p class="text-4"> {!! $aboutUs->special_service??'' !!}</p>
			</div>
		</div>
		<div class="row counters counters-md text-secondary appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="100">
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
		<div class="row">
			<div class="col">
				<hr class="my-5">
			</div>
		</div>
		<div class="row">
			<div class="col">
				<p class="mb-1">OUR EXPERTS</p>
				<h3 class="text-secondary font-weight-bold text-capitalize text-7 mb-5">Construction Team</h3>
			</div>
		</div>
		<div class="row">
			@if (!empty($teams))
				@foreach ($teams as $team)
				<div class="col-md-6 col-lg-3 text-center pb-4 pb-lg-0 px-md-5 d-flex flex-column align-items-center">
					<span class="thumb-info custom-thumb-info thumb-info-hide-wrapper-bg mx-0 mb-2">
						<a class="popup-with-zoom-anim text-decoration-none" title="Robert Doe">
							<img src="{{asset('storage/'.($team->image ?? ''))}}" class="img-fluid" alt="">
						</a>
					</span>
					<span>
						<h4 class="text-color-secondary mb-0">{{$team->name}}</h4>
						<p>{{$team->designation->title ?? ''}}</p>
					</span>
				</div>
				@endforeach
			@endif
			
		</div>
		<div class="row">
			<div class="col">
				<hr class="my-5">
			</div>
		</div>
		<div class="row">
			<div class="col">
				<p class="mb-1">WHAT THEY SAY</p>
				<h3 class="text-secondary font-weight-bold text-capitalize text-7 mb-2">Customers Reviews</h3>
			</div>
		</div>
		<div class="row">
			<div class="col pb-5">
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
										<img src="{{asset('storage/'.($customerReview->image ?? ''))}}" class="img-fluid rounded-circle" alt="">
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
	</div>

</div>
@endsection
