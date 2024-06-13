<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(){

        // $projects = Project::all();
        $projects = Project::with('technologies', 'type')->paginate(5);

        return response()->json([
            'projects'=>$projects
        ]);
    }


    public function singleProject(){

        $project = Project::with('technologies', 'type')->first();

        return response()->json([
            'project'=>$project
        ]);
    }
}
