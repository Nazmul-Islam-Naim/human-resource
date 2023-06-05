@extends('layouts.layout')
@section('title', 'কর্মকর্তা/কর্মচারীর প্রোফাইল')
@section('content')
<!-- Content Header (Page header) -->
<?php
  $baseUrl = URL::to('/');
?>
<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <!-- Row start -->
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        @include('common.message')
        @include('common.commonFunction')
      </div>
  
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body box-profile">
                    @if (!empty($single_data->image))
                    <center><img class="profile-user-img img-responsive img-circle" src="{{asset('storage/app/public/uploads/employee/'.$single_data->image)}}" alt="User profile picture"></center>
                    @else
                    <center><img class="profile-user-img img-responsive img-circle" src="{{asset('storage/app/public/uploads/employee/no-image.jpg')}}" alt="User profile picture"></center>
                    @endif

                    <h3 class="profile-username text-center">{{$single_data->name}}</h3>

                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item listnoback">
                        <b>কর্মকর্তা/কর্মচারীর আইডি</b> <a class="pull-right text-aqua">{{Converter::en2bn($single_data->employee_id)}}</a>
                      </li>
            
                      <li class="list-group-item listnoback">
                        <b>ডিপার্টমেন্ট </b> <a class="pull-right text-aqua">{{$single_data->user_type_object->user_type??''}}</a>
                      </li>
                      <li class="list-group-item listnoback">
                        <b>মূল পদবী </b> <a class="pull-right text-aqua">{{$single_data->user_designation_object->name??''}}</a>
                      </li>
                      <li class="list-group-item listnoback">
                        <b>বর্তমান কর্মস্থলের পদবী </b> <a class="pull-right text-aqua">{{$single_data->work_station_desigantion->name??''}}</a>
                      </li>
                      <li class="list-group-item listnoback">
                        <b>বেতন স্কেল</b> <a class="pull-right text-aqua">{{$single_data->user_salary_scale_object->name??''}}</a>
                      </li>
                      <li class="list-group-item listnoback">
                        <b>বেতন</b> <a class="pull-right text-aqua">{{Converter::en2bn($single_data->salary)}}</a>
                      </li>
                      <li class="list-group-item listnoback">
                        <b> কর্মস্থল </b> <a class="pull-right text-aqua">{{$single_data->user_workstation_object->name??''}}</a>
                      </li>
                      <li class="list-group-item listnoback">
                        <b>নিজ জেলা</b> <a class="pull-right text-aqua">{{$single_data->user_district_object->name??''}}</a>
                      </li>
                      <li class="list-group-item listnoback">
                        <b>যোগদানের তারিখ</b> <a class="pull-right text-aqua">{{bangla_date(strtotime($single_data->join_date),"en")}}</a> 
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">কর্মকর্তা/কর্মচারীর বিস্তারিত</div>
                    <div class="graph-day-selection" role="group">
                      <a href="{{ URL::to('hr/employee-list') }}" class="btn">কর্মকর্তা/কর্মচারীর তালিকা</a>
                      <a href="{{ route('edit-employee-list', $single_data->id) }}" class="btn">সংশোধন</a>
                      <a href="{{ route('employee-transferred-history', $single_data->id) }}" class="btn">বদলীর ইতিহাস</a>
                      @if ($single_data->status == 2)
                      <a href="{{ route('employee-pension-prl-history', $single_data->id) }}" class="btn"> পেনশন/পি আর এল ইতিহাস </a> 
                      @endif
                      <!-- <a href="button" class="btn active">Change Password</a> -->
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="custom-tabs-container">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="first-tab" data-bs-toggle="tab" href="#Profile" role="tab" aria-controls="Profile" aria-selected="true">প্রোফাইল</a>
                        </li>
                        <!--<li class="nav-item" role="presentation">
                          <a class="nav-link" id="second-tab" data-bs-toggle="tab" href="#Payroll" role="tab" aria-controls="Payroll" aria-selected="false">Payroll</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="third-tab" data-bs-toggle="tab" href="#Leaves" role="tab" aria-controls="Leaves" aria-selected="false">Leaves</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="third-tab" data-bs-toggle="tab" href="#Attendance" role="tab" aria-controls="Attendance" aria-selected="false">Attendance</a>
                        </li> -->
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="Profile" role="tabpanel">

                          <table class="table table-hover table-striped tmb0">
                            <tbody>  
                              <tr>
                                <td>মোবাইল</td>
                                <td>{{Converter::en2bn($single_data->phone)}}</td>
                              </tr>
                              <tr>
                                <td>ইমার্জেন্সি মোবাইল</td>
                                <td>{{Converter::en2bn($single_data->emergency_phone)}}</td>
                              </tr>
                              <tr>
                                <td>ইমেল</td>
                                <td>{{$single_data->email}}</td>
                              </tr>
                              <tr>
                                <td>লিঙ্গ</td>
                                <td>{{genders()[$single_data->gender]}}</td>
                              </tr>
                              <tr>
                                <td>জন্ম তারিখ</td>
                                <td>{{bangla_date(strtotime($single_data->dob),"en")}}</td>
                              </tr>
                              <tr>
                                <td>বৈবাহিক অবস্থা</td>
                                <td>{{maritalStatus()[$single_data->marital_status]}}</td>
                              </tr>
                              <tr>
                                <td class="col-md-4">বাবার নাম</td>
                                <td class="col-md-5">{{$single_data->father_name}}</td>
                              </tr>
                              <tr>
                                <td>মায়ের নাম</td>
                                <td>{{$single_data->mother_name}}</td>
                              </tr>
                              <tr>
                                <td> বর্তমান ঠিকানা</td>
                                <td>{{$single_data->present_address}}</td>
                              </tr>
                              <tr>
                                <td>স্থায়ী ঠিকানা</td>
                                <td>{{$single_data->permanent_address}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="tab-pane fade" id="Payroll" role="tabpanel">
                          
                          <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                              <div class="stats-tile" style="background: #efeff0">
                                <div class="sale-icon">
                                  <i class="icon-shopping-bag1"></i>
                                </div>
                                <div class="sale-details">
                                  
                                  <h2></h2>
                                  <a href="http://127.0.0.1:8000/hc/rooms"><p>Total Net Salary Paid <br>
                                    $314,490.00
                                  </p></a>
                                </div>
                                <div class="sale-graph">
                                  <div id="sparklineLine5"></div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                              <div class="stats-tile" style="background: #efeff0">
                                <div class="sale-icon">
                                  <i class="icon-shopping-bag1"></i>
                                </div>
                                <div class="sale-details">
                                  
                                  <h2></h2>
                                  <a href="http://127.0.0.1:8000/hc/rooms"><p>Total Gross Salary <br>
                                    $314,490.00
                                  </p></a>
                                </div>
                                <div class="sale-graph">
                                  <div id="sparklineLine5"></div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                              <div class="stats-tile" style="background: #efeff0">
                                <div class="sale-icon">
                                  <i class="icon-shopping-bag1"></i>
                                </div>
                                <div class="sale-details">
                                  
                                  <h2></h2>
                                  <a href="http://127.0.0.1:8000/hc/rooms"><p>Total Earning <br>
                                    $314,490.00
                                  </p></a>
                                </div>
                                <div class="sale-graph">
                                  <div id="sparklineLine5"></div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                              <div class="stats-tile" style="background: #efeff0">
                                <div class="sale-icon">
                                  <i class="icon-shopping-bag1"></i>
                                </div>
                                <div class="sale-details">
                                  
                                  <h2></h2>
                                  <a href="http://127.0.0.1:8000/hc/rooms"><p>Total Deduction <br>
                                    $314,490.00
                                  </p></a>
                                </div>
                                <div class="sale-graph">
                                  <div id="sparklineLine5"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="table-responsive">
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Payslip #</th>
                                    <th>Month - Year</th>
                                    <th>Date</th>
                                    <th>Mode</th>
                                    <th>Status</th>
                                    <th>Net Salary</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>

                        </div>
                        <div class="tab-pane fade" id="Leaves" role="tabpanel">
                          
                          <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                              <div class="stats-tile" style="background: #efeff0">
                                <div class="sale-icon">
                                  <i class="icon-shopping-bag1"></i>
                                </div>
                                <div class="sale-details">
                                  <a href="http://127.0.0.1:8000/hc/rooms"><h5>Casual Leave (15)</h5>
                                  <p style="font-size: 10px;margin-bottom: 0;">Used: 14</p>
                                  <p style="font-size: 10px;margin-bottom: 0;">Available: 1</p></a>
                                </div>
                                <div class="sale-graph">
                                  <div id="sparklineLine5"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="table-responsive">
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Leave Type</th>
                                    <th>Leave Date</th>
                                    <th>Days</th>
                                    <th>Apply Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>

                        </div>
                        <div class="tab-pane fade" id="Attendance" role="tabpanel">
                          
                          <p class="text-muter">Attendance</p>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection 