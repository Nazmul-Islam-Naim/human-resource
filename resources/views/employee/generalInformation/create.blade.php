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
                    name="psc_merit_serial" 
                    class="form-control @error('psc_merit_serial') is-invalid @enderror" 
                    value="{{old('psc_merit_serial')}}"
                    placeholder="০১২৩৪৫৬৭৮৯" 
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">পিএসসি মেরিট সিরিয়াল</div>
                </div>
                @error('psc_merit_serial')
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
                    placeholder="আব্দুল আজিজ" 
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
                    placeholder="ABDUL AZIZ" 
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
                    <input type="text" 
                    name="posting" 
                    class="form-control @error('posting') is-invalid @enderror" 
                    value="{{old('posting')}}"
                    placeholder="ঢাকা" 
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">পোস্টিং</div>
                </div>
                @error('posting')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" 
                    name="location" 
                    class="form-control @error('location') is-invalid @enderror" 
                    value="{{old('location')}}"
                    placeholder="উত্তরা, ঢাকা" 
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">লোকেশন</div>
                </div>
                @error('location')
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
                    name="nid" 
                    class="form-control @error('nid') is-invalid @enderror" 
                    value="{{old('nid')}}"
                    placeholder="০১২৩৪৫৬৭" 
                    required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">এন আই ডি  <span class="text-danger">*</span></div>
                </div>
                @error('nid')
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
                    placeholder="আব্দুল জলিল" 
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
                    name="fathers_name_in_english" 
                    class="form-control @error('fathers_name_in_english') is-invalid @enderror" 
                    value="{{old('fathers_name_in_english')}}"
                    placeholder="ABDUL JALIL" 
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">বাবার নাম (ইংরেজি)</div>
                </div>
                @error('fathers_name_in_english')
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
                    placeholder="আয়শা বেগম" 
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
                    <input type="text" 
                    name="mothers_name_in_english" 
                    class="form-control @error('mothers_name_in_english') is-invalid @enderror" 
                    value="{{old('mothers_name_in_english')}}"
                    placeholder="AYSHA BEGUM" 
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">মায়ের নাম (ইংরেজি)</div>
                </div>
                @error('mothers_name_in_english')
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
                    <input type="date" 
                    name="go_date" 
                    class="form-control @error('go_date') is-invalid @enderror" 
                    value="{{old('go_date')??date('Y-m-d')}}"
                    autocomplete="off">
                  </div>
                  <div class="field-placeholder">কনফর্মশেন জি.ও তারিখ </div>
                </div>
                @error('go_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="religion" 
                    class="form-control select2 @error('religion') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($religions as $value => $name)
                      <option value="{{$value}}" {{(old('religion') == $value) ? 'selected' : ''}}>{{$name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">ধর্ম <span class="text-danger">*</span></div>
                </div>
                @error('religion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="freedom_fighter" 
                    class="form-control select2 @error('freedom_fighter') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($freedomFighters as $value => $name)
                      <option value="{{$value}}" {{(old('freedom_fighter') == $value) ? 'selected' : ''}}>{{$name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">মুক্তিযোদ্ধা <span class="text-danger">*</span></div>
                </div>
                @error('freedom_fighter')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="freedom_fighter_child" 
                    class="form-control select2 @error('freedom_fighter_child') is-invalid @enderror" 
                    required="">
                      <option value="">Select</option>
                      @foreach($freedomFighters as $value => $name)
                      <option value="{{$value}}" {{(old('freedom_fighter_child') == $value) ? 'selected' : ''}}>{{$name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">মুক্তিযোদ্ধার সন্তান/নাতি/নাতনি  <span class="text-danger">*</span></div>
                </div>
                @error('freedom_fighter_child')
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
              <div class="col-md-4">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="file" name="signature" class="form-control" value="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">সাক্ষর</div> 
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