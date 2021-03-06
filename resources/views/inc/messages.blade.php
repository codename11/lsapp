<!--Ovo je view za prikazivanje poruka, 
    error i success po sabmitovanju forme.
    Poruke, interno se dobijaju od laravela.
    Kreirano od strane mene-->
@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif