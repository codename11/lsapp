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
<body>
    <div id="app">
        @include('inc.navbar')

        <main class="container py-4">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>
    
    <script src="/vendor/ckeditor/ckeditor.js"></script>
    <!--Stari ckeditor<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        Sa novim CKEditorom, ni ovo donje nije potrebno.
    <script>
        let textArea = document.getElementById("ckeditor");
        window.onload = () => {
            if(textArea){
                CKEDITOR.replace( 'ckeditor' );
            }
        }
    </script>-->
<script>
        
    function myMap() { 
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position){
                let lat = position.coords.latitude;
                let lng = position.coords.longitude;
            
                let mapProp = {
                    center:new google.maps.LatLng(lat,lng),
                    zoom:5,
                };
        
                let marker = new google.maps.Marker({
                    position: mapProp.center,
                    icon:'https://cdn3.iconfinder.com/data/icons/discovery/32x32/actions/gtk-media-record.png',
                    animation:google.maps.Animation.BOUNCE
                });
        
                let map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
            
                marker.setMap(map);
            });
        } 
        
    }
        
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDllwuDAU1-GxoYtmVwp0rjxhPwYSfeI0Y&callback=myMap"></script>
</body>
</html>
