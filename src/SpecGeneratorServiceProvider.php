<?php

namespace Printerous\SpecGenerator;

use Illuminate\Support\ServiceProvider;

class SpecGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__.'/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->make('Printerous\SpecGenerator\SpecGeneratorController');
    }
}
