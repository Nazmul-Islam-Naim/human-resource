@extends('website.layouts.layout')
@section('content')
<div role="main" class="main">
	<section class="page-header bg-color-tertiary custom-page-header page-header-modern page-header-background page-header-background-sm parallax mt-0" data-plugin-parallax data-plugin-options="{'speed': 1.2}" data-image-src="{{asset('storage/'.($project->image ?? ''))}}">
		<div class="container">
			<div class="row">
				<div class="col-md-12 align-self-center">
					<ul class="breadcrumb custom-breadcrumb d-block text-center text-4">
						<li><a href="{{route('home')}}">Home</a></li>
						<li class="active">Projects</li>
					</ul>
				</div>
				<div class="col-md-12 align-self-center p-static text-center mt-2">
					<h1 class="font-weight-bold text-color-secondary text-11">{{$project->title ?? ''}}</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container container-xl-custom pt-4">
		<div class="row">
			<div class="col">
				<p class="text-4 text-justify">
					{!! $project->details ?? '' !!} 
				</p>
			</div>
		</div>

		<div class="row pb-5 mb-3">
			<div class="col appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
				<div class="row">
					<div class="col-lg-6 mb-4 mb-lg-0">
						<div class="thumb-gallery">
							<div class="owl-carousel owl-theme manual thumb-gallery-detail mt-3 mb-0" id="customThumbGalleryDetail">
								<div>
									<span class="img-thumbnail img-thumbnail-no-borders d-block">
										<img alt="Project Image" src="{{asset('storage/'.($project->image??''))}}" class="img-fluid">
									</span>
								</div>
								<div>
									<span class="img-thumbnail img-thumbnail-no-borders d-block">
										<img alt="Project Image" src="{{asset('storage/'.($project->image1??''))}}" class="img-fluid">
									</span>
								</div>
								<div>
									<span class="img-thumbnail img-thumbnail-no-borders d-block">
										<img alt="Project Image" src="{{asset('storage/'.($project->image2??''))}}" class="img-fluid">
									</span>
								</div>
								<div>
									<span class="img-thumbnail img-thumbnail-no-borders d-block">
										<img alt="Project Image" src="{{asset('storage/'.($project->image3??''))}}" class="img-fluid">
									</span>
								</div>
								<div>
									<span class="img-thumbnail img-thumbnail-no-borders d-block">
										<img alt="Project Image" src="{{asset('storage/'.($project->image4??''))}}" class="img-fluid">
									</span>
								</div>
							</div>
							<div class="owl-carousel owl-theme manual thumb-gallery-thumbs mt-3 mb-0" id="customThumbGalleryThumbs">
								<div>
									<span class="img-thumbnail img-thumbnail-no-borders d-block cur-pointer">
										<img alt="Project Image" src="{{asset('storage/'.($project->image1??''))}}" class="img-fluid">
									</span>
								</div>
								<div>
									<span class="img-thumbnail img-thumbnail-no-borders d-block cur-pointer">
										<img alt="Project Image" src="{{asset('storage/'.($project->image2??''))}}" class="img-fluid">
									</span>
								</div>
								<div>
									<span class="img-thumbnail img-thumbnail-no-borders d-block cur-pointer">
										<img alt="Project Image" src="{{asset('storage/'.($project->image3??''))}}" class="img-fluid">
									</span>
								</div>
								<div>
									<span class="img-thumbnail img-thumbnail-no-borders d-block cur-pointer">
										<img alt="Project Image" src="{{asset('storage/'.($project->image4??''))}}" class="img-fluid">
									</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="custom-card-style-2">
							<div class="col my-5">
								<div class="row px-5 flex-column">
									<div class="row px-3 mb-3">
										<h3 class="text-secondary font-weight-bold text-capitalize mb-3">Project Info</h3>
										<p>{{$project->info ?? ''}}</p>
									</div>
									<div class="row flex-column px-3 mb-2">
										<h4 class="text-secondary text-4 font-weight-bold text-capitalize mb-0">Project Location</h4>
										<p class="mb-2">{{$project->location ?? ''}}</p>
									</div>
									<hr class="my-2 opacity-5">
									<div class="row flex-column px-3 mb-2">
										<h4 class="text-secondary text-4 font-weight-bold text-capitalize mb-0 pt-3">Project Type</h4>
										<p class="mb-2">{{$project->type->title ?? ''}}</p>
									</div>
									<hr class="my-2 opacity-5">
									<div class="row flex-column px-3 mb-2">
										<h4 class="text-secondary text-4 font-weight-bold text-capitalize mb-0 pt-3">Project Cost</h4>
										<p class="mb-2">{{$project->cost ?? ''}}</p>
									</div>
									<hr class="my-2 opacity-5">
									<div class="row flex-column px-3 mb-2">
										<h4 class="text-secondary text-4 font-weight-bold text-capitalize mb-0 pt-3">Client</h4>
										<p class="mb-2">{{$project->client ?? ''}}</p>
									</div>
									<hr class="my-2 opacity-5">
									<div class="row flex-column px-3">
										<h4 class="text-secondary text-4 font-weight-bold text-capitalize mb-2 pt-3">Project Status</h4>
										<p class="mb-0">General Progress</p>
										<div class="custom-progress-bar progress">
											<div class="progress-bar progress-bar-secondary" data-appear-progress-animation="{{$project->progress ?? 0}}%">
												<span class="progress-bar-tooltip">{{$project->progress ?? 0}}%</span>
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
	</div>

</div>
@endsection
