<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before()
    {
        if(auth()->user()->isAdmin()) {
            return true;
        }
    }

    public function update(User $user)
    {
        if($user->isAdmin()) {
            return true;
        }
        return false;
    }
    public function delete(User $user) : bool
    {
        return $user->isAdmin();
    }
}
