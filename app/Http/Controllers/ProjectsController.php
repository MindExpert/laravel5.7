<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $projects = Project::where('owner_id', auth()->id())->get();
        return view('projects.index', compact('projects'));
        //  or return (identical)-> return view('projects.index', ['projects' => $projects]);
    }

    public function store() { 
        $validated = request()->validate([
            'title' => ['required', 'min:3', 'max:165'],
            'description' => ['required', 'min:3', 'max:510'],
        ]);
        Project::create($validated + ['owner_id' => auth()->id()]);
        
        // $validated['owner_id] = auth()->id();


        // 1st method
        /*
            request()->validate([
                'title' => ['required', 'min:3', 'max:165'],
                'description' => ['required', 'min:3', 'max:510'],
            ]);
            Project::create(request(['title', 'description']));
        */
        
        // 2nd Method
        /*
            Project::create([
                'title' => request('title'),
                'description' => request('description'),
            ]);
        */   

        // 3rd Method
        /*
            $project = new Project();
            $project->title = request('title');
            $project->description = request('description');
            $project->save();
        */
        return redirect('/projects');
    }

    public function create() {    
        return view('projects.create');
    }

    public function show(Project $project) {
        // $project = Project::findOrFail($id);

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

    public function update(Project $project) {
        // we are setting the attributes and saving it
        $this->authorize('update', $project);
        $project->update(request(['title', 'description'])); 
        return redirect('/projects');
        /*
            $project->title = request('title');
            $project->description = request('description');
            $project->save();
        */
    }

    public function destroy(Project $project) {
        $this->authorize('update', $project);
        $project->delete();
        return redirect('/projects');
    }

    public function edit(Project $project) { // example.com/projects/1/edit
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }
}

