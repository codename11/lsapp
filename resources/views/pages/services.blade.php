@extends("layouts.app")
<!--Ovde se navodi iz kog se direktorijuma uzima template. -->

@section("content")
    <h1>{{$title}}</h1>
    @if(count($services) > 0)
    <ul class="list-group">
        @foreach($services as $service)
            <li class="list-group-item">{{$service}}</li>
        @endforeach
    </ul>
    @endif
@endsection
<!--Ovo oznacava sta sve obuhvata template. -->