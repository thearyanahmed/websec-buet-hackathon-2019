<?php

namespace App\Policies;

use App\Models\{User,Post};
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function before()
    {
        // return auth()->user()->isAdmin()
        if(auth()->user()->isAdmin()) {
            return true;
        }
    }

    public function update(User $user,Post $post) : bool
    {
        return $post->user_id == $user->id ; 
    }

    public function view(User $user,Post $post) : bool
    {
        if($post->status == 1) {
            return true;
        }
        if($user->isAdmin() || $user->isModerator() || $user->id == $post->user_id)  {
            return true;
        }      

        return false;
    }
}
