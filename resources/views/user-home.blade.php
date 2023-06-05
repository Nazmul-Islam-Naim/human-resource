@extends('layouts.layout')
@section('title', 'User Dashboard')
@section('content')
<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

	<!-- Content wrapper start -->
	<div class="content-wrapper">

		<!-- Row start -->
		<div class="row gutters">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="stats-tile">
					<div class="sale-icon">
						<i class="icon-shopping-bag1"></i>
					</div>
					<div class="sale-details">
						<h2>000</h2>
						<a href="{{URL::To('hc/rooms')}}"><p>Total Package Taken</p></a>
					</div>
					<div class="sale-graph">
						<div id="sparklineLine5"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- Row end -->
	</div>
	<!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
@endsection