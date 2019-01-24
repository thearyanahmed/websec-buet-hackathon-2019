<?php

namespace App\Services;

use Prophecy\ServicePacker\Service\Service as BaseService;
use Prophecy\ServicePacker\Traits\Crudable;
use App\Repositories\PostRepository;

class PostService extends BaseService
{
    use Crudable;

    private $postRepo;
    
    public function __construct(PostRepository $postRepository)
    {
    	$this->postRepo = $postRepository;
    }

    protected function setRepository() : string
    {
        return PostRepository::class;
    }

    public function getPosts(int $userid)
    {
    	$conds = [['status','=',1]];
        $secondaryConds = [['user_id','=',$userid]];
            
    	return $this->postRepo->instance()->where($conds)->orWhere($secondaryConds)->get();
    }
}
