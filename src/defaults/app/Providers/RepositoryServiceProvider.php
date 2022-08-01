<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $models = [
            // 'Example',
            // 'ExampleTransaction' => 'ExampleMaster'
        ];

        foreach ($models as $index => $model) {
            if (!is_numeric($index)) {
                $this->app->bind("App\Interfaces\\{$model}\\{$index}RepositoryInterface", "App\Repositories\\{$model}\\{$index}EloquentRepository");
            } else {
                $this->app->bind("App\Interfaces\\{$model}RepositoryInterface", "App\Repositories\\{$model}EloquentRepository");
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
