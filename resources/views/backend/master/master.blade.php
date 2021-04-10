<!DOCTYPE html>
<html lang="{{Illuminate\Support\Facades\App::currentLocale()}}">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="{{ asset('')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="backend\assets\images\favicon.ico">

    <!-- custom css -->
    @yield('style')

    <!-- App css -->
    <link href="backend\assets\css\bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet">
    <link href="backend\assets\css\app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet">

    <!-- icons -->
    <link href="backend\assets\css\icons.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

</head>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <!-- Begin page -->
    <div id="wrapper">
       
        <!--Start header-->
        @include('backend.master.header')
        <!--End header-->

        <!-- Side bar -->
        @include('backend.master.sidebar')
        <!-- End Side bar-->

        <!--dashboard-->
        <div class="content-page">
            @yield('content')
        </div>
        <!--end dashboard-->
    </div>

    @include('backend.master.footer')

    <!-- Vendor js -->
    <script src="backend\assets\js\vendor.min.js"></script>

    <!-- custom js -->
    @yield('script')

    <!-- App js-->
    <script src="backend\assets\js\app.min.js"></script>
</body>

</html>
