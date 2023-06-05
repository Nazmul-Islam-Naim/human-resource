@extends('website.layouts.layout')
@section('content')
<style>
	ul.pagination {
    display: flex;
    justify-content: center;
}
</style>
<div role="main" class="main">

	<section class="page-header bg-color-tertiary custom-page-header page-header-modern page-header-background page-header-background-sm parallax mt-0" data-plugin-parallax data-plugin-options="{'speed': 1.2}" data-image-src="{{asset('storage/'.($commonSlider->slider_image ?? ''))}}">
		<div class="container">
			<div class="row">
				<div class="col-md-12 align-self-center">
					<ul class="breadcrumb custom-breadcrumb d-block text-center text-4">
						<li><a href="{{route('home')}}">Home</a></li>
						<li class="active">Blogs</li>
					</ul>
				</div>
				<div class="col-md-12 align-self-center p-static text-center mt-2">
					<h1 class="font-weight-bold text-color-secondary text-11">Blogs</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container pt-4 pb-5 my-5">
		<div class="row">
			<div class="col-lg-8 mb-5 mb-lg-0 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1600">

				@if (!empty($blogs))
					@foreach ($blogs as $blog)
					<article class="mb-5">
						<div class="card bg-transparent border-0 custom-border-radius-1">
							<div class="card-body p-0 z-index-1">
								<a href="{{route('blog-details',$blog->slug)}}" data-cursor-effect-hover="plus">
									<img class="card-img-top custom-border-radius-1 mb-2" src="{{asset('storage/'.($blog->image ?? ''))}}" alt="Card Image">
								</a>
								<p class="text-uppercase text-color-default text-1 my-2">
									<time pubdate datetime="2023-01-10">{{date('d F Y',strtotime($blog->created_at))}}</time> 
									<span class="opacity-3 d-inline-block px-2">|</span> 
									{{$blog->category->title ?? ''}}
									<span class="opacity-3 d-inline-block px-2">|</span> 
									{{$blog->creator->name ?? ''}}
								</p>
								<div class="card-body p-0">
									<h4 class="card-title text-5 font-weight-bold pb-1 mb-2"><a class="text-color-dark text-color-hover-primary text-decoration-none" href="{{route('blog-details',$blog->slug)}}">{{$blog->title}}</a></h4>
									<p class="card-text mb-2">{!! Str::limit(strip_tags($blog->details),150) !!}</p>
									<a href="{{route('blog-details',$blog->slug)}}" class="text-decoration-none custom-link-hover-effects">
										<span class="custom-view-more d-inline-flex font-weight-medium text-color-primary">
											Read More
											<img width="27" height="27" src="{{asset('website/img/arrow-right.svg')}}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary ms-2'}" style="width: 27px;" />
										</span>
									</a>
								</div>
							</div>
						</div>
					</article>
					@endforeach
				@endif

				{{$blogs->links()}}

			</div>
			<div class="blog-sidebar col-lg-4 pt-4 pt-lg-0 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1800">
				<aside class="sidebar">
					<div class="px-3 mt-4">
						<h3 class="text-color-quaternary text-capitalize font-weight-bold text-5 m-0 mb-3">Recent Posts</h3>
						<div class="pb-2 mb-1">
							@if (!empty($latestBlogs))
								@foreach ($latestBlogs as $latestBlog)
								<a href="{{route('blog-details',$latestBlog->slug)}}" class="text-color-default text-uppercase text-1 mb-0 d-block text-decoration-none">{{date('d F Y',strtotime($latestBlog->created_at))}} <span class="opacity-3 d-inline-block px-2">|</span> {{$latestBlog->category->title ?? ''}} <span class="opacity-3 d-inline-block px-2">|</span> {{$latestBlog->creator->name ?? ''}}</a>
								<a href="{{route('blog-details',$latestBlog->slug)}}" class="text-color-dark text-hover-primary font-weight-bold text-3 d-block pb-3 line-height-4">{{$latestBlog->title}}</a>
								@endforeach
							@endif
						</div>
					</div>
					<div class="py-1 clearfix">
						<hr class="my-2">
					</div>
					<div class="px-3 mt-4">
						<h3 class="text-color-quaternary text-capitalize font-weight-bold text-5 m-0">Categories</h3>
						<ul class="nav nav-list flex-column mt-2 mb-0 p-relative right-9">
							@if (!empty($categories))
								@foreach ($categories as $category)
								<li class="nav-item"><a class="nav-link bg-transparent border-0" href="{{route('blogs',$category->slug)}}">{{$category->title}} ({{$category->categories->count()}})</a></li>
								@endforeach
							@endif
						</ul>
					</div>
				</aside>
			</div>
		</div>
	</div>

	<div class="position-relative pb-5 d-none d-xl-block">
		<div class="position-absolute transform3dy-n50 left-0">
			<div class="appear-animation" data-appear-animation="fadeInRightShorterPlus" data-appear-animation-delay="1500" data-appear-animation-duration="1500ms">
				<div class="custom-square-1 bg-primary mt-0 mb-5"></div>
			</div>
		</div>
	</div>

</div>
@endsection
