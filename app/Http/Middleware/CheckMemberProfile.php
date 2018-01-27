<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Auth;

/**
 * check member profile info accessable
 *
 * rule param check order:
 *
 *   $isCompleted1|$type1|$machineType1-$isCompleted2|$type2|$machineType2-$isCompleted3|$type3|$machineType3
 *
 * and etc.
 */
class CheckMemberProfile
{
    private $page = [];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $rule)
    {
        $member = Auth::user();
        $rules  = explode('-', $rule);

        if (App()->isLocal()) {
            return $next($request);
        }

        $res = false;
        foreach ($rules as $rule)
        {
            list($is_completed, $type, $machine_type) = explode('|', $rule);

            $r = $this->performCompletedCheck($member, $is_completed)
                && $this->performTypeCheck($member, $type)
                && $this->performMachineTypeCheck($member, $machine_type);

            $res = $res || $r;
            if ($res) {
                break;
            }
        }

        if (! $res) {
            return response()->view('home.common.message', $this->page);
        }

        return $next($request);
    }

    private function performCompletedCheck($member, $is_completed)
    {
        $ret = false;
        switch ($is_completed) {
            case '*':
                $ret = true;
                break;

            // true
            case 'T':
                $ret = $member->isCompleted() == config('define.member.is_completed.true.value');
                break;

            // false
            case 'F':
                $ret = $member->isCompleted() == config('define.member.is_completed.false.value');
                break;

            default:
                $ret = false;
                break;
        }

        if (! $ret) {
            $this->page = [
                'msg_type'         => 'info',
                'title'            => 'Forbidden',
                'detail'           => 'Access Denied for your profile is completed or not',
                'primary_btn_desc' => 'Home',
                'primary_btn_url'  => route('home.index'),
            ];
        }

        return $ret;
    }

    private function performTypeCheck($member, $type)
    {
        $ret = false;
        switch ($type) {
            case '*':
                $ret = true;
                break;

            // Doctor
            case 'D':
                $ret = $member->isDoctor();
                break;

            // Provider
            case 'P':
                $ret = $member->isProvider();
                break;

            default:
                $ret = false;
                break;
        }

        if (! $ret) {
            $this->page = [
                'msg_type'         => 'info',
                'title'            => 'Forbidden',
                'detail'           => 'Access Denied for your role type',
                'primary_btn_desc' => 'Home',
                'primary_btn_url'  => route('home.index'),
            ];
        }

        return $ret;
    }

    private function performMachineTypeCheck($member, $machine_type)
    {
        $ret = false;
        switch ($machine_type) {
            case '*':
                $ret = true;
                break;

            // Default
            case 'D':
                $ret = $member->hasNoMachine();
                break;

            // Ultrasound
            case 'U':
                $ret = $member->hasUltrasound();
                break;

            // Endoscope
            case 'E':
                $ret = $member->hasEndoscope();
                break;

            default:
                $ret = false;
                break;
        }

        if (! $ret) {
            $this->page = [
                'msg_type'         => 'info',
                'title'            => 'Forbidden',
                'detail'           => 'Access Denied for your machine type',
                'primary_btn_desc' => 'Home',
                'primary_btn_url'  => route('home.index'),
            ];
        }

        return $ret;
    }

}
