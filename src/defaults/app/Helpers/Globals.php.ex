<?php

namespace App\Helpers;

use App\Helpers\Upload;
use App\Interfaces\ExampleRepositoryInterface;
use App\Models\Example;

class Globals
{
    /*======================================================================
     * STATIC METHODS
     *======================================================================*/

    /**
     * Globals::hUpload()
     * return a helper class (Upload)
     *
     * @return Upload
     */
    public static function hUpload()
    {
        return Upload::class;
    }

    /**
     * Globals::mExample()
     * return a model class (Example)
     *
     * @return Example
     */
    public static function mExample()
    {
        return Example::class;
    }

    /**
     * Globals::iExample()
     * return a interface class (Example)
     *
     * @return ExamplePlanRepositoryInterface
     */
    public static function iExample()
    {
        return ExamplePlanRepositoryInterface::class;
    }
}
