<?php

namespace App\Services;

use Prophecy\ServicePacker\Service\Service as BaseService;
use Prophecy\ServicePacker\Traits\Crudable;
use App\Repositories\PostRepository as PostRepo;
class PostService extends BaseService
{
    use Crudable;

    protected function setRepository() : string
    {
        return \App\Repositories\PostRepository::class;
    }
}
