<?php

/**
 * _vers($urlFile, $onlyVersion)
 * File versioning e.g css and js files (version is generated by date last modified)
 *
 * @param String $urlFile = URL file path
 * @param Bool $onlyVersion = return only the file version
 * @return String $url = Full URL file path
 */
if (!function_exists('_vers')) {
    function _vers($urlFile, $onlyVersion = false)
    {
        $url = url($urlFile);
        $version = '';

        $path = public_path($urlFile);
        if (file_exists($path)) {
            $version = filemtime($path);
            $url .= '?v=' . $version;
        }

        if ($onlyVersion) {
            return $version;
        }

        return $url;
    }
}

/**
 * _trim($string, $limit, $withSuffix)
 * Trim a string with limit characters & optional ellipsis
 * 
 * @param String $string - string to be trim
 * @param Int $limit - the character limit for the string
 * @param String/Bool $withSuffix - optional with suffix after the limit, can be set to False
 * @return String
 */
if (!function_exists('_trim')) {
    function _trim($string, $limit = 50, $withSuffix = '...') {
        if (empty($withSuffix)) {
            $withSuffix = '';
        }

        return \Illuminate\Support\Str::limit($string ?? '', $limit, $withSuffix);
    }
}

/**
 * _trimText($string, $limit, $withSuffix)
 * Trim a string with limit characters & optional ellipsis (and remove html tags)
 * 
 * @param String $string - string to be trim
 * @param Int $limit - the character limit for the string
 * @param String/Bool $withSuffix - optional with suffix after the limit, can be set to False
 * @return String
 */
if (!function_exists('_trimText')) {
    function _trimText($string, $limit = 50, $withSuffix = '...') {
        $string = strip_tags($string);
        return _trim($string, $limit, $withSuffix);
    }
}

/**
 * _isRoute($routename)
 * Check current route name
 * 
 * @param String $routeName - the route name to be check
 * @return String [$name,'active','']
 */
if (!function_exists('_isRoute')) {
    function _isRoute($routeName = null)
    {
        $rtn = '';
        $name = \Request::route()->action['as'];

        if (is_null($routeName)) {
            $rtn = $name;
        } else {
            if (!empty($name)) {
                if (is_array($routeName)) {
                    if (in_array($name, $routeName)) {
                        $rtn = 'active';
                    }
                } elseif ($name == $routeName) {
                    $rtn = 'active';
                }
            }
        }

        return $rtn;
    }
}