<?php

namespace App\Policies;

use App\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function update(User $user, Project $project)
    { 
        // *** ME ***
        // check the owner_id of the $project and determine 
        // if thats equal to the id of authenticated $user
        return $project->owner_id == $user->id;  
    }

}
