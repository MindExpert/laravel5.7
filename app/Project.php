<?php

namespace App;

use App\Events\ProjectCreated;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => ProjectCreated::class
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
        $this->tasks()->create($task);
        /*  2nd Method 
            $this->tasks()->create(['description'=> $description]);
        */
        /*  1st Method 
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


