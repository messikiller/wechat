<?php

namespace App\Providers;

use App\Services\Acl;
use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Acl::class, function ($app) {
            return Acl::_new();
        });
    }
}
