<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Privilege;
use App\Models\UserPrivilege;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements JWTSubject
{
    protected $table      = 't_users';
    protected $primaryKey = 'id';

    public $timestamps = false;

    public function privileges()
    {
        return $this->belongsToMany(Privilege::class, (new UserPrivilege)->getTable(), 'user_id', 'privilege_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
