<?php

namespace App\Providers;

use App\Models\Permission;
use App\Auth\CustomUserProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Foundation\Application;
use Auth;
use Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        /**
         * Override hash methods
         */
        Auth::provider('custom', function(Application $app, $model) {
            return new CustomUserProvider($app['hash'], $model['model']);
        });

        Log::info("Foobar Boot AUthServiceProvider");
        //foreach ($this->getPer)

    }
}
