<?php

namespace Toporlabs\Regulations\Providers;

use Illuminate\Support\ServiceProvider;

class RegulationsServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Toporlabs\Regulations\Commands\GetRegulationsCommand',
        'Toporlabs\Regulations\Commands\RevertRegulationsCommand',
    ];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
