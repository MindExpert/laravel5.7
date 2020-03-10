<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\Events\ProjectCreated;


class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        // $projects = Project::where('owner_id', auth()->id())->get();
        // $projects = auth()->user()->projects;
        // dump($projects);
        return view('projects.index', [
            'projects' => auth()->user()->projects
        ]);
    }

    public function store() 
    { 
        $attributes = $this->validateProject();
        $attributes['owner_id'] = auth()->id();
        $project = Project::create($attributes);
        return redirect('/projects');
    }

    public function create() 
    {    
        return view('projects.create');
    }

    public function show(Project $project) 
    {
        // abort_if ($project->owner_id !== auth()->id(), 403);
        // abort_unless($project->owner_id !== auth()->id(), 403);
        // if (\Gate::denies('update', $project)) {
        //     abort(403);
        // }
        // abort_unless(\Gate::allows('update', $project), 403);   
        // auth()->user()->can('update', $project);

        $this->authorize('update', $project);
        return view('projects.show', compact('project'));
    }

    public function update(Project $project) 
    {
        // we are setting the attributes and saving it
        $this->authorize('update', $project);
        $validated = request()->validate([
            'title' => ['required', 'min:3', 'max:165'],
            'description' => ['required', 'min:3', 'max:510'],
        ]);
        $project->update($validated); // we used the method for validation
        return redirect('/projects');
    }

    public function destroy(Project $project) 
    {
        $this->authorize('update', $project);
        $project->delete();
        return redirect('/projects');
    }

    public function edit(Project $project) // example.com/projects/1/edit
    { 
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    protected function validateProject()
    {
        return request()->validate([
            'title' => ['required', 'min:3', 'max:165'],
            'description' => ['required', 'min:3', 'max:510'],
        ]);
    }
}

