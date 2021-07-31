@extends('layouts.app')

@section('content')

<div style="text-align:center;">
<a href="/home"style="display: inline;">Home</a> | 
<a href="/projects"style="display: inline;">Projects</a> | 
<a href="/projects/{{ $construct->projectID }}"style="display: inline;">Collections</a> | 
<a href="/projects/collections/{{ $construct->collectionID }}"style="display: inline;">Constructs</a>
</div>

<div class="wrapper construct-details">
    <h1>Inspection For: {{ $construct->constructName }}</h1>
    <p>Construct Information:</p>
    <div class="row">
        <div class="col"><p>Name: {{ $construct->constructName }}</p></div>
        <div class="col"><p>Type: {{ $construct->constructType }}</p></div>
        <div class="col"><p>Manager: {{ $manager->name }}</p></div>
    </div>
    <br>
    @if($construct->latitude != null && $construct->longitude != null)
    <div class="row">
        <div class="col"><p style="display: inline;">latitude: {{ $construct->latitude }}</p></div>
        <div class="col"><p style="display: inline;">longitude: {{ $construct->longitude }}</p></div>
        <div class="col"><a href="https://maps.google.com/?q={{ $construct->latitude }},{{ $construct->longitude }}" target="_blank">
            <but class="btn btn-info">Go to</but>
        </a></div>
    </div>
    @endif
    <br>
    <div class="text-center"><p style="display: inline;">Current Status: </p>
    @if($construct->status == 'a')<p style="color:green; display: inline;">Accepted</p>
    @elseif($construct->status == 'r')<p style="color:red; display: inline;">Rejected</p>
    @else<p style="color:gray; display: inline;">Uninspected</p>@endif</div>
    
    @if($construct->status == 'u')
    @else
    <hr>
    <p class="text-center">Report Body:</p>
    <p class="text-center">{{ $construct->report }}</p>
    <br>
    <p>Reported Submited By: {{ $reporter->name }}</p>
    <p class="text-center">Report Submited On: {{ $construct->updated_at }}</p>
    @endif

    @if( $construct->managerID == $user->id )
    <form action="{{ route('constructs.destroy', $construct->constructID) }}" method="POST">
        @csrf
        @method('DELETE') <!-- changes the method for the form from post to delete -->
        <button class="btn btn-danger">Delete Construct</button>
    </form>
    @endif
</div>

        @if($construct->status == 'u')
            <div class="text-center"><a href="/projects/collections/constructs/report/{{ $construct->constructID }}">
            <button class="btn btn-info">
            Start Report
            </button></a></div>
        @else
            @if($construct->managerID == $user->id)
        <div class="text-center"><a href="/projects/collections/constructs/report/{{ $construct->constructID }}">
            <button class="btn btn-info">
            Change Report
            </button></a></div>
            @endif
        @endif

@endsection