<?php
namespace Ryne\LaravelStarter;

use Illuminate\Support\ServiceProvider;

class LaravelStarterServiceProvider
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
