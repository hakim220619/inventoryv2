<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/lexa/layouts/purple/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Jun 2023 03:13:42 GMT -->

<head>

    <meta charset="utf-8" />
    <title>{{ Helper::apk()->title }} | {{ request()->user()->full_name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

</head>

<style>
    .password-input-container {
        position: relative;
    }

    .password-input {
        padding-right: 32px;
    }

    .toggle-password {
        position: absolute;
        top: 45px;
        right: 10px;
        cursor: pointer;
        z-index: 9999;
    }
</style>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('backend.layout.navbar')

        @include('backend.layout.sidebar')
        <div class="main-content">

            @include('sweetalert::alert')

            <div class="page-content">

                <div class="container-fluid">
                    <div class="position" style="margin-top: -2%;
                margin-bottom: 2%;">
                        <div class="progress">
                            <div class="progress-bar progress-bar-animated" role="progressbar"></div>
                        </div>
                    </div>
                    @yield('content')
                </div>
                <!-- end page title -->

            </div> <!-- container-fluid -->


            @include('backend.layout.footer')
            <script>
                $(document).ready(function() {
                    $(".toggle-password").click(function() {
                        var passwordInput = $($(this).siblings(".password-input"));
                        var icon = $(this);
                        if (passwordInput.attr("type") == "password") {
                            passwordInput.attr("type", "text");
                            icon.removeClass("fa-eye").addClass("fa-eye-slash");
                        } else {
                            passwordInput.attr("type", "password");
                            icon.removeClass("fa-eye-slash").addClass("fa-eye");
                        }
                    });
                })
            </script>
            <script></script>
            <!-- JAVASCRIPT -->
            <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
            <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
            <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
            <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
            <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
            <script src="{{ asset('assets/js/app.js') }}"></script>

            <script src="{{ asset('assets/libs/parsleyjs/parsley.min.js') }}"></script>

            <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
            <!-- materialdesign icon js-->
            <script src="{{ asset('assets/js/pages/materialdesign.init.js') }}"></script>
            <!-- Sweet Alerts js -->
            <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

            <!-- Sweet alert init js-->
            <script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>

            <!-- Datatable init js -->
            <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

            <!-- Required datatable js -->
            <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
            <!-- Buttons examples -->
            <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
            <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
            <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
            <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
            <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
            <!-- Responsive examples -->
            <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

            <!-- Datatable init js -->
            <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

            <!-- fontawesome icons init -->
            <script src="{{ asset('assets/js/pages/fontawesome.init.js') }}"></script>



</body>

<!-- Mirrored from themesbrand.com/lexa/layouts/purple/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Jun 2023 03:13:42 GMT -->

</html>
