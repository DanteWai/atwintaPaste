<?php

namespace App\Policies;

use App\Models\Paste;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PastePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paste  $paste
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Paste $paste)
    {
        if($paste->access->title === 'private' && $user->id !== $paste->user_id){
            return false;
        }

        return true;
    }
}
