<!DOCTYPE html>
<html lang="en">
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>{{$logo->title ?? ''}}</title>	

		<meta name="keywords" content="WebSite Template" />
		<meta name="description" content="construction">
		<meta name="author" content="binary-it.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{{asset('storage/'.($logo->fav_icon ??''))}}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{asset('storage/'.($logo->fav_icon ??''))}}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('website/vendor/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('website/vendor/fontawesome-free/css/all.min.css')}}">
		<link rel="stylesheet" href="{{asset('website/vendor/animate/animate.compat.css')}}">
		<link rel="stylesheet" href="{{asset('website/vendor/simple-line-icons/css/simple-line-icons.min.css')}}">
		<link rel="stylesheet" href="{{asset('website/vendor/owl.carousel/assets/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{asset('website/vendor/owl.carousel/assets/owl.theme.default.min.css')}}">
		<link rel="stylesheet" href="{{asset('website/vendor/magnific-popup/magnific-popup.min.css')}}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset('website/css/theme.css')}}">
		<link rel="stylesheet" href="{{asset('website/css/theme-elements.css')}}">
		<link rel="stylesheet" href="{{asset('website/css/theme-blog.css')}}">
		<link rel="stylesheet" href="{{asset('website/css/theme-shop.css')}}">

		<!-- Demo CSS -->
		<link rel="stylesheet" href="{{asset('website/css/demos/demo-construction-2.css')}}">

		<!-- Skin CSS -->
		<link id="skinCSS" rel="stylesheet" href="{{asset('website/css/skins/skin-construction-2.css')}}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset('website/css/custom.css')}}">

		<!-- Head Libs -->
		<script src="{{asset('website/vendor/modernizr/modernizr.min.js')}}"></script>

		
		<!-- leaflet CSS -->
		<link rel="stylesheet" href="{{asset('backend/custom/leaflet/1.7.1/css/leaflet.min.css')}}">

		<!-- leaflet js -->
		<script src="{{asset('backend/custom/leaflet/1.7.1/js/leaflet.min.js')}}"></script>

	</head>
	<body>
		<div class="body">
			<header id="header" class="header-effect-shrink bg-color-tertiary custom-header" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyChangeLogo': true, 'stickyStartAt': 100, 'stickyHeaderContainerHeight': 83}">
				<div class="header-body border-0 box-shadow-none">
					<div class="header-top header-top-default bg-color-white border-bottom-0">
						<div class="container-fluid px-lg-4">
							<div class="header-row py-2">
								<div class="header-column justify-content-start">
									<div class="header-row">
										<nav class="header-nav-top">
											<ul class="nav nav-pills text-uppercase text-2">
												<li class="nav-item nav-item-anim-icon">
													<a class="px-0" href="mailto:{{$contact->email ?? ''}}"><i class="far fa-envelope text-4 top-1 left-0"></i> {{$contact->email ?? ''}}</a>
												</li>
												<li class="nav-item nav-item-anim-icon ps-md-4">
													<span class="d-none d-md-block">
														<i class="far fa-clock p-relative top-2 text-4"></i><span> {{$contact->office_time ?? ''}}</span>
													</span>
												</li>
											</ul>
										</nav>
									</div>
								</div>

								<div class="header-column justify-content-end">
									<div class="header-row">
										<ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean">
											<li class="social-icons-facebook"><a href="{{$socialLink->facebook??'#'}}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
											<li class="social-icons-twitter"><a href="{{$socialLink->twitter??'#'}}" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
											<li class="social-icons-linkedin"><a href="{{$socialLink->linkedin??'#'}}" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
											<li class="social-icons-linkedin"><a href="{{$socialLink->whatsapp??'#'}}" target="_blank" title="Whatsapp"><i class="fab fa-whatsapp"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="header-container container-fluid bg-secondary px-0">
						<div class="header-row">
							<div class="header-column bg-color-primary flex-grow-0 px-3 px-lg-5">
								<div class="header-row">
									<div class="header-logo">
										<a href="{{route('home')}}">
											<img alt="Porto" class="img-logo" width="123" height="32" src="{{asset('storage/'.($logo->header_logo ?? ''))}}">
										</a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end justify-content-lg-start px-lg-5">
								<div class="header-row pe-3">
									<div class="header-nav header-nav-links order-2 order-lg-1 header-nav-light-text flex-grow-0 justify-content-start">
										<div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1 ">
											<nav class="collapse">
												<ul class="nav nav-pills" id="mainNav">
													<li class="dropdown">
														<a class="dropdown-item active" href="{{route('home')}}">
															Home
														</a>
													</li>
													<li class="dropdown">
														<a class="dropdown-item" href="{{route('about-us')}}">
															About Us
														</a>
													</li>
													<li class="dropdown">
														<a class="dropdown-item" href="{{route('projects')}}">
															Projects
														</a>
													</li>
													<li class="dropdown">
														<a class="dropdown-item" href="{{route('services')}}">
															Services
														</a>
													</li>
													<li class="dropdown">
														<a class="dropdown-item" href="{{route('blogs')}}">
															Blogs
														</a>
													</li>
													<li class="dropdown">
														<a class="dropdown-item" href="{{route('contact-us')}}">
															Contact Us
														</a>
													</li>
												</ul>
											</nav>
										</div>
										<button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
											<i class="fas fa-bars"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="header-row d-none d-lg-inline-flex justify-content-end">
							<div class="order-1 order-lg-2 pe-4 d-none d-xl-block">
								<div>
									<div class="feature-box feature-box-style-2 align-items-center p-relative top-8 px-2">
										<div class="feature-box-icon">
											<i class="fas fa-mobile-alt text-9 p-relative bottom-8 text-color-light"></i>
										</div>
										<div class="feature-box-info ps-0">
											<p class="text-color-light opacity-8 text-uppercase line-height-1 text-2 pb-0 mb-2">CALL US NOW</p>
											<p class="text-uppercase text-color-light font-weight-black letter-spacing-minus-1 line-height-1 text-5 pb-0"><a href="tel:{{$contact->phone ?? ''}}" class="text-color-light text-color-hover-primary text-decoration-none">{{$contact->phone ?? ''}}</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

            @yield('content')

			<footer id="footer" class="bg-color-secondary border-top-0 mt-0 custom-footer">
				<div class="container container-xl-custom py-md-4">
					<div class="row justify-content-md-center py-5">
						<div class="col-md-12 col-lg-2 d-flex align-items-center justify-content-center justify-content-lg-start mb-5 mb-lg-0">
							<a href="{{route('home')}}"><img src="{{asset('storage/'.($logo->header_logo ?? ''))}}" alt="Logo" class="img-fluid logo"></a>
						</div>
						<div class="col-md-3 text-center text-md-start">
							<p class="text-5 text-color-light font-weight-bold mb-3 mt-4 mt-lg-0">Get in Touch</p>
							<p class="text-3 mb-0 font-weight-bold text-color-light opacity-7 text-uppercase">ADDRESS</p>
							<p class="text-3 mb-2 text-color-light">{{$contact->address ?? ''}}</p>
							<p class="text-3 mb-0 font-weight-bold text-color-light opacity-7 text-uppercase">PHONE</p>
							<p class="text-3 mb-2 text-color-light"><a href="tel:{{$contact->phone ?? ''}}" class="text-color-light">{{$contact->phone ?? ''}}</a></p>
							<p class="text-3 mb-0 font-weight-bold text-color-light opacity-7 text-uppercase">EMAIL</p>
							<p class="text-3 mb-2 "><a href="mailto:{{$contact->email ?? ''}}" class="text-color-light">{{$contact->email ?? ''}}</a></p>
							<p class="text-3 mb-0 font-weight-bold text-color-light opacity-7 text-uppercase">Working Days/Hours</p>
							<p class="text-3 mb-3 text-color-light">{{$contact->office_time ?? ''}}</p>
							<ul class="social-icons social-icons-dark social-icons-clean">
								<li class="social-icons-instagram">
									<a href="{{$socialLink->whatsapp??'#'}}" target="_blank" title="Whatsapp">
										<i class="fab fa-whatsapp font-weight-semibold"></i>
									</a>
								</li>
								<li class="social-icons-linkedin">
									<a href="{{$socialLink->linkedin??'#'}}" target="_blank" title="Linkedin">
										<i class="fab fa-linkedin-in font-weight-semibold"></i>
									</a>
								</li>
								<li class="social-icons-twitter">
									<a href="{{$socialLink->twitter??'#'}}" target="_blank" title="Twitter">
										<i class="fab fa-twitter font-weight-semibold"></i>
									</a>
								</li>
								<li class="social-icons-facebook">
									<a href="{{$socialLink->facebook??'#'}}" target="_blank" title="Facebook">
										<i class="fab fa-facebook-f font-weight-semibold"></i>
									</a>
								</li>
							</ul>
						</div>
						<div class="col-md-4 text-center text-md-start mt-5 mt-md-0 mb-5 mb-lg-0">
							<p class="text-5 text-color-light font-weight-bold mb-3 mt-4 mt-lg-0">Useful links</p>
							<div class="row opacity-7">
								<div class="col-md-5">
									<p class="mb-0"><a href="{{route('home')}}" class="text-3 text-color-light link-hover-style-1">Home</a></p>
									<p class="mb-0"><a href="{{route('about-us')}}" class="text-3 text-color-light link-hover-style-1">About Us</a></p>
									<p class="mb-0"><a href="{{route('about-us')}}" class="text-3 text-color-light link-hover-style-1">Team Members</a></p>
									<p class="mb-0"><a href="{{route('about-us')}}" class="text-3 text-color-light link-hover-style-1">Client Reviews</a></p>
									<p class="mb-0"><a href="{{route('projects')}}" class="text-3 text-color-light link-hover-style-1">Prjects</a></p>
									<p class="mb-0"><a href="{{route('services')}}" class="text-3 text-color-light link-hover-style-1">Services</a></p>
									<p class="mb-0"><a href="{{route('blogs')}}" class="text-3 text-color-light link-hover-style-1">Blogs</a></p>
									<p class="mb-0"><a href="{{route('contact-us')}}" class="text-3 text-color-light link-hover-style-1">Contact Us</a></p>
								</div>
							</div>
						</div>
						<div class="col-md-3 text-center text-md-start">
							<p class="text-5 text-color-light font-weight-bold mb-3 mt-4 mt-lg-0">Latest Projects</p>

							@if (!empty($footerProjects))
								@foreach ($footerProjects as $footerProject)
								<p class="text-3 mb-0 text-color-light opacity-7">{{$footerProject->type->title ?? ''}}, {{$footerProject->project_status}}</p>
								<p class="text-3 mb-0 font-weight-bold text-color-light">{{$footerProject->location}}</p>
								<p class="text-3 mb-4 font-weight-bold"><a href="{{route('project-details',$footerProject->slug)}}" class="link-hover-style-1 text-primary">VIEW MORE+</a></p>
								@endforeach
							@endif
						</div>
					</div>
				</div>
				<div class="container container-xl-custom">
					<div class="footer-copyright footer-copyright-style-2 bg-color-secondary">
						<div class="py-2">
							<div class="row py-4">
								<div class="col d-flex align-items-center justify-content-center mb-4 mb-lg-0">
									<p class="text-3 text-color-light opacity-7">© Copyright 2023. All Rights Reserved.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src="{{asset('website/vendor/plugins/js/plugins.min.js')}}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{asset('website/js/theme.js')}}"></script>

		<!-- Current Page Vendor and Views -->
		<script src="{{asset('website/js/views/view.contact.js')}}"></script>

		<!-- Demo -->
		<script src="{{asset('website/js/demos/demo-construction-2.js')}}"></script>

		<!-- Theme Custom -->
		<script src="{{asset('website/js/custom.js')}}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{asset('website/js/theme.init.js')}}"></script>

	<!-- Examples -->
		<script src="{{asset('website/js/examples/examples.gallery.js')}}"></script>

	</body>

</html>