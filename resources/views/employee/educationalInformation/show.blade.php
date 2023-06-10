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
                    <div class="card-title">কর্মকর্তা/কর্মচারীর বিস্তারিত</div>
                    <div class="graph-day-selection" role="group">
                      <a href="{{ route('generalInformations.index' ) }}" class="btn"><i class="icon-list"></i></a>
                      <a href="{{ route('generalInformations.edit', $generalInformation->id) }}" class="btn"><i class="icon-edit1"></i></a>
                      <a onclick="printReport();" href="javascript:0;"><i class="icon-print"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive" id="printReport">
                      <table class="table table-bordered " style="width: 100%; font-size: 14px;" cellspacing="0" cellpadding="0">
                        <tbody>  
                          <tr>
                            <td colspan="2" style=" text-align:center">
                              <h3 style="margin-left: 90px;">ইসলামিক ফাউন্ডেশন</h3>
                              <p style="margin-left: 90px;"><small>[প্রতিষ্ঠাতাঃ জাতির পিতা বঙ্গবন্ধু শেখ মুজিবুর রহমান]</small></p>
                              <p style="margin-left: 90px;"><u>আগারগাঁও, শেরে বাংলানগর, ঢাকা-১২০৭</u></p>
                            </td>
                            <td colspan="2" style="">
                              @if (!empty($generalInformation->photo))
                              <img class="profile-user-img img-responsive img-circle" src="{{asset('storage/'.$generalInformation->photo)}}" width="150" height="150" alt="User profile picture">
                              @else
                              <img class="profile-user-img img-responsive img-circle" src="{{asset('custom/img/noImage.png')}}" width="150" height="150" alt="User profile picture">
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td colspan="4" style="text-align: center">ক. সাধারন তথ্যাদি</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">নামঃ (বাংলায়) {{$generalInformation->name_in_bangla}} <br> (ইংরেজী) {{$generalInformation->name_in_english}} </td>
                            <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">পিতার নামঃ {{$generalInformation->fathers_name_in_bangla}}</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">নিজ জেলাঃ {{$generalInformation->district->name ?? ''}}</td>
                            <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">মাতার নামঃ {{$generalInformation->mothers_name_in_bangla}}</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">জন্ম তারিখঃ {{$numTo->bnNum(date('d',strtotime($generalInformation->birth_date)))}}/
                              {{$numTo->bnNum(date('m',strtotime($generalInformation->birth_date)))}}/{{$numTo->bnNum(date('Y',strtotime($generalInformation->birth_date)))}} খ্রিঃ </td>
                            <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">পির আর এল/এল পি আর তারিখঃ {{$numTo->bnNum(date('d',strtotime($generalInformation->prl_date)))}}/
                              {{$numTo->bnNum(date('m',strtotime($generalInformation->prl_date)))}}/{{$numTo->bnNum(date('Y',strtotime($generalInformation->prl_date)))}} খ্রিঃ </td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">বর্তমান পদের নাম ও কর্মস্থলঃ {{$generalInformation->presentDesignation->title ?? ''}}, {{$generalInformation->presentWorkStation->name ?? ''}}</td>
                            <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">বর্তমান পদবী ও বেতন স্কেলঃ  {{$generalInformation->presentDesignation->title ?? ''}}, {{$generalInformation->salaryScale->name ?? ''}}</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">চাকুরীতে যোগদানের তারিখ ও পদের নামঃ  {{$numTo->bnNum(date('d',strtotime($generalInformation->joining_date)))}}/
                              {{$numTo->bnNum(date('m',strtotime($generalInformation->joining_date)))}}/{{$numTo->bnNum(date('Y',strtotime($generalInformation->joining_date)))}} খ্রিঃ, {{$generalInformation->joiningDesignation->title ?? ''}}</td>
                            <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">চাকুরীতে স্থায়ীকরনের তারিখ ও আদেশ নংঃ  {{$numTo->bnNum(date('d',strtotime($generalInformation->permanent_date)))}}/
                              {{$numTo->bnNum(date('m',strtotime($generalInformation->permanent_date)))}}/{{$numTo->bnNum(date('Y',strtotime($generalInformation->permanent_date)))}} খ্রিঃ, {{$generalInformation->order_no}}</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">স্থায়ী ঠিকানাঃ {{$generalInformation->permanent_address}}</td>
                            <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">বর্তমান ঠিকানাঃ {{$generalInformation->present_address}}</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">মোবাইলঃ {{$generalInformation->mobile}}</td>
                            <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">ইমেইলঃ {{$generalInformation->email}}</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">লিঙ্গঃ {{SexEnum::getFromValue($generalInformation->sex ?? '1')->name}}</td>
                            <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">বৈবাহিক অবস্থাঃ {{MaritialStatusEnum::getFromValue($generalInformation->maritial_status ?? '1')->name}}</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">স্বামী/স্ত্রীর নাম ও পেশাঃ  {{$generalInformation->spouse_name_in_bangla}}, {{$generalInformation->occupation->name ?? ''}}</td>
                            <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">বৈবাহিক অবস্থাঃ {{$generalInformation->spouseDistrict->name ?? ''}}</td>
                          </tr>
                        </tbody>
                      </table>
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