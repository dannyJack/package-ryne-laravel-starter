<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Models\ParentModel;

class MainModelAuthenticatable extends Authenticatable
{
    use ParentModel;

    /**
     * @var $appends
     */
    protected $appends = [
        'id',
        'isEmpty',
        'isNotEmpty',
    ];
}
