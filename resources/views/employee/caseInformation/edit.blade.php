@extends('layouts.layout')
@section('title', 'বিভাগীয়/ফৌজদারি মামলা সম্পর্কিত তথ্যা সংশোধন করুন')
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
          {!! Form::open(array('route' =>['caseInformations.update',$caseInformation->id],'method'=>'PUT','enctype'=>'multipart/form-data')) !!}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title text-success">বিভাগীয়/ফৌজদারি মামলা সম্পর্কিত তথ্যা সংশোধন করুন</h2>
            <a href="{{route('caseInformations.index')}}" class="btn btn-primary btn-sm pull-right"><i class="icon-list"></i> <b>মামলার তালিকা</b></a>
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
                    value="{{$caseInformation->generalInformation->name_in_bangla}}"
                    readonly>
                  </div>
                  <div class="field-placeholder">নাম</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="case_no" 
                    class="form-control" 
                    value="{{$caseInformation->case_no}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">মামলা নং <span class="text-danger">*</span></div>
                </div>
                @error('case_no')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="punishment" 
                    class="form-control" 
                    value="{{$caseInformation->punishment}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">শাস্তি</div>
                </div>
                @error('punishment')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date" 
                    name="punishment_order_date"  
                    class="form-control" 
                    value="{{$caseInformation->punishment_order_date}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">আদেশের তারিখ</div>
                </div>
                @error('punishment_order_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="release" 
                    class="form-control" 
                    value="{{$caseInformation->release}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">অব্যাহতি</div>
                </div>
                @error('release')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date" 
                    name="release_order_date"  
                    class="form-control" 
                    value="{{$caseInformation->release_order_date}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">আদেশের তারিখ</div>
                </div>
                @error('release_order_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="comment" 
                    class="form-control" 
                    value="{{$caseInformation->comment}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">মন্তব্য</div>
                </div>
                @error('comment')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="file" name="document" class="form-control" value="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">ডকুমেন্ট</div> 
                </div>
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