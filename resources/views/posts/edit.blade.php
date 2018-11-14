@extends("layouts.app")
<!--Ovo je forma preko koje se vrsi unos. 
    Kontroler joj je PagesController, metoda create().-->
@section("content")
    <h1>Edit Post</h1>
    <!--Akcija salje sve iz forme 
    PostController-ovoj update funkciji, 
    pored toga sajle jos i ajdi posta
    da bise znalo koji post se edituje.-->
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $post->title, ['class' =>  'form-control', 'placeholder' => 'Title'])}}
    </div>

    <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', $post->body, ['id' =>'article-ckeditor', 'class' =>  'form-control', 'placeholder' => 'Body text'])}}
    </div>

    <div class="form-group">
        {{Form::file('cover_image')}}
    </div> 

    <!--Method 'spoofing' jer nema metoda 'update', odnosno 'PUT'.-->
    {{Form::hidden('old_image',$post->cover_image)}}
    {{Form::hidden('_method', 'PUT')}}
    <!--Gornje je isto kao i ovo{{method_field("PUT")}}
    i ovo <input name="_method" type="hidden" value="PUT"> -->
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
    <!--
    Original:
    https://laravelcollective.com/docs/master/html#opening-a-form
    -->
@endsection