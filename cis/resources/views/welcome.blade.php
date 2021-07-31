@extends('layouts.layout')

@section('content')
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <img id="img1.1" src="/img/img1.1.png" alt="">
        <div class="title m-b-md">
            Construction Inspection System <br />
            helps make things easy
        </div>
        

    </div>
</div>
@endsection