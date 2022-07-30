<?php
namespace Ryne\LaravelStarter;

use Illuminate\Support\ServiceProvider as SP;

class ServiceProvider extends SP
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/defaults/phpcs.xml' => config_path('../phpcs.xml'),
            __DIR__ . '/defaults/gitignore' => config_path('../.gitignore'),
        ], 'all');

        $this->publishes([
            __DIR__ . '/defaults/phpcs.xml' => config_path('../phpcs.xml'),
        ], 'phpcs');

        $this->publishes([
            __DIR__ . '/defaults/gitignore' => config_path('../.gitignore'),
        ], 'gitignore');
    }
}
