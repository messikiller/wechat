<?php

namespace App\Observers;

use App\Models\Privilege;
use App\Services\Acl;

class PrivilegeObserver
{
    public function saving(Privilege $privilege)
    {
        Acl::flush();
    }

    public function deleting(Privilege $privilege)
    {
        Acl::flush();
    }
}
