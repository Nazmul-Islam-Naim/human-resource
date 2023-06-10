@extends('layouts.layout')
@section('title', 'কর্মকর্তা/কর্মচারীর শিক্ষাসংক্রান্ত তথ্যাদির তালিকা')
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
              <h3 class="card-title">কর্মকর্তা/কর্মচারীর শিক্ষাসংক্রান্ত তথ্যাদির তালিকা</h3>
              <a href="{{route('educationalInformations.create')}}" class="btn btn-success btn-sm pull-right"><i class="icon-plus-circle"></i> <b>তথ্য যোগ করুন</b></a>
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
                        <th>বর্তমান কর্মস্থল</th> 
                        <th>ডিগ্রী </th> 
                        <th>পাসের সন </th> 
                        <th>পাঠিত বিষয় </th> 
                        <th>বোর্ড/বিশ্ববিদ্যালয় </th> 
                        <th>ফলাফল </th> 
                        <th>ডকুমেন্ট </th> 
                        <th width="15%">একশন</th>
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

   
    var table = $('#example').DataTable({
			serverSide: true,
			processing: true,
			ajax: {
        url: "{{route('educationalInformations.index')}}",
      },
      "lengthMenu": [[ 100, 150, 250, -1 ],[ '100', '150', '250', 'All' ]],
      dom: 'Blfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8]
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
                    columns: [ 0, 1, 2, 3,4,5,6,7,8],
                },
                messageBottom: null
            }
        ],
			aaSorting: [[0, "asc"]],

			columns: [
        {data: 'DT_RowIndex'},
				{
          data: 'general_information.name',
          render: function(data, type, row) {
            var url = "/hr/employee-transferred-history/"+ row.id; 
						return '<a href=' + url +'>'+ data +'</a>';
					}
        },
				{data: 'general_information.present_designation.name'},
				{data: 'general_information.present_workstation.name'},
				{data: 'degree.name'},
				{data: 'passing_year.name'},
				{data: 'reading_subject.name'},
				{data: 'board.name'},
				{data: 'result'},
				{
          data: 'document',
          render:function(data, type, row){
            if (data != null) {
              var url = '{{asset("storage/".":doc")}}'; 
              var url = url.replace(':doc', data);
              return "<a href='"+ url +"' class='btn btn-sm btn-default btn-status-active' target='_blank' data-id='" + row.id + "'><i class='fa fa-file-pdf-o'  aria-hidden='true'></i></a>";
            } else {
              return ''
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

     //-------- Delete single data with Ajax --------------//
     $("#example").on("click", ".button-delete", function(e) {
			  e.preventDefault();

        var confirm = window.confirm('Are you sure want to delete data?');
        if (confirm != true) {
          return false;
        }
        var id = $(this).data('id');
        var link = '{{route("educationalInformations.destroy",":id")}}';
        var link = link.replace(':id', id);
        var token = '{{csrf_token()}}';
        $.ajax({
          url: link,
          type: 'POST',
          data: {
            '_method': 'DELETE',
            '_token': token
          },
          success: function(data) {
            table.ajax.reload();
          },

        });
    });

});
</script>
@endsection 