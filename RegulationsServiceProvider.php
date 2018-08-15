<?php

namespace Regulations\Providers;

use Illuminate\Support\ServiceProvider;

class RegulationsServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Regulations\Commands\GetRegulationsCommand',
        'Regulations\Commands\RevertRegulationsCommand',
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
