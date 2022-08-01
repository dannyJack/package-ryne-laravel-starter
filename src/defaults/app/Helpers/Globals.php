<?php

namespace App\Helpers;

class Globals
{
    /*======================================================================
     * CONSTANTS
     *======================================================================*/

    const FILETYPE_IMAGE = 'image';
    const FILETYPE_CSV = 'csv';

    const CSV_ACCEPTEDEXTENSION = ['csv'];
    const CSV_ACCEPTEDMIMES = ['csv', 'xlsx'];
    const IMG_ACCEPTEDEXTENSION = ['gif', 'jpg', 'jpeg', 'png'];

    /*======================================================================
     * STATIC METHODS
     *======================================================================*/

    /**
     * Globals::__()
     * return a concatenated by lang/locale by space (" ")
     *
     * @param Strin/Int/Object/Array $trans
     * @return String $rtn
     */
    public static function __($trans)
    {
        $rtn = '';

        if (!is_array($trans)) {
            $trans = [$trans];
        }

        foreach ($trans as $ind => $tran) {
            if ($ind != 0) {
                $rtn .= ' ';
            }

            $rtn .= __($tran);
        }

        return $rtn;
    }

    /**
     * Globals::__values()
     * return an array with translated values
     *
     * @param Array $data
     * @return Array $rtn
     */
    public static function __values(array $data)
    {
        $rtn = $data;

        foreach ($data as $key => $val) {
            $rtn[$key] = __($val);
        }

        return $rtn;
    }

    /**
     * Globals::implode()
     * return a concatenated array with a set of character string combination
     *
     * @param Array $array
     * @param String $delimeter
     * @param String/Null $pre - prefix to be added every loop
     * @return String $rtn
     */
    public static function implode($array, $delimeter, $pre = null)
    {
        $rtn = '';

        foreach ($array as $ind => $ar) {
            if ($ind != 0) {
                $rtn .= $delimeter;
            }

            if (!empty($pre)) {
                $rtn .= $pre;
            }

            $rtn .= $ar;
        }

        return $rtn;
    }

    /**
     * Globals::paginateLinks($paginatedList, $blade)
     *
     * @param LengthAware $paginatedList
     * @param String|Null $blade
     */
    public static function paginateLinks($paginatedList, $blade = null)
    {
        $requestData = request()->all();

        if (!empty($blade)) {
            $rtn = $paginatedList->appends(collect($requestData)->reject(function ($item, $key) {
                return strpos($key, '//') !== false;
            })->map(function ($item, $key) {
                return empty($item) ? '' : $item;
            })->toArray())->links($blade);
        } else {
            $rtn = $paginatedList->appends(collect($requestData)->reject(function ($item, $key) {
                return strpos($key, '//') !== false;
            })->map(function ($item, $key) {
                return empty($item) ? '' : $item;
            })->toArray())->links();
        }

        return $rtn;
    }

    /**
     * Globals::outputInputHiddeSearchParam($isReturn)
     *
     * @param Bool $isReturn
     * @param String $rtn
     */
    public static function outputInputHiddeSearchParam($isReturn = false)
    {
        $rtn = '';
        $params = request()->all();

        foreach ($params as $key => $val) {
            if (strpos($key, '//') === false) {
                $rtn .= '<input type="hidden" name="' . $key . '" value="' . $val . '" />';
            }
        }

        if ($isReturn) {
            return $rtn;
        } else {
            echo $rtn;
        }
    }
}
