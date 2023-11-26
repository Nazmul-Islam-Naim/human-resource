@extends('layouts.layout')
@section('title', 'কর্মকর্তা/কর্মচারীর ডকুমেন্ট')
@section('content')
<!-- Content Header (Page header) -->
@php
    use App\Enum\SexEnum;
    use App\Enum\MaritialStatusEnum;
    use Rakibhstu\Banglanumber\NumberToBangla;
    $numTo = new NumberToBangla();
@endphp
<style>
  .table th, .table td {
    white-space: inherit;
}
</style>
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

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">কর্মকর্তা/কর্মচারীর ডকুমেন্টের রেকর্ড</div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12" id="printReport">
                        <p>
                            নামঃ {{$generalInformation->name_in_bangla}} ||
                            মূল পদঃ {{$generalInformation->mainDesignation->title ?? ''}} ||
                            বর্তমান কর্মস্থলঃ {{$generalInformation->presentWorkStation->name ?? ''}} ||
                            বর্তমান পদবীঃ {{$generalInformation->presentDesignation->title ?? ''}} ||
                            পি আর এলঃ {{Carbon\Carbon::parse($generalInformation->prl_date)->format('d-m-Y')}}
                         </p>
                        <div class="table-responsive">
                          <table class="table table-bordered table-striped table-sm " style="width: 100%; font-size: 14px;" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr style="background: #eee">
                                    <th style="border: 1px solid #eee">Sl</th>
                                    <th style="border: 1px solid #eee">Added Date</th>
                                    <th style="border: 1px solid #eee">Title</th>
                                    <th style="border: 1px solid #eee">Document</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($documents as $key => $document)
                                    <tr>
                                        @if ($document->document_title == App\Enum\DocumentTitleEnum::Offer_Letter->toString())
                                            @if ($document->document == $document->documentable->document)
                                            <td style="border: 1px solid #ddd; color:green">{{$key+1}}</td>
                                            <td style="border: 1px solid #ddd; color:green" >{{Carbon\Carbon::parse($document->created_at)->format('d-m-Y')}}</td>
                                            <td style="border: 1px solid #ddd; color:green">{{$document->document_title}}</td>
                                            <td style="border: 1px solid #ddd"><a href="{{asset('storage/'.$document->document)}}" target="_blank"><i class="icon-file" style=" color:green"></i></a></td>
                                            @else
                                            <td style="border: 1px solid #ddd; color:red">{{$key+1}}</td>
                                            <td style="border: 1px solid #ddd; color:red" >{{Carbon\Carbon::parse($document->created_at)->format('d-m-Y')}}</td>
                                            <td style="border: 1px solid #ddd; color:red">{{$document->document_title}}</td>
                                            <td style="border: 1px solid #ddd"><a href="{{asset('storage/'.$document->document)}}" target="_blank"><i class="icon-file" style=" color:red"></i></a></td>
                                            @endif
                                        @elseif ($document->document_title == App\Enum\DocumentTitleEnum::Transfer_Letter->toString())
                                            @if ($document->document == $document->documentable->transfer_document)
                                            <td style="border: 1px solid #ddd; color:green">{{$key+1}}</td>
                                            <td style="border: 1px solid #ddd; color:green" >{{Carbon\Carbon::parse($document->created_at)->format('d-m-Y')}}</td>
                                            <td style="border: 1px solid #ddd; color:green">{{$document->document_title}}</td>
                                            <td style="border: 1px solid #ddd"><a href="{{asset('storage/'.$document->document)}}" target="_blank"><i class="icon-file" style=" color:green"></i></a></td>
                                            @else
                                            <td style="border: 1px solid #ddd; color:red">{{$key+1}}</td>
                                            <td style="border: 1px solid #ddd; color:red" >{{Carbon\Carbon::parse($document->created_at)->format('d-m-Y')}}</td>
                                            <td style="border: 1px solid #ddd; color:red">{{$document->document_title}}</td>
                                            <td style="border: 1px solid #ddd"><a href="{{asset('storage/'.$document->document)}}" target="_blank"><i class="icon-file" style=" color:red"></i></a></td>
                                            @endif
                                        @elseif($document->document_title == App\Enum\DocumentTitleEnum::Release_Letter->toString())
                                            @if ($document->document == $document->documentable->release_document)
                                            <td style="border: 1px solid #ddd; color:green">{{$key+1}}</td>
                                            <td style="border: 1px solid #ddd; color:green" >{{Carbon\Carbon::parse($document->created_at)->format('d-m-Y')}}</td>
                                            <td style="border: 1px solid #ddd; color:green">{{$document->document_title}}</td>
                                            <td style="border: 1px solid #ddd"><a href="{{asset('storage/'.$document->document)}}" target="_blank"><i class="icon-file" style=" color:green"></i></a></td>
                                            @else
                                            <td style="border: 1px solid #ddd; color:red">{{$key+1}}</td>
                                            <td style="border: 1px solid #ddd; color:red" >{{Carbon\Carbon::parse($document->created_at)->format('d-m-Y')}}</td>
                                            <td style="border: 1px solid #ddd; color:red">{{$document->document_title}}</td>
                                            <td style="border: 1px solid #ddd"><a href="{{asset('storage/'.$document->document)}}" target="_blank"><i class="icon-file" style=" color:red"></i></a></td>
                                            @endif
                                        @elseif($document->document_title == App\Enum\DocumentTitleEnum::Joining_Letter->toString())
                                            @if ($document->document == $document->documentable->join_document)
                                            <td style="border: 1px solid #ddd; color:green">{{$key+1}}</td>
                                            <td style="border: 1px solid #ddd; color:green" >{{Carbon\Carbon::parse($document->created_at)->format('d-m-Y')}}</td>
                                            <td style="border: 1px solid #ddd; color:green">{{$document->document_title}}</td>
                                            <td style="border: 1px solid #ddd"><a href="{{asset('storage/'.$document->document)}}" target="_blank"><i class="icon-file" style=" color:green"></i></a></td>
                                            @else
                                            <td style="border: 1px solid #ddd; color:red">{{$key+1}}</td>
                                            <td style="border: 1px solid #ddd; color:red" >{{Carbon\Carbon::parse($document->created_at)->format('d-m-Y')}}</td>
                                            <td style="border: 1px solid #ddd; color:red">{{$document->document_title}}</td>
                                            <td style="border: 1px solid #ddd"><a href="{{asset('storage/'.$document->document)}}" target="_blank"><i class="icon-file" style=" color:red"></i></a></td>
                                            @endif
                                        @else
                                            @if ($document->document == $document->documentable->pension_document)
                                            <td style="border: 1px solid #ddd; color:green">{{$key+1}}</td>
                                            <td style="border: 1px solid #ddd; color:green" >{{Carbon\Carbon::parse($document->created_at)->format('d-m-Y')}}</td>
                                            <td style="border: 1px solid #ddd; color:green">{{$document->document_title}}</td>
                                            <td style="border: 1px solid #ddd"><a href="{{asset('storage/'.$document->document)}}" target="_blank"><i class="icon-file" style=" color:green"></i></a></td>
                                            @else
                                            <td style="border: 1px solid #ddd; color:red">{{$key+1}}</td>
                                            <td style="border: 1px solid #ddd; color:red" >{{Carbon\Carbon::parse($document->created_at)->format('d-m-Y')}}</td>
                                            <td style="border: 1px solid #ddd; color:red">{{$document->document_title}}</td>
                                            <td style="border: 1px solid #ddd"><a href="{{asset('storage/'.$document->document)}}" target="_blank"><i class="icon-file" style=" color:red"></i></a></td>
                                            @endif
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center">No documents...!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection
