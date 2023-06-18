@extends('layouts.layout')
@section('title', 'পদভিত্তিক বর্তমান কর্মস্থল সংশোধন করুন')
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
  
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="card card-primary">
          {!! Form::open(array('route' =>['transfer-status-update',$transferStatus->id],'method'=>'PUT','enctype'=>'multipart/form-data')) !!}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title text-success">পদভিত্তিক বর্তমান কর্মস্থল সংশোধন করুন</h2>
            <a href="{{route('transfer-status-index')}}" class="btn btn-primary btn-sm pull-right"><i class="icon-list"></i> <b>তালিকা</b></a>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="workstation_id" 
                    class="form-control select2 @error('workstation_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($workstations as $workstation)
                      <option value="{{$workstation->id}}" {{(($transferStatus->workstation_id == $workstation->id) ?? (old('workstation_id') == $workstation->id)) ? 'selected' : ''}}>{{$workstation->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">পূর্ববর্তী কর্মস্থলের নাম নির্বাচন করুন  <span class="text-danger">*</span></div> 
                </div>
                @error('workstation_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-12">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="designation_id" 
                    class="form-control select2 @error('designation_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($designations as $designation)
                      <option value="{{$designation->id}}" {{(($transferStatus->designation_id == $designation->id) ?? (old('designation_id') == $designation->id)) ? 'selected' : ''}}>{{$designation->title}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">পূর্ববর্তী পদবীর নাম নির্বাচন করুন <span class="text-danger">*</span></div> 
                </div>
                @error('designation_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-12">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date" 
                    name="previous_joining_date"  
                    class="form-control" 
                    value="{{$transferStatus->previous_joining_date}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">পূর্ববর্তী পদে যোগদানের তারিখ<span class="text-danger">*</span></div>
                </div>
                @error('previous_joining_date')
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