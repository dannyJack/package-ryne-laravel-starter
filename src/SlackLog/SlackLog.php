<?php

namespace Ryne\LaravelStarter\SlackLog;

class SlackLog
{
    /*======================================================================
     * STATIC METHODS
     *======================================================================*/

    /**
     * SlackLog::info($message)
     * send slack log information message
     *
     * @param String $message
     * @return void
     */
    public static function info($message)
    {
        if (config('slackLog.enable', false)) {
            if (!empty(config('slackLog.webhookUrl', ''))) {
                $message = self::preProcessMessage($message);
                \Log::channel('slack')->info($message);
            } else {
                \Ryne\LaravelStarter\L0g::error('Slack Log is not working properly.', [
                    'slackLog.enable' => config('slackLog.enable', false),
                    'slackLog.webhookUrl' => config('slackLog.webhookUrl', ''),
                ]);
            }
        }
    }

    /**
     * SlackLog::error($message)
     * send slack log error message
     *
     * @param String $message
     * @return void
     */
    public static function error($message)
    {
        if (config('slackLog.enable', false)) {
            if (!empty(config('slackLog.webhookUrl', ''))) {
                $message = self::preProcessMessage($message);
                \Log::channel('slack')->error($message);
            } else {
                \Ryne\LaravelStarter\L0g::error('Slack Log is not working properly.', [
                    'slackLog.enable' => config('slackLog.enable', false),
                    'slackLog.webhookUrl' => config('slackLog.webhookUrl', ''),
                ]);
            }
        }
    }
    
    /*======================================================================
     * PRIVATE STATIC METHODS
     *======================================================================*/

    /**
     * SlackLog::message($message)
     * pre-processing message
     *
     * @param String $message
     * @return String $rtn
     */
    private static function preProcessMessage($message)
    {
        $rtn = $message;

        if (!empty(config('slackLog.projectName', ''))) {
            $str = 'Project Name: ' . config('slackLog.projectName', '') . "\n";
            $rtn = $str . $message;
        }

        return $rtn;
    }
}
