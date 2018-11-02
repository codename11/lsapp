<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* Ovaj kontroler sluzi iskljucivo 
za prikazivanje stranica. Njegove metode vracaju view-ove
za pojedine strane. */
class PagesController extends Controller
{
    public function index(){
        $title = "Welcome to Laravel!";
        //return view("pages.index", compact("title"));
        /*Ovde se navodi da se view-u koji se poziva, 
        prosledi i promenljiva ciji sadrzaj ide u jednom tagu.*/
        return view("pages.index")->with("title", $title);
    }

    public function about(){
        $title = "About us";
        return view("pages.about")->with("title", $title);
    }

    public function services(){
        /*Slican kao prethodan primer samo se prosledjuje niz(asicijativni).*/
        $data = array(
            "title" => "Services",
            "services" => ["Web design", "Programming", "SEO"]
        );
        return view("pages.services")->with($data);
    }
}
