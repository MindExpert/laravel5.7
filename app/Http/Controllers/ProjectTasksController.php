<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {

        // $validated['owner_id] = auth()->id();
        /* 1st method
            request()->validate([
                'title' => ['required', 'min:3', 'max:165'],
                'description' => ['required', 'min:3', 'max:510'],
            ]);
            Project::create(request(['title', 'description']));
        */
        /* 2nd Method
            Project::create([
                'title' => request('title'),
                'description' => request('description'),
            ]);
        */   
        /* 3rd Method
            $project = new Project();
            $project->title = request('title');
            $project->description = request('description');
            $project->save();
        */

        /* 2nd Method */
        // what are we doing to the project, We are adding a task, so I'm gonna create a method called addTask();
        // This method is of Project model, there we "$this->tasks()->create(compact('description'))", and since its 
        // an eloquent model, it add t
        
        $validated = request()->validate([
            'description' => ['required',  'min:3', 'max:165']
        ]);
        $project->addTask($validated);

       return back();
    }

   /* 
        public function update(Task $task)
        {   
            /* 1st Method */
            // $task->update([
            //     'completed' => request()->has('completed')
            // ]);

            /* 2nd Method - calling complete method */
            // $task->complete(request()->has('completed'));

            /* 3rd Method - if else statement */
                // if (request()->has('completed')) {
                //     $task->complete();
                // } else {
                //     $task->incomplete();
                // }

            /* 4rth Method - ternary operation */
                // request()->has('completed') ?  $task->complete() : $task->incomplete();

            /* 5th Method - set a method 
            $method = request()->has('completed') ?  'complete' : 'incomplete';
            $this->$method();

            return back();
        }
    */
    
}
