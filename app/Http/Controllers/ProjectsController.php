<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
            // you can say apply this middleware auth only to
        // $this->middleware('auth')->only(['store', 'update']);
            // you can say apply to everything except
        // $this->middleware('auth')->except(['show']);
    }

    public function index() 
    {
        // auth()->id() // Id of loged in user
        // auth()->user() // User Instance
        // auth()->check() //boolean
        // auth()->guest()

        $projects = Project::where('owner_id', auth()->id())->get();
        return view('projects.index', ['projects' => $projects]);
        //  or use  (identical)-> return view('projects.index', compact('projects'));
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
        $this->authorize('view', $project);
        return view('projects.show', compact('project'));
    }

    public function update(Project $project) {
        // this is same as one below to setting the attributes and persisting it (save)
        $project->update(request(['title', 'description'])); 

        /*
            $project->title = request('title');
            $project->description = request('description');
            $project->save();
        */
        return redirect('/projects');
    }

    public function destroy(Project $project) {
        // dd(request()->all()); //Quick Debugging function
        // Project::findOrFail($id)->delete();
        $project->delete();
        return redirect('/projects');
    }

    public function edit(Project $project) { // example.com/projects/1/edit
        return view('projects.edit', compact('project'));
    }
}

