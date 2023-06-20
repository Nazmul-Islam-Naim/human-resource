@extends('layouts.layout')
@section('title', 'স্থানান্তর ফর্ম')
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
        {!! Form::open(array('route' =>['transfer-form-store',$generalInformation->id],'method'=>'POST','files'=>true)) !!}
        <div class="card">
          <div class="card-header">
            <div class="card-title">কর্মকর্তা/কর্মচারীকে বদলীর জন্য নিচের ফর্মটি পূরন করুন</div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2 mb-3">
                <p>নামঃ {{$generalInformation->name_in_bangla}} || 
                  জেলাঃ {{$generalInformation->district->name}} || 
                  মোবাইলঃ {{$generalInformation->mobile}} || 
                  ইমেইলঃ {{$generalInformation->email}} || 
                  বর্তমান পদবীঃ {{$generalInformation->presentDesignation->title}} || 
                  বর্তমান কর্মস্থলঃ {{$generalInformation->presentWorkStation->name}} ||
                  পে-স্কেলঃ {{$generalInformation->salaryScale->name}} </p>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="workstation_id" id="workstation_id"
                    class="form-control select2 @error('workstation_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($workstations as $workstation)
                      <option value="{{$workstation->id}}"
                        {{(old('workstation_id') == $workstation->id) ? 'selected' : ''}}>
                        {{$workstation->name}}
                      </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">কর্মস্থল নির্বাচন করুন<span class="text-danger">*</span></div>
                </div>
                @error('workstation_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="designation_id" id="designation_id"
                    class="form-control select2 @error('designation_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($designations as $designation)
                      <option value="{{$designation->id}}"
                        {{(old('designation_id') == $designation->id) ? 'selected' : ''}}>
                        {{$designation->title}}
                      </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">পদবী নির্বাচন করুন<span class="text-danger">*</span></div>
                </div>
                @error('designation_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="salary_scale_id" id="salary_scale_id"
                    class="form-control select2 @error('salary_scale_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($salaryScales as $salaryScale)
                      <option value="{{$salaryScale->id}}"
                        {{(old('salary_scale_id') == $salaryScale->id) ? 'selected' : ''}}>
                        {{$salaryScale->name}} => {{$salaryScale->salary}}
                      </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">পে-স্কেল নির্বাচন করুন<span class="text-danger">*</span></div>
                </div>
                @error('salary_scale_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="salary" 
                    class="form-control @error('salary') is-invalid @enderror" 
                    value="{{old('salary')}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">বেতন<span class="text-danger">*</span> </div>
                </div>
                @error('salary')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="house_rent" 
                    class="form-control @error('house_rent') is-invalid @enderror" 
                    value="{{old('house_rent')}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">বাড়ী ভাড়া</div>
                </div>
                @error('house_rent')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="total_taken_leave" 
                    class="form-control @error('total_taken_leave') is-invalid @enderror" 
                    value="{{old('total_taken_leave')}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">ভোগকৃত ছুটি</div>
                </div>
                @error('total_taken_leave')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="allowance" 
                    class="form-control @error('allowance') is-invalid @enderror" 
                    value="{{old('allowance')}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">অতিরিক্ত দায়িত্ব ভাতা</div>
                </div>
                @error('allowance')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date" 
                    name="transferred_date" 
                    class="form-control @error('transferred_date') is-invalid @enderror" 
                    value="{{old('transferred_date')??date('Y-m-d')}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">বদলীর তারিখ  <span class="text-danger">*</span> </div>
                </div>
                @error('transferred_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date" 
                    name="joining_date" 
                    class="form-control @error('joining_date') is-invalid @enderror" 
                    value="{{old('joining_date')??date('Y-m-d')}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">যোগদানের তারিখ  <span class="text-danger">*</span> </div>
                </div>
                @error('joining_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="comment" 
                    class="form-control @error('comment') is-invalid @enderror" 
                    value="{{old('comment')}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">মন্তব্য</div>
                </div>
                @error('comment')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-end">
            <button class="btn btn-primary" type="submit"><i class="icon-chevrons-up"></i>বদলী করুন</button>
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
@endsection 