<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Privilege;

class UserPrivilege extends Model
{
    protected $table      = 't_user_privileges';
    protected $primaryKey = 'id';
    protected $guarded    = [];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function privilege()
    {
        return $this->belongsTo(Privilege::class, 'privilege_id', 'id');
    }
}
