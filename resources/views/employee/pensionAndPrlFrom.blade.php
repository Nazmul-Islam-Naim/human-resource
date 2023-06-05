@extends('layouts.layout')
@section('title', 'পেনশন/পি আর এল')
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
        {!! Form::open(array('route' =>['employee-pension-prl',$single_data->id],'method'=>'POST','files'=>true)) !!}
        <div class="card">
          <div class="card-header">
            <div class="card-title">কর্মকর্তা/কর্মচারীর পেনশন/পি আর এল এর জন্য ফর্মটা পূরন করুন</div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control" type="text" name="" value="{{ $single_data->name }}" required="" autocomplete="off">
                    <input class="form-control" type="hidden" name="employee_id" value="{{ $single_data->id}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">কর্মকর্তা/কর্মচারীর নাম <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="district_id" class="form-control select-single select2 js-state" data-live-search="true" required>
                      @foreach ($all_district as $district)
                      <option value="{{$district->id}}" {{($district->id == $single_data->district_id)?'selected':''}}>{{$district->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">জেলা  <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  class="form-control datepicker" type="text" name="dob" value="{{$single_data->dob}}" autocomplete="off">
                  </div>
                  <div class="field-placeholder">জন্ম তারিখ<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  class="form-control datepicker" type="text" name="prl_date" autocomplete="off">
                  </div>
                  <div class="field-placeholder">পি আর এল তারিখ <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  class="form-control numeric" type="text" name="last_basic_salary" autocomplete="off">
                  </div>
                  <div class="field-placeholder">সর্বশেষ মূল বেতন <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  class="form-control numeric" type="text" name="leave_average_pay" autocomplete="off">
                  </div>
                  <div class="field-placeholder">গড় বেতনে ছুটি<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control numeric" type="text" name="leave_half_pay"  required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">অর্ধগড় বেতনে ছুটি <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control numeric" type="text" name="due_provident_fund"   autocomplete="off">
                  </div>
                  <div class="field-placeholder">পাওনা প্রেভিডেন্ট ফান্ড</div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control numeric" type="text" name="leave_encashment_owed" autocomplete="off">
                  </div>
                  <div class="field-placeholder">ছুটি নগদায়ন পাওনা <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control numeric" type="text" name="amount_gratuity"   autocomplete="off">
                  </div>
                  <div class="field-placeholder">গ্রাচ্যুটির পরিমান  <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control numeric" type="text" name="audit_objected_amount"  required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">অডিট আপত্তিকৃত টাকার পরিমান<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <textarea class="form-control" name="reason_audit_objections" style="height:40px" ></textarea>
                  </div>
                  <div class="field-placeholder">অডিট আপত্তির কারন<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control numeric" type="text" name="total_amount_owed"  required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">মোট পাওনা টাকার পরিমান<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control numeric" type="text" name="amount_money_payable"  autocomplete="off">
                  </div>
                  <div class="field-placeholder">পরিশোধযোগ্য টাকার পরিমান</div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control numeric" type="text" name="provident_fund"  autocomplete="off">
                  </div>
                  <div class="field-placeholder">প্রেভিডেন্ট ফান্ড</div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control numeric" type="text" name="leave_encashment"  required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">ছুটি নগদায়ন<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control numeric" type="text" name="gratuity" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">গ্রাচ্যুটি<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control numeric" type="text" name="amount_loan_taken" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">গৃহীত লোনের পরিমান<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <textarea name="reason_amount_loan_taken"></textarea>
                  </div>
                  <div class="field-placeholder">লোনের কারন</div>
                </div>
                <!-- Field wrapper end -->
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-primary" type="submit">পেনশন যোগ করুন</button>
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