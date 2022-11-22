<?php

namespace Ryne\LaravelStarter;

use Ryne\LaravelStarter\Consts\L0gConst;
use Ryne\LaravelStarter\Helpers\L0gHelper;

class L0g
{
    /*======================================================================
    .* STATIC METHODS
    .*======================================================================*/

    /**
     * L0g::info($message)
     * call the L0gHelper::constructMessage() method
     *
     * @param String $message
     * @param Object|Array|String|Int ...$params
     * @return void
     */
    public static function info($message, ...$params)
    {
        $message = L0gHelper::constructMessage(L0gConst::TYPE_INFO, $message, $params);
        \Log::info($message);
    }

    /**
     * L0g::error($message)
     * call the self::constructMessage() method
     *
     * @param String $message
     * @param Object|Array|String|Int ...$params
     */
    public static function error($message, ...$params)
    {
        $message = L0gHelper::constructMessage(L0gConst::TYPE_ERROR, $message, $params);
        \Log::error($message);
    }

    /**
     * L0g::channel($channel)
     * new instantiation of class L0gHelper
     *
     * @param String $channel
     */
    public static function channel($channel)
    {
        $rtn = new L0gHelper($channel);

        return $rtn;
    }

    // /**
    //  * L0g::slackInfo($message)
    //  * send slack log information message
    //  *
    //  * @param String $message
    //  * @param Object|Array|String|Int ...$params
    //  * @return void
    //  */
    // public static function slackInfo($message, ...$params)
    // {
    //     if (config('slackLog.enable')) {
    //         if (!empty(config('slackLog.webhookUrl'))) {
    //             \Log::channel('slack')->info($message);
    //         } else {
    //             \L0g::error('Slack Log is not working properly.', [
    //                 'slackLog.enable' => config('slackLog.enable'),
    //                 'slackLog.webhookUrl' => config('slackLog.webhookUrl'),
    //             ]);
    //         }
    //     }
    // }

    // /**
    //  * L0g::slackError($message)
    //  * send slack log error message
    //  *
    //  * @param String $message
    //  * @param Object|Array|String|Int ...$params
    //  * @return void
    //  */
    // public static function slackError($message, ...$params)
    // {
    //     if (config('slackLog.enable')) {
    //         if (!empty(config('slackLog.webhookUrl'))) {
    //             \Log::channel('slack')->error($message);
    //         } else {
    //             \L0g::error('Slack Log is not working properly.', [
    //                 'slackLog.enable' => config('slackLog.enable'),
    //                 'slackLog.webhookUrl' => config('slackLog.webhookUrl'),
    //             ]);
    //         }
    //     }
    // }
}
