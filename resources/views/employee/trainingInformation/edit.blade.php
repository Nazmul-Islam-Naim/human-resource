@extends('layouts.layout')
@section('title', 'প্রশিক্ষন সম্পর্কিত তথ্যা সংশোধন করুন')
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
          {!! Form::open(array('route' =>['trainingInformations.update',$trainingInformation->id],'method'=>'PUT','enctype'=>'multipart/form-data')) !!}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title text-success">প্রশিক্ষন সম্পর্কিত তথ্যা সংশোধন করুন</h2>
            <a href="{{route('trainingInformations.index')}}" class="btn btn-primary btn-sm pull-right"><i class="icon-list"></i> <b>শিক্ষাসংক্রান্ত তথ্যের তালিকা</b></a>
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
                    value="{{$trainingInformation->generalInformation->name_in_bangla}}"
                    readonly>
                  </div>
                  <div class="field-placeholder">নাম</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="course_id" 
                    class="form-control select2 @error('course_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($courses as $course)
                      <option value="{{$course->id}}" {{(($trainingInformation->course_id == $course->id) ?? (old('course_id') == $course->id)) ? 'selected' : ''}}>{{$course->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">কোর্স <span class="text-danger">*</span></div> 
                </div>
                @error('course_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="institute_id" 
                    class="form-control select2 @error('institute_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($institutes as $institute)
                      <option value="{{$institute->id}}" {{(($trainingInformation->institute_id == $institute->id) ?? (old('institute_id') == $institute->id)) ? 'selected' : ''}}>{{$institute->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">ইনস্টিটিউট<span class="text-danger">*</span></div>
                </div>
                @error('institute_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date" 
                    name="date_from"  
                    class="form-control" 
                    value="{{$trainingInformation->date_from}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">হতে <span class="text-danger">*</span></div>
                </div>
                @error('date_from')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date" 
                    name="date_to"  
                    class="form-control" 
                    value="{{$trainingInformation->date_to}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">পর্যন্ত <span class="text-danger">*</span></div>
                </div>
                @error('date_to')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="comment" 
                    class="form-control" 
                    value="{{$trainingInformation->comment}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">ফলাফল <span class="text-danger">*</span></div>
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