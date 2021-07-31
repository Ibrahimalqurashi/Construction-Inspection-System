<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Projects;
use App\Collections;
use App\Constructs;

class ConstructController extends Controller
{

    // this method makes all pages here reqire a login
    public function __construct(){
        $this->middleware('auth');
    }

    // used in learning
    // public function index(){
    
    //     $constructs = Constructs::all();
    //     $user = auth()->user();
    //     $constructs = Constructs::orderBy('type', 'desc')->get();
    //     $constructs = Constructs::where('type', 'electric')->get();
    //     $constructs = Constructs::latest()->get();

    //     return view('constructs.index', [
    //         'constructs' => $constructs,
    //         'user' => $user
    //         ]);
    // }

    public function access($userID, $projectID){

        $user = User::findOrFail($userID);
        $projectIDs = explode(":", $user->projects);

        $project = Projects::findOrFail($projectID);

        foreach($projectIDs as $ids){
            if($ids == $project->id){
                return true;
            }if($user->id == $project->managerID){
                return true;
            }
        }
        return false;
    }

    public function show($id){

        $user = auth()->user();
        $construct =  Constructs::findOrFail($id);
        $pID = $construct->projectID;
        $access = $this->access($user->id, $pID);
        $manager = User::findOrFail($construct->managerID);
        $reporter = null;
        if($construct->status != 'u'){
            $reporter = User::findOrFail($construct->reporterID);}

        if($access){
            return view('constructs.show', [
                'construct'=> $construct,
                'manager' => $manager,
                'user' => $user,
                'reporter' => $reporter
                 ]);
        }else{
            return redirect()->route('home')->with('msg', 'You Do not have Access to This Construct');
        }
    }

    public function create($id){

        $user = auth()->user();
        $collection =  Collections::findOrFail($id);
        
        if($collection->managerID == $user->id){
            return view('constructs.create', [
                'pid' => $collection->projectID,
                'cid' => $collection->collectionID
            ]);
        }else{
            return redirect()->route('home')->with('msg', 'You Are not the Manager of This Project, you cannot add to it');
        }
    }

    public function store(){
        
        $collectionID = request('collectionID');

        $user = auth()->user();
        $managerID = $user->id;

        $construct = new Constructs();

        $construct->constructName = request('constructName');
        $construct->constructType = request('constructType');
        $construct->managerID = $managerID;
        $construct->projectID = request('projectID');
        $construct->collectionID = request('collectionID');
        $construct->latitude = request('latitude');
        $construct->longitude = request('longitude');

        $construct->save();

        return redirect()->route('collections.show', ['id' => $collectionID])->with('msg', 'You have successfully added a new Construct');
        
    }

    public function destroy($id){
        $construct = Constructs::findOrFail($id);
        $collectionID = $construct->collectionID;
        $construct->delete();

        return redirect()->route('collections.show', ['id' => $collectionID])->with('msg', 'You have successfully deleted the Construct');
        
    }

    public function upload($id){

        $allCollections = Collections::all();

        foreach($allCollections as $col){
            if($col->collectionID == $id){
                $colID = $col->collectionID;
                $proID = $col->projectID;
            }
        }

        return view('constructs.upload', [
            'pid' => $proID,
            'cid' => $colID
        ]);
    }

    public function start($id){

        
        $construct = Constructs::findOrFail($id);
        return view('constructs.report', [
            'construct' => $construct,
        ]);
    }

    public function report(){

        $user = auth()->user();

        $id = request('id');
        $construct = Constructs::findOrFail($id);
        $collectionID = $construct->collectionID;
        
        $construct->status = request('status');
        $construct->report = request('report');
        $construct->reporterID = $user->id;

        $construct->save();

        return redirect()->route('collections.show', ['id' => $collectionID])->with('msg', 'You have successfully Submited a reprot for the Construct');
    }

}
