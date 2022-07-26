@php 
    $assets = asset('template_assets');
@endphp
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Meta data -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta content="Idetechno" name="description">
        <meta content="Idetechno" name="author">
        <meta name="keywords" content="Idetechno"/>

        <!-- Title -->
        <title>{{ AppName() }}</title>

        <!--Favicon -->
        <link rel="icon" href="{{ $assets }}/images/brand/favicon.ico" type="image/x-icon"/>

        <!-- Bootstrap css -->
        <link href="{{ $assets }}/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

        <!-- Style css -->
        <link href="{{ $assets }}/css/style.css" rel="stylesheet" />

        <!-- Dark css -->
        <link href="{{ $assets }}/css/dark.css" rel="stylesheet" />

        <!-- Skins css -->
        <link href="{{ $assets }}/css/skins.css" rel="stylesheet" />

        <!-- Animate css -->
        <link href="{{ $assets }}/css/animated.css" rel="stylesheet" />

        <!-- P-scroll bar css-->
        <link href="{{ $assets }}/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

        <!---Icons css-->
        <link href="{{ $assets }}/plugins/web-fonts/icons.css" rel="stylesheet" />
        <link href="{{ $assets }}/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
        <link href="{{ $assets }}/plugins/web-fonts/plugin.css" rel="stylesheet" />

        <!---jvectormap css-->
        <link href="{{ $assets }}/plugins/jvectormap/jqvmap.css" rel="stylesheet" />

        <!-- simplebar CSS -->
        {{-- <link rel="stylesheet" href="{{ $assets }}/plugins/simplebar/css/simplebar.css"> --}}

        <!-- Data table css -->
        <link href="{{ $assets }}/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

        <!--Daterangepicker css-->
        <link href="{{ $assets }}/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />

        @yield('vendor_css')

        @yield('css_scripts')
    </head>

    <body class="light-mode">

        <!---Global-loader-->
        <div id="global-loader" >
            <img src="{{ $assets }}/images/svgs/loader.svg" alt="loader">
        </div>

        <div class="page">
            <div class="page-main">

                <!--app header-->
                @include('layouts.members.header')
                <!--/app header-->
                <!-- Horizontal-menu -->
                @include('layouts.members.menu')
                <!-- Horizontal-menu end -->

                {{-- content --}}
                @yield('content')
                
            </div>

            <!--Footer-->
            <footer class="footer">
                <div class="container">
                    <div class="row align-items-center flex-row-reverse">
                        <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                            
                            Copyright © 2021 <a href="https://idetechno.com/" target="_blank">INB Logistik develope by Idetechno.com</a>. All rights reserved.
                        </div>
                    </div>
                </div>
            </footer>
            <!-- End Footer-->

        </div>

        <!-- Back to top -->
        <a href="#top" id="back-to-top">
            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z"/></svg>
        </a>

        <!-- Jquery js-->
        <script src="{{ $assets }}/js/vendors/jquery-3.5.1.min.js"></script>

        <!-- Bootstrap4 js-->
        <script src="{{ $assets }}/plugins/bootstrap/popper.min.js"></script>
        <script src="{{ $assets }}/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!--Othercharts js-->
        <script src="{{ $assets }}/plugins/othercharts/jquery.sparkline.min.js"></script>

        <!-- Circle-progress js-->
        <script src="{{ $assets }}/js/vendors/circle-progress.min.js"></script>

        <!-- Jquery-rating js-->
        <script src="{{ $assets }}/plugins/rating/jquery.rating-stars.js"></script>

        <!--Horizontal js-->
        <script src="{{ $assets }}/plugins/horizontal-menu/horizontal.js"></script>

        <!-- ECharts js -->
        <script src="{{ $assets }}/plugins/echarts/echarts.js"></script>

        <!-- Peitychart js-->
        <script src="{{ $assets }}/plugins/peitychart/jquery.peity.min.js"></script>
        <script src="{{ $assets }}/plugins/peitychart/peitychart.init.js"></script>

        <!-- Apexchart js-->
        {{-- <script src="{{ $assets }}/js/apexcharts.js"></script> --}}

        <!--Moment js-->
        <script src="{{ $assets }}/plugins/moment/moment.js"></script>

        <!-- Daterangepicker js-->
        <script src="{{ $assets }}/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="{{ $assets }}/js/daterange.js"></script>

        <!---jvectormap js-->
        {{-- <script src="{{ $assets }}/plugins/jvectormap/jquery.vmap.js"></script>
        <script src="{{ $assets }}/plugins/jvectormap/jquery.vmap.world.js"></script>
        <script src="{{ $assets }}/plugins/jvectormap/jquery.vmap.sampledata.js"></script> --}}

        <!-- Index js-->
        <script src="{{ $assets }}/js/index1.js"></script>

        <!-- Data tables js-->
        <script src="{{ $assets }}/plugins/datatable/js/jquery.dataTables.js"></script>
        <script src="{{ $assets }}/plugins/datatable/js/dataTables.bootstrap4.js"></script>
        <script src="{{ $assets }}/plugins/datatable/js/dataTables.buttons.min.js"></script>
        <script src="{{ $assets }}/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
        <script src="{{ $assets }}/plugins/datatable/js/jszip.min.js"></script>
        <script src="{{ $assets }}/plugins/datatable/js/pdfmake.min.js"></script>
        <script src="{{ $assets }}/plugins/datatable/js/vfs_fonts.js"></script>
        <script src="{{ $assets }}/plugins/datatable/js/buttons.html5.min.js"></script>
        <script src="{{ $assets }}/plugins/datatable/js/buttons.print.min.js"></script>
        <script src="{{ $assets }}/plugins/datatable/js/buttons.colVis.min.js"></script>
        <script src="{{ $assets }}/plugins/datatable/dataTables.responsive.min.js"></script>
        <script src="{{ $assets }}/plugins/datatable/responsive.bootstrap4.min.js"></script>
        <script src="{{ $assets }}/js/datatables.js"></script>

        <!--Counters -->
        {{-- <script src="{{ $assets }}/plugins/counters/counterup.min.js"></script>
        <script src="{{ $assets }}/plugins/counters/waypoints.min.js"></script> --}}

        <!-- simplebar JS -->
        {{-- <script src="{{ $assets }}/plugins/simplebar/js/simplebar.min.js"></script> --}}

        <!--Chart js -->
        {{-- <script src="{{ $assets }}/plugins/chart/chart.bundle.js"></script> --}}
        <script src="{{ $assets }}/plugins/chart/utils.js"></script>

        <!-- Custom js-->
        <script src="{{ $assets }}/js/custom.js"></script>
        @yield('vendor_js')
        @yield('js_scripts')

    </body>
</html>