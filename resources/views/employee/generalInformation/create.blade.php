@extends('layouts.layout')
@section('title', 'কর্মকর্তা/কর্মচারীর যোগের ফর্ম')
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
          {!! Form::open(array('route' =>['generalInformations.store'],'method'=>'POST','enctype'=>'multipart/form-data')) !!}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title text-success">কর্মকর্তা/কর্মচারীর সাধারন তথ্য পূরন করুন</h2>
            <a href="{{route('generalInformations.index')}}" class="btn btn-primary btn-sm pull-right"><i class="icon-arrow-left-circle"></i> <b>কর্মকর্তা/কর্মচারীর তালিকা</b></a>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="employee_id"
                    class="form-control @error('employee_id') is-invalid @enderror"
                    value="{{old('employee_id')}}"
                    placeholder="০১২৩"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">ইমপ্লোয়ী আইডি</div>
                </div>
                @error('employee_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="name_in_bangla"
                    class="form-control @error('name_in_bangla') is-invalid @enderror"
                    value="{{old('name_in_bangla')}}"
                    placeholder="কর্মকর্তা/কর্মচারীর নাম"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">নাম (বাংলায়) <span class="text-danger">*</span></div>
                </div>
                @error('name_in_bangla')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="name_in_english"
                    class="form-control @error('name_in_english') is-invalid @enderror"
                    value="{{old('name_in_english')}}"
                    placeholder="Employee name"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">নাম (ইংরেজি)</div>
                </div>
                @error('name_in_english')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="fathers_name_in_bangla"
                    class="form-control @error('fathers_name_in_bangla') is-invalid @enderror"
                    value="{{old('fathers_name_in_bangla')}}"
                    placeholder="বাবার নাম"
                    required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">বাবার নাম (বাংলায়)<span class="text-danger">*</span></div>
                </div>
                @error('fathers_name_in_bangla')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="mothers_name_in_bangla"
                    class="form-control @error('mothers_name_in_bangla') is-invalid @enderror"
                    value="{{old('mothers_name_in_bangla')}}"
                    placeholder="মায়ের নাম"
                    required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">মায়ের নাম (বাংলায়)<span class="text-danger">*</span></div>
                </div>
                @error('mothers_name_in_bangla')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="district_id"
                    class="form-control select2 @error('district_id') is-invalid @enderror"
                    required="">
                      <option value="">Select</option>
                      @foreach($districts as $district)
                      <option value="{{$district->id}}" {{(old('district_id') == $district->id) ? 'selected' : ''}}>{{$district->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">জেলা <span class="text-danger">*</span></div>
                </div>
                @error('district_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date"
                    name="birth_date"
                    class="form-control @error('birth_date') is-invalid @enderror"
                    value="{{old('birth_date')??date('Y-m-d')}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">জন্ম তারিখ </div>
                </div>
                @error('birth_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="present_designation_id"
                    class="form-control select2 @error('present_designation_id') is-invalid @enderror"
                    required="">
                      <option value="">Select</option>
                      @foreach($designations as $designation)
                      <option value="{{$designation->id}}" {{(old('present_designation_id') == $designation->id) ? 'selected' : ''}}>{{$designation->title}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">বর্তমান পদের নাম <span class="text-danger">*</span></div>
                </div>
                @error('present_designation_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="present_workstation_id"
                    class="form-control select2 @error('present_workstation_id') is-invalid @enderror"
                    required="">
                      <option value="">Select</option>
                      @foreach($workstations as $workstation)
                      <option value="{{$workstation->id}}" {{(old('present_workstation_id') == $workstation->id) ? 'selected' : ''}}>{{$workstation->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">বর্তমান কর্মস্থল <span class="text-danger">*</span></div>
                </div>
                @error('present_workstation_id')
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
                      <option value="{{$salaryScale->id}}" {{(old('salary_scale_id') == $salaryScale->id) ? 'selected' : ''}}>{{$salaryScale->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">বর্তমান বেতন স্কেল <span class="text-danger">*</span></div>
                </div>
                @error('salary_scale_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="joining_type"
                    class="form-control select2 @error('joining_type') is-invalid @enderror"
                    required="">
                      <option value="">Select</option>
                      @foreach($joiningTypes as $key => $value)
                      <option value="{{$key}}" {{(old('joining_type') == $key) ? 'selected' : ''}}>{{$value}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">যোগদানের ধরন  <span class="text-danger">*</span></div>
                </div>
                @error('joining_type')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date"
                    name="joining_date"
                    class="form-control @error('joining_date') is-invalid @enderror"
                    value="{{old('joining_date')??date('Y-m-d')}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">যোগদানের তারিখ </div>
                </div>
                @error('joining_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="joining_designation_id"
                    class="form-control select2 @error('joining_designation_id') is-invalid @enderror"
                    >
                      <option value="">Select</option>
                      @foreach($designations as $designation)
                      <option value="{{$designation->id}}" {{(old('joining_designation_id') == $designation->id) ? 'selected' : ''}}>{{$designation->title}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">যোগদানের পদবী </div>
                </div>
                @error('joining_designation_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="main_designation_id"
                    class="form-control select2 @error('main_designation_id') is-invalid @enderror"
                    >
                      <option value="">Select</option>
                      @foreach($designations as $designation)
                      <option value="{{$designation->id}}" {{(old('main_designation_id') == $designation->id) ? 'selected' : ''}}>{{$designation->title}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">মূল পদ</div>
                </div>
                @error('main_designation_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date"
                    name="permanent_date"
                    class="form-control @error('permanent_date') is-invalid @enderror"
                    value="{{old('permanent_date')??date('Y-m-d')}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">চাকুরীতে স্থায়ীকরনের তারিখ </div>
                </div>
                @error('permanent_date')
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
                    placeholder="ইফা. প্রশা./উন্নয়ন প্রকল্প-১৭(৮)/২৯২/৯৪(ভলি-১)৪৪৫০"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">চাকুরীতে স্থায়ীকরনের আদেশ নাম্বার </div>
                </div>
                @error('order_no')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <textarea name="permanent_address" id="permanent_address"
                    class="form-control @error('permanent_address') is-invalid @enderror"
                    placeholder="ঢাকা, বাংলাদেশ"
                    style="height: 40px">
                    {{old('permanent_address')}}
                  </textarea>
                  </div>
                  <div class="field-placeholder">স্থায়ী ঠীকানা</div>
                </div>
                @error('permanent_address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <textarea name="present_address" id="present_address"
                    class="form-control @error('present_address') is-invalid @enderror"
                    placeholder="ঢাকা, বাংলাদেশ"
                    style="height: 40px">
                    {{old('present_address')}}
                  </textarea>
                  </div>
                  <div class="field-placeholder">বর্তমান ঠীকানা</div>
                </div>
                @error('present_address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="nid"
                    class="form-control @error('nid') is-invalid @enderror"
                    value="{{old('nid')}}"
                    placeholder="০১***********"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">এনআইডি নাম্বার</div>
                </div>
                @error('nid')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="mobile"
                    class="form-control @error('mobile') is-invalid @enderror"
                    value="{{old('mobile')}}"
                    placeholder="০১***********"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">মোবাইল নাম্বার</div>
                </div>
                @error('mobile')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{old('email')}}"
                    placeholder="nin@mail.com"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">ইমেইল</div>
                </div>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="sex"
                    class="form-control select2 @error('sex') is-invalid @enderror"
                    required="">
                      <option value="">Select</option>
                      @foreach($sexes as $value => $name)
                      <option value="{{$value}}" {{(old('sex') == $value) ? 'selected' : ''}}>{{$name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">সেক্স <span class="text-danger">*</span></div>
                </div>
                @error('sex')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="maritial_status"
                    class="form-control select2 @error('maritial_status') is-invalid @enderror"
                    required="">
                      <option value="">Select</option>
                      @foreach($maritialStatus as $value => $name)
                      <option value="{{$value}}" {{(old('maritial_status') == $value) ? 'selected' : ''}}>{{$name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">বৈবাহিক অবস্থা <span class="text-danger">*</span></div>
                </div>
                @error('maritial_status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="spouse_name_in_bangla"
                    class="form-control @error('spouse_name_in_bangla') is-invalid @enderror"
                    value="{{old('spouse_name_in_bangla')}}"
                    placeholder="স্বামী/স্ত্রীর নাম"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">স্বামী/স্ত্রীর নাম (বাংলা)</div>
                </div>
                @error('spouse_name_in_bangla')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="occupation_id"
                    class="form-control select2 @error('occupation_id') is-invalid @enderror"
                    >
                      <option value="">Select</option>
                      @foreach($occupations as $occupation)
                      <option value="{{$occupation->id}}" {{(old('occupation_id') == $occupation->id) ? 'selected' : ''}}>{{$occupation->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">স্বামী/স্ত্রীর পেশা</div>
                </div>
                @error('occupation_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="spouse_district_id"
                    class="form-control select2 @error('spouse_district_id') is-invalid @enderror"
                    >
                      <option value="">Select</option>
                      @foreach($districts as $district)
                      <option value="{{$district->id}}" {{(old('spouse_district_id') == $district->id) ? 'selected' : ''}}>{{$district->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">স্বামী/স্ত্রীর জেলা</div>
                </div>
                @error('spouse_district_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="file" name="photo" class="form-control" value="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">ছবি (পাসপোর্ট সাইজের)</div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="file" name="document" class="form-control" value="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">ডকুমেন্ট</div>
                </div>
              </div>
            </div>
          <div class="card-footer text-end">
            <button class="btn btn-sm btn-success"><i class="icon-save"></i>যোগ করুন</button>
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
  });
});
</script>
@endsection
