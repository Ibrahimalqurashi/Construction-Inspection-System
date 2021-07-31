@extends('layouts.app')

@section('content')
<div class="wrapper create-construct">
    <h1>Construct Report</h1>
    <p>Construct Name: {{ $construct->constructName }}</p>
        <p>Construct Type: {{ $construct->constructType }}</p>
    <form action="/projects/collections/constructs/report" method="POST">
        @csrf
       
        <lable>Current Status: </lable>
        @if($construct->status == 'a')<p style="color:green; display: inline;">Accepted</p>
        @elseif($construct->status == 'r')<p style="color:red; display: inline;">Rejected</p>
        @else<p style="color:gray; display: inline;">Uninspected</p>@endif
        
        <label for="status">Select the Constructs status:</label>
        <select name="status" id="status">
            <option value="a" style="color:green">Accepted</option>
            <option value="r" style="color:red">Rejected</option>
        </select>

        <label for="report">Report Body:</label>
        <textarea name="report" id="report" cols="60" rows="5">{{ $construct->report }}</textarea>
        
        <input hidden type="text" name="id" id="id" value="{{ $construct->constructID }}">

        <br>
        <input type="submit" value="Submit Report">
    </form>
</div>
@endsection