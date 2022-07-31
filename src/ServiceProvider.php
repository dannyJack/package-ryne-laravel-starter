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
            __DIR__ . '/defaults/.env.setup' => config_path('../.env.setup'),
            __DIR__ . '/defaults/phpcs.xml' => config_path('../phpcs.xml'),
            __DIR__ . '/defaults/gitignore' => config_path('../.gitignore'),
            __DIR__ . '/SlackLog/config/slackLog.php' => config_path('./slackLog.php'),
        ], 'all');

        $this->publishes([
            __DIR__ . '/defaults/.env.setup' => config_path('../.env.setup'),
        ], 'env');

        $this->publishes([
            __DIR__ . '/defaults/phpcs.xml' => config_path('../phpcs.xml'),
        ], 'phpcs');

        $this->publishes([
            __DIR__ . '/defaults/gitignore' => config_path('../.gitignore'),
        ], 'gitignore');

        $this->publishes([
            __DIR__ . '/SlackLog/config/slackLog.php' => config_path('./slackLog.php'),
        ], 'slackLog');
    }
}
