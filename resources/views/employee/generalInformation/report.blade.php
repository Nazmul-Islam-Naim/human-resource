@extends('layouts.layout')
@section('title', 'কর্মকর্তা / কর্মচারীর চাকুরী সংক্রান্ত তথ্য')
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
                            <h3 class="card-title">কর্মকর্তা / কর্মচারীর চাকুরী সংক্রান্ত তথ্যঃ</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-bordered cell-border compact nowrap hover order-column row-border stripe"
                                            id="example">
                                            <thead>
                                                <tr>
                                                    <th>ক্রমিক নং</th>
                                                    <th>কর্মকর্তা / কর্মচারীর <br> নাম</th>
                                                    <th>১ম যোগদানের <br> তারিখ</th>
                                                    <th>১ম যোগদাকৃত <br> পদবী</th>
                                                    <th>সর্বশেষ <br> পদবী</th>
                                                    <th>সর্বশেষ <br> মূলপদ</th>
                                                    <th>কর্মস্থলসমূহের <br> নাম</th>
                                                    <th>কর্মস্থলসমূহের কর্মকাল <br> (... থেকে ...)</th>
                                                    <th>পিআরএল-এ <br> গমনের তারিখ</th>
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
    {!! Html::script('custom/yajraTableJs/jquery.js') !!}
    {!! Html::script('custom/yajraTableJs/yajraDateTime.js') !!}
    {!! Html::script('custom/yajraTableJs/newAjax.moment.js') !!}
    {!! Html::script('custom/yajraTableJs/dataTable.js') !!}
    {!! Html::script('custom/yajraTableJs/query.dataTables1.12.1.js') !!}
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

            var table = $('#example').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ route('job-report') }}',
                },
                "lengthMenu": [
                    [100, 150, 250, -1],
                    ['100', '150', '250', 'All']
                ],
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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            format: {
                                body: function(data, row, column, node) {
                                    if (column) {
                                        return data.replace(/\n/ig, "<br/>");
                                    }
                                    // return column === 7 ? data.replace(/\n/ig, "<br/>") : data;
                                }
                            }
                        },
                        messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
                    },
                    {
                        extend: 'print',
                        title: "",
                        messageTop: function() {
                            var top =
                                '<center><p class ="text-center"><img src="{{ asset('backend/custom/images') }}/header.png" height="100"/></p></center>';
                            top += '<h5>কর্মকর্তা / কর্মচারীর চাকুরী সংক্রান্ত তথ্যঃ</h5>';

                            return top;
                        },
                        customize: function(win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table').css('font-size', 'inherit');

                            $(win.document.body).find('table thead th').css('border',
                                '1px solid #ddd');
                            $(win.document.body).find('table tbody td').css('border',
                                '1px solid #ddd');
                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            format: {
                                body: function(data, row, column, node) {
                                    if (column) {
                                        return data.replace(/\n/ig, "<br/>");
                                    }
                                    // return column === 7 ? data.replace(/\n/ig, "<br/>") : data;
                                }
                            }
                        },
                        messageBottom: null
                    }
                ],
                aaSorting: [
                    [0, "asc"]
                ],

                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'name_in_bangla',
                        render: function(data, type, row) {
                            if (data != null) {
                                return data;
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'joining_date',
                        render: function(data, type, row) {
                            if (data != null) {
                                const toBn = n => n.replace(/\d/g, d => "০১২৩৪৫৬৭৮৯" [d]);
                                return toBn(dateFormat(new Date(data)).toString());
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'joining_designation.title',
                        render: function(data, type, row) {
                            if (data != null) {
                                return data;
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'present_designation.title',
                        render: function(data, type, row) {
                            if (data != null) {
                                return data;
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'main_designation.title',
                        render: function(data, type, row) {
                            if (data != null) {
                                return data;
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'workstations'
                    },
                    {
                        data: 'timePeriods'
                    },
                    {
                        data: 'prl_date',
                        render: function(data, type, full, meta) {
                            if (data != null) {
                                const toBn = n => n.replace(/\d/g, d => "০১২৩৪৫৬৭৮৯" [d]);
                                return toBn(dateFormat(new Date(data)).toString());
                            } else {
                                return '';
                            }
                        }
                    },
                ]
            });
        });
    </script>
@endsection
