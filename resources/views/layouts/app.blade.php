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
<style>

img[src="https://cdn3.iconfinder.com/data/icons/discovery/32x32/actions/gtk-media-record.png"]{
    border-radius:16px;
    border:3px solid blue !important;
    
}

</style>
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

<!--Test za da li je trenutna ruta ona za google mapu gde se pojavljuje.
Ako jeste, onda se 'kod' za gmape realizuje. Ukoliko nije ruta za mape definisana u kontroleru,
nece se realizovati.-->
<?php 
    $route = Route::getFacadeRoot()->current()->uri();
    
    if(isset($route) && $route=="test"){
?>

    <script>
        let data = JSON.parse({!!json_encode($data)!!});
        
        console.log(data);
        //Kobajagi podaci dobijeni od servera.
        /*let data = {
            "stores":[
                {
                    "id":"1",
                    "naziv":"Tehnokom",
                    "adresa":"Knez Mihajlova 82",
                    "lat":"-33.890542",
                    "lng":"151.274856",
                    "id_komercijaliste":"Miloš Lovrić",
                    "description": "store"
                },
                {
                    "id":"2",
                    "naziv":"Termo Fluid",
                    "adresa":"Knez Mihajlova 86",
                    "lat":"-33.923036",
                    "lng":"151.259052",
                    "id_komercijaliste":"Dejan Ilić",
                    "description": "store"
                },
                {
                    "id":"3",
                    "naziv":"Vodoterm",
                    "adresa":"Irene Zeković 31",
                    "lat":"-34.028249",
                    "lng":"151.157507",
                    "id_komercijaliste":"Dejan Ilić",
                    "description": "store"
                },
                
            ],
            "salons": [
                {
                    "id":"4",
                    "naziv":"Home Decor System",
                    "adresa":"Kolarska 117",
                    "lat":"-33.80010128657071",
                    "lng":"151.28747820854187",
                    "id_komercijaliste":"Dejan Ilić",
                    "description": "salon"
                },
                {
                    "id":"5",
                    "naziv":"Dobrić",
                    "adresa":"Obilazni put bb",
                    "lat":"-33.950198",
                    "lng":"151.259302",
                    "id_komercijaliste":"Dejan Ilić",
                    "description": "salon"
                }
            ]
        };*/

        //let data = JSON.parse({$data});
        //console.log(data);
        let icons = {
            buyer: { 
                url: "https://www.gravatar.com/avatar/bae5ca56926344693f12254ce9cfb702?s=32&d=identicon&r=PG", 
                letter: ""
                    },
            manager: { 
                url: "https://www.gravatar.com/avatar/3aa31a90e5710a559643ed0045e32184?s=32&d=identicon&r=PG", 
                letter: ""
                    },
            salon: { 
                url: "https://dl1.cbsistatic.com/i/r/2017/02/01/0231dff5-60fe-4427-869e-306bb526f792/thumbnail/32x32/6962ed0b3a6bddef4029bdaa7329c36d/fmimg305106705692540651.png", 
                letter: ""
            },
            store: { 
                url: "https://cdn1.iconfinder.com/data/icons/Momentum_GlossyEntireSet/32/store.png", 
                letter: ""
            },
            projectFirstPhase: { 
                url: "https://dl1.cbsistatic.com/i/r/2017/11/13/6579c82f-5125-4eb5-a380-c485724fa2d6/thumbnail/32x32/6d2e80a1995b2a083ab11c522cbc5aab/iconimg29084.png", 
                letter: ""
            },
            projectSecondPhase: { 
                url: "https://addons.thunderbird.net/user-media/addon_icons/141/141863-64.png?modified=1329495840", 
                letter: ""
            },  
            projectThirdPhase: { 
                url: "https://static.coinpaprika.com/storage/cdn/currency_images/6560453.png", 
                letter: ""
            }, 
            default: { 
                url: "https://www.hedgewars.org/images/smileys/shock.png", 
                letter: ""
            },    
        };
        
    </script>
    <script defer src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script defer src="{{ asset('js/skripta.js') }}"></script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDllwuDAU1-GxoYtmVwp0rjxhPwYSfeI0Y&callback=myMap"></script>

    <script>  /*Ovo je potrebno da se iz php prebaci u js. 
    Ako je kao niz gore, onda mora i da se ieterira.*/
      
        
    </script>

<?php
    }
?>
</body>
</html>
