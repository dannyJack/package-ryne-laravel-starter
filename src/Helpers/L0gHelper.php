<?php

namespace Ryne\LaravelStarter\Helpers;

use Ryne\LaravelStarter\Consts\L0gConst;

class L0gHelper
{
    private $channel = null;

    /*======================================================================
    .* CONSTRUCTOR
    .*======================================================================*/

    /**
     * @param String $channel - Log channel to be used
     */
    public function __construct($channel)
    {
        $this->channel = $channel;
    }

    /*======================================================================
    .* PUBLIC METHODS
    .*======================================================================*/

    /**
     * info($message)
     * call the out() method
     *
     * @param String $message
     * @param Object|Array|String|Int ...$params
     * @return void
     */
    public function info($message, ...$params)
    {
        $message = self::constructMessage(L0gConst::TYPE_INFO, $message, $params);
        $this->out(L0gConst::TYPE_INFO, $message);
    }

    /**
     * error($message)
     * call the out() method
     *
     * @param String $message
     * @param Object|Array|String|Int ...$params
     */
    public function error($message, ...$params)
    {
        $message = self::constructMessage(L0gConst::TYPE_ERROR, $message, $params);
        $this->out(L0gConst::TYPE_ERROR, $message);
    }

    /**
     * out($type, $message)
     * call the laravel Log method
     * 
     * @param String|L0gConst::TYPE_ $type - Log type
     * @param String $message - message to be output
     */
    public function out($type, $message)
    {
        if ($type == L0gConst::TYPE_ERROR) {
            if (!empty($this->channel)) {
                \Log::channel($this->channel)->error($message);
            } else {
                \Log::error($message);
            }
        } else {
            if (!empty($this->channel)) {
                \Log::channel($this->channel)->info($message);
            } else {
                \Log::info($message);
            }
        }
    }

    /*======================================================================
    .* STATIC METHODS
    .*======================================================================*/

