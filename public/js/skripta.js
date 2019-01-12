let marker;
let arr = [];

function myMap(me) { 
    let mapProp = new google.maps.Map(document.getElementById('googleMap'), {
        zoom: 10,
        center: {lat: -33.92, lng: 151.25}
    });
   
    let checkLen = document.querySelectorAll("input[type=checkbox]").length;

    for(let i=0;i<checkLen;i++){
        
        if(document.querySelectorAll("input[type=checkbox]")[i].checked){
        
            let ifValExists = arr.indexOf(document.querySelectorAll("input[type=checkbox]")[i].value);
            if(ifValExists==-1){
                arr.push(document.querySelectorAll("input[type=checkbox]")[i].value);
            }
            
        }
        
    }

    if(me && document.getElementById(me.value).checked==false){
        let index = arr.indexOf(me.value);
        if (index > -1) {
            arr.splice(index, 1);
        }
    }
    
    setMarkers(mapProp,data, arr);
    
}
        
function setMarkers(map,markerData, arr){
    
    let unFlattened;
    let flattened;
    
    if(arr && arr.length>0){

        unFlattened = arr.map((item, index) => markerData[item+"s"]);
        
        flattened = unFlattened.reduce(function(a, b) {
            return a.concat(b);
        });
        
    }
    
    let icoUrl;
    let markArr = [];
    let lat1;
    let lng1;
    let add = 0;

    if(flattened && flattened.length>0){
        
        var infowindow = new google.maps.InfoWindow();
        for(let i=0;i<flattened.length;i++){
            
            switch (flattened[i].description) {
                case "buyer":/*Ovo je description atribut niza objekata iz baze.*/
                    icoUrl = icons.buyer.url;
                    break;
                case "manager":
                    icoUrl = icons.manager.url;
                    break;
                case "salon":
                    icoUrl = icons.salon.url;
                    break;
                case "store":
                    icoUrl = icons.store.url;
                    break;
                case "projectFirstPhase":
                    icoUrl = icons.projectFirstPhase.url;
                    break;
                case "projectSecondPhase":
                    icoUrl = icons.projectSecondPhase.url;
                    break;
                case "projectThirdPhase":
                    icoUrl = icons.projectThirdPhase.url;
                    break;
                default:
                    icoUrl = icons.default.url;
                    break;
            }

            if(i-1>=0 && flattened[i-1].lat==flattened[i].lat && flattened[i-1].lng==flattened[i].lng){
                add = 0.0000167107;//Regulation for proximity between pins.
                lat1 = parseFloat(flattened[i].lat)+add;
                lng1 = parseFloat(flattened[i].lng)+add;
            }
            else{
                lat1 = (parseFloat(flattened[i].lat));
                lng1 = (parseFloat(flattened[i].lng));
            }

            marker = new google.maps.Marker({
                position: {lat: lat1, lng: lng1},
                map: map,
                icon: icoUrl,
                title: ""+flattened[i].naziv,
                zIndex: i,
                animation: google.maps.Animation.DROP,
            });

            markArr.push(marker);

            let addresa = flattened[i].adresa ? "<p>Adresa: "+flattened[i].adresa+"</p>" : "<br>"; //Vrsi proveru da li postoji adresa, ako postoji, prikayuje je, ukoliko ne postoji, onda samo brejk lajn.
            let naziv = flattened[i].naziv ? "<h1>"+flattened[i].naziv+"</h1>" : "<br>";
            let ltdLng = flattened[i].lat && flattened[i].lng ? "<p>Koordinate: <br>Latitude: "+flattened[i].lat+"<br>Longitude: "+flattened[i].lng+"</p>" : "<br>";

            google.maps.event.addListener(marker, 'click', ((marker, i) => {
                return () => {
                    infowindow.setContent("<div>"+naziv+addresa+ltdLng+"</div>");
                    infowindow.open(map, marker);
                }
            })(marker, i));
            
        }

        var markerCluster = new MarkerClusterer(map, markArr, {
            imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
            }
        );

    }

}