let marker;
let arr = [];//Čuva imena pritisnutih checkbox-ova.
let input = document.getElementById('inp');//Polje za pretragu.
let elem = document.getElementById("suggestion");//Ispadaju sugestije, klikom na neku od njih, centrira na traženu metu.
//console.log(data);
input.addEventListener("click", function(event){
/* Osluškuje kada je kliknuto na polja za pretragu, 
a sugestija nije prikazana, a postoje nađene sugestije koje su i upisane,
treba da prikaže sugestiju kada se kline na polje.*/
	if(elem.style.display == "none" && elem.children.length>0 && input.value.length>0){
		event.stopPropagation();
		elem.style.display = "inline-block";
    }
/*Ako ima čekirano, prikazuje sugestiju.*/
    if(arr.length>0){
        elem.style.display = "inline-block";
        blast();//Funkcija za generisanje sugestija.
    }
    
});

document.getElementById("searchx").addEventListener("click", ()=>{
    event.stopPropagation();
    
    blast();
    elem.style.display == "none";
    elem.style.display == "inline-block";
          
});

/*Osluškuje kada se kline bilo gde na strani*/
document.addEventListener("click", function(e){
	/*te ukoliko je otkrivena sugestija, sakriva je.*/
	if(elem.style.display == "inline-block"){
		elem.style.display = "none";
    }

    //console.log(arr);
/*ukoliko se klikne bilo gde na dokumentu, a ništa nije čekirano
brišu se sve sugestije i sakrivaju se.*/
    if(arr.length==0){
        elem.innerHTML = "";
        elem.style.display = "none";
    }
    	
});

/*Ukoliko se dogodi neki unos u polju za pretragu, 
aktiviraj funkciju za generisanje sugestija.*/ 
$('document').ready(()=>{
    input.addEventListener("keydown", (e)=>{
        if(e.key=="Enter"){
            blast();
        }  
    });
    
});

