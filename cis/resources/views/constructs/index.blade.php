@extends('layouts.app')

@section('content')

<div class="wrapper construct-index">
    <h1>Construct List</h1>
    <p>these are the constructs {{ $user->name }} currently has acces to</p>
        @foreach($constructs as $construct)
            <div class="construct-item">
                <img src="/img/magGlass.png" alt="inspect icon">
              <h4>{{ $construct->constructName }}</a></h4>
            </div>
        @endforeach
</div>

        


@endsection