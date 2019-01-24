<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Http\Resources\PostCollection;
use App\Http\Resources\GenericResponseResource as GenericResponse;

class Index extends Controller
{
    private $postSvc;

    public function __construct(PostService $postSvc)
    {
        $this->postSvc = $postSvc;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        if(auth()->user()->isAdmin() || auth()->user()->isModerator()) {
            $posts = $this->postSvc->all();
        } else {

            $posts = $this->postSvc->getPosts(auth()->user()->id);
        }

        if(count($posts) < 1) {
            $response['message'] = 'Sorry,there are no posts in database';
            return new GenericResponse($response);
        }

        return new GenericResponse($posts);
    }
}
