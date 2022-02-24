<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link href="{{asset('/Backend-Assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/Backend-Assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
</head>
<body class="bg-body">
<div class="d-flex flex-column flex-root" id="app">
    <!--begin::Authentication - Sign-up -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(/avatar/14.png)">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
{{--            <a href="../../demo8/dist/index.html" class="mb-12">--}}
{{--                <img alt="Logo" src="assets/media/logos/logo-1.svg" class="h-40px" />--}}
{{--            </a>--}}
            <!--end::Logo-->
            @yield('content')
        </div>
        <!--begin::Footer-->
        <div class="d-flex flex-center flex-column-auto p-10">
            <!--begin::Links-->
            <div class="d-flex align-items-center fw-bold fs-6">
                <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>
                <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
                <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
            </div>
            <!--end::Links-->
        </div>
        <!--end::Footer-->
    </div>
</div>


<script src="{{ asset('/js/app.js') }}"></script>
<script src="{{asset('/Backend-Assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('/Backend-Assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{asset('/Backend-Assets/js/custom/authentication/sign-in/general.js')}}"></script>
<script src="{{asset('/Backend-Assets/js/custom/authentication/sign-up/general.js')}}"></script>
</body>
</html>
