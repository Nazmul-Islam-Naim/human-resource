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
                                  @if (!empty($generalInformation->photo))
                                  <img class="profile-user-img img-responsive img-circle" src="{{asset('storage/'.$generalInformation->photo)}}" width="150" height="150" alt="User profile picture">
                                  @else
                                  <img class="profile-user-img img-responsive img-circle" src="{{asset('custom/img/noImage.png')}}" width="150" height="150" alt="User profile picture">
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td colspan="8" style="text-align: center">ক. সাধারন তথ্যাদি</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">নামঃ (বাংলায়) {{$generalInformation->name_in_bangla}} <br> (ইংরেজী) {{$generalInformation->name_in_english}} </td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">পিতার নামঃ {{$generalInformation->fathers_name_in_bangla}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">নিজ জেলাঃ {{$generalInformation->district->name ?? ''}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">মাতার নামঃ {{$generalInformation->mothers_name_in_bangla}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">জন্ম তারিখঃ {{$numTo->bnNum(date('d',strtotime($generalInformation->birth_date)))}}/
                                  {{$numTo->bnNum(date('m',strtotime($generalInformation->birth_date)))}}/{{$numTo->bnNum(date('Y',strtotime($generalInformation->birth_date)))}} খ্রিঃ </td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">পির আর এল/এল পি আর তারিখঃ {{$numTo->bnNum(date('d',strtotime($generalInformation->prl_date)))}}/
                                  {{$numTo->bnNum(date('m',strtotime($generalInformation->prl_date)))}}/{{$numTo->bnNum(date('Y',strtotime($generalInformation->prl_date)))}} খ্রিঃ </td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">বর্তমান পদের নাম ও কর্মস্থলঃ {{$generalInformation->presentDesignation->title ?? ''}}, {{$generalInformation->presentWorkStation->name ?? ''}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">বর্তমান পদবী ও বেতন স্কেলঃ  {{$generalInformation->presentDesignation->title ?? ''}}, {{$generalInformation->salaryScale->name ?? ''}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; ">চাকুরীতে যোগদানের তারিখ ও পদের নামঃ  {{$numTo->bnNum(date('d',strtotime($generalInformation->joining_date)))}}/
                                  {{$numTo->bnNum(date('m',strtotime($generalInformation->joining_date)))}}/{{$numTo->bnNum(date('Y',strtotime($generalInformation->joining_date)))}} খ্রিঃ, {{$generalInformation->joiningDesignation->title ?? ''}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; ">চাকুরীতে স্থায়ীকরনের তারিখ ও আদেশ নংঃ  {{$numTo->bnNum(date('d',strtotime($generalInformation->permanent_date)))}}/
                                  {{$numTo->bnNum(date('m',strtotime($generalInformation->permanent_date)))}}/{{$numTo->bnNum(date('Y',strtotime($generalInformation->permanent_date)))}} খ্রিঃ, {{$generalInformation->order_no}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">স্থায়ী ঠিকানাঃ {{$generalInformation->permanent_address}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">বর্তমান ঠিকানাঃ {{$generalInformation->present_address}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">মোবাইলঃ {{$generalInformation->mobile}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">ইমেইলঃ {{$generalInformation->email}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">লিঙ্গঃ {{SexEnum::getFromValue($generalInformation->sex ?? '1')->name}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">বৈবাহিক অবস্থাঃ {{MaritialStatusEnum::getFromValue($generalInformation->maritial_status ?? '1')->name}}</td>
                              </tr>
                              <tr>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">স্বামী/স্ত্রীর নাম ও পেশাঃ  {{$generalInformation->spouse_name_in_bangla}}, {{$generalInformation->occupation->name ?? ''}}</td>
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:justify; ">স্ত্রীর জেলার নামঃ {{$generalInformation->spouseDistrict->name ?? ''}}</td>
                              </tr>
                              <tr style="border:none; text-align: center; height:50px">
                                <td colspan="8" style="border:none; text-align: center;">খ. শিক্ষাসংক্রান্ত তথ্যাদি</td>
                              </tr>
                              <tr>
                                <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">ক্রম.</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">ডিগ্রী</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">পাসের সন</td>
                                <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">পাঠিত বিষয়</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">বোর্ড/বিশ্ববিদ্যালয়</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">ফলাফল</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">ডকুমেন্ট</td>
                              </tr>
                              @if (count($generalInformation->educationalInformation)>0)
                                  @foreach ($generalInformation->educationalInformation as $key => $educationalInformation)
                                  <tr>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$numTo->bnNum($key+1)}}</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$educationalInformation->degree->name ?? ''}}</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$educationalInformation->passingYear->name ?? ''}}</td>
                                    <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$educationalInformation->readingSubject->name ?? ''}}</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$educationalInformation->board->name ?? ''}}</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$educationalInformation->result}}</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">
                                      @if (!empty($educationalInformation->document))
                                      <a href="{{asset('storage/'.$educationalInformation->document)}}" target="_blank"><i class="icon-documents"></i></a>
                                      @endif
                                    </td>
                                  </tr>
                                  @endforeach
                                @else
                                  <tr>
                                    <td colspan="8" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center;  color:#ddd">কোন তথ্য পাওয়া যায়নি। </td>
                                  </tr>
                                @endif
                                <tr style="border:none; text-align: center; height:50px">
                                  <td colspan="8" style="border:none; text-align: center">গ. প্রশিক্ষন সম্পর্কিত তথ্যাদি</td>
                                </tr>
                                <tr>
                                  <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">ক্রম.</td>
                                  <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">কোর্সের নাম</td>
                                  <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">প্রতিষ্ঠানের নাম</td>
                                  <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">শুরুর তারিখ</td>
                                  <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">শেষ তারিখ</td>
                                  <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">মন্তব্য</td>
                                  <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">ডকুমেন্ট</td>
                                </tr>
                                @if (count($generalInformation->trainingInformation)>0)
                                    @foreach ($generalInformation->trainingInformation as $key => $trainingInformation)
                                    <tr>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$numTo->bnNum($key+1)}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$trainingInformation->course->name ?? ''}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$trainingInformation->institute->name ?? ''}}</td>
                                      <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$numTo->bnNum(date('d',strtotime($trainingInformation->date_from)))}}/
                                        {{$numTo->bnNum(date('m',strtotime($trainingInformation->date_from)))}}/{{$numTo->bnNum(date('Y',strtotime($trainingInformation->date_from)))}} খ্রিঃ </td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$numTo->bnNum(date('d',strtotime($trainingInformation->date_to)))}}/
                                        {{$numTo->bnNum(date('m',strtotime($trainingInformation->date_to)))}}/{{$numTo->bnNum(date('Y',strtotime($trainingInformation->date_to)))}} খ্রিঃ </td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$trainingInformation->comment}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">
                                        @if (!empty($trainingInformation->document))
                                        <a href="{{asset('storage/'.$trainingInformation->document)}}" target="_blank"><i class="icon-documents"></i></a>
                                        @endif
                                      </td>
                                    </tr>
                                    @endforeach
                                  @else
                                    <tr>
                                      <td colspan="8" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center;  color:#ddd">কোন তথ্য পাওয়া যায়নি। </td>
                                    </tr>
                                  @endif
                                <tr style="border:none; text-align: center; height:50px">
                                  <td colspan="8" style="border:none; text-align: center">ঘ. প্রকাশনা সম্পর্কিত তথ্যাদি</td>
                                </tr>
                                <tr>
                                  <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">ক্রম.</td>
                                  <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">প্রকাশনার শিরোনাম</td>
                                  <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">জার্নালের নাম/বইয়ের নামে</td>
                                  <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">প্রকাশকাল</td>
                                  <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">মন্তব্য</td>
                                  <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">ডকুমেন্ট</td>
                                </tr>
                                @if (count($generalInformation->publicationInformation)>0)
                                    @foreach ($generalInformation->publicationInformation as $key => $publicationInformation)
                                    <tr>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$numTo->bnNum($key+1)}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$publicationInformation->publication->name ?? ''}}</td>
                                      <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$publicationInformation->books_name}}</td>
                                      <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$numTo->bnNum(date('d',strtotime($publicationInformation->publication_date)))}}/
                                        {{$numTo->bnNum(date('m',strtotime($publicationInformation->publication_date)))}}/{{$numTo->bnNum(date('Y',strtotime($publicationInformation->publication_date)))}} খ্রিঃ </td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$publicationInformation->comment}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">
                                        @if (!empty($publicationInformation->document))
                                        <a href="{{asset('storage/'.$publicationInformation->document)}}" target="_blank"><i class="icon-documents"></i></a>
                                        @endif
                                      </td>
                                    </tr>
                                    @endforeach
                                  @else
                                    <tr>
                                      <td colspan="8" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center;  color:#ddd">কোন তথ্য পাওয়া যায়নি। </td>
                                    </tr>
                                  @endif
                                  <tr style="border:none; text-align: center; height:50px">
                                    <td colspan="8" style="border:none; text-align: center">ঙ. পদোন্নতি সম্পর্কিত তথ্যাদি</td>
                                  </tr>
                                  <tr>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">ক্রম.</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">পদোন্নতি প্রাপ্ত পদের নাম</td>
                                    <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">পদোন্নতি প্রাপ্তির তারিখ</td>
                                    <td colspan="3" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">আদেশ নং ও তারিখ</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">পে-স্কেল</td>
                                  </tr>
                                  @if (count($generalInformation->publicationInformation)>0)
                                    @foreach ($generalInformation->promotionInformation as $key => $promotionInformation)
                                    <tr>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$numTo->bnNum($key+1)}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$promotionInformation->promotionDesignation->title ?? ''}}</td>
                                      <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$numTo->bnNum(date('d',strtotime($promotionInformation->promotion_date)))}}/
                                        {{$numTo->bnNum(date('m',strtotime($promotionInformation->promotion_date)))}}/{{$numTo->bnNum(date('Y',strtotime($promotionInformation->promotion_date)))}} খ্রিঃ</td>
                                      <td colspan="3" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$promotionInformation->order_no}} <br> {{$numTo->bnNum(date('d',strtotime($promotionInformation->date)))}}/
                                        {{$numTo->bnNum(date('m',strtotime($promotionInformation->date)))}}/{{$numTo->bnNum(date('Y',strtotime($promotionInformation->date)))}} খ্রিঃ </td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$promotionInformation->salaryScale->salary ?? ''}}</td>
                                    </tr>
                                    @endforeach
                                  @else
                                  <tr>
                                    <td colspan="8" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center;  color:#ddd">কোন তথ্য পাওয়া যায়নি। </td>
                                  </tr>
                                  @endif
                                  <tr style="border:none; text-align: center; height:50px">
                                    <td colspan="8" style="border:none; text-align: center">চ. বিভাগীয়/ফৌজদারি মামলা সম্পর্কিত তথ্যাদি</td>
                                  </tr>
                                  <tr>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">ক্রম.</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">বিভাগীয়/ফৌজদারি মামলা নং</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">শাস্তি</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">আদেশের তারিখ</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">অব্যাহতি</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">আদেশের তারিখ</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">মন্তব্য</td>
                                    <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">ডকুমেন্ট</td>
                                  </tr>
                                  @if (count($generalInformation->caseInformation)>0)
                                    @foreach ($generalInformation->caseInformation as $key => $caseInformation)
                                    <tr>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$numTo->bnNum($key+1)}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$caseInformation->case_no}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$caseInformation->punishment}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{($caseInformation->punishment_order_date != null) ? $numTo->bnNum(date('d',strtotime($caseInformation->punishment_order_date))).'/'.
                                        $numTo->bnNum(date('m',strtotime($caseInformation->punishment_order_date))).'/'.$numTo->bnNum(date('Y',strtotime($caseInformation->punishment_order_date))). ' খ্রিঃ' : ''}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$caseInformation->release}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{ ($caseInformation->release_order_date != null) ? $numTo->bnNum(date('d',strtotime($caseInformation->release_order_date))).'/'.
                                        $numTo->bnNum(date('m',strtotime($caseInformation->release_order_date))).'/'.$numTo->bnNum(date('Y',strtotime($caseInformation->release_order_date))).' খ্রিঃ ' : ''}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$caseInformation->comment}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">
                                        @if (!empty($caseInformation->document))
                                        <a href="{{asset('storage/'.$caseInformation->document)}}" target="_blank"><i class="icon-documents"></i></a>
                                        @endif
                                      </td>
                                    </tr>
                                    @endforeach
                                  @else
                                  <tr>
                                    <td colspan="8" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center;  color:#ddd">কোন তথ্য পাওয়া যায়নি। </td>
                                  </tr>
                                  @endif
                                  <tr style="border:none; text-align: center; height:50px">
                                    <td colspan="8" style="border:none; text-align: center">ছ. পদায়ন সম্পর্কিত তথ্যাদি</td>
                                  </tr>
                                  <tr>
                                    <td rowspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">ক্রম.</td>
                                    <td rowspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">পদের নাম</td>
                                    <td rowspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">কর্মস্থলের নাম</td>
                                    <td colspan="3" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">কার্যকাল</td>
                                    <td rowspan="2" colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">মন্তব্য</td> 
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">হতে</td>
                                    <td colspan="1" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center">পর্যন্ত</td>
                                  </tr>
                                  @if (count($generalInformation->employeeTransfer)>0)
                                    @foreach ($generalInformation->employeeTransfer as $key => $employeeTransfer)
                                    <tr>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$numTo->bnNum($key+1)}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$employeeTransfer->designation->title ?? ''}}</td>
                                      <td style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$employeeTransfer->workstation->name ?? ''}}</td>
                                      <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{($employeeTransfer->joining_date != null) ? $numTo->bnNum(date('d',strtotime($employeeTransfer->joining_date))).'/'.
                                        $numTo->bnNum(date('m',strtotime($employeeTransfer->joining_date))).'/'.$numTo->bnNum(date('Y',strtotime($employeeTransfer->joining_date))). ' খ্রিঃ' : ''}}</td>
                                      <td colspan="1" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{ ($employeeTransfer->release_date != null) ? $numTo->bnNum(date('d',strtotime($employeeTransfer->release_date))).'/'.
                                        $numTo->bnNum(date('m',strtotime($employeeTransfer->release_date))).'/'.$numTo->bnNum(date('Y',strtotime($employeeTransfer->release_date))).' খ্রিঃ ' : 'চলমান'}}</td>
                                      <td colspan="2" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; white-space: unset; text-align:center">{{$employeeTransfer->comment}}</td>
                                    </tr>
                                    @endforeach
                                  @else
                                  <tr>
                                    <td colspan="8" style="border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; text-align:center;  color:#ddd">কোন তথ্য পাওয়া যায়নি। </td>
                                  </tr>
                                  @endif
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