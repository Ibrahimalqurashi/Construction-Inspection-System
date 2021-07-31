<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use App\Collections;
use App\Constructs;
use App\User;

class ProjectsController extends Controller
{
        // this method makes all pages here reqire a login
        public function __construct(){
            $this->middleware('auth');
        }
    
        public function index(){
            
            $user = auth()->user();

            $userProjects = $user->projects;
            $projects = array();

            if($userProjects == ''){
                return view('projects.index', [
                    'projects' => $projects,
                    'user' => $user
                    ]);
            }

            $projectIDs = explode(":", $userProjects);
            
            $this->cleanup();
            
            $count = \DB::table('projects')->count();

            if($count != 0){
                foreach($projectIDs as $pid){
                    array_push( $projects , Projects::findOrFail($pid));
                }
            }

            $projects = array_unique($projects);
    
            return view('projects.index', [
                'projects' => $projects,
                'user' => $user
                ]);
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

    public function show($id){

            
        $user = auth()->user();
        $projectIDs = explode(":", $user->projects);

        $access = $this->access($user->id, $id);

        if($access){
            $collections = Collections::all()->where('projectID', $id);

            $project = Projects::findOrFail($id);

            $manager = User::findOrFail($project->managerID);

            return view('projects.show', [
                    'collections' => $collections,
                    'user' => $user,
                    'project'=> $project,
                    'manager'=> $manager,
                    ]);
        }else{
            return redirect()->route('home')->with('msg', 'You Do not have Access to This Project');
            }
    }

    public function create(){
        return view('projects.create');
    }

    public function store(){
        
        $user = auth()->user();
        $id = $user->id;

        $project = new Projects();

        $project->name = request('name');
        $project->sponsorName = request('sponsor');
        $project->managerID = $id;

        $project->save();


        $this->cleanup();
        return redirect('/projects')->with('msg', 'You have successfully Created a new Project');
    }

    public function destroy($id){

        $allConstructs = Constructs::all()->where('projectID', $id);
        $allCollections = Collections::all()->where('projectID', $id);


        foreach($allConstructs as $construct){
            if($construct->projectID == $id){
                $construct->delete();
            }
        }

        foreach($allCollections as $collection){
            if($collection->projectID == $id){
                $collection->delete();
            }
        }


        $project = Projects::findOrFail($id);
        $project->delete();

        $this->cleanup();

        return redirect('/projects');
    }


    public function add($proID){
        $user = auth()->user();
        $project = Projects::findOrFail($proID);

        if($user->id == $project->managerID){
        return view('projects.add', [
            'project' => $project,
        ]);}else{
            return redirect()->route('home')->with('msg', 'You Are not the Manager of This Project, You cannot add others to it');
        }
    }

    public function update(){
        
        $user = auth()->user();
        $id = $user->id;

        $newP = request('proID');

        $projectIDs = explode(":", $user->projects);
        array_push($projectIDs, $newP);
        $newArray = array_unique($projectIDs);

        $projectIDsString = implode(":", $newArray);
        
        $user->projects = $projectIDsString;
        $user->save();

        $email = request('email');

        $addedUser = User::where('email', $email)->first();

    if( $addedUser != null){
        if($addedUser->email == $email){
            $a1 = explode(":", $addedUser->projects);
            array_push($a1, $newP);
            $a2 = array_unique($a1);
    
            $stringOfProjects = implode(":", $a2);
            
            $addedUser->projects = $stringOfProjects;
            $addedUser->save();
            return redirect()->route('projects.show', ['id' => $newP])->with('msg', 'You have successfully Added an inspector to this project');
        }}else{
            return redirect()->route('projects.show', ['id' => $newP])->with('msg', 'Email not found');
        }
        
    }

    public function cleanup(){

        $user = auth()->user();

        $projectIDs = explode(":", $user->projects);

        $newProjectIDs = array();

        $allProjects = Projects::all();

        foreach($projectIDs as $pid){
            foreach($allProjects as $p){
                if($p->id == $pid){
                    array_push($newProjectIDs, $pid);
                }if($p->managerID == $user->id){
                    array_push($newProjectIDs, $p->id);
                }
            }
        }

        $stringOfProjects = implode(":", array_unique($newProjectIDs));

        $user->projects = $stringOfProjects;
        $user->save();
    }
}
