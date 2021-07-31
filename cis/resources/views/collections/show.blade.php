@extends('layouts.app')

@section('content')

<div style="text-align:center;">
<a href="/home"style="display: inline;">Home</a> | 
<a href="/projects"style="display: inline;">Projects</a> | 
<a href="/projects/{{ $collection->projectID }}"style="display: inline;">Collections</a>
</div>

<div class="wrapper construct-index">
    <h1>{{ $collection->collectionName }}</h1>
    
    @if( $collection->managerID == $user->id)
    <form action="{{ route('collections.destroy', $collection->collectionID) }}" method="POST">
        @csrf
        @method('DELETE') <!-- changes the method for the form from post to delete -->
        <button class="btn btn-danger">Delete Collection</button>
    </form>
    @endif

    <p>these are the constructs {{ $user->name }} currently has access to</p>
    
    @if( $user->id == $collection->managerID)
    <div class="row text-center">
          <div class="col">
          <a href="constructs/create/{{$collection->collectionID}}">
            <button class="btn btn-info">
            Add Construct
            </button></a>
          </div>
          <div class="col">
          <a href="constructs/upload/{{$collection->collectionID}}">
            <button class="btn btn-outline-success">
              Upload Excel Sheet
            </button></a>
          </div>
        </div>
    @endif

        <hr>
        @if(is_null( session('msg')))

        @else
            <p class="msg alert alert-success">{{ session('msg') }}</p><hr>
        @endif

        

        @if(count($constructs) == 0)
          @if($user->id == $collection->managerID)
          <p class="text-center">Collection is Empty Please Add Constructs</p>
          @else
          <p class="text-center">This Collection Currently has no Constructs</p>
          @endif
        @else

        <p class="text-center">Current Progress: {{round($precentage, 2)}}%</p>
        <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{$precentage}}%;" aria-valuenow={{$precentage}} aria-valuemin="0" aria-valuemax="100">{{round($precentage, 2)}}%</div>
        </div>
        
        <br>

        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped">
              <thead>
                <tr class="text-center bg-info text-light">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>latitude</th>
                  <th>longitude</th>
                  <th>Precentage</th>
                  <th>Status</th>
                  <th>More</th>
                  @if( $collection->managerID == $user->id )
                  <th>Delete</th>  
                  @endif
                </tr>
              </thead>
              <tbody>
              
              @foreach($constructs as $construct)
                <tr class="text-center">
                <td>{{ $construct->constructID }}</td>
                  <td>{{ $construct->constructName }}</td>
                  <td>{{ $construct->constructType }}</td>
                  <td>{{ $construct->latitude }}</td>
                  <td>{{ $construct->longitude }}</td>
                  <td>{{ round(100/count($constructs), 2) }}%</td>
                  @if($construct->status == 'a')<td style="color:green; font-weight: bold;">Accepted</td>
                  @elseif($construct->status == 'r')<td style="color:red; font-weight: bold;">Rejected</td>
                  @else<td style="color:gray">Uninspected</td>@endif
                  <td><a href="constructs/{{ $construct->constructID }}"><button class="btn btn-info">More</button></a></td>
                  @if( $collection->managerID == $user->id )
                  <td>
                    <form action="{{ route('constructs.destroy', $construct->constructID) }}" method="POST">
                    @csrf
                    @method('DELETE') <!-- changes the method for the form from post to delete -->
                    <button class="btn btn-danger">Delete</button>
                    </form>
                  </td>  
                  @endif
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endif
        
</div>

        


@endsection