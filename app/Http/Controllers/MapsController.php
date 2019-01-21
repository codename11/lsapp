<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kupci;

class MapsController extends Controller
{
   public function index()
	{	$kupci = Kupci::all();
		//dd($kupci);
		$title="Mape";

		$stores = Kupci::where('id', '>', 0)->where('koordinate','NOT LIKE','')->get();

		$salons = Kupci::where('id', '>', 0)->where('koordinate','NOT LIKE','')->limit(10)->get();
		//Promenjen naziv promenljive iz salones u salons.
		$filteri = array();

		
		

		//sve dobijene kupce stavimo u niz koji se prosleđuje na VIEW za prikazivanje na mapi
		foreach ($stores as $key => $k) {


			$lat = '';
			$long = '';

			if($k->koordinate){
				$koordinate = explode(',', $k->koordinate);
				$lat = $koordinate[0];
				$long = $koordinate[1];
			}



		    $data['stores'][$key] = [
		        'id' => "".$k->id,//Dodato da id bude string.
		        'naziv' => $k->naziv,
		        'adresa' => $k->adresa,
		        'lat' => $lat,
		        'lng' => $long,
		        'id_komercijaliste' => $k->id_komercijaliste,//Promenjeno iz $k->komercijalista->komercijalista u sadasnje kako je.
		        'description' => 'store',
		    ];




		}
		//Ova dva su dodata čisto onako. Da se prikažu i druge ikonice.
		$data['stores'][3]["description"] = "salon";
		$data['stores'][4]["description"] = "salon";
		/*
		$data['salons']=$data['stores'];
		$data['salons'][0]["description"] = "salon";
		$data['salons'][1]["description"] = "salon";
		$data['salons'][2]["description"] = "salon";
		$data['salons'][3]["description"] = "salon";
		$data['salons'][4]["description"] = "salon";
		*/
		//dd($data);
		//dd(count($data['stores']));



		if($stores->count() > 0)
			array_push($filteri, 'store');
//Promenjen naziv promenljive iz salones u salons.
		if($salons->count() > 0)
			array_push($filteri, 'salon');

//-33.923036,151.259052 za ono drugo u kupci u mojoj bazi
		


	
		/*foreach ($data as $radnje) {
			foreach ($radnje as $r) {

				echo $r['id'];
			}
		}*/
		//$data = json_encode($kupci);
		//dd($data);
		//dd(gettype($data));

		return view('test1')/*Promenjeno ime u poslatom view-u iz test u test1. 
		Moj je i dalje samo test. Tako sam stavio da bih naizmenično mogao 
		da proverim razliku od view-a do view-a.
		Važno!!! Da bi radili dugmići/checkbox-ovi, treba da kez niza bude salons.*/
		->with('data', json_encode($data))
		->with('filteri', $filteri);
		//return View::make('mape/radnje');
	}


	public function setCoordinate(){

		$kupci = Kupci::where('id', '>', 0)->get();


		//za sve kupce koji nemaju koordinate dodati ih na onsvu adrese
		foreach ($kupci as $k) {

		echo $k->koordinate;
		if(!$k->koordinate){
		$coordinates = explode(',', $k->getCoordinates());


		echo $k->Naziv;
			if($k->getCoordinates()){
			$k->koordinate = $k->getCoordinates();
			$k->save();
			}

		}


		}
	}
}
