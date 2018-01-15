<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPrivilege extends Model
{
    protected $table      = 't_user_privileges';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
