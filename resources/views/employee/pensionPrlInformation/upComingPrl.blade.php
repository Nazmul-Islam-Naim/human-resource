@extends('layouts.layout')
@section('title', 'পদভিত্তিক পিআরএল-এর তথ্য পদওয়ারী')
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
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">পদবী অনুযায়ী কর্মকর্তা/কর্মচারী খুজুন </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12">
                <div class="form-inline">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <select name="designation_id" id="designation_id"
                          class="form-control select2 @error('designation_id') is-invalid @enderror">
                            <option value="">Select</option>
                            @foreach($designations as $designation)
                            <option value="{{$designation->id}}">
                              {{$designation->title}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="field-placeholder">পদবী নির্বাচন করুন </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <input type="submit" value="খুজুন" class="btn btn-success btn-md" id="filter">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <input type="submit" value="রিফ্রেশ" class="btn btn-secondary btn-md" id="reset">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-primary">
          <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">পদভিত্তিক পিআরএল-এর তথ্য পদওয়ারীঃ</h3>
            </div>
          <!-- /.box-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered cell-border compact hover nowrap order-column row-border stripe" id="example"> 
                    <thead> 
                      <tr class="dt-top"> 
                        <th class="dt-wrap">সিঃ</th>
                        <th class="dt-wrap">পদের নাম</th>
                        <th class="dt-wrap">কর্মকর্তা/কর্মচারী নাম</th>
                        <th class="dt-wrap">চাকুরীতে যোগদানের তারিখ</th>
                        <th class="dt-wrap">জন্ম তারিখ</th>
                        <th class="dt-wrap">পিআরল-এ গমনের তারিখ</th>
                        <th class="dt-wrap">নমিনির নাম</th>
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
{!!Html::script('custom/yajraTableJs/jquery-3.5.1.js')!!}
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
   // ================== data table start from here ====================
	$(document).ready(function() {
		'use strict';

    filter_view();

    function filter_view(designation_id = '') {
      var table = $('#example').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
          url: "{{route('up-coming-prls')}}",
          data:{designation_id: designation_id}
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
                      columns: [ 0, 1, 2, 3,4,5,6]
                  }, 
                  messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
              },
              {
                  extend: 'print',
                  title:"",
                  messageTop: function () {
                    var top = '<center><p class ="text-center"><img src="{{asset("backend/custom/images")}}/header.png" height="100"/></p></center>';
                   top += '<h5>পদভিত্তিক পিআরএল-এর তথ্য পদওয়ারীঃ</h5>';
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
                      columns: [ 0, 1, 2, 3,4,5,6]
                  }
              }
          ],
        aaSorting: [[0, "asc"]],

        columns: [
          {data: 'DT_RowIndex'},
          {
            data: 'present_designation.title',
          },
          {
            data: 'name_in_bangla',
            render: function(data, type, row) {
              var url = '{{route("generalInformations.show",":id")}}'; 
              var url = url.replace(':id', row.id);
              return '<a href=' + url +'>'+ data +'</a>';
            }
          },
          {
            data: 'joining_date',
            render:function(data, type, row){
              if (data != null) {
                const toBn = n => n.replace(/\d/g, d => "০১২৩৪৫৬৭৮৯"[d]);
                return toBn(dateFormat(new Date(data)).toString());
              }
            }
          },
          {
            data: 'birth_date',
            render:function(data, type, row){
              if (data != null) {
                const toBn = n => n.replace(/\d/g, d => "০১২৩৪৫৬৭৮৯"[d]);
                return toBn(dateFormat(new Date(data)).toString());
              }
            }
          },
          {
            data: 'prl_date',
            render:function(data, type, row){
              if (data != null) {
                const toBn = n => n.replace(/\d/g, d => "০১২৩৪৫৬৭৮৯"[d]);
                return toBn(dateFormat(new Date(data)).toString());
              }
            }
          },
          {
            data: 'spouse_name_in_bangla',
          }
        ]
      });
    }

    $('#filter').click(function (e) { 
    e.preventDefault();
    var designation_id = $('#designation_id').val();

    if (designation_id != '') {
      $('#example').DataTable().destroy();
      filter_view(designation_id);
    } 
  });
  $('#reset').click(function (e) { 
    e.preventDefault();
    $('#designation_id').val('');
    $('#example').DataTable().destroy();
    filter_view();
  });

});
</script>
@endsection 