<?php

namespace Ryne\LaravelStarter;

use Ryne\LaravelStarter\Helpers\LogHelper;
use Ryne\LaravelStarter\Interfaces\LogInterface;

class L0g implements LogInterface
{
    /*======================================================================
    .* STATIC METHODS
    .*======================================================================*/

    /**
     * L0g::info($message)
     * call the LogHelper::constructMessage() method
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function info(string $message, ...$params)
    {
        $message = LogHelper::constructMessage(LogHelper::TYPE_INFO, $message, $params);
        \Log::info($message);
    }

    /**
     * L0g::error($message)
     * call the self::constructMessage() method
     *
     * @param string $message
     * @param object|array|string|int ...$params
     */
    public static function error($message, ...$params)
    {
        $message = LogHelper::constructMessage(LogHelper::TYPE_ERROR, $message, $params);
        \Log::error($message);
    }

    /**
     * L0g::warning($message)
     * call the self::constructMessage() method
     *
     * @param string $message
     * @param object|array|string|int ...$params
     */
    public static function warning($message, ...$params)
    {
        $message = LogHelper::constructMessage(LogHelper::TYPE_ERROR, $message, $params);
        \Log::error($message);
    }

    /**
     * L0g::channel($channel)
     * new instantiation of class LogHelper
     *
     * @param string $channel
     */
    public static function channel($channel)
    {
        $rtn = new LogHelper($channel);

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
