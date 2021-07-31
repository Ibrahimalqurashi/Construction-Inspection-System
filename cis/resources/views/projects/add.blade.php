@extends('layouts.app')

@section('content')
<div class="wrapper create-construct">
    <h1>Add a new Inspector to: {{ $project->name }}</h1>
    <form action="/projects/add" method="POST">
        @csrf
        <label for="email">Inspectors Email</label>
        <input type="email" name="email" id="email">

        <input hidden type="text" name="proID" id="proID" value="{{ $project->id }}">
        
    <br>
        <input type="submit" value="Add inspector">
    </form>
</div>
@endsection