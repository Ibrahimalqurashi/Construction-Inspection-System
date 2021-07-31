@extends('layouts.app')

@section('content')
<div class="wrapper create-construct">
    <h1>Create a new Project</h1>
    <form action="/projects" method="POST">
        @csrf
        <label for="name">What would you like this project to be called</label>
        <input type="text" name="name" id="name" required>

        <label for="sponsor">who is the projects sponsor:</label>
        <input type="text" name="sponsor" id="sponsor">
        
        <br>
        <input type="submit" value="Create Project">
    </form>
</div>
@endsection