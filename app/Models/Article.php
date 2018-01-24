<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table      = 't_articles';
    protected $primaryKey = 'id';

    public $timestamps = false;

    public function scopePublished($query)
    {
        return $query->where('status', '=', config('define.article.status.normal.value'));
    }
}
