<?php

namespace Ryne\LaravelStarter;

use Ryne\LaravelStarter\Interfaces\LogInterface;

class Logs implements LogInterface
{
    public static function info(string $message, $params = null)
    {
        $message = LogHelper::constructMessage(LogHelper::TYPE_INFO, $message, $params);
        \Log::info($message);
    }

    public static function error(string $message, $params = null)
    {
        $message = LogHelper::constructMessage(LogHelper::TYPE_INFO, $message, $params);
        \Log::info($message);
    }

    public static function warning(string $message, $params = null)
    {
        $message = LogHelper::constructMessage(LogHelper::TYPE_INFO, $message, $params);
        \Log::info($message);
    }
}
