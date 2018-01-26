<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table      = 't_hospitals';
    protected $primaryKey = 'id';

    public $timestamps = false;
    
}
