@extends('layouts.layout')
@section('title', 'ডিপার্টমেন্ট অনুযায়ী জনবলের তথ্য')
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
          <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">ডিপার্টমেন্ট অনুযায়ী জনবলের তথ্যঃ</h3>
              <input type="hidden" value="{{$departmentId}}" id="departmentId">
            </div>
          <!-- /.box-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered cell-border compact hover nowrap order-column row-border stripe" id="example"> 
                    <thead> 
                      <tr class="dt-top"> 
                        <th class="dt-wrap">ক্রমিক নং</th>
                        <th class="dt-wrap">ডিপার্টমেন্টের নাম</th>
                        <th class="dt-wrap">কর্মকর্তা / কর্মচারীর নাম</th>
                        <th class="dt-wrap">কর্মরত কার্যালয়ের পদবী</th> 
                        <th class="dt-wrap">অধীনস্থ কার্যালয়</th> 
                        <th class="dt-wrap">কার্যালয়ের জনবলের সংখ্যা</th> 
                      </tr>
                    </thead>
                  </table>
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
{!!Html::script('custom/yajraTableJs/jquery.js')!!}
{!!Html::script('custom/yajraTableJs/yajraDateTime.js')!!}
{!!Html::script('custom/yajraTableJs/newAjax.moment.js')!!}
{!!Html::script('custom/yajraTableJs/dataTable.js')!!}
{!!Html::script('custom/yajraTableJs/query.dataTables1.12.1.js')!!}
<script>

  function dateFormat(data) { 
    let date, month, year;
    date = data.getDate();
    month = data.getMonth() + 1;
    year = data.getFullYear();

    date = date
        .toString()
        .padStart(2, '0');

    month = month
        .toString()
        .padStart(2, '0');

    return `${date}-${month}-${year}`;
  }

	$(document).ready(function() {
		'use strict';
    const id = $('#departmentId').val();
    var url = '{{route("departments-report",":id")}}'; 
    var url = url.replace(':id', id);
   
    var table = $('#example').DataTable({
			serverSide: true,
			processing: true,
			ajax: {
        url: url,
      },
      "lengthMenu": [[ 100, 150, 250, -1 ],[ '100', '150', '250', 'All' ]],
      dom: 'Blfrtip',
      "language": {
          search: "খুজুন:",
          searchPlaceholder: "কর্মকর্তা / কর্মচারীর নাম"
        },
        buttons: [
            'copy',
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5],
                    format: {
                      body: function (data, row, column, node) {
                        if (column && data !== null && typeof data !== "undefined") {
                            return data.toString().replace(/\n/ig, "<br/>");
                        } else {
                            return data; // Return the original data if it's undefined or null
                        }
                      }
                    }
                },
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'print',
                title:"",
                messageTop: function () {
                  var top = '<center><p class ="text-center"><img src="{{asset("backend/custom/images")}}/header.png" height="100"/></p></center>';
                  
                  return top;
                },
                customize: function (win){
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');
 
                $(win.document.body).find('table').css('font-size', 'inherit');
 
                $(win.document.body).find('table thead th').css('border','1px solid #ddd');  
                $(win.document.body).find('table tbody td').css('border','1px solid #ddd');  
                },
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5],
                    format: {
                      body: function (data, row, column, node) {
                        if (column) {
                            return data.replace(/\n/ig, "<br/>");
                        }
                      }
                    }
                },
                messageBottom: null
            }
        ],
			aaSorting: [[0, "asc"]],

			columns: [
        {data: 'DT_RowIndex'},
				{
          data: 'department.name',
          render:function(data, type, row){
            if(data != null){
              return data;
            }else{
              return '';
            }
          }
        },
				{
          data: 'employees',
          render:function(data, type, row){
            if(data != null){
              return data;
            }else{
              return '';
            }
          }
        },
				{
          data: 'designations',
          render:function(data, type, row){
            if(data != null){
              return data;
            }else{
              return '';
            }
          }
        },
				{
          data: 'workstation.name',
          render:function(data, type, row){
            if(data != null){
              return data;
            }else{
              return '';
            }
          }
        },
        {data: 'totalEmployee'},
			]
    });

});
</script>
@endsection 