<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */


     //Gate pour gérer les authorisation d'accès a certaines pages de l'application
    public function boot(): void
    {
        $this->registerPolicies();

        //le Gate qui permet aux admins de naviguer sur differentes pages
        Gate::define('manage-users', function ($user) {
            return $user->hasRole('admin');
        });
        

        Gate::define('edit-users', function ($user) {
            return $user->hasRole('admin'); //Création de la fonction isAdmin dans le model User
        });


        Gate::define('delete-users', function ($user) {
            return $user->isAdmin(); //Création de la fonction isAdmin dans le model User
        });
    }
}
