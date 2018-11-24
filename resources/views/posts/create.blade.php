@extends("layouts.app")
<!--Ovo je forma preko koje se vrsi unos. 
    Kontroler joj je PagesController, metoda create().-->
@section("content")
    <h1>Create Post</h1>
    <!--Akcija salje sve iz forme 
    PostController-ovoj store funkciji, 
    pored toga salje jos i ajdi posta
    da bise znalo koji post se edituje.-->
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class' =>  'form-control', 'placeholder' => 'Title'])}}
    </div>

    <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', '', ['id' =>'ckeditor'/*'article-ckeditor'*/, 'class' =>  'form-control ckeditor', 'placeholder' => 'Body text'])}}
    </div>

    <div class="form-group">
        {{Form::file('cover_image')}}
    </div> 
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
    <!--
    Original:
    https://laravelcollective.com/docs/master/html#opening-a-form
    -->
@endsection