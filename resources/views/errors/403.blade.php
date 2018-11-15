<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LSAPP') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: black;">

    <!--Custom strana za ono kad se brani pristup korisniku preko polisa.-->
    <img src="https://vignette.wikia.nocookie.net/dragonology/images/2/22/Death_Dragon.jpg/revision/latest/scale-to-width-down/1000?cb=20150427140253" class="img403" alt="not_authorized">
    <a href="{{ URL::previous() }}" class="link403">
        <div class="alert alert-danger">Go Back, you're not authorized to be here!</div>
    </a>
</body>
</html>