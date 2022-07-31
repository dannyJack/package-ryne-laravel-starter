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
        $langPath = 'resources/';

        if (_isAppVersion('>=', '9')) {
            $langPath = '';
        }

        $this->publishes([
            __DIR__ . '/defaults/.env.setup' => config_path('../.env.setup'),
            __DIR__ . '/defaults/phpcs.xml' => config_path('../phpcs.xml'),
            __DIR__ . '/defaults/gitignore' => config_path('../.gitignore'),
            __DIR__ . '/SlackLog/config/slackLog.php' => config_path('./slackLog.php')
        ], 'all');

        $this->publishes([
            __DIR__ . '/defaults/.env.setup' => config_path('../.env.setup')
        ], 'env');

        $this->publishes([
            __DIR__ . '/defaults/phpcs.xml' => config_path('../phpcs.xml')
        ], 'phpcs');

        $this->publishes([
            __DIR__ . '/defaults/gitignore' => config_path('../.gitignore')
        ], 'gitignore');

        $this->publishes([
            __DIR__ . '/SlackLog/config/slackLog.php' => config_path('./slackLog.php')
        ], 'slackLog');

        $this->publishes([
            __DIR__ . '/SlackLog/config/slackLog.php' => config_path('./slackLog.php')
        ], 'slackLog');

        $this->publishes([
            __DIR__ . '/defaults/resources/lang/en/words.php' => config_path('../' . $langPath . 'lang/en/words.php'),
            __DIR__ . '/defaults/resources/lang/en/messages.php' => config_path('../' . $langPath . 'lang/en/messages.php'),
            __DIR__ . '/defaults/resources/lang/ja/words.php' => config_path('../' . $langPath . 'lang/ja/auth.php'),
            __DIR__ . '/defaults/resources/lang/ja/words.php' => config_path('../' . $langPath . 'lang/ja/pagination.php'),
            __DIR__ . '/defaults/resources/lang/ja/words.php' => config_path('../' . $langPath . 'lang/ja/passowods.php'),
            __DIR__ . '/defaults/resources/lang/ja/words.php' => config_path('../' . $langPath . 'lang/ja/validation.php'),
            __DIR__ . '/defaults/resources/lang/ja/words.php' => config_path('../' . $langPath . 'lang/ja/words.php'),
            __DIR__ . '/defaults/resources/lang/ja/messages.php' => config_path('../' . $langPath . 'lang/ja/messages.php')
        ], 'lang');

        $this->publishes([
            __DIR__ . '/defaults/resources/lang/en/words.php' => config_path('../' . $langPath . 'lang/en/words.php'),
            __DIR__ . '/defaults/resources/lang/en/messages.php' => config_path('../' . $langPath . 'lang/en/messages.php')
        ], 'langEn');

        $this->publishes([
            __DIR__ . '/defaults/resources/lang/ja/words.php' => config_path('../' . $langPath . 'lang/ja/auth.php'),
            __DIR__ . '/defaults/resources/lang/ja/words.php' => config_path('../' . $langPath . 'lang/ja/pagination.php'),
            __DIR__ . '/defaults/resources/lang/ja/words.php' => config_path('../' . $langPath . 'lang/ja/passowods.php'),
            __DIR__ . '/defaults/resources/lang/ja/words.php' => config_path('../' . $langPath . 'lang/ja/validation.php'),
            __DIR__ . '/defaults/resources/lang/ja/words.php' => config_path('../' . $langPath . 'lang/ja/words.php'),
            __DIR__ . '/defaults/resources/lang/ja/messages.php' => config_path('../' . $langPath . 'lang/ja/messages.php')
        ], 'langJa');
    }
}
