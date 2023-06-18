@extends('layouts.layout')
@section('title', 'পদভিত্তিক বর্তমান কর্মস্থলের তালিকা')
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
              <h3 class="card-title">পদভিত্তিক বর্তমান কর্মস্থলের তালিকা</h3>
            </div>
          <!-- /.box-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered cell-border compact hover nowrap order-column row-border stripe" id="example"> 
                    <thead> 
                      <tr> 
                        <th>সিঃ</th>
                        <th>নাম</th>
                        <th>বর্তমান পদবী</th>
                        <th>মূল পদ</th>
                        <th>নিজ জেলা</th> 
                        <th>বর্তমান কর্মস্থল</th> 
                        <th>বর্তমান কর্মস্থলে যোগদানের তারিখ</th>
                        <th>পূর্ববর্তী পদবী</th>
                        <th>পূর্ববর্তী কর্মস্থল</th>
                        <th>পূর্ববর্তী কর্মস্থলে যোগদানের তারিখ</th>
                        <th>পি আর এল</th>
                        <th>একশন</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
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
   // ==================== date format ===========
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

    filter_view();

    function filter_view(start_date = '',end_date = '') {
      var table = $('#example').DataTable({
			serverSide: true,
			processing: true,
			ajax: {
        url: "{{route('transfer-status-index')}}",
        data: {start_date: start_date, end_date: end_date}
      },
      "lengthMenu": [[ 100, 150, 250, -1 ],[ '100', '150', '250', 'All' ]],
      dom: 'Blfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10]
                },
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'print',
                title:"",
                messageTop: function () {
                  var top = '<center><p class ="text-center"><img src="{{asset("logo")}}/logo.png" width="40px" height="40px"/></p></center>';
                  top += '<center><h3>ইসলামিক ফাউন্ডেশন</h3></center>';
                  top += '<center><p style="margin-top:-10px">প্রতিষ্ঠাতা - জাতির পিতা বঙ্গবন্ধু শেখ মজিবুর রহমান </p></center>';
                  top += '<center><p style="margin-top:-10px">হেড অফিস</p></center>';
                  
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
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10]
                },
                messageBottom: null
            }
        ],
			aaSorting: [[0, "asc"]],

			columns: [
        {data: 'DT_RowIndex'},
				{
          data: 'general_information.name_in_bangla',
          render: function(data, type, row) {
            var url = '{{route("generalInformations.show",":id")}}'; 
            var url = url.replace(':id', row.id);
						return '<a href=' + url +'>'+ data +'</a>';
					}
        },
				{data: 'general_information.present_designation.title'},
				{data: 'general_information.joining_designation.title'},
				{data: 'general_information.district.name'},
				{data: 'general_information.present_work_station.name'},
				{
          data: 'present_joining_date',
          render: function(data, type, full, meta) {
						if (data != null) {
              const toBn = n => n.replace(/\d/g, d => "০১২৩৪৫৬৭৮৯"[d]);
							return toBn(dateFormat(new Date(data)).toString());
						}
					}
        },
				{
          data: 'previous_designation.title',
          render:function(data, type, row){
            if (data != null) {
              return data;
            } else {
              return '';
            }
          }
        },
				{
          data: 'previous_workstation.name',
          render:function(data, type, row){
            if (data != null) {
              return data;
            } else {
              return '';
            }
          }
        },
				{
          data: 'previous_joining_date',
          render: function(data, type, full, meta) {
						if (data != null) {
              const toBn = n => n.replace(/\d/g, d => "০১২৩৪৫৬৭৮৯"[d]);
							return toBn(dateFormat(new Date(data)).toString());
						}else{
              return ''
            }
					}
        },
				{
          data: 'general_information.prl_date',
          render: function(data, type, full, meta) {
						if (data != null) {
              const toBn = n => n.replace(/\d/g, d => "০১২৩৪৫৬৭৮৯"[d]);
							return toBn(dateFormat(new Date(data)).toString());
						}
					}
        },
        {
          data: 'action',
          orderable:true,
          searchable:true
        }
			]
    });
  }

  $('#filter').click(function (e) { 
    e.preventDefault();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();

    if (start_date != '' && end_date != '') {
      $('#example').DataTable().destroy();
      filter_view(start_date, end_date);
    } else {
    }
  });
  $('#reset').click(function (e) { 
    e.preventDefault();
    $('#start_date').val('');
    $('#end_date').val('');
    $('#example').DataTable().destroy();
    filter_view();
  });

});
</script>
@endsection 