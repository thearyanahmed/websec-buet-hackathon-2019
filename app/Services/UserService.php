<?php

namespace App\Services;

use Prophecy\ServicePacker\Service\Service as BaseService;
use Prophecy\ServicePacker\Traits\Crudable;
use App\Repositories\UserRepository;

class UserService extends BaseService
{
    use Crudable;

    protected function setRepository() : string
    {
        return UserRepository::class;
    }
}
