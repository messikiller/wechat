<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $table      = 't_privileges';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
