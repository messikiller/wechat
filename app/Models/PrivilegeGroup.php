<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Privilege;

class PrivilegeGroup extends Model
{
    protected $table      = 't_privilege_groups';
    protected $primaryKey = 'id';

    public $timestamps = false;

    public function privileges()
    {
        return $this->hasMany(Privilege::class, 'privilege_group_id', 'id');
    }
}
