@extends('layouts.layout')
@section('title', 'Workstation designations')
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
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
        @include('common.message')
      </div>
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">কর্মস্থলের পদবী</div>
          </div>
          {!! Form::open(array('route' =>['workstation-designations.store'],'method'=>'POST','files'=>true)) !!}
          <div class="card-body">
            <div class="col-md-12">
              <div class="form-inline">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <select  name="workstation_id" id="workstation_id" class="form-control select2" required="">
                            <option value="">কর্মস্থল নির্বাচন করুন</option>
                            @foreach($workstations as $workstation)
                            <option value="{{$workstation->id}}" 
                              >
                              {{$workstation->name}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="field-placeholder">কর্মস্থল নির্বাচন করুন <span class="text-danger">*</span> </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="field-wrapper">
                        <select class="select-multiple js-states select2 @error('designation_id') is-invalid @enderror" multiple="multiple" name="designation_id[]" id="designation_id" required="">
                            <option value="">Select</option>
                            @foreach($designations as $designation)
                            <option value="{{$designation->id}}" {{(!empty($single_data) && in_array($designation->id, $alldesignations))?'selected':''}}>{{$designation->title}}</option>
                            @endforeach
                        </select>
                        <div class="field-placeholder">পদবী নির্বাচন করুন<span class="text-danger">*</span></div>
                      </div>
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
@endsection 