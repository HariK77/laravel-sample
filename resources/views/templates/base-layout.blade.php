<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', config('app.name')) - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Dashboard" name="description" />
    <meta content="Lara Codes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('topCss')
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/simplebar.min.js"></script>
    <script src="assets/js/waves.min.js"></script>


    <!-- App js -->
    <script src="assets/js/app.js"></script>

    @yield('js')
</body>

</html>
