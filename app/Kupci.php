<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kupci extends Model
{
    //
    protected $table = 'kupci';

    
    public function komercijalista()
    {
        return $this->belongsTo('App\Komercijalisti', 'ID_komercijalista');
    }

    public function grad()
    {
        return $this->belongsTo('App\Grad', 'ID_grad');
    }

    public function drzava()
    {
        return $this->belongsTo('App\Drzava', 'ID_drzava');
    }

    public function tip()
    {
        return $this->belongsTo('App\Tip', 'ID_tip_kupca');
    }
    public function klasa()
    {
        return $this->belongsTo('App\Klasa', 'ID_klasa');
    }
    public function vrsta()
    {
        return $this->belongsTo('App\Vrsta', 'ID_direktan');
    }
    public function isporucilac()
    {
        return $this->belongsTo('App\Kupci', 'ID_isporucilac');
    }

    public function izvestaji()
    {
        return $this->hasMany('App\Izvestaji', 'id_kupca')->orderBy('datum_obilaska', 'DESC');
    }


     public function getCoordinates()
    {
        //pretvaranje adrese u koordinate
        $address = $this->grad->Grad.'+'.$this->Adresa;

        $address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern
 
        $url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyBTBcnYNnLBzQA-M-3Lttly3yRc2Raog-4&sensor=false&address=$address";
 
        $response = file_get_contents($url);
 
        $json = json_decode($response,TRUE); //generate array object from the response from the web

        if($json['results'])
        return ($json['results'][0]['geometry']['location']['lat'].",".$json['results'][0]['geometry']['location']['lng']);
    }


    public function koordinate(){

        $ll = explode(',', $this->koordinate);

        if($this->koordinate)
            $koordinate = $ll[0].', '.$ll[1];       

        else
            $koordinate = NULL;

        return $koordinate;
    }
}
