@extends('layouts.layout')
@section('title', 'Transfer Application')
@section('content')
<!-- Content Header (Page header) -->
<style>
  table th, .table td {
    white-space: break-spaces;
}
</style>
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
      </div>
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <div class="card-title"></div>
            <a onclick="printApplication();" href="javascript:0;"><i class="icon-print"></i></a>
          </div>
          <!-- /.card-header -->
          <div class="card-body" id="printApplication">
            <div class="col-md-12">
              <table class="table" style="width: 100%">
                <tr>
                  <td style="width: 20%; text-align:right">
                    <img src="{{asset('custom/img')}}/logo.png" width="50px" height="50px" alt="">
                  </td>
                  <td style="width: 60%">
                    <center><h5 style="margin: 0px">ইসলামিক ফাউন্ডেশন</h5></center>
                    <center><h5 style="margin: 0px">(প্রতিষ্ঠাতাঃ জাতির পিতা বঙ্গবন্ধু শেখ মুজিবুর রহমান)</h5></center>
                    <center><h5 style="margin: 0px">ধর্ম বিষয়ক মন্ত্রণালয়</h5></center>
                    <center><h5 style="margin: 0px">www.islamicfoundation.gov.bd</h5></center>
                    <center><h5 style="margin: 0px">আগারগাঁও, শেরেবাংলা নগর, ঢাকা-১২০৭</h5></center>
                  </td>
                  <td style="width: 20%">
                    <img src="{{asset('custom/img')}}/logo.png" width="50px" height="50px" alt="">
                  </td>
                </tr>
              </table>
              <table class="table" style="width: 100%">
                <tr style="height: 60px">
                  <td style="width: 50%"><p style="font-size: 15px">নাম্বারঃ {{$employeeTransferApplication->transfer_number}}</p></td>
                  <td style="width: 50%; text-align:right">
                    <p style="margin-bottom: -10px">{{bangla_date(strtotime($employeeTransferApplication->transferred_workstation_date))}}</p>
                    <p style="margin-right: 65px; margin-top: -10px">তারিখঃ---------</p>
                    <p style="margin-top: -15px">{{bangla_date(strtotime($employeeTransferApplication->transferred_workstation_date),"en")}}</p>
                  </td>
                </tr>
                <tr style="height: 40px">
                  <td colspan="2" style="text-align: center"><p>অফিস আদেশ</p></td>
                </tr>
                <tr style="height: 40px">
                  <td colspan="2"><p>{{$employeeTransferApplication->first_paragraph}}</p></td>
                </tr>
              </table>
              <table class="table" style="width: 100%">
                <tr >
                  <td style="border: 1px solid #ddd">ক্রম</td>
                  <td style="border: 1px solid #ddd">নাম ও মূল পদবি</td>
                  <td style="border: 1px solid #ddd">পদবি ও বর্তমান কর্মস্থল</td>
                  <td style="border: 1px solid #ddd">বদলিকৃত পদ ও কর্মস্থল</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd">
                    ০১. 
                  </td>
                  <td style="border: 1px solid #ddd">
                    <p style="margin:0px">{{$employeeTransferApplication->employeeTransfer->generalInformation->name_in_bangla ?? ''}}</p>
                    <p style="margin:0px">{{$employeeTransferApplication->presentDesignation->title ?? ''}}</p>
                  </td>
                  <td style="border: 1px solid #ddd">
                    <p style="margin:0px">{{$employeeTransferApplication->presentDesignation->title ?? ''}}</p>
                    <p style="margin:0px">{{$employeeTransferApplication->presentWorkstation->name ?? ''}}</p>
                  </td>
                  <td style="border: 1px solid #ddd">
                    <p style="margin:0px">{{$employeeTransferApplication->transferredDesignation->title ?? ''}}</p>
                    <p style="margin:0px">{{$employeeTransferApplication->transferredWorkstation->name ?? ''}}</p>
                  </td>
                </tr>
              </table>
              <table class="table" style="width: 100%">
                <tr style="height: 40px">
                  <td colspan="2" style="white-space: unset">{!! $employeeTransferApplication->editordata1 !!}</td>
                </tr>
                <tr style="height: 40px">
                  <td colspan="2">
                    <div  class="sacretary" style=" margin-right: 100px;margin-top: 100px;width: 203px;height: 128px;display: block;margin-left: 656px;text-align: center;">
                      <p style="margin: 0px">{{$employeeTransferApplication->secretary->name ?? ''}} </p>
                      <p style="margin: 0px">{{$employeeTransferApplication->secretary->designation->title ?? ''}}</p>
                      <p style="margin: 0px">ফোনঃ {{$employeeTransferApplication->secretary->phone ?? ''}} </p>
                      <p style="margin: 0px">ফ্যাক্সঃ {{$employeeTransferApplication->secretary->fax ?? ''}} </p>
                      <p style="margin: 0px">ইমেলঃ {{$employeeTransferApplication->secretary->email ?? ''}} </p>
                    </div>
                  </td>
                </tr>
              </table>
              <table class="table" style="width: 100%">
                <tr style="height: 60px">
                  <td style="width: 50%"><p style="font-size: 15px">নাম্বারঃ {{$employeeTransferApplication->transfer_number}}</p></td>
                  <td style="width: 50%; text-align:right">
                    <p style="margin-bottom: -10px">{{bangla_date(strtotime($employeeTransferApplication->transferred_workstation_date))}}</p>
                    <p style="margin-right: 65px; margin-top: -10px">তারিখঃ---------</p>
                    <p style="margin-top: -15px">{{bangla_date(strtotime($employeeTransferApplication->transferred_workstation_date),"en")}}</p>
                  </td>
                </tr>
              </table>
              <table class="table paragraph" style="width: 100%">
                <tr style="height: 40px">
                  <td colspan="2" ><div style="font-size: 25px" class="editor2">{!! $employeeTransferApplication->editordata2 !!}</div></td>
                </tr>
                <tr style="height: 40px">
                  <td colspan="2">
                    <div  class="sacretary" style=" margin-right: 100px;margin-top: 100px;width: 203px;height: 128px;display: block;margin-left: 656px;text-align: center;">
                      <p style="margin: 0px">{{$employeeTransferApplication->deputySecretary->name ?? ''}}</p>
                      <p style="margin: 0px">{{$employeeTransferApplication->deputySecretary->designation->title ?? ''}} </p>
                    </div>
                  </td>
                </tr>
              </table>
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
<!-- Content wrapper scroll end -->
<script>
  function printApplication() {
    var reportTablePrint=document.getElementById("printApplication");
    newWin= window.open();
    var is_chrome = Boolean(newWin.chrome);
    newWin.document.write(reportTablePrint.innerHTML);
    if (is_chrome) {
        setTimeout(function () { // wait until all resources loaded 
          newWin.document.close(); // necessary for IE >= 10
          newWin.focus(); // necessary for IE >= 10
          newWin.print();  // change window to winPrint
          newWin.close();// change window to winPrint
        }, 250);
    }
    else {
      newWin.document.close(); // necessary for IE >= 10
      newWin.focus(); // necessary for IE >= 10

      newWin.print();
      newWin.close();
    }
  }
</script>
@endsection 