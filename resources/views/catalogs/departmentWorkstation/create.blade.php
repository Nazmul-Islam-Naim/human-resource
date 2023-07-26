@extends('layouts.layout')
@section('title', 'Department Workstations')
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
            <div class="card-title">Department Workstation</div>
          </div>
          {!! Form::open(array('route' =>['department-workstations.store'],'method'=>'POST','files'=>true)) !!}
          <div class="card-body">
            <div class="col-md-12">
              <div class="form-inline">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <select  name="department_id" id="department_id" class="form-control select2" required="">
                            <option value="">ডিপার্টমেন্ট নির্বাচন করুন</option>
                            @foreach($departments as $department)
                            <option value="{{$department->id}}" 
                              >
                              {{$department->name}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="field-placeholder">ডিপার্টমেন্ট নির্বাচন করুন <span class="text-danger">*</span> </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="field-wrapper">
                        <select class="select-multiple js-states select2 @error('workstation_id') is-invalid @enderror" multiple="multiple" 
                          name="workstation_id[]" id="workstation_id" required="">
                            <option value="">Select</option>
                            @foreach($workstations as $workstation)
                            <option value="{{$workstation->id}}" {{(!empty($single_data) && in_array($workstation->id, $allworkstations))?'selected':''}}>{{$workstation->name}}</option>
                            @endforeach
                        </select>
                        <div class="field-placeholder">কার্যালয় নির্বাচন করুন<span class="text-danger">*</span></div>
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