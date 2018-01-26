<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table      = 't_regions';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
