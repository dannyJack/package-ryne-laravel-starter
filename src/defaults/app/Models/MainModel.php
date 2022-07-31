<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\ParentModel;

class MainModel extends Model
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
