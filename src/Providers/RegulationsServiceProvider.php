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
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        require_once(__DIR__ . '/../Config/config.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->mergeConfigFrom( __DIR__ . '/../Config/config.php', 'regulations');
//        $this->commands($this->commands);
    }
}
