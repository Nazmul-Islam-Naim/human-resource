@extends('layouts.layout')
@section('title', 'শূন্য পদের তালিকা')
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
      <input type="hidden" name="designationId" id="designationId" value="{{$designationId}}">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-primary">
          <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">শূন্য পদ কার্যালয়ের তথ্য</h3>
            </div>
          <!-- /.box-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered cell-border compact hover order-column row-border stripe" id="example"> 
                    <thead> 
                      <tr> 
                        <th>সিঃ</th>
                        <th>কার্যালয়ের নাম</th>
                        <th>পদের পদবী</th> 
                        <th>পদ শূন্য হওয়ার সময়</th> 
                        <th>সর্বশেষ শূন্য হওয়ার তারিখ</th> 
                        <th>সর্বশেষ কর্মকর্তা / কর্মচারীর নাম</th> 
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

    var designationId = $('#designationId').val();
    var url = '{{route("empty-designations-report",":id")}}'; 
    var url = url.replace(':id', designationId);
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
          searchPlaceholder: "কার্যালয়"
        },
        buttons: [
            'copy',
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                },
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'print',
                title:"",
                messageTop: function () {
                  var top = '<center><p class ="text-center"><img src="{{asset("backend/custom/images")}}/header.png" height="100"/></p></center>';
                   top += '<h5>শূন্য পদ কার্যালয়ের তথ্যঃ</h5>';
                  
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
                    columns: [ 0, 1, 2, 3]
                },
                messageBottom: null
            }
        ],
			aaSorting: [[0, "asc"]],

			columns: [
        {data: 'DT_RowIndex'},
				{
          data: 'workstation.name',
          render:function(data, type, row){
            if (data != null) {
              return data;
            } else {
              return ''
            }
          }
        },
				{
          data: 'designation.title',
          render:function(data, type, row){
            if (data != null) {
              return data;
            } else {
              return ''
            }
          }
        },
        {data: 'timePeriod'},
        {
          data: 'release_date',
          render: function(data, type, full, meta) {
						if (data != null) {
              const toBn = n => n.replace(/\d/g, d => "০১২৩৪৫৬৭৮৯"[d]);
							return toBn(dateFormat(new Date(data)).toString());
						} else {
              return '';
            }
					}
        },
        {
          data: 'lastEmployee',
          render:function(data, type, row){
            if (data != null) {
              return data;
            } else {
              return ''
            }
          }
        }
			]
    });

});
</script>
@endsection 