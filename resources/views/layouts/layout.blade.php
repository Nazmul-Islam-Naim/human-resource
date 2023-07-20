<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Meta -->
        <meta name="description" content="Islamic Foundation">
        <meta name="author" content="ParkerThemes">
        <link rel="shortcut icon" href="{{asset('backend/custom/img/fav.png')}}">

        <!-- Title -->
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Google Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;500&display=swap" rel="stylesheet">


        <!-- *************
            ************ Common Css Files *************
        ************ -->
        <!-- Bootstrap css -->
        {!!Html::style('backend/custom/css/bootstrap.min.css')!!}
        
        <!-- Icomoon Font Icons css -->
        {!!Html::style('backend/custom/fonts/style.css')!!}
        <!-- Main css for green -->
        {!!Html::style('backend/custom/css/green-main.css')!!}


        <!-- *************
            ************ Vendor Css Files *************
        ************ -->

        <!-- Mega Menu -->
        {!!Html::style('backend/custom/vendor/megamenu/css/megamenu.css')!!}

        <!-- Search Filter JS -->
        {!!Html::style('backend/custom/vendor/search-filter/search-filter.css')!!}
        {!!Html::style('backend/custom/vendor/search-filter/custom-search-filter.css')!!}

        <!-- Data Tables -->
        {!!Html::style('backend/custom/vendor/datatables/dataTables.bs4.css')!!}
        {!!Html::style('backend/custom/vendor/datatables/dataTables.bs4-custom.css')!!}
        {!!Html::style('backend/custom/vendor/datatables/buttons.bs.css')!!}
        <!-- Date Range CSS -->
        {!!Html::style('backend/custom/vendor/daterange/daterange.css')!!}

        <!-- Bootstrap Select CSS -->
        {!!Html::style('backend/custom/vendor/bs-select/bs-select.css')!!}

        <!-- leaflet Select css -->
        {!!Html::style('backend/custom/leaflet/1.7.1/css/leaflet.min.css')!!}
        <!-- leaflet Select js -->
        {!!Html::script('backend/custom/leaflet/1.7.1/js/leaflet.min.js')!!}
        
		<!-- Summernote CSS -->
        {!!Html::style('backend/custom/vendor/summernote/summernote-bs4.css')!!}
        
		<!-- yajra custom CSS -->
        {!!Html::style('backend/custom/yajraTableJs/custom.css')!!}

        <!----------- print css ------------->
        <link rel="stylesheet" type="text/css" href="{{asset('backend/custom/print/print.css')}}" media="print">

        <style>
            .default-sidebar-wrapper .default-sidebar-menu ul li.active a span {
               font-weight: bold;
           }

           .default-sidebar-wrapper .default-sidebar-menu ul li.active a.current-page {
               background: #17995e;
               pointer-events: auto;
               position: relative;
               color: #ffffff;
           }

           .default-sidebar-wrapper .default-sidebar-menu ul li.active a.current-page:hover {
               background: #17995e;
               position: relative;
               color: #ffffff;
           }

           
           .default-sidebar-wrapper .default-sidebar-menu ul li a.selectedMenue {
               background: #17995e;
               pointer-events: auto;
               position: relative;
               color: #ffffff;
           }

           
           .default-sidebar-wrapper .default-sidebar-menu ul li a.selectedMenue:hover {
               background: #17995e;
               position: relative;
               color: #ffffff;
           }
       </style>
        
    </head>
    <?php
        $baseUrl = URL::to('/');
        $url = Request::path();
    ?>
    <body class="default-sidebar">
        <!-- Loading wrapper start -->
        <div id="loading-wrapper">
            <div class="spinner-border"></div>
        </div>
        <!-- Loading wrapper end -->

        <!-- Page wrapper start -->
        <div class="page-wrapper">
            
            <!-- Sidebar wrapper start -->
            <nav class="sidebar-wrapper">
                
                <!-- Default sidebar wrapper start -->
                <div class="default-sidebar-wrapper">

                    <!-- Sidebar brand starts -->
                    <div class="default-sidebar-brand">
                        <a href="{{URL::to('/dashboard')}}" class="logo">
                            <!-- <img src="{{asset('backend/custom/img/logo.svg')}}" alt="Admin" /> -->
                            <!-- <h5>E-Store</h5><br> -->
                            <h6>{{Auth::user()->name}}</h6>
                        </a>
                    </div>
                    <!-- Sidebar brand starts -->

                    <!-- Sidebar menu starts -->
                    <div class="defaultSidebarMenuScroll">
                        <div class="default-sidebar-menu">
                            <ul>
                                <!-------------- dashboard part ------------>
                                <li>
                                    <a href="{{$baseUrl.'/dashboard'}}"  class="{{($url=='dashboard') ? 'selectedMenue':''}}">
                                        <i class="icon-home2"></i>
                                        <span class="menu-text">ড্যাশবোর্ড</span>
                                    </a>
                                </li>
                                <!-------------- catlog part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.cat').'/department' || $url==config('app.cat').'/department/create' || $url==(request()->is(config('app.cat').'/department/*/edit')) ||
                                    $url==config('app.cat').'/designation' || $url==config('app.cat').'/designation/create' || $url==(request()->is(config('app.cat').'/designation/*/edit')) ||
                                    $url==config('app.cat').'/salary-scale' || $url==config('app.cat').'/salary-scale/create' || $url==(request()->is(config('app.cat').'/salary-scale/*/edit')) ||
                                    $url==config('app.cat').'/district' || $url==config('app.cat').'/district/create' || $url==(request()->is(config('app.cat').'/district/*/edit')) ||
                                    $url==config('app.cat').'/workstation' || $url==config('app.cat').'/workstation/create' || $url==(request()->is(config('app.cat').'/workstation/*/edit')) ||
                                    $url==config('app.cat').'/workstation-designations' || $url==config('app.cat').'/workstation-designations/create' || $url==(request()->is(config('app.cat').'/workstation-designations/*/edit')) ||
                                    $url==config('app.cat').'/occupation' || $url==config('app.cat').'/occupation/create' || $url==(request()->is(config('app.cat').'/occupation/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-menu"></i>
                                        <span class="menu-text">ক্যাটালগ</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            {{-- <li>
                                                <a href="{{$baseUrl.'/'.config('app.cat').'/department'}}" class="{{($url==config('app.cat').'/department' || $url==config('app.cat').'/department/create' || $url==(request()->is(config('app.cat').'/department/*/edit'))) ? 'current-page':''}}"> ডিপার্টমেন্ট</a>
                                            </li> --}}
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.cat').'/designation'}}" class="{{($url==config('app.cat').'/designation' || $url==config('app.cat').'/designation/create' || $url==(request()->is(config('app.cat').'/designation/*/edit'))) ? 'current-page':''}}"> পদবী</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.cat').'/salary-scale'}}" class="{{($url==config('app.cat').'/salary-scale' || $url==config('app.cat').'/salary-scale/create' || $url==(request()->is(config('app.cat').'/salary-scale/*/edit'))) ? 'current-page':''}}"> বেতন স্কেল </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.cat').'/district'}}" class="{{($url==config('app.cat').'/district' || $url==config('app.cat').'/district/create' || $url==(request()->is(config('app.cat').'/district/*/edit'))) ? 'current-page':''}}">জেলা </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.cat').'/workstation'}}" class="{{($url==config('app.cat').'/workstation' || $url==config('app.cat').'/workstation/create' || $url==(request()->is(config('app.cat').'/workstation/*/edit'))) ? 'current-page':''}}">কর্মস্থল</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.cat').'/workstation-designations'}}" class="{{($url==config('app.cat').'/workstation-designations' || $url==config('app.cat').'/workstation-designations/create' || $url==(request()->is(config('app.cat').'/workstation-designations/*/edit'))) ? 'current-page':''}}">কর্মস্থলের পদবী</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.cat').'/occupation'}}" class="{{($url==config('app.cat').'/occupation' || $url==config('app.cat').'/occupation/create' || $url==(request()->is(config('app.cat').'/occupation/*/edit'))) ? 'current-page':''}}">পেশা</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- educational information part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.education').'/degrees' || $url==config('app.education').'/degrees/create' || $url==(request()->is(config('app.education').'/degrees/*/edit')) ||
                                    $url==config('app.education').'/passingYears' || $url==config('app.education').'/passingYears/create' || $url==(request()->is(config('app.education').'/passingYears/*/edit')) ||
                                    $url==config('app.education').'/readingSubjects' || $url==config('app.education').'/readingSubjects/create' || $url==(request()->is(config('app.education').'/readingSubjects/*/edit')) ||
                                    $url==config('app.education').'/boards' || $url==config('app.education').'/boards/create' || $url==(request()->is(config('app.education').'/boards/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-book-open"></i>
                                        <span class="menu-text">শিক্ষাসংক্রান্ত তথ্যাদি</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.education').'/degrees'}}" class="{{($url==config('app.education').'/degrees' || $url==config('app.education').'/degrees/create' || $url==(request()->is(config('app.education').'/degrees/*/edit'))) ? 'current-page':''}}"> ডিগ্রী</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.education').'/passingYears'}}" class="{{($url==config('app.education').'/passingYears' || $url==config('app.education').'/passingYears/create' || $url==(request()->is(config('app.education').'/passingYears/*/edit'))) ? 'current-page':''}}"> পাসের সন</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.education').'/readingSubjects'}}" class="{{($url==config('app.education').'/readingSubjects' || $url==config('app.education').'/readingSubjects/create' || $url==(request()->is(config('app.education').'/readingSubjects/*/edit'))) ? 'current-page':''}}"> পাঠিত বিষয় </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.education').'/boards'}}" class="{{($url==config('app.education').'/boards' || $url==config('app.education').'/boards/create' || $url==(request()->is(config('app.education').'/boards/*/edit'))) ? 'current-page':''}}"> বোর্ড/বিশ্ববিদ্যালয় </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- training information part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.education').'/courses' || $url==config('app.education').'/courses/create' || $url==(request()->is(config('app.education').'/courses/*/edit')) ||
                                    $url==config('app.education').'/institutes' || $url==config('app.education').'/institutes/create' || $url==(request()->is(config('app.education').'/institutes/*/edit')) ||
                                    $url==config('app.education').'/publications' || $url==config('app.education').'/publications/create' || $url==(request()->is(config('app.education').'/publications/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-book"></i>
                                        <span class="menu-text">প্রশিক্ষন তথ্যাদি</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.education').'/courses'}}" class="{{($url==config('app.education').'/courses' || $url==config('app.education').'/courses/create' || $url==(request()->is(config('app.education').'/courses/*/edit'))) ? 'current-page':''}}"> কোর্সেস </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.education').'/institutes'}}" class="{{($url==config('app.education').'/institutes' || $url==config('app.education').'/institutes/create' || $url==(request()->is(config('app.education').'/institutes/*/edit'))) ? 'current-page':''}}"> ইনিস্টিটিউটস </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.education').'/publications'}}" class="{{($url==config('app.education').'/publications' || $url==config('app.education').'/publications/create' || $url==(request()->is(config('app.education').'/publications/*/edit'))) ? 'current-page':''}}"> প্রকাশনা </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- employee inforamation part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.hr').'/generalInformations' || $url==config('app.hr').'/generalInformations/create' || $url==(request()->is(config('app.hr').'/generalInformations/*/edit')) ||
                                    $url==config('app.hr').'/educationalInformations-report' || $url==config('app.hr').'/educationalInformations/create' ||
                                    $url==config('app.hr').'/trainingInformations-report' || $url==config('app.hr').'/trainingInformations/create' ||
                                    $url==config('app.hr').'/publicationInformations-report' || $url==config('app.hr').'/publicationInformations/create' ||
                                    $url==config('app.hr').'/promotionInformations-report' || $url==config('app.hr').'/promotionInformations/create' ||
                                    $url==config('app.hr').'/caseInformations-report' || $url==config('app.hr').'/caseInformations/create') ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-people_outline"></i>
                                        <span class="menu-text">কর্মকর্তা/কর্মচারীর তথ্য</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/generalInformations'}}" class="{{($url==config('app.hr').'/generalInformations' || $url==config('app.hr').'/generalInformations/create' || $url==(request()->is(config('app.hr').'/generalInformations/*/edit'))) ? 'current-page':''}}"> সাধারন তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/educationalInformations-report'}}" class="{{($url==config('app.hr').'/educationalInformations-report' || $url==config('app.hr').'/educationalInformations/create') ? 'current-page':''}}"> শিক্ষাসংক্রান্ত তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/trainingInformations-report'}}" class="{{($url==config('app.hr').'/trainingInformations-report' || $url==config('app.hr').'/trainingInformations/create') ? 'current-page':''}}"> প্রশিক্ষন সম্পর্কিত তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/publicationInformations-report'}}" class="{{($url==config('app.hr').'/publicationInformations-report' || $url==config('app.hr').'/publicationInformations/create') ? 'current-page':''}}"> প্রকাশনা সম্পর্কিত তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/promotionInformations-report'}}" class="{{($url==config('app.hr').'/promotionInformations-report' || $url==config('app.hr').'/promotionInformations/create') ? 'current-page':''}}"> পদোন্নতি সম্পর্কিত তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/caseInformations-report'}}" class="{{($url==config('app.hr').'/caseInformations-report' || $url==config('app.hr').'/caseInformations/create') ? 'current-page':''}}"> মামলা সম্পর্কিত তথ্য </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- transfer or prl/pension ------------>
                                <li >
                                    <a  href="{{$baseUrl.'/'.config('app.hr').'/employee-transfer'}}" class="{{($url==config('app.hr').'/employee-transfer' || $url==config('app.hr').'/employee-transfer/create' || $url==(request()->is(config('app.hr').'/employee-transfer/*/edit')) || $url==(request()->is(config('app.hr').'/employee-transfer/*'))  || $url==(request()->is(config('app.hr').'/transfer-form/*')) || $url==(request()->is(config('app.hr').'/employee-pension-prl/*'))) ? 'selectedMenue':''}}">
                                        <i class="icon-users"></i>
                                        <span class="menu-text">কর্মচারী স্থানান্তর/পেনশন</span>
                                    </a>
                                </li>
                                <!-------------- transfer list ------------>
                                <li >
                                    <a href="{{$baseUrl.'/'.config('app.hr').'/employee-transferred-list'}}" class="{{($url==config('app.hr').'/employee-transferred-list' || $url==config('app.hr').'/employee-transferred-list/create' || $url==(request()->is(config('app.hr').'/employee-transferred-list/*/edit')) || $url==(request()->is(config('app.hr').'/employee-transferred-list/*')) || $url==(request()->is(config('app.hr').'/employee-release/*'))) ? 'selectedMenue':''}}">
                                        <i class="icon-list"></i>
                                        <span class="menu-text">কর্মচারী স্থানান্তর তালিকা</span>
                                    </a>
                                </li>
                                <!-------------- pension prl list ------------>
                                <li >
                                    <a href="{{$baseUrl.'/'.config('app.hr').'/employee-pension-prl-list'}}" class="{{($url==config('app.hr').'/employee-pension-prl-list' || $url==config('app.hr').'/employee-pension-prl-list/create' || $url==(request()->is(config('app.hr').'/employee-pension-prl-list/*/edit')) || $url==(request()->is(config('app.hr').'/employee-pension-prl-list/*'))) ? 'selectedMenue':''}}">
                                        <i class="icon-list"></i>
                                        <span class="menu-text">পেনশন/পি আর এল তালিকা</span>
                                    </a>
                                <!-------------- transfer application ------------>
                                {{-- <li >
                                    <a href="{{$baseUrl.'/'.config('app.hr').'/employee-transfer-application-list'}}" class="{{($url==config('app.hr').'/employee-transfer-application-list' || $url==config('app.hr').'/employee-transfer-application-list/create' || $url==(request()->is(config('app.hr').'/employee-transfer-application-list/*/edit')) || $url==(request()->is(config('app.hr').'/employee-transfer-application-list/*'))) ? 'selectedMenue':''}}">
                                        <i class="icon-message"></i>
                                        <span class="menu-text">স্থানান্তর আবেদন পত্র</span>
                                    </a>
                                </li> --}}
                                 <!-------------- workstation designation information part ------------>
                                 <li class="default-sidebar-dropdown {{(
                                    $url==config('app.hr').'/transfer-status-report' ||
                                    $url==config('app.hr').'/workstations' || $url==(request()->is(config('app.hr').'/workstations-report/*')) ||
                                    $url==config('app.hr').'/job-report' ||
                                    $url==config('app.hr').'/up-coming-prls' ||
                                    $url==config('app.hr').'/transfer-status-time' ||
                                    $url==config('app.hr').'/empty-designations-report' ||
                                    $url==config('app.hr').'/up-coming-pensions') ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-book"></i>
                                        <span class="menu-text">পদভিত্তিক কর্মস্থল</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/transfer-status-report'}}" class="{{($url==config('app.hr').'/transfer-status-report') ? 'current-page':''}}"> পদওয়ারী বর্তমান কর্মস্থল </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/workstations'}}" class="{{($url==config('app.hr').'/workstations' || $url==(request()->is(config('app.hr').'/workstations-report/*'))) ? 'current-page':''}}"> কার্যালয়ভিত্তিক জনবলের তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/job-report'}}" class="{{($url==config('app.hr').'/job-report') ? 'current-page':''}}"> চাকুরী সংক্রান্ত তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/up-coming-prls'}}" class="{{($url==config('app.hr').'/up-coming-prls') ? 'current-page':''}}"> পদভিত্তিক পিআরএল-এর তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/up-coming-pensions'}}" class="{{($url==config('app.hr').'/up-coming-pensions') ? 'current-page':''}}">১৫ দিন পরে পিআরএল-এ গমন</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/transfer-status-time'}}" class="{{($url==config('app.hr').'/transfer-status-time') ? 'current-page':''}}"> পদভিত্তিক কর্মস্থলে কার্যকাল </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/empty-designations-report'}}" class="{{($url==config('app.hr').'/empty-designations-report') ? 'current-page':''}}">শূন্য পদসমূহ</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                 <!-------------- amendment information part ------------>
                                 <li class="default-sidebar-dropdown {{(
                                    $url==config('app.hr').'/educationalInformations' || $url==(request()->is(config('app.hr').'/educationalInformations/*/edit')) ||
                                    $url==config('app.hr').'/trainingInformations' || $url==(request()->is(config('app.hr').'/trainingInformations/*/edit')) ||
                                    $url==config('app.hr').'/publicationInformations' || $url==(request()->is(config('app.hr').'/publicationInformations/*/edit')) ||
                                    $url==config('app.hr').'/promotionInformations' || $url==(request()->is(config('app.hr').'/promotionInformations/*/edit'))||
                                    $url==config('app.hr').'/caseInformations' || $url==(request()->is(config('app.hr').'/caseInformations/*/edit')) ||
                                    $url==config('app.hr').'/transfer-status-index' ||
                                    $url==config('app.hr').'/empty-designations' || $url==(request()->is(config('app.hr').'/empty-designations/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-book"></i>
                                        <span class="menu-text">সংশোধন</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/educationalInformations'}}" class="{{($url==config('app.hr').'/educationalInformations' || $url==(request()->is(config('app.hr').'/educationalInformations/*/edit'))) ? 'current-page':''}}"> শিক্ষাসংক্রান্ত তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/trainingInformations'}}" class="{{($url==config('app.hr').'/trainingInformations' || $url==(request()->is(config('app.hr').'/trainingInformations/*/edit'))) ? 'current-page':''}}"> প্রশিক্ষন সম্পর্কিত তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/publicationInformations'}}" class="{{($url==config('app.hr').'/publicationInformations' || $url==(request()->is(config('app.hr').'/publicationInformations/*/edit'))) ? 'current-page':''}}"> প্রকাশনা সম্পর্কিত তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/promotionInformations'}}" class="{{($url==config('app.hr').'/promotionInformations' || $url==(request()->is(config('app.hr').'/promotionInformations/*/edit'))) ? 'current-page':''}}"> পদোন্নতি সম্পর্কিত তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/caseInformations'}}" class="{{($url==config('app.hr').'/caseInformations' || $url==(request()->is(config('app.hr').'/caseInformations/*/edit'))) ? 'current-page':''}}"> মামলা সম্পর্কিত তথ্য </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/transfer-status-index'}}" class="{{($url==config('app.hr').'/transfer-status-index') ? 'current-page':''}}"> পদওয়ারী বর্তমান কর্মস্থল </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.hr').'/empty-designations'}}" class="{{($url==config('app.hr').'/empty-designations' || $url==(request()->is(config('app.hr').'/empty-designations/*/edit'))) ? 'current-page':''}}">শূন্য পদসমূহ</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- user part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.user').'/designation' || $url==config('app.user').'/designation/create' || $url==(request()->is(config('app.user').'/designation/*/edit')) ||
                                    $url==config('app.user').'/user-list' || $url==config('app.user').'/user-list/create' || $url==(request()->is(config('app.user').'/user-list/*/edit')) ||
                                    $url==config('app.user').'/user-role' || $url==config('app.user').'/user-role/create' || $url==(request()->is(config('app.user').'/user-role/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-user"></i>
                                        <span class="menu-text">ইউজার ব্যাবস্থাপনা</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.user').'/designation'}}" class="{{($url==config('app.user').'/designation' || $url==config('app.user').'/designation/create' || $url==(request()->is(config('app.user').'/designation/*/edit'))) ? 'current-page':''}}">পদবী</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.user').'/user-list'}}" class="{{($url==config('app.user').'/user-list' || $url==config('app.user').'/user-list/create' || $url==(request()->is(config('app.user').'/user-list/*/edit'))) ? 'current-page':''}}">ব্যাবহারকারী</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.user').'/user-role'}}" class="{{($url==config('app.user').'/user-role' || $url==config('app.user').'/user-role/create' || $url==(request()->is(config('app.user').'/user-role/*/edit'))) ? 'current-page':''}}">ইউজার রোল</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar menu ends -->

                </div>
                <!-- Default sidebar wrapper end -->
                
            </nav>
            <!-- Sidebar wrapper end -->

            <!-- *************
                ************ Main container start *************
            ************* -->
            <div class="main-container">

                <!-- Page header starts -->
                <div class="page-header">
                    
                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-9">

                            <!-- Search container start -->
                            <div class="search-container">

                                <!-- Toggle sidebar start -->
                                <div class="toggle-sidebar" id="toggle-sidebar">
                                    <i class="icon-menu"></i>
                                </div>
                                <!-- Toggle sidebar end -->
                            </div>
                            <!-- Search container end -->

                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-3">

                            <!-- Header actions start -->
                            <ul class="header-actions">
                                <li class="dropdown">
                                    <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                                        <span class="avatar">
                                            @if (!empty(auth()->user()->avatar))
                                            <img class="profile-user-img img-responsive img-fluid" src="{{asset('storage/'.auth()->user()->avatar)}}" alt="User profile picture">
                                            @else
                                            <img class="profile-user-img img-responsive img-fluid" src="{{asset('backend/custom/images/noImage.png')}}" alt="User profile picture">
                                            @endif
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end sm" aria-labelledby="userSettings" style="width: 21rem">
                                        <div class="header-profile-actions">
                                            <a href="{{URL::to('settings')}}"><i class="icon-lock"></i>Change Password</a> 
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-log-out1"></i>Logout</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <!-- Header actions end -->

                        </div>
                    </div>
                    <!-- Row end -->                    

                </div>
                <!-- Page header ends -->
                @yield('content') 
                <!-- App footer start -->
                <div class="app-footer">© BinaryIT <?php echo date('Y')?></div>
                <!-- App footer end -->
            </div>
            <!-- ************************* Main container end ************************** -->

        </div>
        <!-- Page wrapper end -->

        <!-- *************
            ************ Required JavaScript Files *************
        ************* -->
        <!-- Required jQuery first, then Bootstrap Bundle JS -->
        {!!Html::script('backend/custom/js/jquery.min.js')!!}
        {!!Html::script('backend/custom/js/bootstrap.bundle.min.js')!!}
        {!!Html::script('backend/custom/js/modernizr.js')!!}
        {!!Html::script('backend/custom/js/moment.js')!!}
        
        {!!Html::script('backend/custom/js/webcam.min.js')!!}

        <!-- *************
            ************ Vendor Js Files *************
        ************* -->
        
        <!-- Megamenu JS -->
        {!!Html::script('backend/custom/vendor/megamenu/js/megamenu.js')!!}
        {!!Html::script('backend/custom/vendor/megamenu/js/custom.js')!!}

        <!-- Slimscroll JS -->
        {!!Html::script('backend/custom/vendor/slimscroll/slimscroll.min.js')!!}
        {!!Html::script('backend/custom/vendor/slimscroll/custom-scrollbar.js')!!}

        <!-- Search Filter JS -->
        {!!Html::script('backend/custom/vendor/search-filter/search-filter.js')!!}
        {!!Html::script('backend/custom/vendor/search-filter/custom-search-filter.js')!!}

        <!-- Data Tables -->
        {!!Html::script('backend/custom/vendor/datatables/dataTables.min.js')!!}
        {!!Html::script('backend/custom/vendor/datatables/dataTables.bootstrap.min.js')!!}
        
        <!-- Custom Data tables -->
        {!!Html::script('backend/custom/vendor/datatables/custom/custom-datatables.js')!!}

        <!-- Download / CSV / Copy / Print -->
        {!!Html::script('backend/custom/vendor/datatables/buttons.min.js')!!}
        {!!Html::script('backend/custom/vendor/datatables/jszip.min.js')!!}
        {!!Html::script('backend/custom/vendor/datatables/pdfmake.min.js')!!}
        {!!Html::script('backend/custom/vendor/datatables/vfs_fonts.js')!!}
        {!!Html::script('backend/custom/vendor/datatables/html5.min.js')!!}
        {!!Html::script('backend/custom/vendor/datatables/buttons.print.min.js')!!}

        <!-- Apex Charts -->
       <!--  {!!Html::script('backend/custom/vendor/apex/apexcharts.min.js')!!}
        {!!Html::script('backend/custom/vendor/apex/examples/pie/basic-pie-graph.js')!!} -->

        <!-- Circleful Charts -->
        <!-- {!!Html::script('backend/custom/vendor/circliful/circliful.min.js')!!}
        {!!Html::script('backend/custom/vendor/circliful/circliful.custom.js')!!} -->

        <!-- Main Js Required -->
        {!!Html::script('backend/custom/js/main.js')!!}

        <!-- Date Range JS -->
        {!!Html::script('backend/custom/vendor/daterange/daterange.js')!!}
        {!!Html::script('backend/custom/vendor/daterange/custom-daterange.js')!!}

        <!-- Bootstrap Select JS -->
        {!!Html::script('backend/custom/vendor/bs-select/bs-select.min.js')!!}
        {!!Html::script('backend/custom/vendor/bs-select/bs-select-custom.js')!!}

        
        <!-- select2 -->
        {!!Html::script('backend/custom/select2/js/select2.min.js')!!}
        
		<!-- Summernote JS -->
        {!!Html::script('backend/custom/vendor/summernote/summernote-bs4.js')!!}
            
        <script type="text/javascript">
            $(document).ready(function(){
              $('.select2').select2({ width: '100%', height: '100%', placeholder: "Select", allowClear: true });
            });
        </script>

        <!-- Sweet alert -->
        {!!Html::script('backend/custom/sweetalert/sweetalert.min.js')!!}
        <script type="text/javascript">
            $('.confirmdelete').on('click', function (event) {
              event.preventDefault();
                  var $form = $(this).closest('form');
                  swal({
                      title: "Are you sure?",
                      text: $(this).attr('confirm'),
                      type: "warning",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      $form.submit();
                    }
                  });
            });

            $(document).ready( function () {
              $('#dataTable').DataTable({
                "paging":   true,
                "ordering": true,
                "info":     true,
              });
            });

            function printReport() {
                //("#print_icon").hide();
                var reportTablePrint=document.getElementById("printReport");
                newWin= window.open();
                var is_chrome = Boolean(newWin.chrome);
                // var top = '<center><img src="{{URL::to("logo/logo.png")}}" width="40px" height="40px"></center>';
                //   top += '<center><h3>Baby Land Park</h3></center>';
                //   top += '<center><p style="margin-top:-10px">Address</p></center>';
                // newWin.document.write(top);
                newWin.document.write(reportTablePrint.innerHTML);
                if (is_chrome) {
                    setTimeout(function () { // wait until all resources loaded 
                    newWin.document.close(); // necessary for IE >= 10
                    newWin.focus(); // necessary for IE >= 10
                    newWin.print();  // change window to winPrint
                    newWin.close();// change window to winPrint
                    }, 250);
                }
                else {
                    newWin.document.close(); // necessary for IE >= 10
                    newWin.focus(); // necessary for IE >= 10

                    newWin.print();
                    newWin.close();
                }
            }
        </script>

        
        @stack("custom_script")  
    </body>
</html>