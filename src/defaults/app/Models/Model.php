<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Md;
use App\Traits\Models\ModelTrait;

class Model extends Md
{
    use ModelTrait;

    /**
     * @var $appends
     */
    protected $appends = [
        'id',
        'isEmpty',
        'isNotEmpty',
    ];
}
