@extends('layouts.layout')
@section('title', 'পদোন্নতি সম্পর্কিত তথ্যাদি সংরক্ষন করুন')
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
            <div class="card-title">পদোন্নতি সম্পর্কিত তথ্যাদি সংরক্ষন করুন</div>
          </div>
          {!! Form::open(array('route' =>['promotionInformations.store'],'method'=>'POST','files'=>true)) !!}
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
                    <div class="col-md-4">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <select name="designation_id" 
                          class="form-control select2 @error('designation_id') is-invalid @enderror" 
                          required="">
                            <option value="">Select</option>
                            @foreach($promotionDesignations as $promotionDesignation)
                            <option value="{{$promotionDesignation->id}}" {{(old('designation_id') == $promotionDesignation->id) ? 'selected' : ''}}>{{$promotionDesignation->title}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="field-placeholder">পদোন্নতি প্রাপ্ত পদের নাম <span class="text-danger">*</span></div>
                      </div>
                      @error('designation_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-4">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <select name="workstation_id" 
                          class="form-control select2 @error('workstation_id') is-invalid @enderror" 
                          required="">
                            <option value="">Select</option>
                            @foreach($promotionWorkstations as $promotionWorkstation)
                            <option value="{{$promotionWorkstation->id}}" {{(old('workstation_id') == $promotionWorkstation->id) ? 'selected' : ''}}>{{$promotionWorkstation->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="field-placeholder">যোগদানকৃত কর্মস্থলের নাম <span class="text-danger">*</span></div>
                      </div>
                      @error('workstation_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-4">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <input type="date" 
                          name="promotion_date" 
                          class="form-control @error('promotion_date') is-invalid @enderror" 
                          value="{{old('promotion_date')??date('Y-m-d')}}"
                          autocomplete="off" required>
                        </div>
                        <div class="field-placeholder">পদোন্নতি প্রাপ্তির তারিখ  <span class="text-danger">*</span> </div>
                      </div>
                      @error('promotion_date')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-4">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <input type="text" 
                          name="order_no" 
                          class="form-control @error('order_no') is-invalid @enderror" 
                          value="{{old('order_no')}}"
                          autocomplete="off" required>
                        </div>
                        <div class="field-placeholder">আদেশ নং<span class="text-danger">*</span> </div>
                      </div>
                      @error('order_no')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-4">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <input type="date" 
                          name="date" 
                          class="form-control @error('date') is-invalid @enderror" 
                          value="{{old('date')??date('Y-m-d')}}"
                          autocomplete="off" required>
                        </div>
                        <div class="field-placeholder">আদেশের তারিখ<span class="text-danger">*</span> </div>
                      </div>
                      @error('date')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-4">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <select name="salary_scale_id" id="salary_scale_id"
                          class="form-control select2 @error('salary_scale_id') is-invalid @enderror" 
                          required="">
                            <option value="">Select</option>
                            @foreach($salaryScales as $salaryScale)
                            <option value="{{$salaryScale->id}}"
                              data-salary="{{$generalInformation->salary}}"
                              {{(old('salary_scale_id') == $salaryScale->id) ? 'selected' : ''}}>
                              {{$salaryScale->name}} => {{$salaryScale->salary}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="field-placeholder">পে-স্কেল<span class="text-danger">*</span></div>
                      </div>
                      @error('salary_scale_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-4">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <input type="text" 
                          name="salary" 
                          class="form-control @error('salary') is-invalid @enderror" 
                          value="{{old('salary')}}"
                          autocomplete="off">
                        </div>
                        <div class="field-placeholder">স্যালারি</div>
                      </div>
                      @error('salary')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
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