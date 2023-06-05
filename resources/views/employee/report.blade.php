@extends('layouts.layout')
@section('title', 'Employee Salary Report')
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
    </div>
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-primary">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Salary Report</h3>
                  
            <a onclick="printReport();" href="javascript:0;"><img class="img-thumbnail" style="width:30px;" src='{{asset("custom/img/print.png")}}'></a>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form method="post" action="{{ route('employee-salary.filter') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-inline">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="field-wrapper">
                          <div class="input-group">
                            <input class="form-control datepicker" type="text" name="start_date" value="<?php echo date('Y-m-d');?>" autocomplete="off">
                          </div>
                          <div class="field-placeholder">From </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="field-wrapper">
                          <div class="input-group">
                            <input class="form-control datepicker" type="text" name="end_date" value="<?php echo date('Y-m-d');?>" autocomplete="off">
                          </div>
                          <div class="field-placeholder">To </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="field-wrapper">
                          <div class="input-group">
                            <input type="submit" value="Search" class="btn btn-info btn-md">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-12" id="printTable">
                <center><h5 style="margin: 0px">Employee Salary</h5></center>
                <div class="table-responsive">
                  @if(!empty($start_date) && !empty($end_date))
                    <center><h5 style="margin: 0px">From : {{dateFormateForView($start_date)}} To : {{dateFormateForView($end_date)}}</h5></center>
                  @else
                    <center><h5 style="margin: 0px">Today : {{date('d-m-Y')}}</h5></center>
                  @endif
                  <table style="width: 100%; font-size: 14px;" cellspacing="0" cellpadding="0"> 
                    <thead> 
                      <tr style="background: #ccc; color: #000">
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">SL</th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">Date</th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">Month</th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">Employee ID</th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">Employee Name</th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">Note</th>
                        <th style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">Amount</th>
                      </tr>
                    </thead>
                    <tbody> 
                      <?php                           
                        $number = 1;
                        $numElementsPerPage = 250; // How many elements per page
                        $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                        $rowCount = 0;

                        $credit = 0;
                        $debit = 0;
                        $sum = 0;
                      ?>
                      @foreach($alldata as $data)
                        <?php 
                          $rowCount++;
                        ?>
                      <tr>
                        <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$currentNumber++}}</td>
                        <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{dateFormateForView($data->date)}}</td>
                        <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{ucfirst($data->month)}}</td>
                        <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$data->ledger_employee_object->employee_id}}</td>
                        <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px"><a href="{{$baseUrl.'/'.config('app.em').'/employee-ledger/'.$data->employee_id}}">{{$data->ledger_employee_object->name}}</a></td>
                        
                        <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{$data->note}}</td>
                        <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">
                          <?php
                            $reasons = $data->reason;

                            if(preg_match("/salary/", $reasons)) {
                              echo $data->amount;
                              $sum = $sum+$data->amount;
                              $credit = $credit+$data->amount;
                            }
                          ?>
                        </td>
                      </tr>
                      @endforeach
                      @if($rowCount==0)
                        <tr>
                          <td colspan="7" align="center">
                            <h5 style="color: #ccc">No Data Found . . .</h5>
                          </td>
                        </tr>
                      @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px; text-align: right" colspan="6">Total</td>
                            <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px">{{Session::get('currency')}} {{number_format($sum, 2)}}</td>
                        </tr>
                    </tfoot>
                    <tfoot>
                      
                    </tfoot>
                  </table>
                  <div class="col-md-12" align="right">
                      {{$alldata->render()}}
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <div class="card-footer"></div>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection 