<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {

        $this->tasks()->create($task);

        /* 3rd Method */
        // $this->tasks()->create(compact('description'));

        /* 2nd Method */
        // $this->tasks()->create(['description'=> $description]);

        /* 1st Method */
        //     return Task::create([
        //        'project_id' => $this->id,
        //        'description' => $description
        //    ]);
    }

}


