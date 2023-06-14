@extends('layouts.layout')
@section('title', 'বদলী চিঠি')
@section('content')
<!-- Content Header (Page header) -->
<style>
  .note-editor.note-frame.card{
    width: 100%;
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
        {!! Form::open(array('route' =>['employee-transfer-application-form-store'],'method'=>'POST','files'=>true)) !!}
        <div class="card">
          <div class="card-header">
            <div class="card-title">বদলী চিঠির জন্য ফর্মটি পূরন করুন </div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control numeric" type="text" name="transfer_number"  value="" required="" autocomplete="off" >
                  </div>
                  <div class="field-placeholder">নাম্বার <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <textarea class="form-control" name="first_paragraph"></textarea>
                  </div>
                  <div class="field-placeholder">টেবিলের উপরের অংশ<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control" type="text" name="" value="{{$employeeTransfer->generalInformation->name_in_bangla}}" required="" autocomplete="off" readonly="">
                    <input class="form-control" type="hidden" name="employee_transfer_id" value="{{$employeeTransfer->id}}" >
                  </div>
                  <div class="field-placeholder">কর্মকর্তা/কর্মচারীর নাম <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control" type="text" name="" value="{{$employeeTransfer->generalInformation->presentDesignation->title}}" required="" autocomplete="off" readonly="">
                    <input class="form-control" type="hidden" name="present_designation_id" value="{{$employeeTransfer->generalInformation->present_designation_id}}" >
                  </div>
                  <div class="field-placeholder">বর্তমান পদবী<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control" type="text" name="" value="{{$employeeTransfer->generalInformation->presentWorkStation->name}}" required="" autocomplete="off" readonly="">
                    <input class="form-control" type="hidden" name="present_workstation_id" value="{{$employeeTransfer->generalInformation->present_workstation_id}}" >
                  </div>
                  <div class="field-placeholder">বর্তমান কর্মস্থল <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control" type="text" name="" value="{{$employeeTransfer->designation->title}}" required="" autocomplete="off" readonly="">
                    <input class="form-control" type="hidden" name="trans_designation_id" value="{{$employeeTransfer->designation_id}}" autocomplete="off" readonly="">
                    <input class="form-control" type="hidden" name="transferred_workstation_date" value="{{$employeeTransfer->transferred_date}}">
                  </div>
                  <div class="field-placeholder">বদলীকৃত পদবী <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control" type="text" name="name" value="{{$employeeTransfer->workstation->name}}" required="" autocomplete="off" readonly="">
                    <input class="form-control" type="hidden" name="trans_workstation_id" value="{{$employeeTransfer->workstation_id}}"autocomplete="off" readonly="">
                  </div>
                  <div class="field-placeholder">বদলীকৃত কর্মস্থল <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="user_id" 
                    class="form-control select2 @error('user_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($users as $user)
                      <option value="{{$user->id}}" {{(old('user_id') == $user->id) ? 'selected' : ''}}>{{$user->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">স্বাক্ষরকারী নির্বাচন করুন <span class="text-danger">*</span></div>
                </div>
                @error('user_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-xl-12 col-lg- 12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <textarea id="summernote1" name="editordata1"></textarea>
                   </div>
                  <div class="field-placeholder">টেবিলের নিচের প্রথম অংশ<span class="text-danger">*</span></div>
                </div>
              </div>
              <div class="col-xl-12 col-lg- 12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <textarea id="summernote2" name="editordata2"></textarea>
                   </div>
                  <div class="field-placeholder">টেবিলের নিচের দ্বিতীয় অংশ  <span class="text-danger">*</span></div>
                </div>
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-end">
            <button class="btn btn-primary" type="submit"><i class="icon-message"></i> সংরক্ষন করুন</button>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->

{!!Html::script('custom/js/jquery.min.js')!!}
<script>
$(document).ready(function() {
  $('#summernote1').summernote();
});
$(document).ready(function() {
  $('#summernote2').summernote();
});
</script>
@endsection 