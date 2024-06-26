<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(){

        // $projects = Project::all();
        $projects = Project::with('technologies', 'type')->paginate(4);

        return response()->json([
            'projects'=>$projects
        ]);
    }


    public function singleProject(Project $project){

        $project->load('technologies', 'type');

        return response()->json([
            'project'=>$project
        ]);
    }
}
