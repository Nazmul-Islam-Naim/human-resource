@extends('layouts.layout')
@section('title', 'কর্মচারী/কর্মকর্তা স্থানান্তরের ইতিহাস')
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
    </div>
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">কর্মকর্তা/কর্মচারীর তথ্য </h3>
                
            <a onclick="printReport();" href="javascript:0;"><img class="img-thumbnail" style="width:30px;" src='{{asset("custom/img/print.png")}}'></a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12" id="printTable">
              <center><h5 style="margin: 0px">কর্মকর্তা/কর্মচারীর তথ্য </h5></center>
              <div class="table-responsive">
                <table class="" style="width: 100%; font-size: 14px;" cellspacing="0" cellpadding="0">
                  <thead> 
                    <tr> 
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">কর্মকর্তা/কর্মচারীর আইডি</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->employee_id}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">কর্মকর্তা/কর্মচারীর নাম </td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->name}}</td>
                    </tr>
                    <tr> 
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">লিঙ্গ</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{genders()[$single_data->gender]}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">জন্ম তারিখ</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{date('d-m-Y',strtotime($single_data->dob))}}</td>
                    </tr>
                    <tr> 
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">বাবার নাম </td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->father_name}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">মায়ের নাম </td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->mother_name}}</td>
                    </tr>
                    <tr> 
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">বৈবাহিক অবস্থা</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{maritalStatus()[$single_data->marital_status]}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px"> মোবাইল</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->phone}}</td>
                    </tr>
                    <tr> 
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">বর্তামান ঠিকানা</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->present_address}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px"> স্থায়ী ঠিকানা </td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->parmanent_address}}</td>
                    </tr>
                  </thead>
                </table>
              </div>
              <br>
              <center><h5 style="margin: 0px">স্থানান্তরের ইতিহাস</h5></center>
              <div class="table-responsive">
                <table class="" style="width: 100%; font-size: 14px;" cellspacing="0" cellpadding="0">  
                  <thead> 
                    <tr style="background: #ccc; color: #000"> 
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">সিঃ</th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">স্থানান্তরের তারিখ</th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">যোগদানের তারিখ</th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">বর্তমান কর্মস্থল</th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">বর্তমান পদবি </th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">পূর্বে যোগদানের তারিখ</th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">পূর্বের কর্মস্থল</th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px"> পূর্বের পদবি </th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">বেতন</th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php                           
                      $number = 1;
                      $numElementsPerPage = 250; // How many elements per page
                      $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                      $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                      $rowCount = 0;

                      $sum = 0;
                      $debit = 0;
                      $credit = 0;
                    ?>
                    @foreach($alldata as $data)
                    <?php $rowCount++; ?>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$currentNumber++}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{date('d-m-Y',strtotime($data->transferred_workstation_date))}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{date('d-m-Y',strtotime($data->transferred_workstation_joining_date))}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$data->user_present_workstation_object->name}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$data->user_present_designation_object->name}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{date('d-m-Y',strtotime($data->present_workstation_joining_date))}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$data->user_previous_workstation_object->name}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$data->user_previous_designation_object->name}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$data->salary}}</td>
                    </tr>
                    @endforeach
                    @if($rowCount==0)
                    <tr>
                      <td colspan="9" align="center">
                        <h4 style="color: #ccc">No Data Found . . .</h4>
                      </td>
                    </tr>
                    @endif
                  </tbody>
                  <tfoot> </tfoot>
                </table>
                <div class="col-md-12" align="right">
                  {{-- {{$alldata->render()}} --}}
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- /.content -->
@endsection 