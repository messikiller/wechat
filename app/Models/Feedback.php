<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class Feedback extends Model
{
    protected $table      = 't_feedbacks';
    protected $primaryKey = 'id';
    protected $guarded    = [];

    public $timestamps = false;

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

}
