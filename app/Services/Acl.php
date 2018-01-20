<?php
namespace App\Services;

use Cache;
use App\Models\User;

class Acl
{
    const config_cache_prefix_path  = 'acl.cache.prefix';
    const config_cache_minutes_path = 'acl.cache.minutes';

    private static $instance;

    public static function _new()
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }

        return new self();
    }

    public static function refresh($user_id)
    {
        self::removeCachedUserAcl($user_id);
    }

    public static function flush()
    {
        Cache::forget(config(self::config_cache_prefix_path));
    }

    public function getUserAcl($user_id)
    {
        if (self::hasCachedUserAcl($user_id)) {
            return self::getCachedUserAcl($user_id);
        }

        $userAcl = $this->getFreshUserAcl($user_id);
        self::setCachedUserAcl($user_id, $userAcl);

        return $userAcl;
    }

    public function getFreshUserAcl($user_id)
    {
        $user = User::find($user_id);
        if (empty($user)) {
            return [];
        }

        return $user->privileges()->pluck('path')->unique()->toArray();
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

    private static function getCachedUserAcl($user_id)
    {
        $prefix = config(self::config_cache_prefix_path);

        if (! Cache::has($prefix)) {
            return false;
        }

        $list = Cache::get($prefix);

        return isset($list[$user_id]) ? $list[$user_id] : false;
    }

    private static function setCachedUserAcl($user_id, $privileges)
    {
        $prefix  = config(self::config_cache_prefix_path);
        $minutes = config(self::config_cache_minutes_path);

        $list = Cache::get($prefix);
        $list[$user_id] = $privileges;

        Cache::put($prefix, $list, $minutes);
    }

    private static function hasCachedUserAcl($user_id)
    {
        $prefix = config(self::config_cache_prefix_path);

        if (! Cache::has($prefix)) {
            return false;
        }

        $list = Cache::get($prefix);

        return ! empty($list[$user_id]);
    }

    private static function removeCachedUserAcl($user_id)
    {
        $prefix  = config(self::config_cache_prefix_path);
        $minutes = config(self::config_cache_minutes_path);

        if (! Cache::has($prefix)) {
            return false;
        }

        $list = Cache::get($prefix);

        unset($list[$user_id]);

        Cache::put($prefix, $list, $minutes);
    }
}
