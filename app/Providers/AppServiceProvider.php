<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Écoute chaque exécution d’un composant Livewire
        Livewire::listen('component.dehydrate', function ($component, $response) {
            Log::info('Livewire composant exécuté : ' . $component->getName());
        });

        Carbon::setLocale('fr');

    }
}
