<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table      = 't_companies';
    protected $primaryKey = 'id';

    public $timestamps = false;
    
}
