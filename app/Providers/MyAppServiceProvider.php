<?php

namespace App\Providers;

use App\Http\Controllers\MonController;
use Illuminate\Support\ServiceProvider;

class MyAppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Enregistrez le contrôleur en tant que singleton dans le conteneur de services
        $this->app->singleton(MonController::class, function ($app) {
            return new MonController();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(MonController $monController): void
    {
        // Utilisez l'instance injectée de MonController
        $monController->peuplerPortefeuilleAvecCO_No();
    }
}
