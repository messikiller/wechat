<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table      = 't_members';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
