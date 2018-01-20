<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Privilege;
use App\Models\UserPrivilege;

class User extends Model
{
    protected $table      = 't_users';
    protected $primaryKey = 'id';

    public $timestamps = false;

    public function privileges()
    {
        return $this->belongsToMany(Privilege::class, (new UserPrivilege)->getTable(), 'user_id', 'privilege_id');
    }

}
