@extends('website.layouts.layout')
@section('content')
<div role="main" class="main">
	<section class="page-header bg-color-tertiary custom-page-header page-header-modern page-header-background page-header-background-sm parallax mt-0" data-plugin-parallax data-plugin-options="{'speed': 1.2}" data-image-src="{{asset('storage/'.($commonSlider->slider_image ?? ''))}}">
		<div class="container">
			<div class="row">
				<div class="col-md-12 align-self-center">
					<ul class="breadcrumb custom-breadcrumb d-block text-center text-4">
						<li><a href="{{route('home')}}">Home</a></li>
						<li class="active">Contact Us</li>
					</ul>
				</div>
				<div class="col-md-12 align-self-center p-static text-center mt-2">
					<h1 class="font-weight-bold text-color-secondary text-11">Contact Us</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container container-xl-custom pt-5">
		<div class="row">
			<div class="col">
				<p class="mb-1">GET IN TOUCH</p>
				<input type="hidden" id="lat" value="{{$contact->lat ?? '23.8643'}}">
				<input type="hidden" id="long" value="{{$contact->long ?? '90.3992'}}">
				<input type="hidden" id="title" value="{{$logo->title ?? 'Binary IT'}}">
				<h3 class="text-secondary font-weight-bold text-capitalize text-7 mb-3">Location in Map</h3>
			</div>
		</div>
		<div class="row pb-4">
			<div class="col-lg-7 pb-5">
				<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
				<div id="mapid" class="google-map m-0" style="min-height: 620px;"></div>
			</div>
			<div class="col-lg-5">
				<div class="custom-card-style-2 card-contact-us mb-5">
					<div class="m-4">
						<div class="row flex-column px-5 pt-3 pb-4">
							<div class="row px-3 mb-3">
								<h3 class="text-secondary font-weight-bold text-capitalize my-3">Contact Info</h3>
								<p>{{$logo->title ?? ''}}</p>
							</div>
							<div class="row px-lg-3 pb-2 align-items-center">
								<div class="col-2 col-lg-1 px-1 text-center">
									<i class="fas fa-map-marker-alt text-8 text-secondary"></i>
								</div>
								<div class="col-10 col-lg-11">
									<h4 class="text-secondary font-weight-bold text-capitalize mb-0">Adress</h4>
									<p class="mb-0">{{$contact->address ?? ''}}</p>
								</div>
							</div>
							<hr class="my-3 opacity-5">
							<div class="row px-lg-3 py-2 align-items-center">
								<div class="col-2 col-lg-1 px-1 text-center">
									<i class="fas fa-mobile-alt text-8 text-secondary"></i>
								</div>
								<div class="col-10 col-lg-11">
									<h4 class="text-secondary font-weight-bold text-capitalize mb-0">Phone Number</h4>
									<p class="mb-0"><a href="tel:{{$contact->phone ?? '#'}}" class="text-color-default">{{$contact->phone ?? ''}}</a></p>
								</div>
							</div>
							<hr class="my-3 opacity-5">
							<div class="row px-lg-3 py-2 align-items-center">
								<div class="col-2 col-lg-1 px-1 text-center">
									<i class="far fa-envelope text-7 text-secondary"></i>
								</div>
								<div class="col-10 col-lg-11">
									<h4 class="text-secondary font-weight-bold text-capitalize mb-0">E-mail Address</h4>
									<p class="mb-0"><a class="px-0 text-default" href="mailto:{{$contact->email ?? '#'}}">{{$contact->email ?? ''}}</a></p>
								</div>
							</div>
							<hr class="my-3 opacity-5">
							<div class="row px-lg-3 pt-2 align-items-center">
								<div class="col-2 col-lg-1 px-1 text-center">
									<i class="far fa-calendar-alt text-7 text-secondary"></i>
								</div>
								<div class="col-10 col-lg-11">
									<h4 class="text-secondary font-weight-bold text-capitalize mb-0">Working days/Hours</h4>
									<p class="mb-1">{{$contact->office_time ?? ''}}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	const lat = document.getElementById('lat').value;
	const long = document.getElementById('long').value;
	const title = document.getElementById('title').value;
	var mymap = L.map('mapid').setView([lat, long], 7);

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(mymap);

	var marker = L.marker([lat, long]).addTo(mymap);
	marker.bindPopup(title);
</script>
@endsection
