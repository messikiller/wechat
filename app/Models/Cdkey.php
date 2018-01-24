<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cdkey extends Model
{
    protected $table      = 't_cdkeys';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
