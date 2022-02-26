<?php
namespace RyneLaraverStarter\L0g;

class L0g
{
    /*======================================================================
     * CONSTANTS
     *======================================================================*/

    const DEBUGTRACE_CNT = 3;

    const TYPE_INFO = 'info';
    const TYPE_ERROR = 'error';

    /*======================================================================
     * STATIC METHODS
     *======================================================================*/

    /**
     * L0g::info($message)
     * call the self::out() method
     * 
     * @param String $message
     */
    public static function info($message, ...$params)
    {
        $message = self::constructMessage(self::TYPE_INFO, $message, $params);
        self::out(self::TYPE_INFO, $message);
    }

    /**
     * L0g::error($message)
     * call the self::out() method
     * 
     * @param String $message
     */
    public static function error($message, ...$params)
    {
        $message = self::constructMessage(self::TYPE_ERROR, $message, $params);
        self::out(self::TYPE_ERROR, $message);
    }
    
    /**
     * L0g::out($type, $message)
     * output logs information/error messages
     *
     * @param L0g::TYPE_ (String) $type
     * @param String $message
     */
    private static function out($type, $message)
    {
        $newFile = false;

        $logPath = GLOBAL_SERVER_STORAGE_PATH;
        if (!file_exists($logPath)) {
            mkdir($logPath, 0777);
        }
        $logPath = GLOBAL_SERVER_STORAGE_PATH . 'logs';
        if (!file_exists($logPath)) {
            mkdir($logPath, 0777);
        }

        $filePath = $logPath . '/' . date('Y-m-d') . '.txt';
        if (!file_exists($filePath)) {
            $newFile = true;
            $myfile = fopen($filePath, "w");
            fclose($myfile);
        }

        $myfile = fopen($filePath, "a") or die("Unable to open file!");
        if (!is_string($message) && !is_bool($message) && !is_numeric($message)) {
            $message = json_encode($message);
        }
        if ($type == self::TYPE_INFO) {
            $type = 'INFO';
        } elseif ($type == self::TYPE_ERROR) {
            $type = 'ERROR';
        }

        $message = date('Y/m/d H:i:s') . " " . $type . ": " . $message;
        if ($newFile) {
            fwrite($myfile, $message);
        } else {
            fwrite($myfile, "\n". $message);
        }

        fclose($myfile);
    }
    
    /**
     * L0g::constructMessage($type, $message)
     * construct message for information/error log
     *
     * @param L0g::TYPE_ (String) $type
     * @param String $message
     * @param Array $params [title][code][user][otherDetails][traceCount][...]
     * @return String $logMessage;
     */
    private static function constructMessage($type, $message, $params = [])
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
                foreach($user as $ind => $u) {
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
        foreach($params as $id => $p) {
            if ($id != 'title' && $id != 'code' && $id != 'user' && $id != 'otherDetails' && $id != 'traceCount') {
                if ($ctr != 0) {
                    $otherTopDetailsStr .= "\n";
                }

                if (is_array($p)) {
                    $str = '';
                    foreach($p as $id2 => $p2) {
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
                    foreach($debug_trace as $ind => $trace) {
                        if ($ind > ($backTraceCount - 1)) {
                            break;
                        }
                        $logMessage .= "\n\t\t" . $trace['file'];
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
            if(!empty($others)) {
                $logMessage .= "\nOther Details:";
                if (is_object($others)) {
                    $others = json_decode(json_encode($others), true);
                }

                if (is_array($others)) {
                    foreach($others as $o) {
                        if(!empty($o)) { 
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