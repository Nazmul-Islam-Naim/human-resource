@extends('website.layouts.layout')
@section('content')
<div role="main" class="main">

	<section class="page-header bg-color-tertiary custom-page-header page-header-modern page-header-background page-header-background-sm parallax mt-0" data-plugin-parallax data-plugin-options="{'speed': 1.2}" data-image-src="{{asset('storage/'.($commonSlider->slider_image ?? ''))}}">
		<div class="container">
			<div class="row">
				<div class="col-md-12 align-self-center">
					<ul class="breadcrumb custom-breadcrumb d-block text-center text-4">
						<li><a href="{{route('home')}}">Home</a></li>
						<li class="active">Blog Details</li>
					</ul>
				</div>
				<div class="col-md-12 align-self-center p-static text-center mt-2">
					<h1 class="font-weight-bold text-color-secondary text-11">Blogs Details</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container pt-4 pb-5 my-5">
		<div class="row">
			<div class="col-lg-8 mb-5 mb-lg-0 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1600">

				<article>
					<div class="card border-0">
						<div class="card-body z-index-1 p-0">
							<p class="text-uppercase text-1 mb-3 text-color-default"><time pubdate datetime="2023-01-10">{{date('d F Y',strtotime($blog->created_at))}}</time> <span class="opacity-3 d-inline-block px-2">|</span> {{$blog->category->title ?? ''}} <span class="opacity-3 d-inline-block px-2">|</span> {{$blog->creator->name ?? ''}}</p>

							<div class="post-image pb-4">
								<img class="card-img-top custom-border-radius-1" src="{{asset('storage/'.($blog->image ?? ''))}}" alt="Card Image">
							</div>

							<div class="card-body p-0">
								{!! $blog->details !!}

								<!-- Go to www.addthis.com/dashboard to customize your tools -->
								<div class="addthis_inline_share_toolbox"></div>
								<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60ba220dbab331b0"></script>

							</div>
						</div>
					</div>
				</article>

			</div>
			<div class="blog-sidebar col-lg-4 pt-4 pt-lg-0 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1800">
				<aside class="sidebar">
					<div class="px-3 mb-4">
						<h3 class="text-color-quaternary text-capitalize font-weight-bold text-5 m-0 mb-3">About The Blog</h3>
						<p class="m-0">{{$blog->title}}</p>
					</div>
					<div class="py-1 clearfix">
						<hr class="my-2">
					</div>
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

</div>
@endsection
