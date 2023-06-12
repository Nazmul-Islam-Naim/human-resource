@extends('layouts.layout')
@section('title', 'প্রশিক্ষন সম্পর্কিত তথ্যাদি সংরক্ষন করুন')
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
            <div class="card-title">প্রশিক্ষন সম্পর্কিত তথ্যাদি সংরক্ষন করুন</div>
          </div>
          {!! Form::open(array('route' =>['trainingInformations.store'],'method'=>'POST','files'=>true)) !!}
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
                      <th  style="text-align: center; border:none">সিঃ </th>
                      <th  style="text-align: center; border:none">কোর্স  <span class="text-danger">*</span></th>
                      <th  style="text-align: center; border:none">ইনস্টিটিউট <span class="text-danger">*</span></th>
                      <th  style="text-align: center; border:none">হতে  <span class="text-danger">*</span></th>
                      <th  style="text-align: center; border:none">পর্যন্ত <span class="text-danger">*</span></th>
                      <th  style="text-align: center; border:none">মন্তব্য</th>
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
                            <select  name="addmore[0][course_id]" id="course_id_0"  class="form-control course_id" required="">
                              <option value="">Select</option>
                              @foreach ($courses as $course)
                                  <option value="{{$course->id}}">{{$course->name}}</option>
                              @endforeach
                           </select>
                        </td>
                        <td style="border: 1px solid #fff; width:15%">
                            <select  name="addmore[0][institute_id]" id="institute_id_0"  class="form-control institute_id" required="">
                              <option value="">Select</option>
                              @foreach ($institutes as $institute)
                                  <option value="{{$institute->id}}">{{$institute->name}}</option>
                              @endforeach
                           </select>
                        </td>
                        <td style="border: 1px solid #fff; width:15%">
                          <input type="date" class="form-control" name="addmore[0][date_from]" value="{{date("Y-m-d")}}" autocomplete="off" required>
                        </td>
                        <td style="border: 1px solid #fff; width:15%">
                          <input type="date" class="form-control" name="addmore[0][date_to]" value="{{date("Y-m-d")}}" autocomplete="off" required>
                        </td>
                        <td style="border: 1px solid #fff; width:15%">
                          <input type="text" class="form-control" name="addmore[0][comment]" autocomplete="off">
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
$availableCoures = "";
$availableInstitutes = "";
  foreach ($courses as $key => $course) {
    $availableCoures .= '<option value="'.$course->id.'">'.$course->name.'</option>';
  }
  foreach ($institutes as $key => $institute) {
    $availableInstitutes .= '<option value="'.$institute->id.'">'.$institute->name.'</option>';
  }
@endphp
{!!Html::script('custom/js/jquery.min.js')!!}
<script type="text/javascript"> 
var AvailableCourses = '<?php echo $availableCoures;?>';
var AvailableInstitutes = '<?php echo $availableInstitutes;?>';
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
      row += '<select  name="addmore['+i+'][course_id]" id="course_id_'+i+'"  class="form-control course_id" required="">';
      row += '<option value="">Select</option>'+AvailableCourses;
      row += '</select>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:15%">';
      row += '<select  name="addmore['+i+'][institute_id]" id="institute_id_'+i+'"  class="form-control institute_id" required="">';
      row += '<option value="">Select</option>'+AvailableInstitutes;
      row += '</select>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:15%">';
      row += ' <input type="date" class="form-control" name="addmore['+i+'][date_from]" value="{{date("Y-m-d")}}" autocomplete="off" required>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:15%">';
      row += ' <input type="date" class="form-control" name="addmore['+i+'][date_to]" value="{{date("Y-m-d")}}" autocomplete="off" required>';
      row += '</td>';
      row += '<td style="border: 1px solid #fff; width:15%">';
      row += ' <input type="text" class="form-control" name="addmore['+i+'][comment]" autocomplete="off">';
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