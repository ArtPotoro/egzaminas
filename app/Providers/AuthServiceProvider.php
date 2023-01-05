<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Restoran;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Restoran::class=>RestonranPolicy::class,
        Product::class=>ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        {$this->registerPolicies();
        Gate::define('admin', function (User $user){
            return ($user->type=='admin');
        });
    }}
}
