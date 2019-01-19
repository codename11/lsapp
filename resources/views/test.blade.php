@extends("layouts.app")
<!--Ovde se navodi iz kog se direktorijuma uzima template. -->

@section("content")

<h1>Google Map-Laravel</h1>

<div class="">
    
    <div style="width: 200px;">
        <input id="inp" class="controls" type="text" placeholder="Search Box">
        <ul class="list-group" id="suggestion"></ul>
    </div>

    <div class="item2" id="googleMap"></div>

    <div class="item1" id="chex">
            <?php 
                $datax = json_decode($data, true); 
                while ($descs = current($datax)) {
                   
                    $len = strlen(key($datax));
                    $description = substr(key($datax),0,$len-1);
                    
                    /*Dobijena vrednost iz baze koja ukoliko je true, 
                    znači da je checkbox čekiran.*/
                    $vredIzBazeChecked = false;
                    /*Ovde se procenjuje da li je dobijena vrednost iz baze
                    istinita, ukoliko jeste postavlja se checked atribut, 
                    ukoliko nije, prazan string koji je u suštini ništa.*/
                    $chc = $vredIzBazeChecked ? "checked" : "";
            ?>
    
                <span class="" style="padding-left: 5px;">
    
                    <label class="switch switch-info">
                        <input id="{{$description}}" type="checkbox" value="{{$description}}" class="form-check-input" onclick="myMap(this)" {{$chc}}>
                        <span></span>
                    </label> {{$description}}
    
                </span>
    
            <?php
                    next($datax);
                }
            ?>
             
        </div>

    <div class="item3" id="legenda">

        <span class="labs"><img src="../images/kupac.png" alt="buyer"> Kupac </span>
        <span class="labs"><img src="../images/menadzer.png" alt="manager"> Menadžer </span>
        <span class="labs"><img src="../images/salon.png" alt="salon"> Salon </span>
        <span class="labs"><img src="../images/radnja.png" alt="store"> Radnja </span>
        <span class="labs"><img src="../images/prvaFaza.png" alt="projectFirstPhase"> Prva faza </span>
        <span class="labs"><img src="../images/drugaFaza.png" alt="projectSecondPhase"> Druga faza </span>
        <span class="labs"><img src="../images/trecaFaza.png" alt="projectThirdPhase"> Treća faza </span>
    
    </div>
</div>
<div id="trt"></div>
@endsection