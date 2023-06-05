@extends('layouts.layout')
@section('title', 'Add/Edit User')
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
    </div>
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          @if(!empty($single_data))
          {!! Form::open(array('route' =>['user-list.update',$single_data->id],'method'=>'PUT','files'=>true)) !!}
          <?php $btn='Update';?>
          @else
          {!! Form::open(array('route' =>['user-list.store'],'method'=>'POST','files'=>true)) !!}
          <?php $btn='Add';?>
          @endif
          <div class="card-header">
            <div class="card-title">{{$btn}} User</div>
          </div>
          
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <!------------------- name --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="text" name="name" value="{{!empty($single_data->name)?$single_data->name:''}}" autocomplete="off">
                  <div class="field-placeholder">Name <span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- email --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="text" name="email" value="{{!empty($single_data->email)?$single_data->email:''}}" autocomplete="off">
                  <div class="field-placeholder">Email</div>
                </div>
              </div>
              <!------------------- phone --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="text" name="phone" value="{{!empty($single_data->phone)?$single_data->phone:''}}" autocomplete="off">
                  <div class="field-placeholder">Phone <span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- role --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <select class="select-single select2 js-state @error('role_id') is-invalid @enderror" data-live-search="true" name="role_id" required="">
                    <option value="">Select</option>
                    @foreach($roles as $role)
                    <option value="{{$role->id}}" {{(!empty($single_data) && $single_data->role_id == $role->id)?'selected':''}}>{{$role->title}}</option>
                    @endforeach
                  </select>
                  <div class="field-placeholder">Role<span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- designation --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <select class="select-single select2 js-state @error('designation_id') is-invalid @enderror" data-live-search="true" name="designation_id" required="">
                    <option value="">Select</option>
                    @foreach($designations as $designation)
                    <option value="{{$designation->id}}" {{(!empty($single_data) && $single_data->designation_id==$designation->id)?'selected':''}}>{{$designation->title}}</option>
                    @endforeach
                  </select>
                  <div class="field-placeholder">Designation<span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- password --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="text" name="password" class="form-controller">
                  <div class="field-placeholder">Password <span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- confirm password --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="text" name="password_confirmation" class="form-controller">
                  <div class="field-placeholder">Confirm Password <span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- avatar --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="file" name="avatar" value="">
                  <div class="field-placeholder">Avatar(500 x 500)px</div>
                </div>
              </div>
              <!------------------- nid --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="field-wrapper">
                  <input type="file" name="nid" value="">
                  <div class="field-placeholder">NID (600 x 500)px</div>
                </div>
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-end">
            <a href="{{route('user-list.index')}}" class="btn btn-secondary">Back</a>
            <button class="btn btn-primary" type="submit">{{$btn}}</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->

@endsection