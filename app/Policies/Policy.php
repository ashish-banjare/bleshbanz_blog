<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    /**
     * Grant all abilities to admin
     *
     * @param \App\Models\Use $user
     * @return bool
     */
    public function before(User $user)
    {
        if($user->role === 'admin'){
            return true;
        }
    }
}
