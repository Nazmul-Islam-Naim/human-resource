@extends('layouts.layout')
@section('title', 'কর্মকর্তা/কর্মচারীর যোগ/সংশোধন ফর্ম')
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
          @if(!empty($single_data))
          {!! Form::open(array('route' =>['update-employee',$single_data->id],'method'=>'PUT','enctype'=>"multipart/form-data")) !!}
          <?php $btn="Update";?>
          @else
          {!! Form::open(array('route' =>['store-employee'],'method'=>'POST','enctype'=>"multipart/form-data")) !!}
          <?php $btn="Save";?>
          @endif
          <div class="card-header d-flex justify-content-between align-items-center">
            @if(!empty($single_data))
            <h2 class="card-title">কর্মকর্তা/কর্মচারীর তথ্য সংশোধন করুন</h2>
            @else
            <h2 class="card-title">কর্মকর্তা/কর্মচারীর যোগের জন্য ফর্মটি পূরন করুন</h2>
            @endif
            <a href="{{URL::to('hr/employee-list')}}" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus-circle"></i> <b>কর্মকর্তা/কর্মচারীর তালিকা</b></a>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
            <h4 class="card-title">কর্মকর্তা/কর্মচারীর তথ্য</h4>
            <div class="row">
              <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" name="employee_id" class="form-control numeric" value="{{!empty($single_data->employee_id)? Converter::en2bn($single_data->employee_id):''}}" required="">
                </div>
                <div class="field-placeholder">কর্মকর্তা/কর্মচারীর তথ্য আইডি <span class="text-danger">*</span></div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" name="name" class="form-control" value="{{!empty($single_data->name)?$single_data->name:''}}" autocomplete="off" required>
                </div>
                <div class="field-placeholder">কর্মকর্তা/কর্মচারীর নাম <span class="text-danger">*</span></div>
              </div>
            </div>
            <!--<div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <select name="user_type" class="form-control" required="">
                    {{-- @foreach($all_user_type as $type)
                    <option value="{{$type->id}}" {{(!empty($single_data->user_type) && $single_data->user_type==$type->id)?'selected':''}}>{{$type->user_type}}</option>
                    @endforeach --}}
                  </select>
                </div>
                <div class="field-placeholder">Role <span class="text-danger">*</span></div>
              </div>
            </div>-->
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <select name="department_id" class="form-control select-single select2 js-state" data-live-search="true" required>
                    <option value="">Select</option>
                    @foreach($all_department as $value)
                    <option value="{{$value->id}}" {{(!empty($single_data->department_id) && $single_data->department_id==$value->id)?'selected':''}}>{{$value->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="field-placeholder">ডিপার্টমেন্ট </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <select name="designation_id" class="form-control select-single select2 js-state" data-live-search="true" required="">
                    <option value="">Select</option>
                    @foreach($all_designation as $value)
                    <option value="{{$value->id}}" {{(!empty($single_data->designation_id) && $single_data->designation_id==$value->id)?'selected':''}}>{{$value->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="field-placeholder">মূল পদবী <span class="text-danger">*</span></div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <select name="workstation_designation_id" class="form-control select-single select2 js-state" data-live-search="true" required="">
                    <option value="">Select</option>
                    @foreach($all_designation as $value)
                    <option value="{{$value->id}}" {{(!empty($single_data->workstation_designation_id) && $single_data->workstation_designation_id==$value->id)?'selected':''}}>{{$value->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="field-placeholder">বর্তমান কর্মস্থলের পদবী <span class="text-danger">*</span></div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <select name="salary_scale_id" class="form-control select-single select2 js-state" data-live-search="true" required="" id="salary_scale_id">
                    <option value="">Select</option>
                    @foreach($all_salary_scale as $value)
                    <option value="{{$value->id}}" {{(!empty($single_data->salary_scale_id) && $single_data->salary_scale_id==$value->id)?'selected':''}}>{{$value->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="field-placeholder">বেতন স্কেল <span class="text-danger">*</span></div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" class="form-group numeric" value="{{!empty($single_data->salary)? Converter::en2bn($single_data->salary):''}}" name="salary" >
                </div>
                <div class="field-placeholder">বেতন <span class="text-danger">*</span></div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <select name="workstation_id" class="form-control select-single select2 js-state" data-live-search="true" required="">
                    <option value="">Select</option>
                    @foreach($all_workstation as $value)
                    <option value="{{$value->id}}" {{(!empty($single_data->workstation_id) && $single_data->workstation_id==$value->id)?'selected':''}}>{{$value->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="field-placeholder">কর্মস্থল <span class="text-danger">*</span></div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <select name="district_id" class="form-control select-single select2 js-state" data-live-search="true" required="">
                    <option value="">Select</option>
                    @foreach($all_district as $value)
                    <option value="{{$value->id}}" {{(!empty($single_data->district_id) && $single_data->district_id==$value->id)?'selected':''}}>{{$value->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="field-placeholder">জেলা <span class="text-danger">*</span></div>
              </div>
            </div>
            <!--<div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" name="last_name" class="form-control" value="{{!empty($single_data->last_name)?$single_data->last_name:''}}" autocomplete="off" required>
                </div>
                <div class="field-placeholder">Last Name </div>
              </div>
            </div>-->
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" name="father_name" class="form-control" value="{{!empty($single_data->father_name)?$single_data->father_name:''}}" autocomplete="off">
                </div>
                <div class="field-placeholder">বাবার নাম</div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" name="mother_name" class="form-control" value="{{!empty($single_data->mother_name)?$single_data->mother_name:''}}" autocomplete="off">
                </div>
                <div class="field-placeholder">মায়ের নাম</div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" name="email" class="form-control" value="{{!empty($single_data->email)?$single_data->email:''}}" autocomplete="off">
                </div>
                <div class="field-placeholder">ইমেল</div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <select name="gender" class="form-control select-single select2 js-state" data-live-search="true">
                    @foreach(genders() as $key=>$value)
                    <option value="{{$key}}" {{(!empty($single_data->gender) && $single_data->gender==$key)?'selected':''}}>{{$value}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="field-placeholder"> লিঙ্গ <span class="text-danger">*</span></div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" name="dob" class="form-control datepicker" value="{{!empty($single_data->dob)?$single_data->dob:''}}" autocomplete="off" >
                </div>
                <div class="field-placeholder">জন্ম তারিখ </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" name="join_date" class="form-control datepicker" value="{{!empty($single_data->join_date)?$single_data->join_date:''}}" autocomplete="off">
                </div>
                <div class="field-placeholder">যোগদানের তারিখ</div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" name="phone" class="form-control" value="{{!empty($single_data->phone)?$single_data->phone:''}}" autocomplete="off">
                </div>
                <div class="field-placeholder">মোবাইল </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" name="emergency_phone" class="form-control" value="{{!empty($single_data->emergency_phone)?$single_data->emergency_phone:''}}" autocomplete="off">
                </div>
                <div class="field-placeholder"> ইমারজেন্সি মোবাইল </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <select name="marital_status" class="form-control select-single select2 js-state" data-live-search="true">
                    @foreach(maritalStatus() as $key=>$value)
                    <option value="{{$key}}" {{(!empty($single_data->marital_status) && $single_data->marital_status==$key)?'selected':''}}>{{$value}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="field-placeholder"> বৈবাহিক অবস্থা</div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="file" name="image" class="form-control" value="" autocomplete="off">
                </div>
                <div class="field-placeholder">ছবি </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" name="present_address" class="form-control" value="{{!empty($single_data->present_address)?$single_data->present_address:''}}" autocomplete="off">
                </div>
                <div class="field-placeholder">বর্তমান ঠিকানা</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="field-wrapper">
                <div class="input-group">
                  <input type="text" name="permanent_address" class="form-control" value="{{!empty($single_data->permanent_address)?$single_data->permanent_address:''}}" autocomplete="off">
                </div>
                <div class="field-placeholder">স্থায়ী ঠিকানা </div>
              </div>
            </div>
          <div class="card-footer">
            @if(!empty($single_data))
            <button class="btn btn-sm btn-success">সংশোধন করুন</button>
            @else
            <button class="btn btn-sm btn-success">যোগ করুন</button>
            @endif
          </div>
          {!! Form::close() !!}
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
{!!Html::script('custom/js/jquery.min.js')!!}
{!!Html::script('custom/ninja/jquery.min.3.6.0.js')!!}
<script>
$(document).ready(function () {
  $('#salary_scale_id').change(function (e) { 
    e.preventDefault();
    var scale = $(this).val();
    // alert(scale);
  });
});
</script>
@endsection 