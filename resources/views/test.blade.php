@extends("layouts.app")
<!--Ovde se navodi iz kog se direktorijuma uzima template. -->

@section("content")

<h1>Google Map-Laravel</h1>

<div class="grid-container1">
    <h3 class="widget-content themed-background-success text-light-op headline"><i class="fa fa-fw fa-chevron-right"></i> Ime trenutno ulogovanog korisnika: {{$name}}</h3>
    <h4 class="legenda widget-content themed-background-success text-light-op">Legenda</h4>
    <div class="item1">
        <div class="form-check">
                
            <label class="switch switch-info">
                <input id="stores" type="checkbox" class="form-check-input" onclick="myMap('stores')">
                <span></span>
            </label> Radnje
        </div>

        <div class="form-check">
                
            <label class="switch switch-success">
                    <input id="salons" type="checkbox" class="form-check-input" onclick="myMap('salons')">
                <span></span>
            </label> Saloni
        </div>

        <div class="form-check">
                
            <label class="switch switch-primary">
                    <input id="managers" type="checkbox" class="form-check-input" onclick="myMap('managers')">
                <span></span>
            </label> Managers
        </div>
    </div>

    <div class="item2" id="googleMap"></div>

    <div class="item3" id="legenda">

        <label class="labs"> Kupac <img src="https://www.gravatar.com/avatar/bae5ca56926344693f12254ce9cfb702?s=32&d=identicon&r=PG" alt="buyer"></label>
        <label class="labs"> Menadžer <img src="https://www.gravatar.com/avatar/3aa31a90e5710a559643ed0045e32184?s=32&d=identicon&r=PG" alt="manager"></label>
        <label class="labs"> Salon <img src="https://dl1.cbsistatic.com/i/r/2017/02/01/0231dff5-60fe-4427-869e-306bb526f792/thumbnail/32x32/6962ed0b3a6bddef4029bdaa7329c36d/fmimg305106705692540651.png" alt="salon"></label>
        <label class="labs"> Radnja <img src="https://cdn1.iconfinder.com/data/icons/Momentum_GlossyEntireSet/32/store.png" alt="store"></label>
        <label class="labs"> Prva faza <img src="https://dl1.cbsistatic.com/i/r/2017/11/13/6579c82f-5125-4eb5-a380-c485724fa2d6/thumbnail/32x32/6d2e80a1995b2a083ab11c522cbc5aab/iconimg29084.png" alt="projectFirstPhase"></label>
        <label class="labs"> Druga faza <img src="https://addons.thunderbird.net/user-media/addon_icons/141/141863-64.png?modified=1329495840" alt="projectSecondPhase"></label>
        <label class="labs"> Treća faza <img src="https://static.coinpaprika.com/storage/cdn/currency_images/6560453.png" alt="projectThirdPhase"></label>
    </div>
</div>


@endsection