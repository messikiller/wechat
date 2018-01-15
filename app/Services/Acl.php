<?php
class Acl
{
    public static function refresh($user_id)
    {

    }

    public static function flash()
    {
        
    }

    public function getUserAcl($user_id)
    {

    }

    public function getFreshUserAcl($user_id)
    {

    }

    public function canAccess($user_id, $path)
    {
        $acl = $this->getUserAcl($user_id);

        $can = false;
        foreach ($acl as $access) {
            if ($access == $path) {
                $can = true;
                break;
            }
        }

        return $can;
    }

    public function canAccessAll($user_id, $pathList)
    {
        $can = true;
        foreach ($pathList as $path)
        {
            if (! $this->canAccess($user_id, $path)) {
                $can = false;
                break;
            }
        }

        return $can;
    }

    public function canAccessOne($user_id, $pathList)
    {
        $can = false;
        foreach ($pathList as $path)
        {
            if ($this->canAccess($user_id, $path)) {
                $can = true;
                break;
            }
        }

        return $can;
    }
}
