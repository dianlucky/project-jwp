<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <title>{{ $title }}</title>

    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ url('assets/plugins/chartist/css/chartist.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/plugins/morris/morris.css') }}" />


    <link rel="stylesheet" href="{{ url('assets/plugins/animate/animate.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-material-design.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/css/icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}" type="text/css" />

    <link href="{{ url('assets/plugins/timepicker/tempusdominus-bootstrap-4.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/plugins/timepicker/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ url('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/plugins/clockpicker/jquery-clockpicker.min.css') }}" rel="stylesheet" />
    <!-- DataTables -->
    <link href="{{ url('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ url('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Dropzone css -->
    <link href="{{ url('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
</head>

<body class="fixed-left">
    <div id="wrapper">
        @include('layout.sidebar')

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                @include('layout.topbar')
                @yield('content')
            </div>
        </div>

    </div>

    <!-- jQuery  -->
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap-material-design.js') }}"></script>
    <script src="{{ url('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ url('assets/js/detect.js') }}"></script>
    <script src="{{ url('assets/js/fastclick.js') }}"></script>
    <script src="{{ url('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ url('assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ url('assets/js/waves.js') }}"></script>
    <script src="{{ url('assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ url('assets/js/jquery.scrollTo.min.js') }}"></script>

    <script src="{{ url('assets/plugins/carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('assets/plugins/fullcalendar/vanillaCalendar.js') }}"></script>
    <script src="{{ url('assets/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ url('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ url('assets/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ url('assets/plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ url('assets/plugins/metro/MetroJs.min.js') }}"></script>
    <script src="{{ url('assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ url('assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ url('assets/pages/dashborad.js') }}"></script>

    <script src="{{ url('assets/plugins/timepicker/moment.js') }}"></script>
    <script src="{{ url('assets/plugins/timepicker/tempusdominus-bootstrap-4.js') }}"></script>
    <script src="{{ url('assets/plugins/timepicker/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ url('assets/plugins/clockpicker/jquery-clockpicker.min.js') }}"></script>
    <script src="{{ url('assets/plugins/select2/select2.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ url('assets/js/app.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ url('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ url('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ url('assets/pages/datatables.init.js') }}"></script>
    <script src="{{ url('assets/pages/form-advanced.js') }}"></script>

    <!-- Dropzone js -->
    <script src="{{ url('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ url('assets/pages/upload-init.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{url('assets/plugins/chart.js/chart.min.js')}}"></script>
    <script src="{{ url('assets/pages/chartjs.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js">


</body>

</html>
