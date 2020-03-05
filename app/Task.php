<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    // A task can be associated to a project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // a task can be completed
    public function complete($completed = true)
    {
        // $this->update(['completed' => $completed]);
        $this->update(compact('completed'));
    }

    // A task can be incompleted
    public function incomplete()
    {
        $this->complete(false);
    }
}
