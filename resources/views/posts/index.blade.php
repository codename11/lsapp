@extends("layouts.app")

@section("content")
    <h1>Posts</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card card-body bg-light p-3 mb-3">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <!--Ovde se prikazuje aploadovana slika kao thumnail.-->
                        <img style="width: 100%;" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <!--Ovde u linku se salje kontroleru, 
                                preko hrefa salje id(ajdi).
                                Prikazuje kad je pisano i ko je pisao.-->
                            <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                    </div>
                </div>
                
            </div>
        @endforeach
        {{$posts->links()}}<!--Ovo je za paginaciju.-->
    @else
        <p>No posts found</p>
    @endif
@endsection