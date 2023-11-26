@extends('layouts.layout')
@section('title', 'পেনশন/পি আর এল')
@section('content')
@php
    use Rakibhstu\Banglanumber\NumberToBangla;
    $numTo = new NumberToBangla();
@endphp
<!-- Content Header (Page header) -->
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
        {!! Form::open(array('route' =>['employee-pension-prl-edit',$employeePensionPrl->id],'method'=>'PUT','files'=>true)) !!}
        <div class="card">
          <div class="card-header">
            <div class="card-title">কর্মকর্তা/কর্মচারীর পেনশন/পি আর এল তথ্য সংশোধন করুন</div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2 mb-3">
                <p>নামঃ {{ $employeePensionPrl->generalInformation->name_in_bangla }} ||
                  জেলাঃ {{ $employeePensionPrl->generalInformation->district->name ?? '' }} ||
                  মোবাইলঃ {{$employeePensionPrl->generalInformation->mobile }} ||
                  জন্ম তারিখঃ  {{$numTo->bnNum(date('d',strtotime($employeePensionPrl->generalInformation->birth_date)))}}/
                  {{$numTo->bnNum(date('m',strtotime($employeePensionPrl->generalInformation->birth_date)))}}/{{$numTo->bnNum(date('Y',strtotime($employeePensionPrl->generalInformation->birth_date)))}} খ্রিঃ ||
                  পি আর এল তারিখঃ  {{$numTo->bnNum(date('d',strtotime($employeePensionPrl->generalInformation->prl_date)))}}/
                  {{$numTo->bnNum(date('m',strtotime($employeePensionPrl->generalInformation->prl_date)))}}/{{$numTo->bnNum(date('Y',strtotime($employeePensionPrl->generalInformation->prl_date)))}} খ্রিঃ</p>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="last_basic_salary"
                    class="form-control @error('last_basic_salary') is-invalid @enderror"
                    value="{{$employeePensionPrl->last_basic_salary ?? old('last_basic_salary')}}"
                    placeholder="২২৫০০"
                    required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">সর্বশেষ মূল বেতন <span class="text-danger">*</span></div>
                </div>
                @error('last_basic_salary')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="leave_average_pay"
                    class="form-control @error('leave_average_pay') is-invalid @enderror"
                    value="{{$employeePensionPrl->leave_average_pay ?? old('leave_average_pay')}}"
                    placeholder="৩০০"
                    required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">গড় বেতনে ছুটি<span class="text-danger">*</span></div>
                </div>
                @error('leave_average_pay')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="leave_half_pay"
                    class="form-control @error('leave_half_pay') is-invalid @enderror"
                    value="{{$employeePensionPrl->leave_half_pay ?? old('leave_half_pay')}}"
                    placeholder="১৫০০"
                    required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">অর্ধগড় বেতনে ছুটি <span class="text-danger">*</span></div>
                </div>
                @error('leave_half_pay')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="due_provident_fund"
                    class="form-control @error('due_provident_fund') is-invalid @enderror"
                    value="{{$employeePensionPrl->due_provident_fund ?? old('due_provident_fund')}}"
                    placeholder="২৫০০"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">পাওনা প্রেভিডেন্ট ফান্ড</div>
                </div>
                @error('due_provident_fund')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="leave_encashment_owed"
                    class="form-control @error('leave_encashment_owed') is-invalid @enderror"
                    value="{{$employeePensionPrl->leave_encashment_owed ?? old('leave_encashment_owed')}}"
                    placeholder="৩০০০"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">ছুটি নগদায়ন পাওনা</div>
                </div>
                @error('leave_encashment_owed')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="amount_gratuity"
                    class="form-control @error('amount_gratuity') is-invalid @enderror"
                    value="{{$employeePensionPrl->amount_gratuity ?? old('amount_gratuity')}}"
                    placeholder="৩০০০"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">গ্রাচ্যুটির পরিমান</div>
                </div>
                @error('amount_gratuity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="audit_objected_amount"
                    class="form-control @error('audit_objected_amount') is-invalid @enderror"
                    value="{{$employeePensionPrl->audit_objected_amount ?? old('audit_objected_amount')}}"
                    placeholder="৩০০০"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">অডিট আপত্তিকৃত টাকার পরিমান</div>
                </div>
                @error('audit_objected_amount')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="reason_audit_objections"
                    class="form-control @error('reason_audit_objections') is-invalid @enderror"
                    value="{{$employeePensionPrl->reason_audit_objections ?? old('reason_audit_objections')}}"
                    placeholder="৩০০০"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">অডিট আপত্তির কারন</div>
                </div>
                @error('reason_audit_objections')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="total_amount_owed"
                    class="form-control @error('total_amount_owed') is-invalid @enderror"
                    value="{{$employeePensionPrl->total_amount_owed ?? old('total_amount_owed')}}"
                    placeholder="৩০০০"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">মোট পাওনা টাকার পরিমান</div>
                </div>
                @error('total_amount_owed')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="amount_money_payable"
                    class="form-control @error('amount_money_payable') is-invalid @enderror"
                    value="{{$employeePensionPrl->amount_money_payable ?? old('amount_money_payable')}}"
                    placeholder="৪৫০০০"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">পরিশোধযোগ্য টাকার পরিমান</div>
                </div>
                @error('amount_money_payable')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="provident_fund"
                    class="form-control @error('provident_fund') is-invalid @enderror"
                    value="{{$employeePensionPrl->provident_fund ?? old('provident_fund')}}"
                    placeholder="৩০০০"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">প্রেভিডেন্ট ফান্ড</div>
                </div>
                @error('provident_fund')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="leave_encashment"
                    class="form-control @error('leave_encashment') is-invalid @enderror"
                    value="{{$employeePensionPrl->leave_encashment ?? old('leave_encashment')}}"
                    placeholder="৩০০০"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">ছুটি নগদায়ন</div>
                </div>
                @error('leave_encashment')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="gratuity"
                    class="form-control @error('gratuity') is-invalid @enderror"
                    value="{{$employeePensionPrl->gratuity ?? old('gratuity')}}"
                    placeholder="৩০০০"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">গ্রাচ্যুটি</div>
                </div>
                @error('gratuity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                      <input type="text"
                      name="amount_loan_taken"
                      class="form-control @error('amount_loan_taken') is-invalid @enderror"
                      value="{{$employeePensionPrl->amount_loan_taken ?? old('amount_loan_taken')}}"
                      placeholder="৫০০০০"
                      autocomplete="off">
                  </div>
                  <div class="field-placeholder">গৃহীত লোনের পরিমান</div>
                </div>
                @error('amount_loan_taken')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text"
                    name="reason_amount_loan_taken"
                    class="form-control @error('reason_amount_loan_taken') is-invalid @enderror"
                    value="{{$employeePensionPrl->reason_amount_loan_taken ?? old('reason_amount_loan_taken')}}"
                    placeholder="লোনের কারন"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">লোনের কারন</div>
                </div>
                @error('reason_amount_loan_taken')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="file" name="pension_document" class="form-control" value="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">ডকুমেন্ট</div>
                </div>
                <!-- Field wrapper end -->
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-end">
            <button class="btn btn-primary" type="submit"><i class="icon-save"></i> সংশোধন করুন</button>
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
