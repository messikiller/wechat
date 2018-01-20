<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PrivilegeGroup;

class Privilege extends Model
{
    protected $table      = 't_privileges';
    protected $primaryKey = 'id';

    public $timestamps = false;

    public function privilegeGroup()
    {
        return $this->belongsTo(PrivilegeGroup::class, 'privilege_group_id', 'id');
    }
}
