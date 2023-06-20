@extends('layouts.layout')
@section('title', 'পদোন্নতি সম্পর্কিত তথ্যা সংশোধন করুন')
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
        <div class="card card-primary">
          {!! Form::open(array('route' =>['promotionInformations.update',$promotionInformation->id],'method'=>'PUT','enctype'=>'multipart/form-data')) !!}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title text-success">পদোন্নতি সম্পর্কিত তথ্যা সংশোধন করুন</h2>
            <a href="{{route('promotionInformations.index')}}" class="btn btn-primary btn-sm pull-right"><i class="icon-list"></i> <b>পদোন্নতির তালিকা</b></a>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"  
                    name="name_in_bangla"
                    class="form-control" 
                    value="{{$promotionInformation->generalInformation->name_in_bangla}}"
                    readonly>
                  </div>
                  <div class="field-placeholder">নাম</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="designation_id" 
                    class="form-control select2 @error('designation_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($promotionDesignations as $promotionDesignation)
                      <option value="{{$promotionDesignation->id}}" {{(($promotionInformation->designation_id == $promotionDesignation->id) ?? (old('designation_id') == $promotionDesignation->id)) ? 'selected' : ''}}>{{$promotionDesignation->title}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">পদোন্নতি প্রাপ্ত পদের নাম  <span class="text-danger">*</span></div> 
                </div>
                @error('designation_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date" 
                    name="promotion_date"  
                    class="form-control" 
                    value="{{$promotionInformation->promotion_date}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">পদোন্নতি প্রাপ্তির তারিখ  <span class="text-danger">*</span></div>
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
                    class="form-control" 
                    value="{{$promotionInformation->order_no}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">আদেশ নং <span class="text-danger">*</span></div>
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
                    class="form-control" 
                    value="{{$promotionInformation->date}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">আদেশের তারিখ <span class="text-danger">*</span></div>
                </div>
                @error('date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="salary_scale_id" 
                    class="form-control select2 @error('salary_scale_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($salaryScales as $salaryScale)
                      <option value="{{$salaryScale->id}}" {{(($promotionInformation->salary_scale_id == $salaryScale->id) ?? (old('salary_scale_id') == $salaryScale->id)) ? 'selected' : ''}}>{{$salaryScale->name}} => {{$salaryScale->salary}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">পে-স্কেল <span class="text-danger">*</span></div> 
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
                    value="{{$promotionInformation->salary??old('salary')}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">স্যালারি</div>
                </div>
                @error('salary')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
          <div class="card-footer text-end">
            <button class="btn btn-sm btn-success"><i class="icon-save"></i>সংরক্ষন করুন</button>
          </div>
          {!! Form::close() !!}
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection 