<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Privilege;
use App\Models\UserPrivilege;
use App\Observers\UserObserver;
use App\Observers\PrivilegeObserver;
use App\Observers\UserPrivilegeObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Privilege::observe(PrivilegeObserver::class);
        UserPrivilege::observe(UserPrivilegeObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
