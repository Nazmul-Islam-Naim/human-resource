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
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">কর্মকর্তা/কর্মচারীর বিস্তারিত</div>
                    <div class="graph-day-selection" role="group">
                      <a href="{{ URL::to('hr/employee-list') }}" class="btn"><i class="icon-list"></i></a>
                      <a href="{{ route('generalInformations.edit', $generalInformation->id) }}" class="btn"><i class="icon-edit1"></i></a>
                      <a onclick="printReport();" href="javascript:0;"><i class="icon-print"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div id="printReport">
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
                            <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">নামঃ (বাংলায়) {{$generalInformation->name_in_bangla}} <br> (ইংরেজী) {{$generalInformation->name_in_english}} </td>
                            <td colspan="2" style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">পিতার নামঃ {{$generalInformation->fathers_name_in_bangla}}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">নামঃ (বাংলায়) {{$generalInformation->name_in_bangla}}</td>
                            <td colspan="2" style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">পিতার নামঃ {{$generalInformation->fathers_name_in_bangla}}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">নামঃ (বাংলায়) {{$generalInformation->name_in_bangla}}</td>
                            <td colspan="2" style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">পিতার নামঃ {{$generalInformation->fathers_name_in_bangla}}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">নামঃ (বাংলায়) {{$generalInformation->name_in_bangla}}</td>
                            <td colspan="2" style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">পিতার নামঃ {{$generalInformation->fathers_name_in_bangla}}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">নামঃ (বাংলায়) {{$generalInformation->name_in_bangla}}</td>
                            <td colspan="2" style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">পিতার নামঃ {{$generalInformation->fathers_name_in_bangla}}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">নামঃ (বাংলায়) {{$generalInformation->name_in_bangla}}</td>
                            <td colspan="2" style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">পিতার নামঃ {{$generalInformation->fathers_name_in_bangla}}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:60%">নামঃ (বাংলায়) {{$generalInformation->name_in_bangla}}</td>
                            <td colspan="2" style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px;margin-left:0px; width:40%">পিতার নামঃ {{$generalInformation->fathers_name_in_bangla}}</td>
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