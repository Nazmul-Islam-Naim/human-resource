@extends('layouts.layout')
@section('title', 'Apply Leave')
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
        <div class="card">
          <div class="card-header">
            <div class="card-title">Apply Leave</div>
            <a href="javascript:void(0)" class="btn btn-sm btn-warning pull-right" data-bs-toggle="modal" data-bs-target="#myModal"><i class="icon-plus-circle"></i> <b>Apply Leave</b></a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="" class="table v-middle">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Leave Date</th>
                    <th>Days</th>
                    <th>Apply Date</th>
                    <th>Status</th>
                    <th width="40px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php                           
                    $number = 1;
                    $numElementsPerPage = 15; // How many elements per page
                    $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                    $rowCount = 0;
                  ?>
                  @foreach($alldata as $data)
                  <?php $rowCount++; ?>
                  <tr>
                    <td>{{$currentNumber++}}</td>
                    <td>{{$data->requestleave_employee_object->name}}</td>
                    <td>{{dateFormateForView($data->leave_from_date)}} - {{dateFormateForView($data->leave_to_date)}}</td>
                    <td>
                      <?php 
                        $now = strtotime(date('Y-m-d', strtotime($data->leave_to_date))); 
                        $your_date = strtotime(date('Y-m-d', strtotime($data->leave_from_date)));
                        $datediff = $now - $your_date;
                        echo $days = round($datediff / (60 * 60 * 24));
                      ?>
                    </td>
                    <td>{{dateFormateForView($data->leave_from_date)}}</td>
                    <td>
                      @if ($data->status == 2)
                      <span class="badge bg-danger">Rejected</span>
                      @elseif ($data->status == 1)
                      <span class="badge bg-primary">Apprved</span>
                      @elseif ($data->status == 0)
                      <span class="badge bg-warning">Pending</span>
                      @endif
                    </td>
                    <td>
                      @if ($data->status == 0)
                      <div class="actions">
                        <a class="btn btn-primary custom-btn" href="{{$baseUrl.'/'.config('app.hr').'/approve-applied-leave/'.$data->id}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Approve" onclick="return confirm('Are you sure?')">
                          Approve
                        </a>
                        <a class="btn btn-danger custom-btn" data-placement="top" title="" data-original-title="Reject" href="{{$baseUrl.'/'.config('app.hr').'/reject-applied-leave/'.$data->id}}" onclick="return confirm('Are you sure?')">Reject</a>
                      </div>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                  @if($rowCount==0)
                  <tr>
                    <td colspan="8" align="center">
                      <h4 style="color: #ccc">No Data Found . . .</h4>
                    </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->

<!-- Modal start -->
<div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> ADD DETAILS</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      {!! Form::open(array('route' =>['store-requested-leave'],'method'=>'POST')) !!}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="field-wrapper">
              <select class="form-select SelectEmployee" id="formSelect" name="employee_id" required="">
                @foreach($allemployee as $value)
                <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
              </select>
              <div class="field-placeholder">Employee</div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="field-wrapper">
              <input id="availableLeave" type="number" min="1" autocomplete="off" class="form-control" required="" readonly>
              <div class="field-placeholder">Available Leave</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="field-wrapper">
              <input type="text" name="leave_from_date" autocomplete="off" class="form-control datepicker" value="{{date('Y-m-d')}}" required="">
              <div class="field-placeholder">Leave From Date</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="field-wrapper">
              <input type="text" name="leave_to_date" autocomplete="off" class="form-control datepicker" value="{{date('Y-m-d')}}" required="">
              <div class="field-placeholder">Leave To Date</div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="field-wrapper">
              <textarea name="reason" autocomplete="off" class="form-control" rows="5"></textarea>
              <div class="field-placeholder">Reason</div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        {{Form::submit('Save',array('class'=>'btn btn-primary btn-sm', 'style'=>'width:15%'))}}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Modal end -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript"> 
// dependancy dropdown using ajax
$(document).ready(function() {
  $('.SelectEmployee').on('change', function() {
    var employeeID = $(this).val();
    if(employeeID) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        //url: "{{URL::to('find-chequeno-with-chequebook-id')}}",
        url: "{{$baseUrl.'/'.config('app.hr').'/find-totalleave-with-employee-id'}}",
        data: {
          'id' : employeeID
        },
        dataType: "json",

        success:function(data) {
          // console.log(data);
          if(data){
            $('#availableLeave').empty();
            $('#availableLeave').focus;
            /*$('#availableLeave').append('<option value="">Select</option>');*/
            
            $('#availableLeave').val(data.total_leave);
          }else{
            $('#availableLeave').empty();
          }
        }
      });
    }else{
      $('#availableLeave').empty();
    }
  });
});
</script>               
@endsection 