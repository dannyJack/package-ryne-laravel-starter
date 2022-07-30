<?php
namespace Ryne\LaravelStarter;

use Illuminate\Support\ServiceProvider;

class LaravelStarterServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/defaults/phpcs.xml' => config_path('../phpcs.xml'),
        ], 'phpcs');
    }
}
