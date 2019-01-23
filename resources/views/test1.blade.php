@extends("layouts.app")
<!--Ovde se navodi iz kog se direktorijuma uzima template. -->

@section("content")

<h1>Peštan Mapa objekata</h1>

<div class="">

    <div class="form-group sl">

        <div class="outer">
            <input id="inp" class="form-control" type="text" placeholder="Search Box">
            <a href="#" id="searchx" class="fa fa-search"></a>
        </div>
        <ul class="list-group" id="suggestion"></ul>
        
    </div>
    <div class="item2" id="googleMap"></div>

    <div class="item1" id="chex">
                
                @foreach($filteri as $f)
                <span class="" style="padding-left: 5px;">
    
                    <label class="switch switch-info">
                        <input id="{{ $f }}" type="checkbox" value="{{ $f }}" class="form-check-input" onclick="myMap(this)" @if($f == 'store') checked @endif>
                        <span></span>
                    </label> {{ $f }}
    
                </span>
                @endforeach
    
             
</div>
    

    <div class="item3" id="legenda">

        <label> Kupac <img src="https://cdn1.iconfinder.com/data/icons/Momentum_GlossyEntireSet/32/store.png" alt="store"></label>
        <label> Menadžer <img src="https://www.gravatar.com/avatar/3aa31a90e5710a559643ed0045e32184?s=32&d=identicon&r=PG" alt="manager"></label>
        <label> Salon <img src="https://dl1.cbsistatic.com/i/r/2017/02/01/0231dff5-60fe-4427-869e-306bb526f792/thumbnail/32x32/6962ed0b3a6bddef4029bdaa7329c36d/fmimg305106705692540651.png" alt="salon"></label>
        <label> Radnja <img src="https://dl1.cbsistatic.com/i/r/2017/11/13/6579c82f-5125-4eb5-a380-c485724fa2d6/thumbnail/32x32/6d2e80a1995b2a083ab11c522cbc5aab/iconimg29084.png" alt="store"></label>
        <label> Prva faza <img src="https://www.gravatar.com/avatar/bae5ca56926344693f12254ce9cfb702?s=32&d=identicon&r=PG" alt="projectFirstPhase"></label>
        <label> Druga faza <img src="https://addons.thunderbird.net/user-media/addon_icons/141/141863-64.png?modified=1329495840" alt="projectSecondPhase"></label>
        <label> Treća faza <img src="https://static.coinpaprika.com/storage/cdn/currency_images/6560453.png" alt="projectThirdPhase"></label>
    </div>

<div id="blah"></div>
<button onclick="testiranje()"> testiranje </button>
@endsection