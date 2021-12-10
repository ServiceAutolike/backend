<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Autolike - @yield('title')</title>
    <link href="{{asset('/auth/vendor/simplebar/dist/simplebar.min.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('/auth/vendor/quill/dist/quill.snow.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('/auth/css/theme.min.css')}}" rel="stylesheet" type="text/css" media="all" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body class="bg-gray-100 billing-templete">
@include('component.header')
@include('component.nav')
<div class="main-content">
    @include('component.header-content')
    <div class="p-3 p-xxl-5">
        <div class="px-3 px-xxl-5 py-3 py-lg-4 border-bottom border-gray-200 after-header">
            <div class="container-fluid px-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="h2 mb-0">@yield('title')</h1>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
        @include('component.footer')
    </div>
</div>
<script data-cfasync="false" src="{{asset('/auth/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
<script src="{{asset('/auth/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}" type="dc48cbed41f80b350d8c6955-text/javascript"></script>
<script src="{{asset('/auth/vendor/lodash/lodash.min.js')}}" type="dc48cbed41f80b350d8c6955-text/javascript"></script>
<script src="{{asset('/auth/vendor/simplebar/dist/simplebar.min.js')}}" type="dc48cbed41f80b350d8c6955-text/javascript"></script>
<script src="{{asset('/auth/vendor/quill/dist/quill.min.js')}}" type="dc48cbed41f80b350d8c6955-text/javascript"></script>
<script src="{{asset('/auth/js/theme-custom.js')}}" type="dc48cbed41f80b350d8c6955-text/javascript"></script>
<script type="dc48cbed41f80b350d8c6955-text/javascript">
            var toolbarOptions = [
            ['bold', 'italic', 'link', { 'list': 'ordered'}, { 'list': 'bullet' }, 'image', 'blockquote'],
            ];
              var quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Start typing...',
                modules: {
                  toolbar: toolbarOptions
                },
              });
        </script>
<script src="{{asset('/auth/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="dc48cbed41f80b350d8c6955-|49" defer=""></script>
<script
    defer
    src="https://static.cloudflareinsights.com/beacon.min.js/v64f9daad31f64f81be21cbef6184a5e31634941392597"
    integrity="sha512-gV/bogrUTVP2N3IzTDKzgP0Js1gg4fbwtYB6ftgLbKQu/V8yH2+lrKCfKHelh4SO3DPzKj4/glTO+tNJGDnb0A=="
    data-cf-beacon='{"rayId":"6b9783ec7c473c52","version":"2021.11.0","r":1,"token":"9ae02b4a12234f118cf01e6f25c04e9d","si":100}'
    crossorigin="anonymous"
></script>
</body>
</html>
