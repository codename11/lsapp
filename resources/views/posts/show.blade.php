@extends("layouts.app")

@section("content")

    <?php 
    
        foreach ($postx as $value) 
            $postsIds[] = $value;

        $cur_index = array_search($post->id, $postsIds);
        $len = count($postsIds);
        
        $prev = 0;
        $next = 0;

        if($cur_index+1!=$len){
            $prev = $postsIds[$cur_index+1];
            
        }
        else{
            $prev = $postsIds[0];
        }
        
        if($cur_index-1>=0){
            $next = $postsIds[$cur_index-1];
        }
        else{
            $next = $postsIds[$len-1];
        }
   
    ?>

    <a href="/posts" class="btn btn-light">Go Back</a>
    <div style="float: right;text-align:center;">
    <label>Projects</label><br>
        <a href="/posts/{{$prev}}" class="btn btn-dark">Prev</a>
        <a href="/posts/{{$next}}" class="btn btn-dark">Next</a>
    </div>
    <h1>{{$post->title}}</h1>
    <!--Ovde se prikazuje aploadovana slika kao thumnail.-->
    <img style="width: 100%;margin-bottom: 20px;" src="/storage/cover_images/{{$post->cover_image}}">
    
    <div>
        <!--{{$post->body}} Ako ovako ostavimo, 
            ckeditor nece parsovati html tagove.
        U donjem primeru se to resava.
        Ovde se nalazi ckeditor:
        https://github.com/unisharp/laravel-ckeditor-->
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    <!--Gleda koji je trenutni korisnik
    i samo za njegove postove se prikazuje edit i delete.-->
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
            <!--Method 'spoofing' jer nema metoda 'delete'.-->
            {!!Form::open(["action" => ["PostsController@destroy", $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
            <!--Jednostruke viticaste zagrade za close.-->
        @endif
    @endif
    <br><a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
 
    <br>Jedan post: {{$post}}
    <hr>
    Id-jevi svih postova: {{$postx}}
@endsection