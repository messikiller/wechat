<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table      = 't_users';
    protected $primaryKey = 'id';

    public $timestamps = false;
    
}