//Funkcija za generisanje sugestija.
function blast(){
    
    //console.log(arr);
    let datax;//Ovde se skladišti kopija prosleđenog objekta od strane servera.
    
    /*Ovde se skladište samo objekti koji su izfilterisani 
    iz objekta sa servera. Filterisanje se vrši na osnovu toga 
    koje je dugme pritisnuto, te samo ti pinovi prikazuju.*/
    let filtered;
    
    if(arr.length>0){//Proverava da li je ima nešto pritisnuto.
        datax = data;//Pravi se kopija prosleđenog od strane servera.
        let arr1 = [];
        /*Ovde se beleže description, te im se dodaje jedno 's' 
        da bi se moglo proveriti niz koji sadrži imena pretisnutih dugmića
        i uporediti sa prosleđenim objektom od servera, 
        tj. sa imenima onih pod-obekata tipa da li je pritisnuto stores 
        jednako sa imenovanim pod-obejktom stores, 
        ako jeste samo te pinove prikazuje.*/
        for(let i=0;i<arr.length;i++){
            arr1.push(arr[i]+"s");
        }

        /*Ovde se prikupljaju objekti koji poklapaju sa gore navedenim.*/
        filtered = Object.keys(datax)
        .filter(key => arr1.includes(key))
        .reduce((obj, key) => {
        obj[key] = datax[key];
        return obj;
        }, {});
    
        //console.log(filtered);
        /*Briše se i skriva sugestije.*/
        document.getElementById("suggestion").innerHTML = "";
        document.getElementById("suggestion").style.display = "none";
/*Ukoliko je nešto uneto u polje za pretragu, */
        if(input.value.length>0){
/*pronalaze se key-evi u ranije navedenom formatu. To su od onih pod-objekata.
stores, salons i dr. od izfilterisanih, tj. samo za one kojima 
su čekirani checkbox-ovi.*/
        let keys1 = Object.keys(filtered);
 
        //console.log(filtered);
        //console.log(keys1);
            for(let i=0;i<keys1.length;i++){
            /*pronalazi key-eve podobjekata od nadređenog mu podobjekta.*/
                let keys2 = Object.keys(filtered[keys1[i]]);
            
                /*Pošto je podobjekat niz koji sadrži objekte, key-evi istog 
                su brojčani indeksi. Gore navedeno.*/
                let keys2Int = keys2.map(num => parseInt(num));
                //console.log(keys2Int);
                for(let j=0;j<keys2.length;j++){
                /*Na osnovu gore navedenih brojčanih indeksa, izdvajaju se ovakvi 
                podaci, članovi niza:
                pr. {"id":"1","naziv":"Tehnokom","adresa":"Knez Mihajlova 82","lat":"44.665192","lng":"20.931357","id_komercijaliste":"Miloš Lovrić","description":"store"}*/
                    let keys3 = Object.keys(filtered[keys1[i]][keys2Int[j]])
                    
                    for(let k=0;k<keys3.length;k++){
                        /*Ovde se izdvajaju baš vrednosti koji su predstavljene i objektu 
                        iz niza, gore navedenog.Ali baš sve.*/
                        let datas = filtered[keys1[i]][keys2Int[j]][keys3[k]];
                        
                        //console.log(typeof datas);
                        //console.log(datas);
                        /*Ovde se filterišu prethodno nađene vrednosti, te se upoređuje sa
                        unetim u polje za pretragu. Ukoliko ono iz polja ima sličnosti sa 
                        sa nečim iz nađenim, ta vrednost nađena se prikazuje u li elementu
                        (ranije rečeno sugestija) ispod polja za pretragu.*/
                        if(datas.toLowerCase().indexOf(input.value.toLowerCase())>-1){
                            //console.log(k+" : "+keys3);
                            index1 = k;
                            if(k==1){
                                let naziv = filtered[keys1[i]][keys2Int[j]][keys3[1]];
                                let adresa = filtered[keys1[i]][keys2Int[j]][keys3[2]];
                                /*Ukoliko dođe do gore navedenog poklapanja, sugestija se prikazuje, 
                                li elementi se za nju generišu ispunjeni nađenim vrednostima.*/
                                document.getElementById("suggestion").style.display = "inline-block";
                                document.getElementById("suggestion").innerHTML += "<li class='list-group-item' style='border: 1px dotted gray;width: 100% !important;' onclick='myMap(false,{lat: "+filtered[keys1[i]][keys2Int[j]].lat+",lng: "+filtered[keys1[i]][keys2Int[j]].lng+"})'>"+naziv+"<br><p>"+adresa+"</p></li>";
                            }
                            else if(k!=1){
                                let naziv = filtered[keys1[i]][keys2Int[j]][keys3[1]];
                                let adresa = filtered[keys1[i]][keys2Int[j]][keys3[2]];
                                /*Ukoliko dođe do gore navedenog poklapanja, sugestija se prikazuje, 
                                li elementi se za nju generišu ispunjeni nađenim vrednostima.*/
                                document.getElementById("suggestion").style.display = "inline-block";
                                document.getElementById("suggestion").innerHTML += "<li class='list-group-item' style='border: 1px dotted gray;width: 100% !important;' onclick='myMap(false,{lat: "+filtered[keys1[i]][keys2Int[j]].lat+",lng: "+filtered[keys1[i]][keys2Int[j]].lng+"})'>"+naziv+"<br><p>"+adresa+"</p></li>";
                            }
                            
                            
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
    
    let zoomedPin = "";
    let centar;
    let mapProp;
    /*Pri startovanju se proverava da ima nečega u polju za pretragu
    koje se poklapa kao što je gore navedeno u prethodnom slučaju,
    ukoliko ima, zatvara se sugestija i setuje se centriranje na 
    koordinatu sugestije.*/
    if(par){
        zoomedPin = par;
        centar = par;
	    document.getElementById("inp").value = "";
	    document.getElementById("suggestion").innerHTML = "";
        document.getElementById("suggestion").style.display = "none";
        
        mapProp = new google.maps.Map(document.getElementById('googleMap'), {
            zoom: 22,
            center: centar
        });

        console.log("you are now at my coordinates.");
        par = "";
        zoomedPin = "";
    }
    else{//Ovo je za default.
        centar = {lat: -27.92, lng: 140.25};
        mapProp = new google.maps.Map(document.getElementById('googleMap'), {
            zoom: 5,
            center: centar
        });
    }
/*Proverava koliko ima čekiranih dugmića.*/
    let checkLen = document.querySelectorAll("input[type=checkbox]").length;

    for(let i=0;i<checkLen;i++){
        //iterira kroz nađene dugmiće.
        //Proverava da li je nađeno dugme ujedno i čekirano.
        if(document.querySelectorAll("input[type=checkbox]")[i].checked){
        /*Proverava da li postoji vrednost(value) u čekiranom dugmetu.*/
            let ifValExists = arr.indexOf(document.querySelectorAll("input[type=checkbox]")[i].value);
            /*Ako se nađena vrednost ne nalazi među sugestijama, onda se ubacuje, 
            ovime se izbegava dupliranje sugestija.*/
            if(ifValExists==-1){
                arr.push(document.querySelectorAll("input[type=checkbox]")[i].value);
            }
            
        }
        
    }
/*Ukoliko je funkcija startovana, ali ni jedna vrednost nije čekirana,
 odnosno ovo se proverava pristartovanju*/
    if(me && document.getElementById(me.value).checked==false){
        let index = arr.indexOf(me.value);
        /*Te ukoliko u nizu u kome se pamte čekirano, iz njega se ukljanjaju
        nakon ove provere.*/
        if (index > -1) {
            arr.splice(index, 1);
        }
    }
    /*Prikazuje mi na strani u json obliku prosleđene podatke od servera.*/
    document.getElementById("blah").innerHTML=JSON.stringify(data);
    /*Setuje markere.*/
    setMarkers(mapProp,data, arr,zoomedPin);
    
}
     
/*function setter(par1,par2,par3,par4){

    if(par4){
        setMarkers(par1,par2, par3,par4);
    }

}*/

function setMarkers(map,markerData, arr, pinZoomed){
    
    let unFlattened;
    let flattened;
    /*Proverava da li se nešto nalazi u nizu u kome se 
    skladište čekirane vrednosti.*/
    if(arr && arr.length>0){
/*ukoliko ima, onda se od markiranih podataka od njihovih glavnih imena 
podobjekata dodaje jedno 's', jer na dugmetu stoji store, a pretraga se 
vrši sa stores.*/
        unFlattened = arr.map((item, index) => markerData[item+"s"]);
        /*Izravnjavanje se vrši-*/
        flattened = unFlattened.reduce(function(a, b) {
            return a.concat(b);
        });
        
    }
    
    let icoUrl;
    let markArr = [];
    let lat1;
    let lng1;
    let add = 0;
/*Izravnjani se sada upotrebljavaju.*/
    if(flattened && flattened.length>0){
        
        var infowindow = new google.maps.InfoWindow();
        for(let i=0;i<flattened.length;i++){
            //console.log(flattened[i].description);
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
                  
            /*if(i-1>=0){
                console.log("****");
                console.log(Math.abs(Math.abs(parseFloat(flattened[i-1].lat))));
                console.log(Math.abs(Math.abs(parseFloat(flattened[i-1].lng))));
                console.log(Math.abs(Math.abs(parseFloat(flattened[i-1].lat))-Math.abs(parseFloat(flattened[i].lat))));
                console.log(Math.abs(Math.abs(parseFloat(flattened[i-1].lng))-Math.abs(parseFloat(flattened[i].lng))));
                console.log("****");
            }*/
            /*
            Da bi algoritam radio, format za niz prosledjen mora biti u formatu:
            /*$data = '
                {
                    "stores":[
                        {
                            "id":"1","naziv":"Tehnokom","adresa":"Knez Mihajlova 82","lat":"44.665192","lng":"20.931357","id_komercijaliste":"Miloš Lovrić","description":"store"
                        },
                        {
                            "id":"2","naziv":"Termo Fluid","adresa":"Knez Mihajlova 86","lat":"-33.923036","lng":"151.259052","id_komercijaliste":"Dejan Ilić","description":"store"
                        },
                        {
                            "id":"3","naziv":"Vodoterm","adresa":"Irene Zeković 31","lat":"-34.028249","lng":"151.157507","id_komercijaliste":"Dejan Ilić","description":"store"
                        }
                    ],
                    "salons":[
                        {
                            "id":"4","naziv":"Home Decor System","adresa":"Kolarska 117","lat":"-33.80010128657071","lng":"151.28747820854187","id_komercijaliste":"Dejan Ilić","description":"salon"
                        },
                        {
                            "id":"5","naziv":"Dobrić","adresa":"Obilazni put bb","lat":"-33.950198","lng":"151.259302","id_komercijaliste":"Dejan Ilić","description":"salon"
                        }
                    ], 
                    "managers":[
                        {
                            "naziv": "Dragan Petrović","datum":"18/12/2018","vreme":"13:53","lat":"-33.7301981","lng":"151.1593021","description":"manager"
                        },
                        {
                            "naziv": "Petar Marković","datum":"13/12/2018","vreme":"09:28","lat":"-33.9301981","lng":"151.1593021","description":"manager"
                        },
                        {
                            "naziv": "Mitar Mirić","datum":"13/12/2018","vreme":"09:28","lat":"-33.9301982","lng":"151.1593021","description":"manager"
                        }
            ]
        }';
        ili ovako:
        $data = '{"stores":[{"id":"1","naziv":"Tehnokom","adresa":"Knez Mihajlova 82","lat":"44.665192","lng":"20.931357","id_komercijaliste":"Miloš Lovrić","description":"store"},{"id":"2","naziv":"Termo Fluid","adresa":"Knez Mihajlova 86","lat":"-33.923036","lng":"151.259052","id_komercijaliste":"Dejan Ilić","description":"store"},{"id":"3","naziv":"Vodoterm","adresa":"Irene Zeković 31","lat":"-34.028249","lng":"151.157507","id_komercijaliste":"Dejan Ilić","description":"store"}],"salons":[{"id":"4","naziv":"Home Decor System","adresa":"Kolarska 117","lat":"-33.80010128657071","lng":"151.28747820854187","id_komercijaliste":"Dejan Ilić","description":"salon"},{"id":"5","naziv":"Dobrić","adresa":"Obilazni put bb","lat":"-33.950198","lng":"151.259302","id_komercijaliste":"Dejan Ilić","description":"salon"}],"managers":[{"naziv": "Dragan Petrović","datum":"18/12/2018","vreme":"13:53","lat":"-33.7301981","lng":"151.1593021","description":"manager"},{"naziv": "Petar Marković","datum":"13/12/2018","vreme":"09:28","lat":"-33.9301981","lng":"151.1593021","description":"manager"},{"naziv": "Mitar Mirić","datum":"13/12/2018","vreme":"09:28","lat":"-33.9301982","lng":"151.1593021","description":"manager"}]}';
        U suštini je isto, ali ovo drugo je sažeto, te stoji u jednom redu.Format im je isti da ne bude zabune.
        U suprotnom, kada su dva nezavisna niza, razdvajanje neće raditi.
        */

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
            /*Ukoliko postoje parametri daje im se vrednost, u suprotnom
            postavlja im se neka difoltna da ne bi bilo nedefinisano.*/
            let addresa = flattened[i].adresa ? "<p>Adresa: "+flattened[i].adresa+"</p>" : "<br>"; //Vrsi proveru da li postoji adresa, ako postoji, prikayuje je, ukoliko ne postoji, onda samo brejk lajn.
            let naziv = flattened[i].naziv ? "<h1>"+flattened[i].naziv+"</h1>" : "<br>";
            let ltdLng = flattened[i].lat && flattened[i].lng ? "<p>Koordinate: <br>Latitude: "+flattened[i].lat+"<br>Longitude: "+flattened[i].lng+"</p>" : "<br>";
            //map,markerData, arr
            //console.log(pinZoomed);
            if(pinZoomed){
                infowindow.setContent("<div>"+naziv+addresa+ltdLng+"</div>");
                infowindow.open(map, marker);
                pinZoomed = "";
            }
            //console.log(marker);
            /*definiše oblačić kada se klikne na određeni čunj.*/
            google.maps.event.addListener(marker, 'click', ((marker, i) => {
                return () => {
                    infowindow.setContent("<div>"+naziv+addresa+ltdLng+"</div>");
                    infowindow.open(map, marker);
                }
            })(marker, i));
            
        }

        

    }
    /*Grupiše markere.*/
    var markerCluster = new MarkerClusterer(map, markArr, {
        imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
        }
    );
}
