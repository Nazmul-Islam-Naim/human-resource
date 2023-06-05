@extends('website.layouts.layout')
@section('content')
<div role="main" class="main">
	<section class="page-header bg-color-tertiary custom-page-header page-header-modern page-header-background page-header-background-sm parallax mt-0" data-plugin-parallax data-plugin-options="{'speed': 1.2}" data-image-src="{{asset('storage/'. ($service->image2 ?? ''))}}">
		<div class="container">
			<div class="row">
				<div class="col-md-12 align-self-center">
					<ul class="breadcrumb custom-breadcrumb d-block text-center text-4">
						<li><a href="{{route('home')}}">Home</a></li>
						<li class="active">Services</li>
					</ul>
				</div>
				<div class="col-md-12 align-self-center p-static text-center mt-2">
					<h1 class="font-weight-bold text-color-secondary text-11">{{$service->title}}</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container container-xl-custom pt-5 pb-5 mb-2">
		<div class="row">
			<div class="col-lg-3 pb-4 pb-lg-0">

				<aside class="sidebar">

					<div class="px-3">
						<h3 class="text-color-secondary text-capitalize font-weight-bold text-5 mt-0 mb-3">Latest Services</h3>

						<ul class="nav nav-list flex-column mb-0 p-relative right-9 mb-4">
							@if (!empty($latestServices))
							@foreach ($latestServices as $latest)
							<li class="nav-item"><a class="nav-link font-weight-bold {{($service->slug == $latest->slug) ? 'text-primary' : 'text-secondary'}} text-3 border-0 my-1 p-relative" href="{{route('service-details',$latest->slug)}}">{{$latest->title}}</a></li>
							@endforeach
							@endif
						</ul>
					</div>

					<div class="py-1 clearfix">
						<hr class="my-2">
					</div>

					<div class="px-3 mt-4">

						<div class="flex-column">
							<div class="row px-3 mb-4">
								<h3 class="text-color-secondary text-capitalize font-weight-bold text-5 m-0 pt-2 pb-1 w-100">Contact Info</h3>
								<p class="line-height-6 pt-1 mb-0">{{$logo->title ?? ''}}</p>
							</div>
							<div class="row px-lg-3 mb-2 pt-3 align-items-center">
								<div class="col-md-2 pb-3 pb-lg-0 text-center">
									<i class="fas fa-map-marker-alt text-8 text-secondary"></i>
								</div>
								<div class="col-md-10 text-center text-md-start">
									<h4 class="text-secondary font-weight-bold text-capitalize mb-1 text-4">Adress</h4>
									<p class="line-height-4 pt-1 mb-0">{{$contact->address ?? ''}}</p>
								</div>
							</div>
							<hr>
							<div class="row px-lg-3 mb-2 pt-3 align-items-center">
								<div class="col-md-2 pb-3 pb-lg-0 text-center">
									<i class="fas fa-mobile-alt text-8 text-secondary"></i>
								</div>
								<div class="col-md-10 text-center text-md-start">
									<h4 class="text-secondary font-weight-bold text-capitalize mb-1 text-4">Phone Number</h4>
									<p class="line-height-4 pt-1 mb-0"><a class="px-0 text-default" href="tel:{{$contact->phone ?? '#'}}" >{{$contact->phone ?? ''}}</a></p>
								</div>
							</div>
							<hr>
							<div class="row px-lg-3 mb-2 pt-3 align-items-center">
								<div class="col-md-2 pb-3 pb-lg-0 text-center">
									<i class="far fa-envelope text-7 text-secondary"></i>
								</div>
								<div class="col-md-10 text-center text-md-start">
									<h4 class="text-secondary font-weight-bold text-capitalize mb-1 text-4">E-mail Address</h4>
									<p class="line-height-4 pt-1 mb-0"><a class="px-0 text-default" href="mailto:{{$ocntact->email ?? ''}}">{{$ocntact->email ?? ''}}</a></p>
								</div>
							</div>
						</div>

					</div>

				</aside>

			</div>
			<div class="col-lg-9">

				<div class="owl-carousel owl-theme custom-dots my-0" data-plugin-options="{'items': 1, 'margin': 18, 'loop': true, 'nav': false, 'dots': true}">
					<div>
						<img src="{{asset('storage/'.($service->image1 ?? ''))}}" class="img-fluid" alt="">
					</div>
					<div>
						<img src="{{asset('storage/'.($service->image2 ?? ''))}}" class="img-fluid" alt="">
					</div>
				</div>

				<div class="mt-4">
					{!! $service->details ?? '' !!}
				</div>

			</div>
		</div>
	</div>

</div>
@endsection
