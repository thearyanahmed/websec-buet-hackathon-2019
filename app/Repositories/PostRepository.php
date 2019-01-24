<?php

namespace App\Repositories;

use Prophecy\ServicePacker\Repository\Repository as BaseRepository;

class PostRepository extends BaseRepository
{
    protected function setModel() : string
    {
        return \App\Models\Post::class;
    }
}
