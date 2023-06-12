@extends('layouts.layout')
@section('title', 'বিভাগীয়/ফৌজদারি মামলা সম্পর্কিত তথ্যাদি সংরক্ষন করুন') 
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
      </div>
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">বিভাগীয়/ফৌজদারি মামলা সম্পর্কিত তথ্যাদি সংরক্ষন করুন</div>
          </div>
          {!! Form::open(array('route' =>['caseInformations.store'],'method'=>'POST','files'=>true)) !!}
          <div class="card-body">
            <div class="col-md-12">
              <div class="form-inline">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <select  name="general_information_id" id="general_information_id" class="form-control select2" required="">
                            <option value="">Select project</option>
                            @foreach($generalInformations as $generalInformation)
                            <option value="{{$generalInformation->id}}" 
                              data-mobile="{{$generalInformation->mobile}}"
                              data-email="{{$generalInformation->email}}"
                              data-district="{{$generalInformation->district->name ?? ''}}"
                              data-designation="{{$generalInformation->presentDesignation->title ?? ''}}"
                              data-workstation="{{$generalInformation->presentWorkstation->name ?? ''}}"
                              >
                              {{$generalInformation->name_in_bangla}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="field-placeholder">কর্মকর্তা/কর্মচারি নির্বাচন করুন <span class="text-danger">*</span> </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <span id="employeeSummery"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table id="myTableID" class="table ">
                  <thead>
                    <tr>
                      <th  style="text-align: center; border:none">মামলা নং <span class="text-danger">*</span></th>
                      <th  style="text-align: center; border:none">শাস্তি </th>
                      <th  style="text-align: center; border:none">আদেশের তারিখ</th>
                      <th  style="text-align: center; border:none">অব্যাহতি </th>
                      <th  style="text-align: center; border:none">আদেশের তারিখ</th>
                      <th  style="text-align: center; border:none">মন্তব্য</th>
                      <th  style="text-align: center; border:none">ডকুমেন্ট</th>
                      <th  style="text-align: center; border:none">একশন</th>
                    </tr>
                  </thead>
                  <tbody class= "body" id="yourtableid" >
                      <tr id="row_0" data-rowid="0">
                        <td style="border: 1px solid #fff; width:10%">
                          <input type="text" class="form-control" name="addmore[0][case_no]" autocomplete="off" required>
                        </td>
                        <td style="border: 1px solid #fff; width:10%">
                          <input type="text" class="form-control" name="addmore[0][punishment]" autocomplete="off">
                        </td>
                        <td style="border: 1px solid #fff; width:15%">
                          <input type="date" class="form-control" name="addmore[0][punishment_order_date]" autocomplete="off">
                        </td>
                        <td style="border: 1px solid #fff; width:10%">
                          <input type="text" class="form-control" name="addmore[0][release]" autocomplete="off">
                        </td>
                        <td style="border: 1px solid #fff; width:15%">
                          <input type="date" class="form-control" name="addmore[0][release_order_date]" autocomplete="off">
                        </td>
                        <td style="border: 1px solid #fff; width:15%">
                          <input type="text" class="form-control" name="addmore[0][comment]" autocomplete="off">
                        </td>
                        <td style="border: 1px solid #fff; width:20%">
                          <input type="file" class="form-control" name="addmore[0][document]" autocomplete="off">
                        </td>
                        <td >
                          <input type="button" class="form-control" value="+" id="addone" onclick="addrow();">
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
          </div>
          <div class="card-footer text-end">
            <button class="btn btn-sm btn-success"><i class="icon-save"></i>যোগ করুন</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
{!!Html::script('custom/js/jquery.min.js')!!}
<script type="text/javascript"> 
var i=0;
var rowcount=1;
function addrow() {
  i++;
  rowcount++;
  var row = '<tr id="row_'+i+'" data-rowid="'+i+'">';
      row += '<td style="border: 1px solid #fff; width:10%">';
      row += ' <input type="text" class="form-control" name="addmore['+i+'][case_no]" autocomplete="off" required>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:10%">';
      row += ' <input type="text" class="form-control" name="addmore['+i+'][punishment]" autocomplete="off">';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:15%">';
      row += ' <input type="date" class="form-control" name="addmore['+i+'][punishment_order_date]" autocomplete="off">';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:10%">';
      row += ' <input type="text" class="form-control" name="addmore['+i+'][release]" autocomplete="off">';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:15%">';
      row += ' <input type="date" class="form-control" name="addmore['+i+'][release_order_date]" autocomplete="off">';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:15%">';
      row += ' <input type="text" class="form-control" name="addmore['+i+'][comment]" autocomplete="off">';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:20%">';
      row += ' <input type="file" class="form-control" name="addmore['+i+'][document]" autocomplete="off">';
      row += '</td>';
      row += '<td style="border: 1px solid #fff">';
      row += ' <input type="button" class="form-control" value="x" id="remove" onclick="$(\'#row_'+i+'\').remove();">';
      row += '</td>';
      row += '</tr>';
      $('.body').append(row);
}

$(document).ready(function () {
    $('#general_information_id').change(function (e) { 
    e.preventDefault();
    var Html = '';
    if($(this).val() != ""){

        var mobile = $("#general_information_id option:selected").attr('data-mobile');
        var email = $("#general_information_id option:selected").attr('data-email');
        var district = $("#general_information_id option:selected").attr('data-district');
        var presentDesignation = $("#general_information_id option:selected").attr('data-designation');
        var presentWorkstation = $("#general_information_id option:selected").attr('data-workstation');

        Html = '<p style="margin: 0px"> <b>  মোবাইল : '+mobile+' || <b>  ইমেল : '+email+' || <b>  নিজ জেলা : '+district+' || <b> বর্তমান পদবী : '+presentDesignation+'  || <b> বর্তমান কর্মস্থল : '+presentWorkstation+'</b></p><hr>';
        $('#employeeSummery').html(Html);
    }else{
        $('#employeeSummery').html(Html);
    }
  });
});


</script>
@endsection 