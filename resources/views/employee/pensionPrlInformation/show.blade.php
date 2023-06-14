@extends('layouts.layout')
@section('title', 'কর্মকর্তা/কর্মচারীর প্রোফাইল')
@section('content')
<!-- Content Header (Page header) -->
@php
    use App\Enum\SexEnum;
    use App\Enum\MaritialStatusEnum;
    use Rakibhstu\Banglanumber\NumberToBangla;
    $numTo = new NumberToBangla();
@endphp
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
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">কর্মকর্তা/কর্মচারীর পেনশন সম্পর্কিত তথ্যাদি</div>
                    <div class="graph-day-selection" role="group">
                      <a onclick="printReport();" href="javascript:0;"><i class="icon-print"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12" id="printReport">
                        <div class="table-responsive">
                          <table class="table table-bordered " style="width: 100%; font-size: 14px;" cellspacing="0" cellpadding="0">
                            <tbody>  
                              <tr>
                                <td colspan="4" style=" text-align:center">
                                  <h3>ইসলামিক ফাউন্ডেশন</h3>
                                  <p><small>[প্রতিষ্ঠাতাঃ জাতির পিতা বঙ্গবন্ধু শেখ মুজিবুর রহমান]</small></p>
                                  <p><u>আগারগাঁও, শেরে বাংলানগর, ঢাকা-১২০৭</u></p>
                                </td>
                                <td colspan="4" style="text-align:center">
                                  @if (!empty($employeePensionPrl->generalInformation->photo))
                                  <img class="profile-user-img img-responsive img-circle" src="{{asset('storage/'.$employeePensionPrl->generalInformation->photo)}}" width="150" height="150" alt="User profile picture">
                                  @else
                                  <img class="profile-user-img img-responsive img-circle" src="{{asset('custom/img/noImage.png')}}" width="150" height="150" alt="User profile picture">
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td colspan="8" style="text-align: center">ক. সাধারন তথ্যাদি</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">নামঃ (বাংলায়) {{$employeePensionPrl->generalInformation->name_in_bangla}} <br> (ইংরেজী) {{$employeePensionPrl->generalInformation->name_in_english}} </td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">পিতার নামঃ {{$employeePensionPrl->generalInformation->fathers_name_in_bangla}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">নিজ জেলাঃ {{$employeePensionPrl->generalInformation->district->name ?? ''}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">মাতার নামঃ {{$employeePensionPrl->generalInformation->mothers_name_in_bangla}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">জন্ম তারিখঃ {{$numTo->bnNum(date('d',strtotime($employeePensionPrl->generalInformation->birth_date)))}}/
                                  {{$numTo->bnNum(date('m',strtotime($employeePensionPrl->generalInformation->birth_date)))}}/{{$numTo->bnNum(date('Y',strtotime($employeePensionPrl->generalInformation->birth_date)))}} খ্রিঃ </td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">পির আর এল/এল পি আর তারিখঃ {{$numTo->bnNum(date('d',strtotime($employeePensionPrl->generalInformation->prl_date)))}}/
                                  {{$numTo->bnNum(date('m',strtotime($employeePensionPrl->generalInformation->prl_date)))}}/{{$numTo->bnNum(date('Y',strtotime($employeePensionPrl->generalInformation->prl_date)))}} খ্রিঃ </td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">বর্তমান পদের নাম ও কর্মস্থলঃ {{$employeePensionPrl->generalInformation->presentDesignation->title ?? ''}}, {{$employeePensionPrl->generalInformation->presentWorkStation->name ?? ''}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">বর্তমান পদবী ও বেতন স্কেলঃ  {{$employeePensionPrl->generalInformation->presentDesignation->title ?? ''}}, {{$employeePensionPrl->generalInformation->salaryScale->name ?? ''}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; ">চাকুরীতে যোগদানের তারিখ ও পদের নামঃ  {{$numTo->bnNum(date('d',strtotime($employeePensionPrl->generalInformation->joining_date)))}}/
                                  {{$numTo->bnNum(date('m',strtotime($employeePensionPrl->generalInformation->joining_date)))}}/{{$numTo->bnNum(date('Y',strtotime($employeePensionPrl->generalInformation->joining_date)))}} খ্রিঃ, {{$employeePensionPrl->generalInformation->joiningDesignation->title ?? ''}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; ">চাকুরীতে স্থায়ীকরনের তারিখ ও আদেশ নংঃ  {{$numTo->bnNum(date('d',strtotime($employeePensionPrl->generalInformation->permanent_date)))}}/
                                  {{$numTo->bnNum(date('m',strtotime($employeePensionPrl->generalInformation->permanent_date)))}}/{{$numTo->bnNum(date('Y',strtotime($employeePensionPrl->generalInformation->permanent_date)))}} খ্রিঃ, {{$employeePensionPrl->generalInformation->order_no}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">স্থায়ী ঠিকানাঃ {{$employeePensionPrl->generalInformation->permanent_address}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">বর্তমান ঠিকানাঃ {{$employeePensionPrl->generalInformation->present_address}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">মোবাইলঃ {{$employeePensionPrl->generalInformation->mobile}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">ইমেইলঃ {{$employeePensionPrl->generalInformation->email}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">লিঙ্গঃ {{SexEnum::getFromValue($employeePensionPrl->generalInformation->sex ?? '1')->name}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">বৈবাহিক অবস্থাঃ {{MaritialStatusEnum::getFromValue($employeePensionPrl->generalInformation->maritial_status ?? '1')->name}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">স্বামী/স্ত্রীর নাম ও পেশাঃ  {{$employeePensionPrl->generalInformation->spouse_name_in_bangla}}, {{$employeePensionPrl->generalInformation->occupation->name ?? ''}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">স্ত্রীর জেলার নামঃ {{$employeePensionPrl->generalInformation->spouseDistrict->name ?? ''}}</td>
                              </tr>
                              <tr style="border:none; text-align: center; height:50px">
                                <td colspan="8" style="border:none; text-align: center;">খ. পেনশন/পি আর এল সম্পর্কিত তথ্যাদি</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">সর্বশেষ মূল বেতনঃ {{$employeePensionPrl->last_basic_salary}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">গড় বেতনে ছুটিঃ {{$employeePensionPrl->leave_average_pay}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">অর্ধগড় বেতনে ছুটিঃ {{$employeePensionPrl->leave_half_pay}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">পাওনা প্রেভিডেন্ট ফান্ডঃ {{$employeePensionPrl->due_provident_fund}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">ছুটি নগদায়ন পাওনাঃ {{$employeePensionPrl->leave_encashment_owed}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">গ্রাচ্যুটির পরিমানঃ {{$employeePensionPrl->amount_gratuity}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">অডিট আপত্তিকৃত টাকার পরিমানঃ {{$employeePensionPrl->audit_objected_amount}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">অডিট আপত্তির কারনঃ {{$employeePensionPrl->reason_audit_objections}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">মোট পাওনা টাকার পরিমানঃ {{$employeePensionPrl->total_amount_owed}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">পরিশোধযোগ্য টাকার পরিমানঃ {{$employeePensionPrl->amount_money_payable}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">প্রেভিডেন্ট ফান্ডঃ {{$employeePensionPrl->provident_fund}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">ছুটি নগদায়নঃ {{$employeePensionPrl->leave_encashment}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">গ্রাচ্যুটিঃ {{$employeePensionPrl->gratuity}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">গৃহীত লোনের পরিমানঃ {{$employeePensionPrl->amount_loan_taken}}</td>
                              </tr>
                              <tr>
                                <td colspan="8" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">লোনের কারনঃ {{$employeePensionPrl->reason_amount_loan_taken}}</td>
                              </tr>
                            </tbody>
                          </table>
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