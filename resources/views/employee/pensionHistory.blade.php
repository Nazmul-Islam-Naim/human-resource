@extends('layouts.layout')
@section('title', 'কর্মকর্তা/কর্মচারীর পেনশন/পি আর এল ইতিহাস')
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
            <h3 class="card-title">কর্মকর্তা/কর্মচারীর তথ্য</h3>
                
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
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->user_type_object->employee_id)}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">কর্মকর্তা/কর্মচারীর নাম</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->user_type_object->name}}</td>
                    </tr>
                    <tr> 
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">লিঙ্গ</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{genders()[$single_data->user_type_object->gender]}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">জন্ম তারিখ</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{date('d-m-Y',strtotime($single_data->user_type_object->dob))}}</td>
                    </tr>
                    <tr> 
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">বাবার নাম </td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->user_type_object->father_name}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">মায়ের নাম</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->user_type_object->mother_name}}</td>
                    </tr>
                    <tr> 
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">বৈবাহিক অবস্থা</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{maritalStatus()[$single_data->user_type_object->marital_status]}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">মোবাইল</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->user_type_object->phone}}</td>
                    </tr>
                    <tr> 
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">বর্তমান ঠিকানা</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->user_type_object->present_address}}</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">স্থায়ী ঠিকানা</td>
                      
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->user_type_object->parmanent_address}}</td>
                    </tr>
                  </thead>
                </table>
              </div>
              <br>
              <center><h5 style="margin: 0px">পেনশন/পি আর এল ইতিহাস</h5></center>
              <div class="table-responsive">
                <table class="table table-hover table-striped tmb0" style="width: 100%; font-size: 14px;" cellspacing="0" cellpadding="0">  
                  <thead>
                  </thead>
                  <tbody> 
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">পি আর এল তারিখ</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{date('d-m-Y',strtotime($single_data->prl_date))}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">সর্বশেষ মূল বেতন</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->last_basic_salary)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">গড় বেতনে ছুটি</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->leave_average_pay)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">অর্ধগড় বেতনে ছুটি</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->leave_half_pay)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">পাওনা প্রেভিডেন্ট ফান্ড</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->due_provident_fund)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">ছুটি নগদায়ন পাওনা</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->leave_encashment_owed)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">গ্রাচ্যুটির পরিমান</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->amount_gratuity)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">অডিট আপত্তিকৃত টাকার পরিমান</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->audit_objected_amount)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">অডিট আপত্তির কারন</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->reason_audit_objections}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">মোট পাওনা টাকার পরিমান</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->total_amount_owed)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">পরিশোধযোগ্য টাকার পরিমান</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->amount_money_payable)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">প্রেভিডেন্ট ফান্ড</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->provident_fund)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">ছুটি নগদায়ন</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->leave_encashment)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">গ্রাচ্যুটি</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->gratuity)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">গৃহীত লোনের পরিমান</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Converter::en2bn($single_data->amount_loan_taken)}}</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">লোনের কারন</td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$single_data->reason_amount_loan_taken}}</td>
                    </tr>
                    @if(empty($single_data))
                    <tr>
                      <td colspan="6" align="center">
                        <h4 style="color: #ccc">No Data Found . . .</h4>
                      </td>
                    </tr>
                    @endif
                  </tbody>
                  <tfoot> </tfoot>
                </table>
                <div class="col-md-12" align="right">
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