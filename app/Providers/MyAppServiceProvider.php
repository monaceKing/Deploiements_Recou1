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
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $monController = new MonController();
        $monController->peuplerPortefeuilleAvecCO_No();
    }
}
