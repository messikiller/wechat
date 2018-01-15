<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table      = 't_feedbacks';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
