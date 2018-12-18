let marker;
let arr = [];

function myMap(val) { 
    let mapProp = new google.maps.Map(document.getElementById('googleMap'), {
        zoom: 10,
        center: {lat: -33.92, lng: 151.25}
    });
    
    if(val){

        if(document.getElementById(val).checked==true){
            arr.push(val);
        }

        if(document.getElementById(val).checked==false){
            let index = arr.indexOf(val);
            
            if (index > -1) {
                arr.splice(index, 1);
            }
        }
        setMarkers(mapProp,data, arr);
    }
    else{
        setMarkers(null);
    }
            
}
        
function setMarkers(map,markerData, arr){
    
    let unFlattened;
    let flattened;
    if(arr && arr.length>0){

        unFlattened = arr.map((item, index) => markerData[item]);
        flattened = unFlattened.reduce(function(a, b) {
            return a.concat(b);
        });
        console.log(arr);
    }
    
    let icoUrl;
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

            marker = new google.maps.Marker({
                position: {lat: parseFloat(flattened[i].lat), lng: parseFloat(flattened[i].lng)},
                map: map,
                icon: icoUrl,
                title: ""+flattened[i].naziv,
                zIndex: i,
                animation: google.maps.Animation.DROP,
            });

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
    }

}