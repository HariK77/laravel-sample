<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', config('app.name')) - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Dashboard" name="description" />
    <meta content="Laravel Sample" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- base url -->
    <meta name="base-url" content="{{ route('dashboard') }}">

    @yield('topCss')
    <!-- Alertify -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/alertifyjs/css/alertify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/alertifyjs/css/themes/bootstrap.min.css') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App Css-->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/custom.css').'?'.time() }}" rel="stylesheet" type="text/css" />
    @yield('bottomCss')
</head>

<body data-sidebar="dark">
    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('templates/includes/top-bar')

        @include('templates/includes/side-nav')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('body')

            @include('templates/includes/footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/waves.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/alertifyjs/alertify.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js').'?'.time() }}"></script>

    @yield('js')
</body>

</html>
