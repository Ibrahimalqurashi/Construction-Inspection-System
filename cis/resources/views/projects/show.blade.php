@extends('layouts.app')

@section('content')

<div style="text-align:center;">
<a href="/home"style="display: inline;">Home</a> | 
<a href="/projects"style="display: inline;">Projects</a>
</div>

<div class="wrapper construct-index">
    <h1>{{ $project->name }}</h1>

    @if( $project->managerID == $user->id)
    <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
        @csrf
        @method('DELETE') <!-- changes the method for the form from post to delete -->
        <button class="btn btn-danger">Delete Project</button>
    </form>
    @endif

    <p>under management of {{ $manager->name }}</p>
    <p>Project Sponsor is: {{ $project->sponsorName }}</p>
    <p>these are the collections {{ $user->name }} currently has acces to</p>
        
    @if( $user->id == $project->managerID)
    <div class="row text-center">
          <div class="col">
          <a href="collections/create/{{$project->id}}">
            <button class="btn btn-info">
            Create new Collection
            </button></a>
          </div>
          <div class="col">
          <a href="add/{{ $project->id }}">
            <button class="btn btn-info">
              Add Inspector to this project
            </button></a>
          </div>
        </div>
        @endif
    <hr>
        @if(is_null( session('msg')))

        @else
            <p class="msg alert alert-success">{{ session('msg') }}</p><hr>
        @endif
       
        @foreach($collections as $collection)
            <div class="construct-item">
                <img src="/img/table.png" alt="inspect icon">
              <h4><a href="collections/{{ $collection->collectionID }}">{{ $collection->collectionName }}</a></h4>
            </div>
        @endforeach
</div>

        


@endsection