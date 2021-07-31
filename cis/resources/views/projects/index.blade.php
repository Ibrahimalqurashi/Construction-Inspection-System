@extends('layouts.app')

@section('content')

<div style="text-align:center;">
<a href="/home"style="display: inline;">Home</a> 
</div> 

<div class="wrapper construct-index">
    <h1>Project List</h1>
    <a href="projects/create">
    <button  class="btn btn-info">Create new Project</button></a>
    <br>
    <br>
    <p>these are the Projects {{ $user->name }} currently has access to</p>

        
        <hr>
        @if(is_null( session('msg')))

        @else
            <p class="msg alert alert-success">{{ session('msg') }}</p><hr>
        @endif
        

        @foreach($projects as $project)
            <div class="construct-item">
                <img src="/img/magGlass.png" alt="inspect icon">
              <h4><a href="projects/{{ $project->id }}">{{ $project->name }}</a></h4>
            </div>
        @endforeach
</div>

        


@endsection