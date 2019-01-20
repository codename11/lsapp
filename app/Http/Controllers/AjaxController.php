<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use DB;
class AjaxController extends Controller {

   public function post(Request $request){
    
        if(Auth::user()){
            $name = Auth::user()->name;
            
        }
        else{
            $name = "Gost";
        }
        //$request->message
        //$request->message=$name;
        $posts = DB::select("SELECT * FROM posts");
        $user = User::all();
        //$myJSON = json_encode($user[0]);
        /*Ovde se isprobava uslovljavanje sa vrednoscu iscitanog checkbox-a, 
        te zavisno od te vrednosti, bice prikazana razlicita vrednost iz baze.*/
        /*if($request->message == "radnja"){
            $myJSON = json_encode($user[0]);
        }
        else if($request->message == "salon"){
            $myJSON = json_encode($user[1]);
        }*/
        /* Zamisljeni podaci od servera. */
        $data = '
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

        //$jasonArr = new stdClass;
        $jasonArr = array();
        $myJSON = json_decode($data);
        $keys = array();
        foreach($myJSON as $row => $val) {
            //Čupa podnazive iz objekta.Ono radnja i sl..
            array_push($keys,$row);
        }
        //$jasonArr->stores=$myJSON->stores;
        for($i=0;$i<count($request->message);$i++){
            /*Upoređuje šta je čekirano sa onim 
            čupanim podnazivima od gore pomenutim.
            Ako je isto, onda ubacuje taj red, radnja==radnja*/
            if($request->message[$i]==$keys[$i]){
                //$jasonArr->{$keys[$i]}=$myJSON->{$keys[$i]};
                $jasonArr[$i]=$myJSON->{$keys[$i]};
            }

        }
        
        /*Response koji se šalje sa servera ukoliko je uspešna pretraga.*/
        $response = array(
            'status' => 'success',
            'msg' => $jasonArr,
        );
      
        //return view("/test")->with(compact("data", "name"));
        //return view("/ajax")->with(compact("response", "name"));
        return response()->json($response); 
   }
}