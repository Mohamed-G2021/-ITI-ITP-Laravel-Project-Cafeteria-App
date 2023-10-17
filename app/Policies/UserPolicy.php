<?php

namespace App\Policies;
use Illuminate\Auth\Access\Response;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }  public function view(User $user, User $model)
    {
        return $user->isAdmin();
    }
    
    public function update(User $user, User $model)
    {
        return $user->isAdmin();
    }
    
    public function delete(User $user, User $model)
    {
        return $user->isAdmin();
    }
    
}
