<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link href="{{asset('/auth/css/theme.min.css')}}" rel="stylesheet" type="text/css" media="all" />
</head>
<body class="signup-simple-template bg-gray-100">
<div class="bg-primary signup-header text-center">
    <div class="container">
        <a href="#"><img src="https://fabrx.co/preview/muse-dashboard/assets/svg/brand/logo-white@150.svg" alt="Muze" /></a>
    </div>
</div>
<div class="container">
@yield('content')
</div>

<script src="{{asset('/auth/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}" type="a7280a37f827040308bcadf4-text/javascript"></script>
<script src="{{asset('/auth/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="a7280a37f827040308bcadf4-|49" defer=""></script>
<script
    defer
    src="https://static.cloudflareinsights.com/beacon.min.js/v64f9daad31f64f81be21cbef6184a5e31634941392597"
    integrity="sha512-gV/bogrUTVP2N3IzTDKzgP0Js1gg4fbwtYB6ftgLbKQu/V8yH2+lrKCfKHelh4SO3DPzKj4/glTO+tNJGDnb0A=="
    data-cf-beacon='{"rayId":"6b9783f5a9b53c52","version":"2021.11.0","r":1,"token":"9ae02b4a12234f118cf01e6f25c04e9d","si":100}'
    crossorigin="anonymous"
></script>
</body>
</html>
