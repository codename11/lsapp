let marker;
let arr = [];
let input = document.getElementById('inp');
let elem = document.getElementById("suggestion");

input.addEventListener("click", function(event){

	if(elem.style.display == "none" && elem.children.length>0 && input.value.length>0){
		event.stopPropagation();
		elem.style.display = "inline-block";
    }

    if(arr.length>0){
        elem.style.display = "inline-block";
        blast();
    }
    
});

document.addEventListener("click", function(e){
	
	if(elem.style.display == "inline-block"){
		elem.style.display = "none";
    }

    console.log(arr);

    if(arr.length==0){
        elem.innerHTML = "";
        elem.style.display = "none";
    }
    	
});

input.addEventListener("input", blast);

function blast(){
    //console.log(arr);
    let datax;
    let filtered;
    
    if(arr.length>0){
        datax = data;
        let arr1 = [];
        for(let i=0;i<arr.length;i++){
            arr1.push(arr[i]+"s");
        }

        filtered = Object.keys(datax)
        .filter(key => arr1.includes(key))
        .reduce((obj, key) => {
        obj[key] = datax[key];
        return obj;
        }, {});
    
        console.log(filtered);

        document.getElementById("suggestion").innerHTML = "";
        document.getElementById("suggestion").style.display = "none";

        if(input.value.length>0){
        let keys1 = Object.keys(filtered);
        let x,y,z;
        //console.log(keys1);
            for(let i=0;i<keys1.length;i++){
            
                let keys2 = Object.keys(filtered[keys1[i]]);
                let keys2Int = keys2.map(num => parseInt(num));
                //console.log(keys2Int);
                for(let j=0;j<keys2.length;j++){
                
                    let keys3 = Object.keys(filtered[keys1[i]][keys2Int[j]])
                    
                    for(let k=0;k<keys3.length;k++){
                        let keys4 = Object.keys(filtered[keys1[i]][keys2Int[j]][keys3[k]]);
                        let datas = filtered[keys1[i]][keys2Int[j]][keys3[k]];
                        
                        if(datas.indexOf(input.value)>-1){
                            index = k;
                            
                            document.getElementById("suggestion").style.display = "inline-block";
                            document.getElementById("suggestion").innerHTML += "<li class='list-group-item' style='border: 1px dotted gray;width: 100% !important;' onclick='myMap(false,{lat: "+filtered[keys1[i]][keys2Int[j]].lat+",lng: "+filtered[keys1[i]][keys2Int[j]].lng+"})'>"+datas+"</li>";
                            
                        }
                        
                        //console.log(datas);
                        //Knez
                    }
                    
                    //console.log(keys3);
                    
                }
                
                //console.log(keys2);
                
            }
            
        }
    }
    }

function myMap(me, par) { 

    let centar;
    if(par){
        centar = par;
	    document.getElementById("inp").value = "";
	    document.getElementById("suggestion").innerHTML = "";
	    document.getElementById("suggestion").style.display = "none";
        console.log("you are now at my coordinates.");
        par = "";
    }
    else{
        centar = {lat: -27.92, lng: 140.25};
    }

    let mapProp = new google.maps.Map(document.getElementById('googleMap'), {
        zoom: 6,
        center: centar
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
    document.getElementById("trt").innerHTML=JSON.stringify(data);
    
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
                  
            add = 0.00002;//Regulation for proximity between pins. Modify cyfer for proximity clustering. 
            /*Also determined minimum value between pin coordinates 
            that doesn't cause clustering.*/

            /*If condition is fulfilled, i.e. absolute value between 
            the latitude and longitude respectably is below minimum 
            for clustering, determined value is added, slightly offsetting coordinates.
            By real world measurments, it's only couple of meters or less, even if that.*/
            if(i-1>=0 && Math.abs(Math.abs(parseFloat(flattened[i-1].lat))-Math.abs(parseFloat(flattened[i].lat)))<add && Math.abs(Math.abs(parseFloat(flattened[i-1].lng))-Math.abs(parseFloat(flattened[i].lng)))<add){

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