    /**
     * L0gHelper::constructMessage($type, $message)
     * construct message for information/error log
     *
     * @param L0gHelper::TYPE_ (String) $type
     * @param String $message
     * @param Array $params [title][code][user][otherDetails][traceCount][...]
     * @return String $logMessage;
     */
    public static function constructMessage($type, $message, $params = [])
    {
        $backTraceCount = 3;
        $date_now = date('Y/m/d H:i:s');
        $logMessage = "";
        $additionalDetails = [];
        $debug_trace = debug_backtrace();

        if (empty($params)) {
            $params = [];
        } elseif (!is_array($params) && !is_object($params)) {
            $params = [$params];
        }

        $params2 = [];
        foreach ($params as $p) {
            if (is_object($p)) {
                $p = json_decode(json_encode($p), true);
            }
            
            if (!is_array($p)) {
                $params2[] = $p;
            } else {
                $params2 = array_merge($params2, $p);
            }
        }
        $params = $params2;

        // Title
        if (count($params) != 0 ? !empty($params['title']) : false) {
            $logMessage .= $params['title'] . ' ';
        }
        
        if (!empty($debug_trace[1])) {
            if (isset($debug_trace[1]['file'])) {
                if (!empty($debug_trace[1]['file']) && !empty($debug_trace[1]['line'])) {
                    $_file = explode('/', $debug_trace[1]['file']);
                    $_file = end($_file);
                    $logMessage .= "***" . $_file;
                    if (!empty($debug_trace[2]['function'])) {
                        $logMessage .= "@" . $debug_trace[2]['function'];
                    }
                    $logMessage .= ':' . $debug_trace[1]['line'] . '***';
                }
            }
        }

        // Message details
        if (count($params) != 0 ? !empty($params['code']) : false) {
            $logMessage .= "\nCode: \"" . $params['code'] . '"';
        }

        if (!empty($message)) {
            $logMessage .= "\nMessage: \"" . $message . '"';
        }

        // User details
        if (count($params) != 0 ? !empty($params['user']) : false) {
            $user = $params['user'];
            if (is_object($user)) {
                $user = json_decode(json_encode($user), true);
            }
            
            $str = '';
            if (is_array($user)) {
                $ctr = 0;
                foreach ($user as $ind => $u) {
                    $str .= "✦";
                    $str .= $ind . ": ";
                    if (is_array($u)) {
                        $str .= json_encode($u);
                    } elseif (is_bool($u)) {
                        $str .= (int)$u;
                    } else {
                        $str .= $u;
                    }
                    $ctr++;
                }
            } elseif (is_bool($user)) {
                $str = (int)$user;
            } else {
                $str = $user;
            }

            if (!empty($str)) {
                $logMessage .= "\nUser account";
                if (!empty($user['id'])) {
                    $logMessage .= " #" . $user['id'] . ':';
                } else {
                    $logMessage .= ":";
                }
                $logMessage .= $str;
            }
        }
        
        // Other top details
        $ctr = 0;
        $otherTopDetailsStr = '';
        foreach ($params as $id => $p) {
            if ($id != 'title' && $id != 'code' && $id != 'user' && $id != 'otherDetails' && $id != 'traceCount') {
                if ($ctr != 0) {
                    $otherTopDetailsStr .= "\n";
                }

                if (is_array($p)) {
                    $str = '';
                    foreach ($p as $id2 => $p2) {
                        $str .= "✦";
                        $str .= $id2 . ": ";
                        if (is_array($p2)) {
                            $str .= json_encode($p2);
                        } elseif (is_bool($p2)) {
                            $str .= (int)$p2;
                        } else {
                            $str .= $p2;
                        }
                    }
                    $otherTopDetailsStr .= '| ' . $id . ': ' . $str;
                } elseif (is_bool($p)) {
                    $str = (int)$p;
                    $otherTopDetailsStr .= '| ' . $id . ': ' . $str;
                } else {
                    $str = $p;
                    $otherTopDetailsStr .= '| ' . $id . ': ' . $str;
                }
                $ctr++;
            }
        }
        
        if (!empty($otherTopDetailsStr)) {
            $logMessage .= "\n" . $otherTopDetailsStr;
        }

        // Backtrace count
        if (count($params) != 0 ? !empty($params['traceCount']) : false) {
            $backTraceCount = $params['traceCount'];
        }

        // Function back trace
        $backtrace_file = null;
        $BF_file = '';
        $BF_line = '';
        $BF_function = '';

        if (!empty($debug_trace)) {
            if (!empty($debug_trace[0])) {
                if (!empty($debug_trace[1])) {
                    $backtrace_file = $debug_trace[1];
                    if (!empty($backtrace_file['function'])) {
                        $BF_function = $backtrace_file['function'];
                    }
                }

                $backtrace_file = $debug_trace[0];
                if (!empty($backtrace_file['file'])) {
                    $BF_file = $backtrace_file['file'];
                }
                if (!empty($backtrace_file['line'])) {
                    $BF_line = $backtrace_file['line'];
                }

                if (!empty($debug_trace[0]['file'])) {
                    $logMessage .= "\n\nFile trace:";
                    $logMessage .= "\n\tfile:";
                    foreach ($debug_trace as $ind => $trace) {
                        if ($ind > ($backTraceCount - 1)) {
                            break;
                        }
                        $logMessage .= "\n\t\t" . (isset($trace['file']) ? $trace['file'] : '');
                        if (!empty($trace['line'])) {
                            $logMessage .= '@' . $trace['line'];
                        }
                        if (!empty($debug_trace[$ind + 1])) {
                            if (!empty($debug_trace[$ind + 1]['function'])) {
                                $logMessage .= ' Function: ' . $debug_trace[$ind + 1]['function'] . '()';
                            }
                        }
                    }
                }
            }
        }

        if (count($params) != 0 ? !empty($params['otherDetails']) : false) {
            $others = $params['otherDetails'];
            if (!empty($others)) {
                $logMessage .= "\nOther Details:";
                if (is_object($others)) {
                    $others = json_decode(json_encode($others), true);
                }

                if (is_array($others)) {
                    foreach ($others as $o) {
                        if (!empty($o)) {
                            $logMessage .= "\n\t\"" . $o . '"';
                        }
                    }
                } elseif (is_string($others)) {
                    $logMessage .= "\n\t\"" . $others . '"';
                }
            }
        }

        $logMessage .= "\n__________________________________________________________________________________________________";
        return $logMessage;
    }
}
