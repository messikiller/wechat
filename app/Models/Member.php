<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\Hospital;
use App\Models\Company;

class Member extends Model
{
    protected $table      = 't_members';
    protected $primaryKey = 'id';
    protected $guarded    = [];

    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function isCompleted()
    {
        return $this->is_completed == config('define.member.is_completed.true.value');
    }

    public function isDoctor()
    {
        return $this->type == config('define.member.type.doctor.value');
    }

    public function isProvider()
    {
        return $this->type == config('define.member.type.provider.value');
    }

    public function hasNoMachine()
    {
        $res = (empty($this->machine_data)) || ($this->machine_type == config('define.member.machine_type.default.value'));
        return $res;
    }

    public function hasUltrasound()
    {
        $res = (! empty($this->machine_data)) && ($this->machine_type == config('define.member.machine_type.ultrasound.value'));
        return $res;
    }

    public function hasEndoscope()
    {
        $res = (! empty($this->machine_data)) && ($this->machine_type == config('define.member.machine_type.endoscope.value'));
        return $res;
    }
}
