@extends('layouts.layout')
@section('title', 'প্রকাশনা সম্পর্কিত তথ্যা সংশোধন করুন')
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
          {!! Form::open(array('route' =>['publicationInformations.update',$publicationInformation->id],'method'=>'PUT','enctype'=>'multipart/form-data')) !!}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title text-success">প্রকাশনা সম্পর্কিত তথ্যা সংশোধন করুন</h2>
            <a href="{{route('publicationInformations.index')}}" class="btn btn-primary btn-sm pull-right"><i class="icon-list"></i> <b>প্রকাশনা তথ্যের তালিকা</b></a>
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
                    value="{{$publicationInformation->generalInformation->name_in_bangla}}"
                    readonly>
                  </div>
                  <div class="field-placeholder">নাম</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="publication_id" 
                    class="form-control select2 @error('publication_id') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($publications as $publication)
                      <option value="{{$publication->id}}" {{(($publicationInformation->publication_id == $publication->id) ?? (old('publication_id') == $publication->id)) ? 'selected' : ''}}>{{$publication->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">প্রকাশনার শিরোনাম <span class="text-danger">*</span></div> 
                </div>
                @error('publication_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="books_name"  
                    class="form-control" 
                    value="{{$publicationInformation->books_name}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">জার্নালের নাম/বইয়ের নাম <span class="text-danger">*</span></div>
                </div>
                @error('books_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date" 
                    name="publication_date"  
                    class="form-control" 
                    value="{{$publicationInformation->publication_date}}"
                    autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">প্রকাশকাল <span class="text-danger">*</span></div>
                </div>
                @error('publication_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="comment" 
                    class="form-control" 
                    value="{{$publicationInformation->comment}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">মন্তব্য</div>
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