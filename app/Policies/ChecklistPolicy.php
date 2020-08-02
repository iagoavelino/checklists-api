<?php

namespace App\Policies;

use App\Checklist;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class ChecklistPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Checklist  $checklist
     * @return mixed
     */
    public function view(User $user, Checklist $checklist)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Checklist $checklist)
    {
        /** Only allows checklist creation if the user is creating a checklist for themselves OR
         * if it is an Admin user. This prevents users from creating checklists to any account other 
         * than their own.
         */
        $isChecklistOwner = $user->id == $checklist->user_id;
        $isAdmin = $user->isAdmin();

        return $isChecklistOwner || $isAdmin;
    }

    /**
     * Determine whether the user can store a checklist.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return true;
        // /** Only allows checklist creation if the user is creating a checklist for themselves OR
        //  * if it is an Admin user. This prevents users from creating checklists to any account other 
        //  * than their own.
        //  */
        // Log::info("ITS GETTING INTO THE POLICY");
        // $isCreatingChecklistForLoggedUser = $user->id === 2;
        // $isAdmin = $user->isAdmin();

        // return $isCreatingChecklistForLoggedUser || $isAdmin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Checklist  $checklist
     * @return mixed
     */
    public function update(User $user, Checklist $checklist)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Checklist  $checklist
     * @return mixed
     */
    public function delete(User $user, Checklist $checklist)
    {
        return $user->checklists->contains($checklist);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Checklist  $checklist
     * @return mixed
     */
    public function restore(User $user, Checklist $checklist)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Checklist  $checklist
     * @return mixed
     */
    public function forceDelete(User $user, Checklist $checklist)
    {
        //
    }
}
