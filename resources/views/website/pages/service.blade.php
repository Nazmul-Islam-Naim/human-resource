@extends('website.layouts.layout')
@section('content')
<style>
	ul.pagination {
    display: flex;
    justify-content: center;
}
</style>
<div role="main" class="main">
	<section class="page-header bg-color-tertiary custom-page-header page-header-modern page-header-background page-header-background-sm parallax mt-0" data-plugin-parallax data-plugin-options="{'speed': 1.2}" data-image-src="{{asset('storage/'.($aboutUs->slider_image ?? ''))}}">
		<div class="container">
			<div class="row">
				<div class="col-md-12 align-self-center">
					<ul class="breadcrumb custom-breadcrumb d-block text-center text-4">
						<li><a href="{{route('home')}}">Home</a></li>
						<li class="active">Service</li>
					</ul>
				</div>
				<div class="col-md-12 align-self-center p-static text-center mt-2">
					<h1 class="font-weight-bold text-color-secondary text-11">Services</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container container-xl-custom pt-5">
		<div class="row pb-3">
			@if (!empty($services))
				@foreach ($services as $service)
				<div class="col-md-6 col-lg-4 mb-4 pb-2">
					<div class="card custom-card border-radius-0 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="600">
						<div class="card-body text-center py-3">
							<div class="feature-box-icon d-flex justify-content-center w-auto my-2 py-4" style="height: 240px">
								<img  width="240px" src="{{asset('storage/'.($service->image1 ?? ''))}}" alt="" data-plugin-options="{'color': '#220c3c', 'animated': true, 'delay': 0, 'strokeBased': true}" />
							</div>
							<h3 class="card-title mb-3 text-5 text-secondary font-weight-bold">{{$service->title}}</h3>
							<h6 class="card-text text-warning">{{$service->type->title ?? ''}}</h6>
							<p class="font-weight-bold mb-0 pb-4">
								<a href="{{route('service-details',$service->slug)}}" class="link-hover-style-1 text-color-primary">READ MORE+</a>
							</p>
						</div>
					</div>
				</div>
				@endforeach
			@endif
		</div>
		<div class="row pb-3" style="justify-content: center">
			{{$services->links()}}
		</div>
	</div>
    <!----- done ------->
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
										<p class="mb-1 text-uppercase">Extra Work</p>
										<h3 class="text-light font-weight-bold text-capitalize text-7 mb-2">Special Services</h3>
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
				<section class="section section-angled custom-angled section-angled-reverse section-center bg-dark border-top-0" style="background-image: url({{asset('storage/'.($aboutUs->image2??''))}}); background-repeat: round;flex: 1">
					<div class="section-angled-layer-top bg-light d-none d-lg-block"></div>
					<div class="section-angled-layer-bottom bg-light"></div>
					<div class="section-angled-content">
					</div>
				</section>
			</div>
		</div>
	</section>

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
	</section>

</div>
@endsection
