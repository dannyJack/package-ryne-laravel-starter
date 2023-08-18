<?php

namespace App\Managers;

use App\Responses\ManagerResponse;

class Manager
{
    public function response(): ManagerResponse
    {
        return new ManagerResponse();
    }
}
