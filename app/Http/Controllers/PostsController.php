<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;//Biblioteka za pisanje klasicnih upita.
/*Kada god se poziva 'Post' kont. koji inace sluzi 
za pojedinacni post, dobija se i parametri koji su 
mu prosledjeni. */
class PostsController extends Controller
{

    public function __construct()
    {   /*Postavi autorizaciju za sve osim za index i show, 
        odnosno za pronalazenje i prikazivanje.*/
        $this->middleware('auth')->except(['index', 'show']);
        /*Ovo znaci da ce traziti autorizaciju 
        za sve operacije, osim za indeksiranje 
        i prikazivanje postova. Dakle svako moze da 
        gleda postove, ali samo trenutno ulogovani 
        korisnik moze editovati i brisati 
        i to samo svoje postove.*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   /*Ova metoda sluzi da prikaze spisak postova
         na blog strani.Podatke, ukljucujuci id-jeve 
         uzima od modela 'Post'.
         Ako se klikne na neki od linkova 
         onda deluje druga metoda 'show()' 
         kojoj se prosleduje id onoga na sta je kliknuto,
         i prikazuje odredjeni post. 
         Linkovima se u hrefu prosledjuje id preko geta.*/
        /*return Post::all(); 
        //Prikazuje sve postove zajedno sa naslovom istih
        i onim tajmstempovima i ostalim stvarima.*/
        //return $post = Post::where("title", "Post Two")->get();
        //$posts = Post::all();//'vata sve podatke iz modela 'Post'.
        //$posts = Post::orderBy("title", "desc")->get();
        /*Donji i gornji nacin pisanja upita je isti. 
        Za donji se koristi biblioteka 'DB', a za gornji 'eloquent'.*/
        //$posts = DB::select("SELECT * FROM posts");
        //Ovde vrsi limit kao u mysql-u.
        //$posts = Post::orderBy("title", "desc")->take(1)->get();
        /*Ovde se vrsi stranicenje. 
        Parametar je brojka prikazanih stavki po stranici.*/
        /*Upit: prikazi sve, poredjaj po created_at tabeli,
        rasruce.*/
        $posts = Post::orderBy("created_at", "desc")->paginate(2);
        
        return view("posts.index")->with("posts", $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'body' => 'required',
                'cover_image' => 'image|nullable|max:1999'
            ]
        );

        //Handle file upload
        if($request->hasFile('cover_image')){
            // Get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            //Skladisti aploadovane slike u app/storage/app/public/samaSlika.jpg
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }/**/
        else{
            $fileNameToStore = 'noimage.jpg';
        }
        // Create Post
        /*Belezenje vrednosti polja iz forme za 
        upisivanje u bazu.*/
        $post = new Post;
        /*Kada se pozove ova funkcija,
        uzmi sta ima iz inputa sa imenom title.*/
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        
        //Ovde se redirektuje po uspesnom postovanju.
        return redirect('/posts')->with('success', 'Post created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   /*Mislim da metoda 'index' nekako*/
        //echo $id;
        /*Metoda find() za model Post nalazi sve vezano za post 
        ciji je parametar(id) se nalazi u promenljivoj $id.
        Dakle 'prikazi mi post sa ajdijem iz $id'.*/
        $post = Post::find($id);/*Poziva 'Post' model
        kao parametar prosledjuje mu $id. 
        Time mu govori da u modelu 'Post' nadje ajdi-jeve(sve).*/
        //Ovo prikazuje sadrzaj u obliku json-a.
        /*Poziva model koji se nalazi u posts>show 
        i prosledjuje mu par. $post koji sadrzi odredjeni red.*/
        return view("posts.show")->with("post", $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for correct user
        /*Proverava da li je trenutni korisnik onaj 
        ciji su postovi, ako jeste, prikazace mu edit dugme, 
        ako nije, nece mu prikazati.*/
        if(auth()->user()->id !== $post->user_id){
            return redirect("/posts")->with("error", 'Unauthorized Page');
        }

        return view("posts.edit")->with("post", $post);
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
        $this->validate(
            $request,
            [
                'title' => 'required',
                'body' => 'required'
            ]
        );

        //Handle file upload
        if($request->hasFile('cover_image')){
            // Get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            //Skladisti aploadovane slike u app/storage/app/public/samaSlika.jpg
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        
        // Create Post
        /*Belezenje vrednosti polja iz forme za 
        upisivanje u bazu.*/
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        $check = $request->file('cover_image');

        $stara_slika = $post->cover_image;

        if($check){

            if($stara_slika==="noimage.jpg"){
                $post->cover_image = $fileNameToStore;
            }
            else{
                Storage::delete('public/cover_images/' . $post->cover_image);
                $post->cover_image = $fileNameToStore;
            }

        }
        else{

            if($stara_slika==="noimage.jpg"){
                $post->cover_image = $stara_slika;
            }
            else{
                Storage::delete('public/cover_images/' . $post->cover_image);
                $post->cover_image = "noimage.jpg";
            }

        }

        $post->save();
        //dd($post);
         /*Izvrsice npr. edit, prikazace ovo 
        i nece redirektovati.*/
        //dd(request()->all());
        /*Prikazace sadrzaj sabmitovanih polja
         iz forme.*/
        //Ovde se redirektuje po uspesnom postovanju.
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // Check for correct user
        /*Proverava da li je trenutni korisnik onaj 
        ciji su postovi, ako jeste, prikazace mu delete dugme, 
        ako nije, nece mu prikazati.*/
        if(auth()->user()->id !== $post->user_id){
            return redirect("/posts")->with("error", 'Unauthorized Page');
        }

        if($post->cover_image !== "noimage.jpg"){
            // Delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post -> delete();
        return redirect('/posts')->with('success', 'Post deleted');

    }
}
