@extends("layouts.app")
<!--Ovde se navodi iz kog se direktorijuma uzima template. -->

@section("content")
<!--Promenljiva title dobija vrednost 
    iz svoje metode u kontroleru(PagesController). -->
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>This is laravel application from the "Laravel From Scratch" Youtube series.</p>
        <p>
            <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
            <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
        </p>
    </div>
    @endsection
<!--Ovo oznacava sta sve obuhvata template. -->