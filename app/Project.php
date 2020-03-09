<?php

namespace App;

use App\Mail\ProjectCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
       parent::boot();
       static::created(function ($project) {
        //This code will be executed only after a project has been created.
            Mail::mailer('smtp')
            ->to($project->owner->email)
            ->send(new ProjectCreated($project));

            // Mail::to($project->owner->email)->send(
            //     new ProjectCreated($project)
            // );
       });
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {

        $this->tasks()->create($task);

        /* 3rd Method 
            $this->tasks()->create(compact('description'));
        */
        /* 2nd Method 
            $this->tasks()->create(['description'=> $description]);
        */
        /* 1st Method 
            return Task::create([
                'project_id' => $this->id,
                'description' => $description
            ]);
        */
    }

    public function owner() 
    {
        return $this->belongsTo(User::class);
    }

}


