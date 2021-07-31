@extends('layouts.app')

@section('content')
<div class="wrapper create-construct">
    <h1>Create a new Collection</h1>
    <form action="/projects/collections" method="POST">
        @csrf
        <label for="collectionName">What would you like this Collection to be called</label>
        <input type="text" name="collectionName" id="collectionName" required>

        <label for="constructors">who is the projects constructors:</label>
        <input type="text" name="constructors" id="constructors">
        <br>

        <input hidden type="text" name="projectID" id="projectID" value="{{ $id }}">

        <input type="submit" value="Create Collection">
    </form>
</div>
@endsection