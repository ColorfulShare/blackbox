<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @section('page-style')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blackbox</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/sistema/favicon.png') }}" type="image/x-icon">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/pages/page-auth.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/core.css'))}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/themes/semi-dark-layout.css')}}"> --}}

    <!-- BEGIN: Page CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/pages/authentication.css')}}"> --}}
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}"> --}}
    <!-- END: Custom CSS-->


</head>

<body class="1-column blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                    @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
