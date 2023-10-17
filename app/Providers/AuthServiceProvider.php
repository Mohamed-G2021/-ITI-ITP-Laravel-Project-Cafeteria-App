<?php
namespace App\Providers;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Define your model policies here

        User::class => UserPolicy::class,
    ];

    public function boot()
    {
            $this->registerPolicies();
        
            Gate::define('admin-access', function (User $user) {
                return $user->role === 'admin';
            });
        
            Gate::resource('user', 'App\Policies\UserPolicy');
        }
        
    }
