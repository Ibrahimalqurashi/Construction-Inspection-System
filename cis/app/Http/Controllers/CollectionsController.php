<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use App\Collections;
use App\Constructs;
use App\User;

class CollectionsController extends Controller
{
    // this method makes all pages here reqire a login
    public function __construct(){
        $this->middleware('auth');
    }

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

    public function show($newId){

        $user = auth()->user();
        $Collection = Collections::findOrFail($newId);

        $id = $Collection->collectionID;

        $pID = $Collection->projectID;
        $access = $this->access($user->id, $pID);


        if($access){
            $constructs = Constructs::all()->where('collectionID', $id);

            $accepted = 0;
            $other = 0;

            foreach($constructs as $c){
                if($c->status == 'a'){
                    $accepted = 1 + $accepted;
                }
            }

            $precentage=0;
            if(count($constructs) != 0){
            $precentage = $accepted/count($constructs) * 100;
            }

            return view('collections.show', [
                'constructs' => $constructs,
                'user' => $user,
                'collection' => $Collection,
                'precentage' => $precentage
                ]);

        }else{
            return redirect()->route('home')->with('msg', 'You Do not have Access to This Collection');
        }       
    }


        public function create($id){
            $user = auth()->user();
            $pro = Projects::findOrFail($id);

            if($user->id == $pro->managerID){
            return view('collections.create', ['id'=> $id]);}
            else{
                return redirect()->route('home')->with('msg', 'You Are not the Manager of This Project');
            }
        }
    
        public function store(){
            
            $user = auth()->user();
            $managerID = $user->id;
            
            $projectID = request('projectID');

            $collection = new Collections();

            $collection->collectionName = request('collectionName');
            $collection->constructors = request('constructors');
            $collection->projectID = $projectID;
            $collection->managerID = $managerID;
            $collection->save();
    
            return redirect()->route('projects.show', ['id' => $projectID])->with('msg', 'You have successfully Created a new Collection');
        }
        

        public function destroy($id){


            $allConstructs = Constructs::all()->where('collectionID', $id);
    
            foreach($allConstructs as $construct){
                if($construct->collectionID == $id){
                    $construct->delete();
                }
            }
    
            $collections = Collections::findOrFail($id);
            $projectID = $collections->projectID;
            $collections->delete();
            
            return redirect()->route('projects.show', ['id' => $projectID])->with('msg', 'You have successfully Deleted the Collection');
        }
}

