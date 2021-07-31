<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Projects;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        $projectIDs = explode(":", $user->projects);

        $user->projects = $projectIDs;
       

        return view('home',  ['user' => $user]);
    }
}
