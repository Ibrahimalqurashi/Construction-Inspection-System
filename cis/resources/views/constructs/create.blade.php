@extends('layouts.app')

@section('content')
<div class="wrapper create-construct">
    <h1>Add a new Construct</h1>
    <form action="/projects/collections/constructs" method="POST">
        @csrf
        
        <label for="constructName">constructs Name:</label>
        <input type="text" name="constructName" id="constructName" required>

        <label for="constructType">constructs Type:</label>
        <input type="text" name="constructType" id="constructType">
    
        <label for="latitude">constructs latitude:</label>
        <input type=number step=any name="latitude" id="latitude" min="-90" max="90">
        
        <label for="longitude">constructs longitude:</label>
        <input type=number step=any name="longitude" id="longitude" min="-90" max="90">
        
        <input hidden type="text" name="projectID" id="projectID" value="{{ $pid }}">
        <input hidden type="text" name="collectionID" id="collectionID" value="{{ $cid }}">

        <br>
        <input type="submit" value="Add Construct">
    </form>
</div>
@endsection