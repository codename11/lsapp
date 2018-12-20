<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Fpdf;
use Sunra\PhpSimple\HtmlDomParser;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Route;

class FpdfController extends Controller
{

    public function pdf($id)
    {

        $pdf = new Fpdf();
        
        $pdf::SetMargins(10,30,10);
        $pdf::AddPage();
        
        //Pocetak prve varijante.
        //Pravi pdf od podataka iz baze.

        $post = Post::find($id);
        $postTitle = $post->title;
        $postBody = $post->body;
        $postCover = $post->cover_image;
        $route = Route::getFacadeRoot()->current()->uri();
        $name = Auth::user()->name;
        $email = Auth::user()->email;

        //Prvi par. je font, drugi bold/italic, ako je prazno onda je obican. Treci je velicina fonta.
        $pdf::SetFont('Arial','',8);//Setuje font za sad pa nadalje.
        $pdf::SetFillColor(255, 255, 153);//Setuje boju za jedan red.
        //Prvi par. je sirina celije, drugi visina, treci sadrzaj, cetvrti je da li ima bordere, peti je brejk lajn, sesti je je kako je centriran tekst unutar celije,
        $pdf::Cell(60,10,"Ime",1,0,'C',true);//Ako je true, onda se u ovom redu setue boja za taj red.
        $pdf::Cell(60,10,"Email",1,0,'C',true);
        $pdf::Cell(0,10,"Ruta",1,1,'C',true);

        $pdf::Cell(60,10,$name,1,0,'C');
        $pdf::Cell(60,10,$email,1,0,'C');
        $pdf::Cell(0,10,$route,1,1,'C');
        
        $pdf::SetFillColor(0, 255, 204);
        $pdf::Cell(60,10,"Title",1,0,'C',true);
        $pdf::Cell(60,10,"Body",1,0,'C',true);
        $pdf::Cell(0,10,"Cover_image",1,1,'C',true);

        $pdf::Cell(60,10,$postTitle,1,0,'C');//Kao par. za tekst uzima vrednost iz baze, joja je naslov posta. Gore definisano.
        $parsedHtml = HtmlDomParser::str_get_html($postBody)->plaintext;//Parsira html, jer se u bodiju koristi ckeditor.
        $document = str_replace("&nbsp;"," ",$parsedHtml);//Parsiranje se ne vrsi dobro, pa je ova linie, a i donja neophodna, stoga rucno parsiranje.
        $document1 = str_replace(". ",".\n",$document);//^Takodje.
        $pdf::MultiCell(60, 5, $document1,1,'C');//Ovo je kada ima previse teksta, pa se 'wrappuje'.
        $pdf::Image("storage/cover_images/".$postCover,130,60,70);//Postavljanje slike. Prvi par je putanja+ime+eks. slike. Drug i treci su x/y koordinate. Cetvrti je procentualno sirina slike.
        //Kraj prve varijante.

        /*//Pocetak duge varijante.
        //Pravi pdf od hardkodovanih podataka. Lici na ovu fakturu: https://invoicesimple1.wpengine.com/wp-content/uploads/2018/06/Sample-Invoice-printable.png 
        $pdf::SetFont('Arial','B',16);
        $pdf::Cell(0,10,"Stanford Plumbing & Heating",0,1,'L');

        $pdf::SetFont('Arial','',12);
        $pdf::Cell(0,10,"123 Madison drive, Seattle, Wa, 7829Q",0,1,'L');
        $pdf::Cell(0,10,"990-120-4560",0,1,'L');
        
        $pdf::Image("Plumbing-icon.png",130,10,70);
        $link = "<a href='http://www.example.com'>www.example.com</a>";//Pravljenje linka.
        $pdf::WriteHTML($link);//Naknadno ubacena funkcija posle instalacije sa composer-om ovog plugin-a. Nalazi se u C:\xampp\htdocs\lsapp\vendor\codedge\laravel-fpdf\src\Fpdf\Fpdf.php . Sluzi za setovanje/parsiranje html.
        
        $pdf::Ln(20);//Kastom odredjivanje brejk lajna. Par. je mera.
        $pdf::SetFont('Arial','B',8);
        $pdf::Cell(130,6,"BILL TO",0,0,'L');
        $pdf::Cell(30,6,"Invoice No: ",0,0,'R');
        $pdf::SetFont('Arial','',8);
        $pdf::Cell(30,6,"#INV02081",0,1,'R');
        $pdf::SetFont('Arial','',8);
        
        $pdf::Line(10, 85, 80, 85);
        $pdf::Cell(130,6,"Allen Smith",0,0,'L');
        $pdf::SetFont('Arial','B',8);
        $pdf::Cell(30,6,"Invoice Date: ",0,0,'R');
        $pdf::SetFont('Arial','',8);
        $pdf::Cell(30,6,"11/11/18",0,1,'R');
        $pdf::Cell(130,6,"87 Private st, Seattle, WA",0,0,'L');
        $pdf::SetFont('Arial','B',8);
        $pdf::Cell(30,6,"Due Date: ",0,0,'R');
        $pdf::SetFont('Arial','',8);
        $pdf::Cell(30,6,"12/01/18",0,1,'R');
        $pdf::Cell(0,6,"allen@gmail.com",0,1,'L');
        $pdf::Cell(0,6,"990-302-1898",0,1,'L');

        $pdf::Ln(10);
        
        $pdf::SetFont('Arial','B',8);
        $pdf::Cell(100,4,"DESCRIPTION","LT",0,'C');//Cetvrti par. granica left i top.
        $pdf::Cell(30,4,"QTY/HR","T",0,'C');//Cetvrti par. granica top.
        $pdf::Cell(30,4,"UNIT PRICE","T",0,'C');//Cetvrti par. granica top.
        $pdf::Cell(30,4,"TOTAL","TR",1,'C');//Cetvrti par. granica top i right.

        $pdf::SetFont('Arial','',8);
        $pdf::Cell(100,4,"Installed new kitchen sink(hours)","LT",0,'C');
        $pdf::Cell(30,4,"3","LT",0,'C');
        $pdf::Cell(30,4,"50.0","LT",0,'C');
        $pdf::Cell(30,4,"150.0","LTR",1,'C');

        $pdf::SetFillColor(245, 245, 245);
        $pdf::Cell(100,4,"Toto sink","LT",0,'C',true);
        $pdf::Cell(30,4,"1","LT",0,'C',true);
        $pdf::Cell(30,4,"500.0","LT",0,'C',true);
        $pdf::Cell(30,4,"500.0","LTR",1,'C',true);

        $pdf::Cell(100,4,"Worcester greenstar magnetic system filter","LT",0,'C');
        $pdf::Cell(30,4,"1","LT",0,'C');
        $pdf::Cell(30,4,"190.0","LT",0,'C');
        $pdf::Cell(30,4,"190.0","LTR",1,'C');

        $pdf::SetFillColor(245, 245, 245);
        $pdf::Cell(100,4,"Nest smart thermostat","LT",0,'C',true);
        $pdf::Cell(30,4,"1","LT",0,'C',true);
        $pdf::Cell(30,4,"250.0","LT",0,'C',true);
        $pdf::Cell(30,4,"250.0","LTR",1,'C',true);

        $pdf::Cell(100,4,"Worcester greenstar 30i","LT",0,'C');
        $pdf::Cell(30,4,"1","LT",0,'C');
        $pdf::Cell(30,4,"1500.0","LT",0,'C');
        $pdf::Cell(30,4,"1500.0","LTR",1,'C');

        $pdf::Cell(100,4,"","LT",0,'C',true);
        $pdf::Cell(30,4,"","LT",0,'C',true);
        $pdf::Cell(30,4,"","LT",0,'C',true);
        $pdf::Cell(30,4,"","LTR",1,'C',true);

        $pdf::Cell(100,4,"","LT",0,'C');
        $pdf::Cell(30,4,"","LT",0,'C');
        $pdf::Cell(30,4,"","LT",0,'C');
        $pdf::Cell(30,4,"","LTR",1,'C');

        $pdf::Cell(100,4,"","LT",0,'C',true);
        $pdf::Cell(30,4,"","LT",0,'C',true);
        $pdf::Cell(30,4,"","LT",0,'C',true);
        $pdf::Cell(30,4,"","LTR",1,'C',true);

        $pdf::Cell(100,4,"","LT",0,'C');
        $pdf::Cell(30,4,"","LT",0,'C');
        $pdf::Cell(30,4,"","LT",0,'C');
        $pdf::Cell(30,4,"","LTR",1,'C');

        $pdf::Cell(100,4,"","LT",0,'C',true);
        $pdf::Cell(30,4,"","LT",0,'C',true);
        $pdf::Cell(30,4,"","LT",0,'C',true);
        $pdf::Cell(30,4,"","LTR",1,'C',true);

        $pdf::Cell(100,4,"","LTB",0,'C');
        $pdf::Cell(30,4,"","LTB",0,'C');
        $pdf::Cell(30,4,"","LTB",0,'C');
        $pdf::Cell(30,4,"","LTRB",1,'C');//Cetvrti par. granica left, top, right i bottom.

        $pdf::SetFont('Arial','',8);
        $pdf::Cell(100,60,"Thank you for your business!",0,0,'C');
        
        $pdf::Cell(60,6,"SUBTOTAL",0,0,'R');
        $pdf::Cell(30,6,"2590.00",0,1,'R');
        $pdf::Line(170, 173, 200, 173);
        
        $pdf::Cell(160,6,"DISCOUNT",0,0,'R');
        $pdf::Cell(30,6,"50.00",0,1,'R');
        $pdf::Line(170, 179, 200, 179);

        $pdf::Cell(160,6,"SUBTOTAL LESS DISCOUNT",0,0,'R');
        $pdf::Cell(30,6,"2540.00",0,1,'R');
        $pdf::Line(170, 185, 200, 185);

        $pdf::Cell(160,6,"TAX RATE",0,0,'R');
        $pdf::Cell(30,6,"12%",0,1,'R');
        $pdf::Line(170, 191, 200, 191);

        $pdf::Cell(160,6,"TOTAL TAX",0,0,'R');
        $pdf::Cell(30,6,"304.80",0,1,'R');
        $pdf::Line(170, 197, 200, 197);

        $pdf::SetFont('Arial','B',10);
        $pdf::Cell(160,6,"BALANCE DUE",0,0,'R');
        $pdf::Cell(30,6,"$ 2,844.80",0,1,'R');
        $pdf::Line(170, 203, 200, 203);

        $pdf::SetFont('Arial','B',8);
        $pdf::Cell(120,20,"Terms & Instructions",0,1,'L');
        $pdf::Line(10, 217, 70, 217);
        
        $pdf::SetFont('Arial','',8);
        $pdf::Cell(120,0,"Please pay within 2 days by PayPal (bob@stanfordplumbing.com)",0,1,'L');
        $pdf::Cell(120,8,"Installed products have 5 year warranty.",0,0,'L');
        //Kraj druge varijante.
        */
        $pdf::Output();
        exit;
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
