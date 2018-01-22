<?php

namespace App\Observers;

use App\Models\User;
use App\Services\Acl;

class UserObserver
{
    public function saving(User $user)
    {
        Acl::refresh($user->id);
    }

    public function deleting(User $user)
    {
        Acl::refresh($user->id);
    }
}
