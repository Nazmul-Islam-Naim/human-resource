@extends('layouts.layout')
@section('title', 'পদবী সংশোধন করুন')
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
          {!! Form::open(array('route' =>['empty-designations.update',$workstationDesignation->id],'method'=>'PUT','enctype'=>'multipart/form-data')) !!}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title text-success">পদবী সংশোধন করুন || কর্মস্থলঃ {{$workstationDesignation->workstation->name ?? ''}} || পদবীঃ {{$workstationDesignation->designation->title ?? ''}}</h2>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="general_information_id" 
                    class="form-control select2 @error('general_information_id') is-invalid @enderror" 
                    >
                      <option value="">Select</option>
                      @foreach($generalInformations as $generalInformation)
                      <option value="{{$generalInformation->id}}" {{(($workstationDesignation->general_information_id == $generalInformation->id) ?? (old('general_information_id') == $generalInformation->id)) ? 'selected' : ''}}>{{$generalInformation->name_in_bangla}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">কর্মকর্তা/কর্মচারী নির্বাচন করুন <span class="text-danger">*</span></div>
                </div>
                @error('general_information_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-12">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date" 
                    name="joining_date" 
                    class="form-control @error('joining_date') is-invalid @enderror" 
                    value="{{$workstationDesignation->joining_date}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">যোগদানের তারিখ </div>
                </div>
                @error('joining_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-12">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date" 
                    name="release_date" 
                    class="form-control @error('release_date') is-invalid @enderror" 
                    value="{{$workstationDesignation->release_date}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">অব্যাহতির তারিখ </div>
                </div>
                @error('release_date')
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