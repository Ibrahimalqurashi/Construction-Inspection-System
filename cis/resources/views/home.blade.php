@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div style="text-align:center;">
            <a href="/projects"style="display: inline;">Projects</a>
        </div>
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome {{ $user->name }}
                    You are logged in!
                    <br><br>
                    <div class="text-center">
                    <a href="/projects"><button class="btn btn-info">Go to Projects</button></a>
                    </div>
                    <br>
                    <br>
                    @if(is_null( session('msg')))
                    @else
                    <p class="msg alert alert-danger">! Erorr: {{ session('msg') }}</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
