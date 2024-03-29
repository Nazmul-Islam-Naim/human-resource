@extends('layouts.layout')
@section('title', 'কর্মকর্তা/কর্মচারীর পদোন্নতি সম্পর্কিত তথ্যাদির তালিকা')
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
              <h3 class="card-title">কর্মকর্তা/কর্মচারীর পদোন্নতি সম্পর্কিত তথ্যাদির তালিকা</h3>
              <a href="{{route('promotionInformations.create')}}" class="btn btn-success btn-sm pull-right"><i class="icon-plus-circle"></i> <b>তথ্য যোগ করুন</b></a>
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
                        <th>নাম</th>
                        <th>বর্তমান পদবী</th>
                        <th>বর্তমান কর্মস্থল</th>
                        <th>পদের নাম </th>
                        <th>পদোন্নতির তারিখ</th>
                        <th>আদেশ নং ও তারিখ</th>
                        <th>পে-স্কেল </th>
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
        url: "{{route('promotionInformations.index')}}",
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
                    columns: [ 0, 1, 2, 3,4,5,6,7]
                },
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'print',
                title:"",
                messageTop: function () {
                  var top = '<center><p class ="text-center"><img src="{{asset("backend/custom/images")}}/header.png" height="100"/></p></center>';
                    top += '<h5>কর্মকর্তা/কর্মচারীর পদোন্নতি সম্পর্কিত তথ্যাদির তালিকাঃ</h5>';

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
                    columns: [ 0, 1, 2, 3,4,5,6,7],
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
            var url = url.replace(':id', row.general_information.id);
						return '<a href=' + url +'>'+ data +'</a>';
					}
        },
				{data: 'general_information.present_designation.title'},
				{data: 'general_information.present_workstation.name'},
				{data: 'promotion_designation.title'},
				{
          data: 'promotion_date',
          render:function(data, type, row){
            const toBn = n => n.replace(/\d/g, d => "০১২৩৪৫৬৭৮৯"[d]);
            return toBn(dateFormat(new Date(data)).toString());
          }
        },
				{
          data: 'date',
          render:function(data, type, row){
            const toBn = n => n.replace(/\d/g, d => "০১২৩৪৫৬৭৮৯"[d]);
            return row.order_no + '<br>' +toBn(dateFormat(new Date(data)).toString());
          }
        },
				{data: 'salary_scale.salary'},
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
        var link = '{{route("promotionInformations.destroy",":id")}}';
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
