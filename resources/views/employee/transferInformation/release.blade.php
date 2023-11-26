@extends('layouts.layout')
@section('title', 'কর্মকর্তা/কর্মচারীকে অব্যাহতি করুন')
@section('content')
<!-- Content Header (Page header) -->
@php
    use Rakibhstu\Banglanumber\NumberToBangla;
    $numTo = new NumberToBangla();
@endphp
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
        {!! Form::open(array('route' =>['employee-release-update', $employeeTransfer->id],'method'=>'PUT','files'=>true)) !!}
        <div class="card">
          <div class="card-header">
            <div class="card-title">কর্মকর্তা/কর্মচারীকে অব্যাহতি করুন</div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2 mb-3">
                <p>নামঃ {{$employeeTransfer->generalInformation->name_in_bangla}} ||
                  জেলাঃ {{$employeeTransfer->generalInformation->district->name}} ||
                  মোবাইলঃ {{$employeeTransfer->generalInformation->mobile}} ||
                  ইমেইলঃ {{$employeeTransfer->generalInformation->email}} ||
                  বর্তমান পদবীঃ {{$employeeTransfer->generalInformation->presentDesignation->title}} ||
                  বর্তমান কর্মস্থলঃ {{$employeeTransfer->generalInformation->presentWorkStation->name}} ||
                  পে-স্কেলঃ {{$employeeTransfer->generalInformation->salaryScale->name}} ||
                  যোগদানের তারিখঃ {{$numTo->bnNum(date('d',strtotime($employeeTransfer->joining_date)))}}/
                  {{$numTo->bnNum(date('m',strtotime($employeeTransfer->joining_date)))}}/{{$numTo->bnNum(date('Y',strtotime($employeeTransfer->joining_date)))}} খ্রিঃ</p>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date"
                    name="release_date"
                    class="form-control @error('release_date') is-invalid @enderror"
                    value="{{$employeeTransfer->release_date ?? ''}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">অব্যাহতির তারিখ </div>
                </div>
                @error('release_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date"
                    name="joining_date"
                    class="form-control @error('joining_date') is-invalid @enderror"
                    value="{{$employeeTransfer->joining_date ?? ''}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">যোগদানের তারিখ </div>
                </div>
                @error('joining_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="file" name="release_document" class="form-control" value="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">অব্যাহতির ডকুমেন্ট </div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="file" name="join_document" class="form-control" value="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">যোগদানের ডকুমেন্ট </div>
                </div>
                <!-- Field wrapper end -->
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-end">
            <button class="btn btn-primary" type="submit"><i class="icon-chevrons-up"></i>অব্যাহতি করুন</button>
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
