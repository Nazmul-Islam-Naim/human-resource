@extends('layouts.layout')
@section('title', 'শিক্ষাসংক্রান্ত তথ্যাদি সংরক্ষন করুন')
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
            <div class="card-title">শিক্ষাসংক্রান্ত তথ্যাদি সংরক্ষন করুন</div>
          </div>
          {!! Form::open(array('route' =>['educationalInformations.store'],'method'=>'POST','files'=>true)) !!}
          <div class="card-body">
            <div class="col-md-12">
              <div class="form-inline">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <select  name="general_information_id" id="general_information_id" class="form-control select2" required="">
                            <option value="">Select project</option>
                            @foreach($generalInformations as $generalInformation)
                            <option value="{{$generalInformation->id}}" 
                              data-mobile="{{$generalInformation->mobile}}"
                              data-email="{{$generalInformation->email}}"
                              data-district="{{$generalInformation->district->name ?? ''}}"
                              data-designation="{{$generalInformation->presentDesignation->title ?? ''}}"
                              data-workstation="{{$generalInformation->presentWorkstation->name ?? ''}}"
                              >
                              {{$generalInformation->name_in_bangla}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="field-placeholder">কর্মকর্তা/কর্মচারি নির্বাচন করুন <span class="text-danger">*</span> </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <span id="employeeSummery"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table id="myTableID" class="table ">
                  <thead>
                    <tr>
                      <th  style="text-align: center; border:none">সিঃ</th>
                      <th  style="text-align: center; border:none">ডিগ্রী <span class="text-danger">*</span> </th>
                      <th  style="text-align: center; border:none">পাসের সন <span class="text-danger">*</span></th>
                      <th  style="text-align: center; border:none">পাঠিত বিষয়  <span class="text-danger">*</span></th>
                      <th  style="text-align: center; border:none">বোর্ড/বিশ্ববিদ্যালয় <span class="text-danger">*</span></th>
                      <th  style="text-align: center; border:none">ফলাফল <span class="text-danger">*</span></th>
                      <th  style="text-align: center; border:none">ডকুমেন্ট</th>
                      <th  style="text-align: center; border:none">একশন</th>
                    </tr>
                  </thead>
                  <tbody class= "body" id="yourtableid" >
                      <tr id="row_0" data-rowid="0">
                        <td style="border: 1px solid #fff; width:5%">
                          <span>1</span>
                        </td>
                        <td style="border: 1px solid #fff; width:15%">
                            <select  name="addmore[0][degree_id]" id="degree_id_0"  class="form-control degree_id" required="">
                              <option value="">Select</option>
                              @foreach ($degrees as $degree)
                                  <option value="{{$degree->id}}">{{$degree->name}}</option>
                              @endforeach
                           </select>
                        </td>
                        <td style="border: 1px solid #fff; width:15%">
                            <select  name="addmore[0][passing_year_id]" id="passing_year_id_0"  class="form-control passing_year_id" required="">
                              <option value="">Select</option>
                              @foreach ($passingYears as $passingYear)
                                  <option value="{{$passingYear->id}}">{{$passingYear->name}}</option>
                              @endforeach
                           </select>
                        </td>
                        <td style="border: 1px solid #fff; width:15%">
                            <select  name="addmore[0][reading_subject_id]" id="reading_subject_id_0"  class="form-control reading_subject_id" required="">
                              <option value="">Select</option>
                              @foreach ($readingSubjects as $readingSubject)
                                  <option value="{{$readingSubject->id}}">{{$readingSubject->name}}</option>
                              @endforeach
                           </select>
                        </td>
                        <td style="border: 1px solid #fff; width:15%">
                            <select  name="addmore[0][board_id]" id="board_id_0"  class="form-control board_id" required="">
                              <option value="">Select</option>
                              @foreach ($boards as $board)
                                  <option value="{{$board->id}}">{{$board->name}}</option>
                              @endforeach
                           </select>
                        </td>
                        <td style="border: 1px solid #fff; width:15%">
                          <input type="text" class="form-control" name="addmore[0][result]" autocomplete="off" required>
                        </td>
                        <td style="border: 1px solid #fff; width:20%">
                          <input type="file" class="form-control" name="addmore[0][document]" autocomplete="off">
                        </td>
                        <td >
                          <input type="button" class="form-control" value="+" id="addone" onclick="addrow();">
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
@php
$availableDegrees = "";
$availablePassingYears = "";
$availableReadingSubjects = "";
$availableBoards = "";
  foreach ($degrees as $key => $degree) {
    $availableDegrees .= '<option value="'.$degree->id.'">'.$degree->name.'</option>';
  }
  foreach ($passingYears as $key => $passingYear) {
    $availablePassingYears .= '<option value="'.$passingYear->id.'">'.$passingYear->name.'</option>';
  }
  foreach ($readingSubjects as $key => $readingSubject) {
    $availableReadingSubjects .= '<option value="'.$readingSubject->id.'">'.$readingSubject->name.'</option>';
  }
  foreach ($boards as $key => $board) {
    $availableBoards .= '<option value="'.$board->id.'">'.$board->name.'</option>';
  }
@endphp
{!!Html::script('custom/js/jquery.min.js')!!}
<script type="text/javascript"> 
var AvailableDegrees = '<?php echo $availableDegrees;?>';
var AvailablePassingYears = '<?php echo $availablePassingYears;?>';
var AvailableReadingSubjects = '<?php echo $availableReadingSubjects;?>';
var AvailableBoards = '<?php echo $availableBoards;?>';
var i=0;
var rowcount=1;
function addrow() {
  i++;
  rowcount++;
  var row = '<tr id="row_'+i+'" data-rowid="'+i+'">';
      row += '<td style="border: 1px solid #fff";  width:5%">';
      row += ' <span>'+rowcount+'</span>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:15%">';
      row += '<select  name="addmore['+i+'][degree_id]" id="degree_id_'+i+'"  class="form-control degree_id" required="">';
      row += '<option value="">Select</option>'+AvailableDegrees;
      row += '</select>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:15%">';
      row += '<select  name="addmore['+i+'][passing_year_id]" id="passing_year_id_'+i+'"  class="form-control passing_year_id" required="">';
      row += '<option value="">Select</option>'+AvailablePassingYears;
      row += '</select>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:15%">';
      row += '<select  name="addmore['+i+'][reading_subject_id]" id="reading_subject_id_'+i+'"  class="form-control reading_subject_id" required="">';
      row += '<option value="">Select</option>'+AvailableReadingSubjects;
      row += '</select>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:15%">';
      row += '<select  name="addmore['+i+'][board_id]" id="board_id_'+i+'"  class="form-control board_id" required="">';
      row += '<option value="">Select</option>'+AvailableBoards;
      row += '</select>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:15%">';
      row += ' <input type="text" class="form-control" name="addmore['+i+'][result]" autocomplete="off" required>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:20%">';
      row += ' <input type="file" class="form-control" name="addmore['+i+'][document]" autocomplete="off">';
      row += '</td>';
      row += '<td style="border: 1px solid #fff">';
      row += ' <input type="button" class="form-control" value="x" id="remove" onclick="$(\'#row_'+i+'\').remove();">';
      row += '</td>';
      row += '</tr>';
      $('.body').append(row);
}

$(document).ready(function () {
    $('#general_information_id').change(function (e) { 
    e.preventDefault();
    var Html = '';
    if($(this).val() != ""){

        var mobile = $("#general_information_id option:selected").attr('data-mobile');
        var email = $("#general_information_id option:selected").attr('data-email');
        var district = $("#general_information_id option:selected").attr('data-district');
        var presentDesignation = $("#general_information_id option:selected").attr('data-designation');
        var presentWorkstation = $("#general_information_id option:selected").attr('data-workstation');

        Html = '<p style="margin: 0px"> <b>  মোবাইল : '+mobile+' || <b>  ইমেল : '+email+' || <b>  নিজ জেলা : '+district+' || <b> বর্তমান পদবী : '+presentDesignation+'  || <b> বর্তমান কর্মস্থল : '+presentWorkstation+'</b></p><hr>';
        $('#employeeSummery').html(Html);
    }else{
        $('#employeeSummery').html(Html);
    }
  });
});


</script>
@endsection 