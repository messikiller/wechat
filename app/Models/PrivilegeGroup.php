<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivilegeGroup extends Model
{
    protected $table      = 't_privilege_groups';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
