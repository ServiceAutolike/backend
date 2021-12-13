<html lang="en">
<!--begin::Head-->
<head><base href="">
    <title>Autolike - @yield('title')</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Auto LIke" />
    <meta property="og:url" content="https://autolike.com.vn" />
    <meta property="og:site_name" content="AutoLike.Com.Vn" />
    <link rel="shortcut icon" href="{{ asset('Backend-Assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('Backend-Assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('Backend-Assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled">
    <!--begin::Main-->
    <!--begin::Root-->
    @include('component.header') 
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                 @yield('content')
            </div>
        </div>
    </div>
    @include('component.footer') 
    
    <!--end::Main-->
    <script>var hostUrl = "Backend-Assets/";</script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('Backend-Assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('Backend-Assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('Backend-Assets/js/custom/widgets.js') }}"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->
</html>

