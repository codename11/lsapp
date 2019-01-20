@extends("layouts.app")
<!--Ovde se navodi iz kog se direktorijuma uzima template. -->

@section("content")

    <div class="checkbox">
        <label><input id="stores" type="checkbox" value="stores">Radnja</label>
    </div>
    <div class="checkbox">
        <label><input id="salons" type="checkbox" value="salons">Salon</label>
    </div>
    <button id="ajaxbtn">Post via ajax!</button>
    <div class="writeinfo"></div>   
    
@endsection