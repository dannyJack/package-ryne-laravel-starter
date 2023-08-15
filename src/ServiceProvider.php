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

        $langEn = [
            __DIR__ . '/defaults/resources/lang/en/words.php' => config_path('../' . $langPath . 'lang/en/words.php'),
            __DIR__ . '/defaults/resources/lang/en/messages.php' => config_path('../' . $langPath . 'lang/en/messages.php')
        ];
        $langJa = [
            __DIR__ . '/defaults/resources/lang/ja/validation.php' => config_path('../' . $langPath . 'lang/ja/validation.php'),
            __DIR__ . '/defaults/resources/lang/ja/words.php' => config_path('../' . $langPath . 'lang/ja/words.php'),
            __DIR__ . '/defaults/resources/lang/ja/messages.php' => config_path('../' . $langPath . 'lang/ja/messages.php')
        ];

        /** BY BATCH */

        // $this->publishes(array_merge([
        //     __DIR__ . '/defaults/.env.setup' => config_path('../.env.setup'),
        //     __DIR__ . '/defaults/phpcs.xml' => config_path('../phpcs.xml'),
        //     __DIR__ . '/defaults/gitignore' => config_path('../.gitignore'),
        //     __DIR__ . '/SlackLog/config/slackLog.php' => config_path('./slackLog.php'),
        //     __DIR__ . '/defaults/app/Traits/Models/ModelTrait.php' => config_path('../app/Traits/Models/ModelTrait.php'),
        //     __DIR__ . '/defaults/app/Models/Model.php' => config_path('../app/Models/Model.php'),
        //     __DIR__ . '/defaults/app/Models/ModelAuthenticatable.php' => config_path('../app/Models/ModelAuthenticatable.php'),
        //     __DIR__ . '/defaults/app/Models/ModelCompoships.php' => config_path('../app/Models/ModelCompoships.php')
        // ], $langEn, $langJa), 'all');

        $this->publishes(array_merge([
            __DIR__ . '/defaults/resources/views/layouts/auth/app.blade.php' => config_path('../resources/views/layouts/auth/app.blade.php'),
            __DIR__ . '/defaults/resources/views/layouts/auth/aside.blade.php' => config_path('../resources/views/layouts/auth/aside.blade.php'),
            __DIR__ . '/defaults/resources/views/layouts/auth/content-header.blade.php' => config_path('../resources/views/layouts/auth/content-header.blade.php'),
            __DIR__ . '/defaults/resources/views/layouts/auth/header.blade.php' => config_path('../resources/views/layouts/auth/header.blade.php'),

            __DIR__ . '/defaults/resources/views/layouts/common/app.blade.php' => config_path('../resources/views/layouts/common/app.blade.php'),

            __DIR__ . '/defaults/public/images/common/logo.svg' => config_path('../public/images/common/logo.svg'),

            __DIR__ . '/defaults/resources/views/assets/js/common/asset-js-toastr-message.blade.php' => config_path('../resources/views/assets/js/common/asset-js-toastr-message.blade.php'),
            __DIR__ . '/defaults/public/js/toastr-message.js' => config_path('../public/js/toastr-message.js'),

            __DIR__ . '/defaults/resources/views/pages/auth/dashboard/index.blade.php' => config_path('../resources/views/pages/auth/dashboard/index.blade.php'),
            __DIR__ . '/defaults/resources/views/pages/guest/auth/login.blade.php' => config_path('../resources/views/pages/guest/auth/login.blade.php'),

            __DIR__ . '/defaults/app/Traits/Model/ModelTrait.php' => config_path('../app/Traits/Model/ModelTrait.php'),
            __DIR__ . '/defaults/app/Models/Model.php' => config_path('../app/Models/Model.php'),
            __DIR__ . '/defaults/app/Models/ModelAuthenticatable.php' => config_path('../app/Models/ModelAuthenticatable.php'),
            __DIR__ . '/defaults/app/Models/ModelCompoships.php' => config_path('../app/Models/ModelCompoships.php'),

            __DIR__ . '/defaults/.env.setup' => config_path('../.env.setup'),
            // __DIR__ . '/defaults/gitignore' => config_path('../.gitignore'),
            // __DIR__ . '/SlackLog/config/slackLog.php' => config_path('./slackLog.php')
        ], $langEn, $langJa), 'starter');

        /** ROOT DIR */

        // $this->publishes([
        //     __DIR__ . '/defaults/.env.setup' => config_path('../.env.setup')
        // ], 'env');

        // $this->publishes([
        //     __DIR__ . '/defaults/phpcs.xml' => config_path('../phpcs.xml')
        // ], 'phpcs');

        // $this->publishes([
        //     __DIR__ . '/defaults/gitignore' => config_path('../.gitignore')
        // ], 'gitignore');

        /** IRS (Interfaces, Repositories, Services) + Helpers (Globals, Upload) + Traits (ModelCollectionTrait, UploadTrait) */

        // $this->publishes([
        //     __DIR__ . '/defaults/app/Helpers/Globals.php' => config_path('../app/Helpers/Globals.php'),
        //     __DIR__ . '/defaults/app/Helpers/Globals.php.ex' => config_path('../app/Helpers/Globals.php.ex'),
        //     __DIR__ . '/defaults/app/Helpers/Upload.php' => config_path('../app/Helpers/Upload.php'),
        //     __DIR__ . '/defaults/app/Interfaces/ExampleRepositoryInterface.php.ex' => config_path('../app/Interfaces/ExampleRepositoryInterface.php.ex'),
        //     __DIR__ . '/defaults/app/Providers/RepositoryServiceProvider.php' => config_path('../app/Providers/RepositoryServiceProvider.php'),
        //     __DIR__ . '/defaults/app/Repositories/ExampleEloquentRepository.php.ex' => config_path('../app/Repositories/ExampleEloquentRepository.php.ex'),
        //     __DIR__ . '/defaults/app/Repositories/MainEloquentRepository.php' => config_path('../app/Repositories/MainEloquentRepository.php'),
        //     __DIR__ . '/defaults/app/Services/ExampleService.php.ex' => config_path('../app/Services/ExampleService.php.ex'),
        //     __DIR__ . '/defaults/app/Services/MainService.php' => config_path('../app/Services/MainService.php'),
        //     __DIR__ . '/defaults/app/Traits/ModelCollectionTrait.php' => config_path('../app/Traits/ModelCollectionTrait.php'),
        //     __DIR__ . '/defaults/app/Traits/UploadTrait.php' => config_path('../app/Traits/UploadTrait.php'),
        //     __DIR__ . '/defaults/config/upload.php' => config_path('../config/upload.php'),
        // ], 'irs');

        /** CONFIG DIR */

        // $this->publishes([
        //     __DIR__ . '/SlackLog/config/slackLog.php' => config_path('./slackLog.php')
        // ], 'slackLog');

        /** LOCALE DIR */

        // $this->publishes(array_merge($langEn, $langJa), 'lang');
        // $this->publishes($langEn, 'langEn');
        // $this->publishes($langJa, 'langJa');

        /** MODELS DIR */

        // $this->publishes([
        //     __DIR__ . '/defaults/app/Traits/Models/ModelTrait.php' => config_path('../app/Traits/Models/ModelTrait.php'),
        //     __DIR__ . '/defaults/app/Models/Model.php' => config_path('../app/Models/Model.php'),
        //     __DIR__ . '/defaults/app/Models/ModelAuthenticatable.php' => config_path('../app/Models/ModelAuthenticatable.php'),
        //     __DIR__ . '/defaults/app/Models/ModelCompoships.php' => config_path('../app/Models/ModelCompoships.php')
        // ], 'model');

        /** BLADE TEMPLATES */

        // $this->publishes([
        //     __DIR__ . '/defaults/resources/views/layouts/common/app.blade.php' => config_path('../resources/views/layouts/common/app.blade.php'),
        //     __DIR__ . '/defaults/resources/views/layouts/common/app.blade.php' => config_path('../resources/views/layouts/common/app.blade.php'),
        //     __DIR__ . '/defaults/resources/views/assets/js/common/asset-js-toastr-message.blade.php' => config_path('../resources/views/assets/js/common/asset-js-toastr-message.blade.php'),
        //     __DIR__ . '/defaults/public/js/toastr-message.js' => config_path('../public/js/toastr-message.js'),
        // ], 'blade-templates');
    }
}
