<?php

namespace App\Policies;

use App\Models\Paste;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PastePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User|null $user
     * @param Paste $paste
     * @return bool
     */
    public function view(?User $user, Paste $paste)
    {
        if($paste->access->title !== 'private'){
            return true;
        } else {
            return  $user && ($user->id === $paste->user_id);
        }
    }
}
