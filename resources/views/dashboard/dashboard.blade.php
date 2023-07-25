@extends('layouts.layout')
@section('title', 'ড্যাশবোর্ড')
@section('content')
<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

	<!-- Content wrapper start -->
	<div class="content-wrapper">

		<!-- Row start -->
		<div class="row gutters">
			{{-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('user-list.show',($dg->id ?? ''))}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('storage/'. ($dg->avatar??''))}}"  width="40" height="40" alt="">
						</div>
						<div class="sale-details">
							<h6>{{$dg->name ?? ''}}</h6>
							<p>মহাপরিচালক</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('user-list.show',($secretary->id ?? ''))}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('storage/'. ($secretary->avatar??''))}}"  width="40" height="40" alt="">
						</div>
						<div class="sale-details">
							<h6>{{$secretary->name ?? ''}}</h6>
							<p>সচিব</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('user-list.show',($deputySecretary->id ?? ''))}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('storage/'. ($deputySecretary->avatar??''))}}" width="40" height="40" alt="">
						</div>
						<div class="sale-details">
							<h6>{{$deputySecretary->name ?? ''}}</h6>
							<p>উপ-সচিব</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div> --}}
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('workstation.index')}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('custom/img/dashboard/workstation.gif')}}" alt="">
						</div>
						<div class="sale-details">
							<h2>{{$workstations}}</h2>
							<p>কর্মস্থল</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('designation.index')}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('custom/img/dashboard/designation.gif')}}" alt="">
						</div>
						<div class="sale-details">
							<h2>{{$designations}}</h2>
							<p>পদবী</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('empty-designation')}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('custom/img/dashboard/designation.gif')}}" alt="">
						</div>
						<div class="sale-details">
							<h2>{{$emptyDesignations}}</h2>
							<p>পদ শূন্য</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('overall-employee')}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('custom/img/dashboard/employees.gif')}}" alt="">
						</div>
						<div class="sale-details">
							<h2>{{$employees}}</h2>
							<p>মোট কর্মকর্তা/কর্মচারী</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('director')}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('custom/img/dashboard/director.gif')}}" alt="">
						</div>
						<div class="sale-details">
							<h2>{{$directors}}</h2>
							<p>পরিচালক</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('assistant-director')}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('custom/img/dashboard/assistant.gif')}}" alt="">
						</div>
						<div class="sale-details">
							<h2>{{$assitantDirectors}}</h2>
							<p>সহকারী পরিচালক</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('sub-assistant-director')}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('custom/img/dashboard/subAssistant.gif')}}" alt="">
						</div>
						<div class="sale-details">
							<h2>{{$subAssitantDirectors}}</h2>
							<p>উপ-সহকারী পরিচালক</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('present-employee')}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('custom/img/dashboard/employees.gif')}}" alt="">
						</div>
						<div class="sale-details">
							<h2>{{$runningEmployees}}</h2>
							<p>বর্তমান কর্মকর্তা/কর্মচারী</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('up-coming-pensions')}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('custom/img/dashboard/pension.gif')}}" alt="">
						</div>
						<div class="sale-details">
							<h2>{{$upComingPensions}}</h2>
							<p>আসন্ন পেনশন</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{route('pension-employee')}}" target="_blank">
					<div class="stats-tile">
						<div class="sale-icon">
							<img src="{{asset('custom/img/dashboard/pension.gif')}}" alt="">
						</div>
						<div class="sale-details">
							<h2>{{$pensionEmployees}}</h2>
							<p>পেনশন প্রাপ্ত কর্মকর্তা/কর্মচারী</p>
						</div>
						<div class="sale-graph">
							<div id="sparklineLine5"></div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<!-- Row end -->
	</div>
	<!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
@endsection