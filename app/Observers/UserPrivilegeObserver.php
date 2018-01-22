<?php

namespace App\Observers;

use App\Models\UserPrivilege;
use App\Services\Acl;

class UserPrivilegeObserver
{
    public function saving(UserPrivilege $userPrivilege)
    {
        Acl::refresh($userPrivilege->user_id);
    }

    public function deleting(UserPrivilege $userPrivilege)
    {
        Acl::refresh($userPrivilege->user_id);
    }
}
