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
    
    let map1;
    if(arr){
        map1 = arr.map((item, index) => markerData[item]).flat();
    }
    
    let icoUrl;
    if(map1){
        
        var infowindow = new google.maps.InfoWindow();
        for(let i=0;i<map1.length;i++){

            switch (map1[i].description) {
                case "buyer":
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
                    break;
            }

            marker = new google.maps.Marker({
                position: {lat: parseFloat(map1[i].lat), lng: parseFloat(map1[i].lng)},
                map: map,
                icon: icoUrl,
                title: ""+map1[i].naziv,
                zIndex: i,
                animation: google.maps.Animation.DROP,
            });
            
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent("<div><h1>"+map1[i].naziv+"</h1><p>Adresa: "+map1[i].adresa+"</p><p>Koordinate: <br>Latitude: "+map1[i].lat+"<br>Longitude: "+map1[i].lng+"</p></div>");
                    infowindow.open(map, marker);
                }
            })(marker, i));
            
        }
    }

}