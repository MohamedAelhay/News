<?php

namespace App\Providers;

use App\City;
use App\Folder;
use App\Policies\CityPolicy;
use App\Policies\FolderPolicy;
use App\Policies\RolePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        City::class => CityPolicy::class,
        Folder::class => FolderPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user)
        {
            return $user->isAdmin() ? true : null;
        });
    }
}
