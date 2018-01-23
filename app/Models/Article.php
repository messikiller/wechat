<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table      = 't_articles';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
