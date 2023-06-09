@extends('layouts.layout')
@section('title', 'শিক্ষাসংক্রান্ত তথ্যা সংশোধন করুন')
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
          {!! Form::open(array('route' =>['educationalInformations.update',$educationalInformation->id],'method'=>'PUT','enctype'=>'multipart/form-data')) !!}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title text-success">শিক্ষাসংক্রান্ত তথ্যা সংশোধন করুন</h2>
            <a href="{{route('educationalInformations.index')}}" class="btn btn-primary btn-sm pull-right"><i class="icon-list"></i> <b>শিক্ষাসংক্রান্ত তথ্যের তালিকা</b></a>
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
                    value="{{$educationalInformation->generalInformation->name_in_bangla}}"
                    readonly>
                  </div>
                  <div class="field-placeholder">নাম</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="degree_id" 
                    class="form-control select2 @error('degree_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($degrees as $degree)
                      <option value="{{$degree->id}}" {{(($educationalInformation->degree_id == $degree->id) ?? (old('degree_id') == $degree->id)) ? 'selected' : ''}}>{{$degree->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">ডিগ্রী <span class="text-danger">*</span></div>
                </div>
                @error('degree_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="passing_year_id" 
                    class="form-control select2 @error('passing_year_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($passingYears as $passingYear)
                      <option value="{{$passingYear->id}}" {{(($educationalInformation->passing_year_id == $passingYear->id) ?? (old('passing_year_id') == $passingYear->id)) ? 'selected' : ''}}>{{$passingYear->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">পাসের সন <span class="text-danger">*</span></div>
                </div>
                @error('passing_year_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="reading_subject_id" 
                    class="form-control select2 @error('reading_subject_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($readingSubjects as $readingSubject)
                      <option value="{{$readingSubject->id}}" {{(($educationalInformation->reading_subject_id == $readingSubject->id) ?? (old('reading_subject_id') == $readingSubject->id)) ? 'selected' : ''}}>{{$readingSubject->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">পাঠিত বিষয় <span class="text-danger">*</span></div>
                </div>
                @error('reading_subject_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="board_id" 
                    class="form-control select2 @error('board_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($boards as $board)
                      <option value="{{$board->id}}" {{(($educationalInformation->board_id == $board->id) ?? (old('board_id') == $board->id)) ? 'selected' : ''}}>{{$board->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">বোর্ড/বিশ্ববিদ্যালয় <span class="text-danger">*</span></div>
                </div>
                @error('board_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="result" 
                    class="form-control" 
                    value="{{$educationalInformation->result}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">ফলাফল <span class="text-danger">*</span></div>
                </div>
                @error('result')
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