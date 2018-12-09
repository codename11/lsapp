@extends("layouts.app")
<!--Ovde se navodi iz kog se direktorijuma uzima template. -->

@section("content")

<h1>Google Map-Laravel</h1>
<h3>Ime trenutno ulogovanog korisnika: 
    @if($name)
        {{$name}}
    @endif
</h3>
<div id="googleMap" style="width:100%;height:400px;"></div>

@endsection