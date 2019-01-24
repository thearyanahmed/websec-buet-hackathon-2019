<?php

namespace App\Policies;

use App\Models\{User,Post};
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function before()
    {
        if(auth()->user()->isAdmin()) {
            return true;
        }
    }

    public function update(User $user,Post $post) : bool
    {
        return $post->user_id == $user->id ; 
    }
}
