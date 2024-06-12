<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('name', 'asc')->get();

        $technologies = Technology::orderBy('name', 'asc')->get();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();

        // $form_data = $request->all();

        //controllo la generazione dello slug,
        //evitando che ci siano errori qualora ce ne sia uno già esistente
        //assegnando al nuovo "-n" (contatore)
        $base_slug = Str::slug($form_data['name_project']);

        $slug = $base_slug;

        $n = 0;

        do{
            $find = Project::where('slug', $slug)->first();

            if($find !== null){
                $n++;
                $slug = $base_slug .'-'. $n;
            }

        }while($find !== null);

        $form_data['slug'] = $slug; //aggiungo all'array associativo in form_data lo slug
        $project = Project::create($form_data);

        if($request->has('technologies')){
            $project->technologies()->attach($form_data['technologies']);
        }

        return to_route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('name', 'asc')->get();

        $project->load(['technologies']);

        $technologies = Technology::orderBy('name', 'asc')->get();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();

        // $form_data = $request->all();

        
        //controllo la generazione dello slug,
        //evitando che ci siano errori qualora ce ne sia uno già esistente
        //assegnando al nuovo "-n" (contatore)
        $base_slug = Str::slug($form_data['name_project']);

        $slug = $base_slug;

        $n = 0;

        do{
            $find = Project::where('slug', $slug)->first();

            if($find !== null){
                $n++;
                $slug = $base_slug .'-'. $n;
            }

        }while($find !== null);

        $form_data['slug'] = $slug; //aggiungo all'array associativo in form_data lo slug

        $project->fill($form_data);
        
        $project->save();


        if($request->has('technologies')){

            $project->technologies()->sync($request->technologies);

        } else {

            $project->technologies()->sync([]);
        }


        return to_route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index');
    }
}
