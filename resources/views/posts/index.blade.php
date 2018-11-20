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
    1.count: {{$posts->count()}}<br>
    2.currentPage: {{$posts->currentPage()}}<br>
    3.firstItem: {{$posts->firstItem()}}<br>
    4.hasMorePages: {{$posts->hasMorePages()}}<br>
    5.lastItem: {{$posts->lastItem()}}<br>
    6.lastPage: {{$posts->lastPage()}}<br>
    7.nextPageUrl: {{$posts->nextPageUrl()}}<br>
    8.onFirstPage: {{$posts->onFirstPage()}}<br>
    9.perPage: {{$posts->perPage()}}<br>
    10.previousPageUrl: {{$posts->previousPageUrl()}}<br>
    11.total: {{$posts->total()}}<br>
    
@endsection