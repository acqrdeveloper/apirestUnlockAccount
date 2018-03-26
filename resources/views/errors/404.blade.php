<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta author="Alex Christian" email="aquispe.developer@gmail.com"/>
    <title>Page not found</title>
    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Customize -->
    <style>
        footer.sticky-footer {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 56px;
            background-color: #e9ecef;
            line-height: 55px;
        }

        @media (min-width: 992px) {
            footer.sticky-footer {
                width: calc(100% - 250px);
            }
        }
    </style>
</head>
<body style="background: url({{asset('background/background_01.jpg')}});">
<div class="container pt-5">
    <div class="text-center m-5">
        <img class="img-thumbnail" style="background-color: transparent;border: 0;width: 150px" src="{{asset('logo.svg')}}">
    </div>
    <div class="row">
        <div class="col-12 text-center text-white">
            <div class="mt-5">
                <h1>Estimado usuario, esta página no ha sido encontrada</h1>
            </div>
        </div>
    </div>
    <footer class="sticky-footer w-100 mt-5"
            style="background-color: transparent !important;color:#f5f5f5; letter-spacing: 1px">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Corporación Sapia {{date("Y")}}</small>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
