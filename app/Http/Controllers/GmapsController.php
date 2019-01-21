<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

use Illuminate\Support\Facades\Auth;

class GmapsController extends Controller
{

    public function test(Request $request,User $user){
        
        $data = new \stdClass();
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
        }';*/
    $data = '{"stores":[{"id":"1","naziv":"Tehnokom","adresa":"Knez Mihajlova 82","lat":"44.665192","lng":"20.931357","id_komercijaliste":"Miloš Lovrić","description":"store"},{"id":"2","naziv":"Termo Fluid","adresa":"Knez Mihajlova 86","lat":"-33.923036","lng":"151.259052","id_komercijaliste":"Dejan Ilić","description":"store"},{"id":"3","naziv":"Vodoterm","adresa":"Irene Zeković 31","lat":"-34.028249","lng":"151.157507","id_komercijaliste":"Dejan Ilić","description":"store"}],"salons":[{"id":"4","naziv":"Home Decor System","adresa":"Kolarska 117","lat":"-33.80010128657071","lng":"151.28747820854187","id_komercijaliste":"Dejan Ilić","description":"salon"},{"id":"5","naziv":"Dobrić","adresa":"Obilazni put bb","lat":"-33.950198","lng":"151.259302","id_komercijaliste":"Dejan Ilić","description":"salon"}],"managers":[{"naziv": "Dragan Petrović","datum":"18/12/2018","vreme":"13:53","lat":"-33.7301981","lng":"151.1593021","description":"manager"},{"naziv": "Petar Marković","datum":"13/12/2018","vreme":"09:28","lat":"-33.9301981","lng":"151.1593021","description":"manager"},{"naziv": "Mitar Mirić","datum":"13/12/2018","vreme":"09:28","lat":"-33.9301982","lng":"151.1593021","description":"manager"}]}';
    //dd($data);
    //dd(gettype($data));
    if(Auth::user()){
            $name = Auth::user()->name;
        }
        else{
            $name = "Gost";
        }
        
        return view("/test")->with(compact("data", "name"));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
