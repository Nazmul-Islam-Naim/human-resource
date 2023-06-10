@extends('layouts.layout')
@section('title', 'Add Phase')
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
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Add Phase To Project</div>
          </div>
          {!! Form::open(array('route' =>['educationalInformations.store'],'method'=>'POST','files'=>true)) !!}
          <div class="card-body">
            <div class="col-md-12">
              <div class="form-inline">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <select  name="project_id"  class="form-control select-single js-states select2" data-live-search="true" required="">
                            <option value="">Select project</option>
                            @foreach($generalInformations as $generalInformation)
                            <option value="{{$generalInformation->id}}">{{$generalInformation->name_in_bangla}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="field-placeholder">employee <span class="text-danger">*</span> </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table id="myTableID" class="table ">
                  <thead>
                    <tr>
                      <th>Sl</th>
                      <th>Date</th>
                      <th>Document Title</th>
                      <th>Document</th>
                      <th>Image Title</th>
                      <th>Image</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody class= "body" id="yourtableid" >
                      <tr id="row_0" data-rowid="0">
                        <td style="border: 1px solid #fff">
                          <span>1</span>
                        </td>
                        <td style="border: 1px solid #fff">
                          <input class="form-control" type="date" name="addmore[0][date]" value="<?php echo date('Y-m-d');?>" autocomplete="off" requried="">
                        </td>
                        <td style="border: 1px solid #fff; width:20%">
                            <select  name="addmore[0][des]" id="document_title_id_0"  class="form-control document_title_id" required="">
                           
                           </select>
                        </td>
                        <td style="border: 1px solid #fff; width:20%">
                          <input type="file" class="form-control" name="addmore[0][doc]" autocomplete="off">
                        </td>
                        <td style="border: 1px solid #fff; width:20%">
                            <textarea name="addmore[0][image_title]" style="height:40px" class="form-control"></textarea>
                        </td>
                        <td style="border: 1px solid #fff; width:20%">
                          <input type="file" class="form-control" name="addmore[0][image]" autocomplete="off">
                        </td>
                        <td >
                          <input type="button" class="form-control" value="+" id="addone" onclick="addrow();getDocumentTitle();">
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
          </div>
          <div class="card-footer text-end">
            <button class="btn btn-sm btn-success"><i class="icon-save"></i>যোগ করুন</button>
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
{!!Html::script('custom/js/jquery.min.js')!!}
<script type="text/javascript"> 
var i=0;
var rowcount=1;
function addrow() {
  i++;
  rowcount++;
  var row = '<tr id="row_'+i+'" data-rowid="'+i+'">';
      row += '<td style="border: 1px solid #fff">';
      row += ' <span>'+rowcount+'</span>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff">';
      row += ' <input class="form-control" type="date" name="addmore['+i+'][date]" value="<?php echo date('Y-m-d');?>" autocomplete="off" requried="">';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:20%">';
      row += '<select  name="addmore['+i+'][des]" id="document_title_id_'+i+'"  class="form-control select-single js-states select2" data-live-search="true" required="">';
      row += '</select>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:20%">';
      row += ' <input type="file" class="form-control" name="addmore['+i+'][doc]" autocomplete="off">';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:20%">';
      row += ' <textarea name="addmore['+i+'][image_title]" style="height:40px" class="form-control"></textarea>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:20%">';
      row += ' <input type="file" class="form-control" name="addmore['+i+'][image]" autocomplete="off">';
      row += '</td>';
      row += '<td style="border: 1px solid #fff">';
      row += ' <input type="button" class="form-control" value="x" id="remove" onclick="$(\'#row_'+i+'\').remove();">';
      row += '</td>';
      row += '</tr>';
      $('.body').append(row);
}

// dependancy dropdown sub phase
$(document).ready(function() {
    $('#phase_id').on('change', function() {
      var phaseid = $(this).val();
      if(phaseid) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          method: "POST",
          url: "{{$baseUrl.'/'.config('app.phase').'/get-sub-phase'}}",
          data: {
            'id' : phaseid
          },
          dataType: "json",

          success:function(data) {
            //console.log(data);
            if(data){
              $('#sub_phase_id').empty();
              $('#sub_phase_id').focus;
              $('#sub_phase_id').append('<option value="">Select</option>'); 
              $.each(data, function(key, value){
                console.log(data);
                $('select[name="sub_phase_id"]').append('<option value="'+ value.id +'">' + value.name+ '</option>');
              });
            }else{
              $('#sub_phase_id').empty();
            }
          }
        });
      }else{
        $('#sub_phase_id').empty();
      }
    });
});
// dependancy dropdown document title first row
$(document).ready(function() {
    $('.sub_phase_id').on('change', function() {
      var subphaseid = $(this).val();
      if(subphaseid) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          method: "POST",
          url: "{{$baseUrl.'/'.config('app.phase').'/get-document-title'}}",
          data: {
            'id' : subphaseid,
          },
          dataType: "json",

          success:function(data) {
            //console.log(data);
            if(data){
              $('.document_title_id').empty();
              $('.document_title_id').focus;
              $('.document_title_id').append('<option value="">Select</option>'); 
              $.each(data, function(key, value){
                console.log(data);
                $('.document_title_id').append('<option value="'+ value.name +'">' + value.name+ '</option>');
              });
            }else{
              $('.document_title_id').empty();
            }
          }
        });
      }else{
        $('.document_title_id').empty();
      }
    });
});
// dependancy dropdown document title after first row
function getDocumentTitle(){
  var subphaseid = $('#sub_phase_id').val();
  var RowID = $('#yourtableid tr:last').attr('data-rowid');
  console.log(RowID);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: "POST",
    url: "{{$baseUrl.'/'.config('app.phase').'/get-document-title'}}",
    data: {
      'id' : subphaseid,
    },
    dataType: "json",
    success:function(data) {
      $("select#document_title_id_"+RowID).empty();
          $("select#document_title_id_"+RowID).append('<option  value="">--Select--</option>');
          $.each(data, function(key, value){
              console.log(value.name);
              $("select#document_title_id_"+RowID).append('<option  value="'+ value.name +'">'+value.name+'</option>');
          });
    }
  });
}
</script>
@endsection 